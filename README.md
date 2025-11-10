# E-commerce Platform (Scaffold)

This archive provides a ready scaffold for a **Laravel 11** project using **Blade + jQuery** and **MySQL**.
It is _not_ a full Laravel installation. Please follow the steps below to create a runnable project.

## Quick setup (recommended)
1. Create a fresh Laravel 11 project:
   ```bash
   composer create-project laravel/laravel:^11 ecommerce-platform
   cd ecommerce-platform
   ```
2. Copy files from this scaffold into your project root (merge/overwrite when prompted).
   From the extracted scaffold folder run (example):
   ```bash
   cp -r /path/to/scaffold/app/* ./app/
   cp -r /path/to/scaffold/database/* ./database/
   cp -r /path/to/scaffold/routes/* ./routes/
   cp -r /path/to/scaffold/resources/* ./resources/
   cp -r /path/to/scaffold/config/* ./config/ || true
   ```
3. Install front-end deps and build assets (optional for jQuery):
   ```bash
   npm install
   npm run dev
   ```
4. Configure `.env`:
   - DB_DATABASE, DB_USERNAME, DB_PASSWORD for MySQL
   - MAIL_MAILER, MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD, MAIL_ENCRYPTION, MAIL_FROM_ADDRESS

5. Run migrations & seeders:
   ```bash
   php artisan migrate
   php artisan db:seed --class=SampleDataSeeder
   ```

6. Serve:
   ```bash
   php artisan serve
   ```

## What is included in this scaffold
- app/Models: Product, Cart, Order, OrderItem
- app/Http/Controllers: Admin/ProductController, CartController, OrderController, HomeController
- database/migrations: migrations for products, carts, orders, order_items, add_role_to_users
- database/seeders/SampleDataSeeder.php (sample products + admin user creation)
- resources/views: Blade templates for public pages and admin product management
- routes/web.php and routes/api.php (API endpoints using sanctum assumed)
- app/Mail/OrderConfirmationMail.php (mailable stub)

## Notes
- Sanctum: this scaffold assumes you'll install and configure Laravel Sanctum for API auth.
- Admin template: this scaffold uses simple Blade pages — you can replace admin UI with AdminLTE or any template.

If you want, I can also copy these files directly into a fresh Laravel project for you. Just say the word.
