# Cafe Web Application
[![Laravel](https://img.shields.io/badge/Laravel-12.x-orange.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)
[![Stars](https://img.shields.io/github/stars/ArKar-PlayBoy/Cafe-web-application)](https://github.com/ArKar-PlayBoy/Cafe-web-application/stargazers)
A comprehensive cafe management system built with Laravel 12, Tailwind CSS, and Alpine.js. Manage orders, inventory, reservations, and staff - all from a modern, intuitive interface.
---
## Features
### Customer Experience
- **Digital Menu** - Browse products by categories with real-time availability status
- **Smart Cart** - Persistent shopping cart with quantity management
- **Table Reservations** - Interactive table booking system with date/time selection
- **Multi-Channel Payments** - Support for COD, MPU, Visa, KBZ Pay, and Stripe
- **Order Tracking** - Track order status in real-time (Pending → Preparing → Ready → Completed)
- **Order History** - View past transactions and reorder easily
### Staff & Admin Power
- **Live Dashboard** - Real-time statistics on orders, revenue, and reservations
- **Order Management** - Complete workflow: Pending → Preparing → Ready → Completed
- **Reservation Management** - View, confirm, or cancel table bookings
- **Inventory Control** - Track stock levels, log waste, adjust quantities
- **Stock Alerts** - Automatic notifications for low stock and expiring items
- **Recipe Management** - Define ingredient requirements for each menu item
- **Batch Tracking** - FIFO inventory tracking with expiration dates
### Admin Exclusive
- **Full CRUD Operations** - Manage products, categories, tables, and users
- **Role-Based Access** - Separate dashboards for Admin, Staff, and Customers
- **User Management** - Create, ban/unban users, view activity
- **Order Export** - Download order data as CSV for reporting
- **Payment Verification** - Review and verify manual payment submissions
- **Dark Mode** - Built-in theme toggling for different environments
---
## Tech Stack
| Component | Technology |
|-----------|------------|
| Framework | Laravel 12.x |
| Frontend | Tailwind CSS 4.x, Alpine.js 3.x |
| Authentication | Laravel Breeze (Multi-Guard) |
| Database | MySQL 8.0+ |
| Build Tool | Vite 7.x |
| Payment Gateway | Stripe, MPU, KBZ Pay |
| PHP Version | 8.2+ |
---
## Screenshots
> Add your screenshots here
```
📸 Customer Menu
📸 Shopping Cart
📸 Order Tracking
📸 Admin Dashboard
📸 Staff Dashboard
📸 Inventory Management
```
---
## Project Structure
```
cafe-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Admin panel controllers
│   │   │   ├── Staff/         # Staff panel controllers
│   │   │   ├── CartController.php
│   │   │   ├── MenuController.php
│   │   │   └── ...
│   │   └── Middleware/        # RBAC middleware
│   ├── Models/                # Eloquent models
│   └── View/Components/       # Blade components
├── database/
│   ├── migrations/            # Database migrations
│   └── seeders/              # Database seeders
├── resources/
│   └── views/                # Blade templates
│       ├── customer/          # Customer views
│       ├── admin/            # Admin panel views
│       ├── staff/            # Staff panel views
│       └── components/       # Reusable components
├── routes/
│   ├── web.php               # Main routes
│   └── api.php               # API routes
└── config/                   # Configuration files
```
---
## Installation
### Prerequisites
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL 8.0+
### Steps
1. **Clone the repository**
   ```bash
   git clone https://github.com/ArKar-PlayBoy/Cafe-web-application.git
   cd cafe-app
   ```
2. **Install PHP dependencies**
   ```bash
   composer install
   ```
3. **Install Node.js dependencies**
   ```bash
   npm install
   ```
4. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
5. **Configure Database**
   Open `.env` and update your MySQL credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=cafe_db
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```
6. **Run Migrations & Seeders**
   ```bash
   php artisan migrate --seed
   ```
7. **Compile Assets**
   ```bash
   npm run build
   ```
8. **Start the Server**
   ```bash
   # Terminal 1: Start Laravel server
   php artisan serve
   # Terminal 2: Start Vite dev server (optional, for hot reload)
   npm run dev
   ```
9. **Access the Application**
   - Customer Portal: http://localhost:8000
   - Admin Panel: http://localhost:8000/admin/login
   - Staff Panel: http://localhost:8000/staff/login
### Default Credentials
After seeding, you can login with:
| Role | Email | Password |
|------|-------|----------|
| Admin | admin@cafe.com | password |
| Staff | staff@cafe.com | password |
| Customer | user@cafe.com | password |
---
## API Routes Overview
### Customer Routes (Authenticated)
| Method | Route | Description |
|--------|-------|-------------|
| GET | /menu | Browse menu items |
| GET | /cart | View shopping cart |
| POST | /cart/add/{menuItem} | Add item to cart |
| PUT | /cart/update/{cartItem} | Update cart item |
| DELETE | /cart/remove/{cartItem} | Remove cart item |
| GET | /checkout | Checkout page |
| POST | /checkout | Place order |
| GET | /orders | Order history |
| GET | /orders/{order} | Order details |
| POST | /orders/{order}/upload-payment | Upload payment proof |
| POST | /orders/{order}/cancel | Cancel order |
| GET | /reservations | View reservations |
| POST | /reservations | Make reservation |
### Admin Routes
| Method | Route | Description |
|--------|-------|-------------|
| GET | /admin/dashboard | Admin dashboard |
| GET | /admin/menu | Manage menu items |
| POST | /admin/menu | Create menu item |
| GET | /admin/tables | Manage tables |
| GET | /admin/users | Manage users |
| POST | /admin/users/{user}/ban | Ban user |
| GET | /admin/orders | View all orders |
| GET | /admin/orders/export/all | Export orders CSV |
| GET | /admin/stock | Inventory management |
| GET | /admin/stock/alerts | Stock alerts |
| GET | /admin/stock/batches | Batch tracking |
### Staff Routes
| Method | Route | Description |
|--------|-------|-------------|
| GET | /staff/dashboard | Staff dashboard |
| GET | /staff/orders | Manage orders |
| PUT | /staff/orders/{order}/status | Update order status |
| POST | /staff/orders/{order}/reject | Reject order |
| GET | /staff/reservations | Manage reservations |
| PUT | /staff/reservations/{reservation}/status | Update reservation |
| GET | /staff/stock | View stock |
| POST | /staff/stock/{stock}/in | Add stock |
| POST | /staff/stock/{stock}/waste | Log waste |
| POST | /staff/stock/{stock}/adjust | Adjust quantity |
---
## Database Schema
The system uses a relational MySQL schema:
```
Users (id, name, email, role_id, ...)
  ↓
Roles (id, name) → admin, staff, customer
  ↓
Categories (id, name, ...) → MenuItems (id, category_id, ...)
  ↓
Orders (id, user_id, status, total, ...)
  ↓
OrderItems (id, order_id, menu_item_id, quantity, ...)
  ↓
StockItems (id, name, current_quantity, min_quantity, ...)
  ↓
StockBatches (id, stock_item_id, quantity, expiry_date, ...)
```
---
## Security
- **Role-Based Access Control (RBAC)** - Strict middleware for Admin/Staff routes
- **CSRF Protection** - All forms protected with Laravel tokens
- **Password Hashing** - Bcrypt hashing via Laravel
- **Input Validation** - Form request validation on all inputs
---
## Contributing
1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request
---
## License
This project is open-sourced software licensed under the [MIT license](LICENSE).
---
## Author
**Ar Kar**
- GitHub: [@ArKar-PlayBoy](https://github.com/ArKar-PlayBoy)
- Project: [Cafe Web Application](https://github.com/ArKar-PlayBoy/Cafe-web-application)
---
## Acknowledgments
- [Laravel](https://laravel.com) - The PHP framework
- [Tailwind CSS](https://tailwindcss.com) - CSS framework
- [Alpine.js](https://alpinejs.dev) - JavaScript framework
- [Laravel Breeze](https://laravel.com/docs/starter-kits#breeze) - Authentication starter kit
