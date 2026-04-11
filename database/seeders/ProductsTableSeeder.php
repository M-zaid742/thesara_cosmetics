<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'HydraGuard SPF 50',
                'subtitle' => 'Protect & nourish',
                'description' => 'Lightweight broad-spectrum SPF 50 protection with a non-greasy finish for daily use.',
                'price' => 27.00,
                'old_price' => 34.00,
                'cost_price' => 12.00,
                'stock' => 120,
                'category' => 'sunscreen',
                'brand' => 'Thesara',
                'badge' => 'Top Rated',
                'image_url' => 'images/seller4.png',
                'is_featured' => true,
                'slug' => 'hydraguard-spf-50'
            ],
            [
                'name' => 'Vitamin Radiance Serum',
                'subtitle' => 'Brightening & glow',
                'description' => 'A brightening serum to help boost radiance and improve the look of uneven tone.',
                'price' => 27.00,
                'old_price' => 32.00,
                'cost_price' => 11.00,
                'stock' => 80,
                'category' => 'serum',
                'brand' => 'Thesara',
                'badge' => 'Save $5',
                'image_url' => 'images/seller2.png',
                'is_featured' => true,
                'slug' => 'vitamin-radiance-serum'
            ],
            [
                'name' => 'Hydra Balance Moisturizer',
                'subtitle' => 'Hydration boost',
                'description' => 'Daily moisturizer that supports a soft, hydrated feel without heaviness.',
                'price' => 25.00,
                'old_price' => 30.00,
                'cost_price' => 9.00,
                'stock' => 60,
                'category' => 'moisturizer',
                'brand' => 'Thesara',
                'badge' => 'New',
                'image_url' => 'images/seller3.png',
                'is_featured' => false,
                'slug' => 'hydra-balance-moisturizer'
            ],
            [
                'name' => 'Gentle Amino Cleanser',
                'subtitle' => 'Soft foam cleanse',
                'description' => 'A gentle cleanser that helps remove impurities while keeping skin comfortable.',
                'price' => 22.00,
                'old_price' => 29.00,
                'cost_price' => 7.00,
                'stock' => 100,
                'category' => 'cleanser',
                'brand' => 'Thesara',
                'badge' => 'Bestseller',
                'image_url' => 'images/seller1.png',
                'is_featured' => false,
                'slug' => 'gentle-amino-cleanser'
            ],
            [
                'name' => 'Smooth AHA Exfoliator',
                'subtitle' => 'Refine texture',
                'description' => 'A gentle exfoliator to help improve the look of texture and dullness.',
                'price' => 19.00,
                'old_price' => 24.00,
                'cost_price' => 10.00,
                'stock' => 75,
                'category' => 'exfoliator',
                'brand' => 'Thesara',
                'badge' => null,
                'image_url' => 'images/seller5.png',
                'is_featured' => false,
                'slug' => 'smooth-aha-exfoliator'
            ],
            // --- 10 NEW DOCTOR RECOMMENDED PRODUCTS ---
            [
                'name' => 'Retinol 0.5% Intense Night Oil',
                'subtitle' => 'Anti-Aging Clinical',
                'description' => 'A high-potency Vitamin A treatment that targets fine lines and uneven texture. Recommended for night use only.',
                'price' => 45.00,
                'old_price' => 55.00,
                'cost_price' => 22.00,
                'stock' => 50,
                'category' => 'serum',
                'brand' => 'Thesara',
                'badge' => 'Dr. Choice',
                'image_url' => 'images/clinical/retinol.png',
                'is_featured' => true,
                'slug' => 'retinol-0-5-intense-night-oil'
            ],
            [
                'name' => 'Hyaluronic B5 Hydration',
                'subtitle' => 'Molecular Moisture',
                'description' => 'Multi-depth hydration complex with pure Vitamin B5 to plump skin and repair moisture barriers.',
                'price' => 32.00,
                'old_price' => 38.00,
                'cost_price' => 12.00,
                'stock' => 150,
                'category' => 'serum',
                'brand' => 'Thesara',
                'badge' => 'Bestseller',
                'image_url' => 'images/clinical/hyaluronic.png',
                'is_featured' => true,
                'slug' => 'hyaluronic-b5-hydration'
            ],
            [
                'name' => 'Niacinamide 10% + Zinc 1%',
                'subtitle' => 'Blemish Control',
                'description' => 'High-strength vitamin and mineral blemish formula. Reduces the appearance of skin blemishes and congestion.',
                'price' => 18.00,
                'old_price' => 22.00,
                'cost_price' => 6.00,
                'stock' => 200,
                'category' => 'serum',
                'brand' => 'Thesara',
                'badge' => 'Clinical',
                'image_url' => 'images/clinical/niacinamide.png',
                'is_featured' => false,
                'slug' => 'niacinamide-10-zinc-1'
            ],
            [
                'name' => 'Vitamin C 20% Glow Serum',
                'subtitle' => 'Powerful Antioxidant',
                'description' => 'Pure L-Ascorbic Acid formula that brightens skin tone and neutralizes free radicals for a healthy glow.',
                'price' => 48.00,
                'old_price' => 60.00,
                'cost_price' => 20.00,
                'stock' => 45,
                'category' => 'serum',
                'brand' => 'Thesara',
                'badge' => 'Premium',
                'image_url' => 'images/clinical/vitamin-c.png',
                'is_featured' => true,
                'slug' => 'vitamin-c-20-glow-serum'
            ],
            [
                'name' => '2% BHA Liquid Exfoliant',
                'subtitle' => 'Salicylic Acid Peel',
                'description' => 'The world-renowned chemical exfoliant that unclogs pores, smooths wrinkles, and evens out skin tone.',
                'price' => 34.00,
                'old_price' => 42.00,
                'cost_price' => 14.00,
                'stock' => 85,
                'category' => 'exfoliator',
                'brand' => 'Thesara',
                'badge' => 'Derm Recommended',
                'image_url' => 'images/clinical/bha-liquid.png',
                'is_featured' => true,
                'slug' => '2-bha-liquid-exfoliant'
            ],
            [
                'name' => '10% Glycolic AHA Solution',
                'subtitle' => 'Texture Resurfacing',
                'description' => 'High concentration AHA treatment to dissolve dead skin cells and reveal smoother, younger-looking skin.',
                'price' => 29.00,
                'old_price' => 35.00,
                'cost_price' => 11.00,
                'stock' => 60,
                'category' => 'exfoliator',
                'brand' => 'Thesara',
                'badge' => 'Expert Care',
                'image_url' => 'images/clinical/aha-solution.png',
                'is_featured' => false,
                'slug' => '10-glycolic-aha-solution'
            ],
            [
                'name' => 'Azelaic 10% Anti-Redness',
                'subtitle' => 'Spot & Tone Corrector',
                'description' => 'Effective treatment for rosacea and post-inflammatory hyperpigmentation. Calms irritated skin.',
                'price' => 38.00,
                'old_price' => 45.00,
                'cost_price' => 16.00,
                'stock' => 40,
                'category' => 'moisturizer',
                'brand' => 'Thesara',
                'badge' => 'Clinical',
                'image_url' => 'images/clinical/azelaic-cream.png',
                'is_featured' => false,
                'slug' => 'azelaic-10-anti-redness'
            ],
            [
                'name' => 'Ceramide Barrier Balm',
                'subtitle' => 'Skin Recovery Relief',
                'description' => 'Loaded with essential ceramides and lipids to restore the skin barrier after chemical peels or procedures.',
                'price' => 42.00,
                'old_price' => 50.00,
                'cost_price' => 18.00,
                'stock' => 70,
                'category' => 'moisturizer',
                'brand' => 'Thesara',
                'badge' => 'Recovery',
                'image_url' => 'images/clinical/ceramide-balm.png',
                'is_featured' => true,
                'slug' => 'ceramide-barrier-balm'
            ],
            [
                'name' => 'Pure Zinc Mineral SPF 50',
                'subtitle' => 'Physical Protection',
                'description' => '100% mineral sunscreen with high-purity Zinc Oxide. No white cast, reef-safe, and perfect for surgery recovery.',
                'price' => 36.00,
                'old_price' => 44.00,
                'cost_price' => 15.00,
                'stock' => 110,
                'category' => 'sunscreen',
                'brand' => 'Thesara',
                'badge' => 'Dr. Choice',
                'image_url' => 'images/clinical/mineral-spf.png',
                'is_featured' => true,
                'slug' => 'pure-zinc-mineral-spf-50'
            ],
            [
                'name' => 'Multi-Peptide Lash & Brow',
                'subtitle' => 'Growth & Volume',
                'description' => 'Targeted peptide technology to promote thicker, fuller, and healthier-looking lashes and brows in 4 weeks.',
                'price' => 55.00,
                'old_price' => 75.00,
                'cost_price' => 24.00,
                'stock' => 30,
                'category' => 'serum',
                'brand' => 'Thesara',
                'badge' => 'New Tech',
                'image_url' => 'images/clinical/peptide-lash.png',
                'is_featured' => false,
                'slug' => 'multi-peptide-lash-brow'
            ],
        ];

        foreach ($products as $productData) {
            Product::updateOrCreate(
                ['name' => $productData['name']],
                $productData
            );
        }
    }
}
