# Multi-Tenant Flat & Bill Management System

## Project Overview
A complete **Laravel 10 multi-tenant system** for managing buildings, flats, tenants, and bills with proper data isolation, role-based permissions, and email notifications.

---

## Setup Instructions

### Prerequisites
- PHP 8.1 or higher  
- Composer  
- MySQL 8.0+  
- Node.js & NPM  

### Installation Steps

1. **Clone the repository**
```bash
git clone https://github.com/kalam614/flat-bill-management.git
cd flat-bill-management
```

2. **Install dependencies**
```bash
composer install
npm install && npm run dev
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database configuration**
Update your `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=flat_bill_management
DB_USERNAME=your_username
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@flatbill.test
MAIL_FROM_NAME="Flat Bill Management"
```

5. **Database setup**
```bash
php artisan migrate --seed
```

6. **Start the development server**
```bash
php artisan serve
```

---

## Authentication

This project uses **[Laravel Breeze](https://laravel.com/docs/10.x/starter-kits#laravel-breeze)** for authentication scaffolding.

### Why Breeze?
- Lightweight, minimal starter kit  
- Provides ready-to-use login, registration, password reset  
- Tailwind-based views (easily customizable)  
- Perfect for extending with role-based access  

### Role Handling
We extended Breeze by adding a **role column** to the `users` table:

```php
$table->enum('role', ['admin', 'house_owner'])->default('house_owner');
```

- Default role = `house_owner`  
- Admins created via seeder or manually  

### Access Control
- **Admin users** → Manage house owners, tenants, and all system data  
- **House Owner users** → Limited to their own flats, tenants, and bills  

Enforced by:  
- **Global Scopes** (filter data by `house_owner_id`)  
- **Middleware checks** (`IsAdmin`, `IsHouseOwner`)  

---

## Multi-Tenant Implementation

This system uses **column-based multi-tenancy** with the following approach:

### Data Isolation Strategy
1. **Tenant Identification** – Each House Owner is a tenant with unique ID  
2. **Global Scopes** – Automatic filtering ensures data isolation  
3. **Middleware Protection** – Route-level security prevents cross-tenant access  
4. **Query Optimization** – Proper indexing and eager loading  

### Key Components
- `TenantScope` – Global scope for tenant filtering  
- `TenantMiddleware` – Route protection middleware  
- `HasTenant` trait – Reusable tenant functionality  

---

## Database Structure

### Core Tables
- `users` – System users (Admin, House Owners)  
- `house_owners` – House owner profiles  
- `flats` – Flats within buildings  
- `tenants` – Tenant information  
- `bill_categories` – Bill types (Electricity, Gas, Water, Utility)  
- `bills` – Bill records with payment status  
- `bill_payments` – Partial and full payments tracking  

---

## Default Login Credentials

### Super Admin
- Email: **admin@gmail.com**  
- Password: **12345678**  

### House Owner 1
- Email: **owner1@gmail.com**  
- Password: **12345678**  

### House Owner 2  
- Email: **owner2@gmail.com**  
- Password: **12345678**  

---

## Features Implemented

### Admin (Super Admin)
✅ Manage House Owners  
✅ Create and assign Tenants  
✅ View all Tenant details  
✅ Remove tenants  
✅ Global dashboard  

### House Owner
✅ Manage Flats in their building  
✅ Manage flat details (number, owner info)  
✅ Create custom Bill Categories  
✅ Generate Bills for flats  
✅ Track due amounts for unpaid bills  
✅ Receive email notifications  
✅ Tenant-isolated dashboard  

---

## Email Notifications

Email notifications are sent for:
- **New bill creation** → Sent to flat owner  
- **Bill payment confirmation** → Sent to flat owner & admin  


### Local Development (Mailtrap)

This project uses **[Mailtrap](https://mailtrap.io/)** for safe email testing during development.

#### Why Mailtrap?
- Realistic email testing without sending to real users  
- SMTP credentials provided for local integration  
- Web inbox to preview, debug, and verify emails  

#### Setup
1. Create a free Mailtrap account  
2. Create a new inbox  
3. Copy SMTP credentials into `.env` (already shown above)  

Now, all system emails will be captured safely in your Mailtrap inbox.

---

## Performance Optimizations

1. **Database Indexing**
   - Composite indexes on tenant/owner columns  
   - Foreign key constraints for integrity  

2. **Query Optimization**
   - Eager loading relationships  
   - Global scopes prevent N+1 queries  
   - Pagination on list views  

---


Covers:
- Multi-tenant isolation  
- Role-based permissions  
- Bill calculations  
- Email notifications  

---

## Design Decisions

### Multi-Tenancy
- **Column-based tenancy** for simplicity  
- **Global scopes** for automatic filtering  
- **Middleware** for extra security  

### Database
- **Normalized** structure  
- **Composite indexes** for queries  

### Security
- Role-based permissions   
- Tenant isolation at multiple levels  
- CSRF protection on forms  

---


## Support
For setup issues or questions, check code comments or documentation in the repository.
