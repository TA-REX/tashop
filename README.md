# 🛒 TAShop — Complete Laravel E-Commerce

A full-featured e-commerce site built with Laravel 11, Bootstrap 5, and MySQL.

---

## ✅ FEATURES
- Beautiful homepage with hero banner & featured products
- Shop page with search, category filter, and sort
- Product detail page with related products
- Session-based shopping cart (works for guests too)
- User registration & login
- Checkout with Cash on Delivery
- My Orders page with order history
- Order detail page
- Admin Dashboard with revenue, orders, products, users stats
- Admin: Add / Edit / Delete products with image upload
- Admin: View & update order status (pending → processing → shipped → delivered)
- Responsive Bootstrap 5 design
- 18 demo products across 6 categories pre-loaded

---

## ⚡ SETUP — 5 STEPS (takes ~10 minutes)

### STEP 1 — Create fresh Laravel project
```bash
composer create-project laravel/laravel tashop
cd tashop
```

### STEP 2 — Copy TAShop files
Extract this zip and copy ALL files into your `tashop/` folder.
When asked to overwrite, say YES to all.

### STEP 3 — Configure database
Open `.env` and set:
```
APP_NAME=TAShop
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tashop
DB_USERNAME=root
DB_PASSWORD=
```
Then create a database named `tashop` in phpMyAdmin.

### STEP 4 — Install & build
```bash
composer install
php artisan key:generate
php artisan migrate:fresh
php artisan db:seed
php artisan storage:link
```

### STEP 5 — Run
```bash
php artisan serve
```
Open: **http://localhost:8000**

---

## 🔐 LOGIN CREDENTIALS

| Role     | Email                   | Password  |
|----------|-------------------------|-----------|
| Admin    | admin@tashop.com        | password  |
| Customer | customer@tashop.com     | password  |

---

## 🗂 FILE STRUCTURE

```
tashop/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── ProductController.php
│   │   │   │   └── OrderController.php
│   │   │   ├── Auth/
│   │   │   │   ├── AuthenticatedSessionController.php
│   │   │   │   ├── RegisteredUserController.php
│   │   │   │   ├── PasswordResetLinkController.php
│   │   │   │   └── NewPasswordController.php
│   │   │   ├── HomeController.php
│   │   │   ├── ShopController.php
│   │   │   ├── CartController.php
│   │   │   ├── CheckoutController.php
│   │   │   └── OrderController.php
│   │   ├── Middleware/
│   │   │   └── AdminMiddleware.php
│   │   └── Requests/Auth/
│   │       └── LoginRequest.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Category.php
│   │   ├── Product.php
│   │   ├── Order.php
│   │   └── OrderItem.php
│   └── Providers/
│       └── AppServiceProvider.php
├── bootstrap/
│   └── app.php
├── database/
│   ├── migrations/         ← All migration files
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php   ← Main layout
│   │   └── admin.blade.php ← Admin layout
│   ├── auth/
│   │   ├── login.blade.php
│   │   ├── register.blade.php
│   │   ├── forgot-password.blade.php
│   │   └── reset-password.blade.php
│   ├── home.blade.php
│   ├── shop/
│   │   ├── index.blade.php
│   │   └── show.blade.php
│   ├── cart/
│   │   └── index.blade.php
│   ├── checkout/
│   │   └── index.blade.php
│   ├── orders/
│   │   ├── index.blade.php
│   │   └── show.blade.php
│   └── admin/
│       ├── dashboard.blade.php
│       ├── products/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   └── edit.blade.php
│       └── orders/
│           ├── index.blade.php
│           └── show.blade.php
├── routes/
│   ├── web.php
│   ├── auth.php
│   └── console.php
└── .env.example
```

---

## 🛠 TROUBLESHOOTING

**"Class not found" error:**
```bash
composer dump-autoload
```

**Permission errors on Linux/Mac:**
```bash
chmod -R 775 storage bootstrap/cache
```

**Page shows blank / error:**
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
# Check storage/logs/laravel.log for details
```

**Images not showing:**
```bash
php artisan storage:link
```

**Reset demo data:**
```bash
php artisan migrate:fresh --seed
```

---

## 🌐 PAGES

| Page | URL |
|------|-----|
| Homepage | / |
| Shop | /shop |
| Product Detail | /shop/{slug} |
| Cart | /cart |
| Login | /login |
| Register | /register |
| Checkout | /checkout |
| My Orders | /orders |
| Admin Dashboard | /admin |
| Admin Products | /admin/products |
| Admin Orders | /admin/orders |
