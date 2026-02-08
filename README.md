Thesara Cosmetics 🛍️✨

Project Overview
Thesara Cosmetics is a modern e-commerce platform for skincare products, combining shopping convenience with AI-powered personalized recommendations. Users can browse products, get skincare advice from our chatbot, and make purchases seamlessly.

Developed as a Final Year Project (FYP) by a team of three:
Hassan – AI Chatbot Integration
Zaid – Frontend Development (HTML, CSS, JavaScript, Bootstrap)
Tahreem Arshad – Backend & Admin Panel (Laravel, PHP, MySQL)

🎯 Key Features
User Features
Browse skincare products with detailed descriptions
Add products to cart & complete secure checkout
Personalized skincare suggestions via AI chatbot
Responsive design for all devices
Admin Features
Manage products, orders, and user activities
Dashboard for sales, analytics, and reports
Role-based access and secure authentication

AI Features
Personalized skincare recommendations
Interactive AI chatbot for queries
Continuous learning for better suggestions

💻 Technologies Used
Layer	Technologies / Tools
Frontend	HTML5, CSS3, JavaScript, Bootstrap
Backend / Admin	Laravel, PHP, MySQL
AI Integration	Python-based chatbot
Version Control	Git & GitHub
Deployment	[Your hosting platform]
🌟 Demo


GIF demo showing homepage, AI chatbot interaction, and checkout process.

📸 Screenshots

Home Page


Product Page


Admin Dashboard


🚀 Installation & Setup

Clone the repository:

git clone https://github.com/yourusername/thesara-cosmetics.git


Navigate to the project directory:

cd thesara-cosmetics


Install Laravel dependencies:

composer install


Install Node dependencies & compile assets (if using Bootstrap JS or Laravel Mix):

npm install
npm run dev


Copy .env.example to .env and configure your database & mail settings:

cp .env.example .env


Generate the application key:

php artisan key:generate


Run migrations (with optional seed data):

php artisan migrate --seed


Serve the application locally:

php artisan serve


Visit the application:

http://127.0.0.1:8000

🏗️ Project Structure
thesara-cosmetics/
├── app/                 # Laravel backend logic
├── resources/views/     # Blade templates (frontend & admin)
├── public/              # Assets: CSS, JS, Images
├── routes/              # Web & API routes
├── database/            # Migrations & seeders
├── AI/                  # AI chatbot integration
└── README.md

👨‍💻 Team Members
Name	Role	Responsibilities
Hassan	AI Developer	AI chatbot integration and product suggestions
Zaid	Frontend Developer	HTML, CSS, JavaScript, Bootstrap UI/UX
Tahreem Arshad	Backend / Admin Panel Dev	Laravel backend, admin panel, database management

⚡ Future Enhancements
Payment gateway integration
Advanced AI personalization using user history
Reviews & rating system
Enhanced analytics and reporting


