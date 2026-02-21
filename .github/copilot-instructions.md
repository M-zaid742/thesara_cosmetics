# Thesara Cosmetics - AI Agent Instructions

## Project Overview
Thesara Cosmetics is a Laravel 12 e-commerce platform for skincare products with AI-powered chatbot integration and personalized skincare recommendations. The system supports both customer and admin workflows with separate authentication systems.

**Tech Stack**: Laravel 12 + PHP 8.2, MySQL, Blade templates, Vite bundler, Bootstrap 5.3, JavaScript

---

## Architecture & Data Model

### Core Entities (Eloquent Models)
- **Product** (`app/Models/Product.php`) - Skincare products with relationships to ProductImage, Review, Cart, Order, Wishlist
- **User** (`app/Models/User.php`) - Customers with Cart, Order, Wishlist, Review, SkinAnalysis relationships
- **Admin** (`app/Models/Admin.php`) - Separate from User; has own authentication via `auth:admin` guard
- **Order** + **OrderItem** - Order structure with line items; use OrderItem as pivot
- **Cart** - Acts as intermediate model between User and Product (not just pivot table)
- **Wishlist** - User's saved products
- **SkinAnalysis** - AI skin assessment data for personalized recommendations
- **Review** - Product reviews by users

**Key Pattern**: Models define `$fillable` for mass assignment protection. Relationships are declared as methods returning `hasMany()`, `hasOne()`, etc. See [Product.php](app/Models/Product.php#L11-L60) for examples.

### Route Organization
- **Public routes** ([routes/web.php](routes/web.php#L37-L47)): `/shop`, `/product/{id}`, `/cart`, `/checkout`, `/track-order`
- **Customer auth**: Standard Laravel `Auth::routes()` (login, register)
- **Admin routes**: Prefixed `/admin`, use `auth:admin` middleware, separate LoginController at `AdminAuthController`
- **Key insight**: Admin dashboard and product management are only accessible to admins via `auth:admin` guard

---

## Development Workflow

### Setup
```bash
composer install
npm install
php artisan key:generate
php artisan migrate --seed
```

### Local Development
```bash
php artisan serve          # Start server at http://127.0.0.1:8000
npm run dev                # Watch Vite for asset changes (concurrent with artisan)
```

### Building
```bash
npm run build              # Production Vite build
php artisan optimize       # Laravel optimization
```

### Testing
Tests use **Pest** (see composer.json `require-dev`). Run:
```bash
php artisan test           # Runs Pest test suite
```

---

## Critical Developer Patterns

### Model Relationships
Always define relationships in models; don't use raw queries:
```php
// Bad - don't use
$product->reviews()->get();  // ✅ Good - use this

// Good pattern from ProductController:
Product::with('images')->find($id)  // Eager loading prevents N+1
```

### Form Validation (Request Classes)
Controllers validate via Request classes (though not explicitly shown, follows Laravel conventions):
- Validate `product_id`, `quantity`, `category` in ProductController methods
- Always use `Request::validate()` with rules array
- Custom rules for business logic (e.g., stock availability)

### Authentication Guards
- Default `Auth` guard = customers (User model, routes like `/login`)
- `Auth::guard('admin')` or `auth:admin` middleware = admins (Admin model, routes `/admin/login`)
- **Important**: Do NOT mix guards; check guard in conditional business logic

### Password Handling (User Model)
⚠️ **Non-standard**: User model has custom `setPasswordAttribute()` that checks if value is already hashed before re-hashing. When creating/updating users, pass raw password; the mutator handles hashing.

### Controller Patterns
See [ProductController.php](app/Products/Controllers/ProductController.php):
- `index()` - List with search/filter queries
- `show($id)` - Detail page with eager loading
- `addToCart()` - Uses `Cart::create()` directly
- Always redirect back with session messages: `with('success', '...')`

---

## Frontend Structure

### Views Location
- Customer views: `resources/views/*.blade.php` (e.g., `welcome.blade.php`, `shop.blade.php`)
- Admin views: `resources/views/admin/*` (e.g., `admin.login`, `admin.dashboard`)
- Shared layouts: `resources/views/layouts/*`

### Styling
- **⚠️ Config conflict**: `vite.config.js` has unresolved merge conflict between Tailwind CSS vs SCSS (`resources/sass/app.scss`)
- **Current state**: Bootstrap 5.3.8 is primary CSS framework (+ some SCSS)
- Tailwind may be intended but not fully integrated; clarify before adding new styles
- CSS compiled via Vite with laravel-vite-plugin

### Assets
- Icon/Images: `public/images/`, `public/admin/img/`
- Feature-specific JS: `public/js/{feature}.js` (e.g., `cart.js`, `product.js`)
- Admin plugins: `public/admin/plugins/` (e.g., daterangepicker)

---

## Workflow Integration Points

### AI Chatbot
- Model: `SkinAnalysis` (stores user skin type, preferences, analysis results)
- Controller: `ChatbotController` (handles chatbot requests)
- **Integration pattern**: Receives user skin analysis → stores in DB → recommendations guide product suggestions

### Order Fulfillment
1. User adds Product to Cart (`POST /cart/add` → CartController)
2. Navigate to checkout (`/checkout` → PageController)
3. Create Order + OrderItems
4. User tracks order (`GET /track-order/result` → TrackController)

### Notifications
- Model: `Notification` (related to User)
- Likely used for: order updates, chatbot responses, new product alerts
- Implementation: Check `NotificationController` and migration details

---

## Common Tasks & File Locations

| Task | Primary Files |
|------|----------------|
| Add new product field | Migrate: `database/migrations/2026_01_30_134913_create_products_table.php`, Model: `app/Models/Product.php` |
| Create admin feature | Route: `routes/web.php` prefix('admin'), Controller: `app/Http/Controllers/Admin/`, View: `resources/views/admin/` |
| Modify customer auth | Auth routes auto-loaded via `Auth::routes()`, Controllers: `app/Http/Controllers/Auth/` |
| Add product filters | ProductController `index()` method, update search/category query builder |
| Style new components | Add CSS to `resources/sass/app.scss` (or clarify Tailwind if migrating) |
| Create API endpoint | Use Sanctum tokens (`laravel/sanctum` in composer.json); consider separate route group |

---

## Known Issues & Quirks

1. **Unresolved merge conflict**: `package.json` and `vite.config.js` have conflicts between Tailwind CSS and SCSS setup — need to resolve which is primary
2. **Custom password hashing**: User model's `setPasswordAttribute()` is non-standard; ensure compatibility with Laravel password resets
3. **Separate admin auth**: Admin model uses custom authentication guard; not using Laravel's default admin scaffolding
4. **Limited tests**: Only `ExampleTest.php` exists; no comprehensive test coverage established

---

## Quick Command Reference

```bash
# Database
php artisan migrate --seed              # Run migrations + seeders
php artisan migrate:rollback            # Rollback last batch
php artisan tinker                      # Interactive shell (debug models)

# Asset bundling
npm run dev                             # Watch mode
npm run build                           # Production build (must run before deployment)

# Cache & optimization
php artisan cache:clear                 # Clear Laravel cache
php artisan config:cache                # Cache config
php artisan optimize                    # Full optimization

# Debugging
php artisan route:list                  # Show all routes
php artisan model:show Product          # Inspect model structure
```

---

## When Modifying Code

- **Database changes**: Always create migration before modifying model
- **Adding routes**: Use consistent prefix grouping (admin routes use `prefix('admin')`)
- **New models**: Use `php artisan make:model ModelName -m` to gen model + migration
- **Auth changes**: Test both User and Admin guards to ensure proper isolation
- **Frontend updates**: Use existing CSS framework (Bootstrap) unless migrating to Tailwind; coordinate with team first

