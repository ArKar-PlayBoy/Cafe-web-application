A full-featured café management system that handles customer ordering, staff operations, and admin control, built with Laravel, Tailwind CSS, Alpine.js, and MySQL.

👤 Customer Experience

Digital Menu
Browse menu items by categories with real-time availability updates.

Smart Cart
Persistent shopping cart with quantity management. Items stay in the cart until checkout.

Reservations
Interactive table booking system with availability check.

Multi-Channel Payments
Supports Cash on Delivery (COD), MPU, Visa, and KBZ Pay.

Order History
Customers can track current order status and view past transactions.

🧑‍🍳 Staff & Admin Features

Live Dashboard
Real-time statistics on orders, reservations, and revenue.

Order Status Workflow
Manage orders through stages: Pending → Preparing → Ready → Completed.

Role-Based Access Control (RBAC)
Separate dashboards and permissions for Staff vs. Admins.

Inventory & Menu Control
Full CRUD (Create, Read, Update, Delete) operations for products, categories, and tables.

Dark Mode
Built-in theme toggle for day/night working environments.

🛠️ Tech Stack

Backend Framework: Laravel 12.0

Frontend: Tailwind CSS & Alpine.js

Authentication: Laravel Breeze (Multi-Guard)

Database: MySQL 8.0+

Build Tool: Vite

🚀 Getting Started
Prerequisites

PHP ≥ 8.2

Composer

Node.js & NPM

MySQL Server

Installation Steps

Clone the repository

git clone https://github.com/your-username/cafe-app.git
cd cafe-app

Install dependencies

composer install
npm install

Set up environment variables

cp .env.example .env
php artisan key:generate

Configure Database
Update your .env file with MySQL credentials:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cafe_db
DB_USERNAME=root
DB_PASSWORD=

Run migrations & seeders

php artisan migrate --seed

Compile assets & start development server

npm run dev

Serve the backend in a new terminal

php artisan serve
🏗️ Database Architecture

The system uses a relational MySQL schema for data integrity:

Users & Roles:
Separate guards for Customer, Staff, Admin.

Catalog:
Categories → MenuItems

Sales:
Orders ↔ OrderItems ↔ Payments

Physical:
Tables ↔ Reservations

🔐 Security & Middleware

Role-Based Access Control (RBAC):

EnsureUserIsAdmin: Only admins can access system settings and user management.

EnsureUserIsStaff: Staff can access order fulfillment and reservation logs.

CSRF Protection:
All forms are protected with Laravel’s built-in CSRF tokens.

📝 License

This project is open-source and licensed under the MIT license.
