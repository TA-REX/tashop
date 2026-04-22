<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        \App\Models\User::create([
            'name'     => 'Admin',
            'email'    => 'admin@tashop.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Customer user
        \App\Models\User::create([
            'name'     => 'John Customer',
            'email'    => 'customer@tashop.com',
            'password' => Hash::make('password'),
            'role'     => 'customer',
        ]);

        // Categories
        $cats = [
            ['name' => 'Electronics',    'emoji' => '📱'],
            ['name' => 'Clothing',        'emoji' => '👕'],
            ['name' => 'Books',           'emoji' => '📚'],
            ['name' => 'Home & Kitchen',  'emoji' => '🏠'],
            ['name' => 'Sports',          'emoji' => '⚽'],
            ['name' => 'Beauty',          'emoji' => '💄'],
        ];

        foreach ($cats as $cat) {
            \App\Models\Category::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
            ]);
        }

        // Products
        $products = [
            // Electronics
            ['name' => 'Wireless Earbuds Pro',   'price' => 1200, 'sale_price' => 999,  'stock' => 50,  'category_id' => 1, 'desc' => 'High quality wireless earbuds with noise cancellation and 24hr battery life.'],
            ['name' => 'Smart Watch Series 5',   'price' => 4500, 'sale_price' => 3800, 'stock' => 30,  'category_id' => 1, 'desc' => 'Feature-packed smartwatch with heart rate monitor, GPS and sleep tracking.'],
            ['name' => 'Bluetooth Speaker',      'price' => 1800, 'sale_price' => null, 'stock' => 40,  'category_id' => 1, 'desc' => 'Portable waterproof speaker with 360 degree sound and 12hr battery.'],
            ['name' => 'USB-C Charging Cable',   'price' => 250,  'sale_price' => null, 'stock' => 200, 'category_id' => 1, 'desc' => 'Fast charging braided USB-C cable, 2 meter length.'],
            // Clothing
            ['name' => 'Premium Cotton T-Shirt', 'price' => 450,  'sale_price' => 350,  'stock' => 100, 'category_id' => 2, 'desc' => '100% premium cotton t-shirt, available in multiple colors.'],
            ['name' => 'Slim Fit Jeans',         'price' => 1200, 'sale_price' => null, 'stock' => 60,  'category_id' => 2, 'desc' => 'Classic slim fit jeans with stretch fabric for comfort.'],
            ['name' => 'Hooded Sweatshirt',      'price' => 900,  'sale_price' => 750,  'stock' => 45,  'category_id' => 2, 'desc' => 'Warm and cozy hooded sweatshirt perfect for winter.'],
            ['name' => 'Sports Sneakers',        'price' => 2200, 'sale_price' => null, 'stock' => 35,  'category_id' => 2, 'desc' => 'Lightweight running sneakers with cushioned sole.'],
            // Books
            ['name' => 'Laravel: Up & Running',  'price' => 600,  'sale_price' => null, 'stock' => 40,  'category_id' => 3, 'desc' => 'Complete guide to building applications with Laravel framework.'],
            ['name' => 'Clean Code',             'price' => 550,  'sale_price' => 480,  'stock' => 35,  'category_id' => 3, 'desc' => 'A handbook of agile software craftsmanship by Robert C. Martin.'],
            ['name' => 'PHP 8 Objects',          'price' => 500,  'sale_price' => null, 'stock' => 28,  'category_id' => 3, 'desc' => 'Patterns, and Practice - complete PHP 8 development guide.'],
            // Home & Kitchen
            ['name' => 'Coffee Mug Set',         'price' => 380,  'sale_price' => null, 'stock' => 80,  'category_id' => 4, 'desc' => 'Set of 4 ceramic coffee mugs, microwave and dishwasher safe.'],
            ['name' => 'LED Desk Lamp',          'price' => 950,  'sale_price' => 799,  'stock' => 25,  'category_id' => 4, 'desc' => 'Energy saving LED desk lamp with adjustable brightness and USB charging port.'],
            ['name' => 'Non-Stick Frying Pan',   'price' => 700,  'sale_price' => null, 'stock' => 30,  'category_id' => 4, 'desc' => 'Premium non-stick frying pan, compatible with all cooktops.'],
            // Sports
            ['name' => 'Yoga Mat',               'price' => 650,  'sale_price' => 550,  'stock' => 60,  'category_id' => 5, 'desc' => 'Anti-slip premium yoga mat, 6mm thick with carrying strap.'],
            ['name' => 'Water Bottle 1L',        'price' => 350,  'sale_price' => null, 'stock' => 90,  'category_id' => 5, 'desc' => 'BPA-free stainless steel insulated water bottle.'],
            // Beauty
            ['name' => 'Vitamin C Serum',        'price' => 850,  'sale_price' => 720,  'stock' => 55,  'category_id' => 6, 'desc' => 'Brightening vitamin C face serum with hyaluronic acid.'],
            ['name' => 'Moisturizing Cream',     'price' => 480,  'sale_price' => null, 'stock' => 70,  'category_id' => 6, 'desc' => 'Daily moisturizing cream for all skin types, SPF 30.'],
        ];

        foreach ($products as $p) {
            \App\Models\Product::create([
                'name'        => $p['name'],
                'slug'        => Str::slug($p['name']) . '-' . rand(100, 999),
                'description' => $p['desc'],
                'price'       => $p['price'],
                'sale_price'  => $p['sale_price'],
                'stock'       => $p['stock'],
                'category_id' => $p['category_id'],
                'is_active'   => true,
            ]);
        }
    }
}
