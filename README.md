🌟 Key Features👤 Customer ExperienceDigital Menu: Browse by categories with real-time availability status.Smart Cart: Persistent shopping cart with quantity management.Reservations: Interactive table booking system.Multi-Channel Payments: Integrated support for COD, MPU, Visa, and KBZ Pay.Order History: Track current order status and view past transactions.🧑‍🍳 Staff & Admin PowerLive Dashboard: Real-time statistics on orders and reservations.Status Workflow: Manage order lifecycles: Pending → Preparing → Ready → Completed.Role-Based Access (RBAC): Distinct dashboards and permissions for Staff vs. Admins.Inventory & Menu Control: Full CRUD for products, categories, and physical tables.Dark Mode: Built-in theme toggling for different working environments.🛠️ Tech StackFramework: Laravel 12.0Frontend: Tailwind CSS & Alpine.jsAuthentication: Laravel Breeze (Multi-Guard)Database: MySQL 8.0+Build Tool: Vite🚀 Getting StartedPrerequisitesPHP $\ge$ 8.2ComposerNode.js & NPMMySQL ServerInstallation StepsClone the repository:Bashgit clone https://github.com/your-username/cafe-app.git
cd cafe-app
Install dependencies:Bashcomposer install
npm install
Environment Setup:Bashcp .env.example .env
php artisan key:generate
Configure Database:Update your .env file with your MySQL credentials:Code snippetDB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cafe_db
DB_USERNAME=root
DB_PASSWORD=
Run Migrations & Seeders:Bashphp artisan migrate --seed
Compile Assets & Start Server:Bashnpm run dev
# In a new terminal
php artisan serve
🏗️ Database ArchitectureThe system utilizes a relational MySQL schema designed for data integrity:Users & Roles: Separate guards for Customer, Staff, and Admin.Catalog: Categories $\rightarrow$ MenuItems.Sales: Orders $\leftrightarrow$ OrderItems $\leftrightarrow$ Payments.Physical: Tables $\leftrightarrow$ Reservations.🔐 Security & MiddlewareThis project implements strict Role-Based Access Control (RBAC):EnsureUserIsAdmin: Restricts system settings and user management to administrators.EnsureUserIsStaff: Grants access to order fulfillment and reservation logs.CSRF Protection: All forms are secured via Laravel's built-in tokens.📝 LicenseThis project is open-sourced software licensed under the MIT license.