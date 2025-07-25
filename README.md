# MUZURO ECOMMERCE - Computer Products E-commerce Website

A full-stack e-commerce web application for browsing and purchasing computer products built with PHP, MySQL, HTML5, CSS3, Bootstrap, and JavaScript.

## Features Implemented

### User Features
- ✅ User registration and login/logout
- ✅ Browse computer products by category
- ✅ View product details
- ✅ Add products to cart
- ✅ Remove items from cart
- ✅ Checkout and place order (bypasses PayPal)
- ✅ View order history
- ✅ User dashboard
- ✅ User profile page

### Admin Features
- ✅ Admin login
- ✅ Add/edit/delete products
- ✅ View all user orders
- ✅ Manage user accounts

### Technical Features
- ✅ Responsive design using Bootstrap
- ✅ Data validation (client-side and server-side)
- ✅ Secure password storage using PHP password_hash()
- ✅ SQL injection protection using prepared statements
- ✅ Session management for login/cart state

## Recent Updates

### Fixed Issues:
1. **✅ PayPal Bypass**: Replaced PayPal checkout with simple "Place Order" button
2. **✅ User Registration**: Added complete user registration system
3. **✅ Landing Page**: Added user dashboard after login (non-admin users)
4. **✅ Navigation**: Updated navigation with conditional login/logout links
5. **✅ Order Management**: Improved order processing and history tracking

### New Pages Added:
- `register.php` - User registration page
- `dashboard.php` - User landing page/dashboard
- `order_history.php` - User order history
- `user_profile.php` - User profile information
- `logout.php` - Session termination
- Updated `success.php` - Order confirmation page

## Setup Instructions

### Prerequisites
- XAMPP/LAMP/WAMP server
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web browser

### Installation Steps

1. **Clone/Download the project**
   ```
   Copy the MUZURO ECOMMERCE folder to your web server directory
   (e.g., htdocs for XAMPP)
   ```

2. **Database Setup**
   - Start Apache and MySQL in XAMPP
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a database named `ecom_db`
   - Import your existing database tables or run the SQL updates in `database_updates.sql`

3. **Database Configuration**
   - Open `kresources/config.php`
   - Update database credentials if needed:
     ```php
     define("DB_HOST","localhost");
     define("DB_USER","root");
     define("DB_PASS","");
     define("DB_NAME","ecom_db");
     ```

4. **Run Database Updates**
   - Execute the SQL commands in `database_updates.sql` in phpMyAdmin
   - This will add required columns and sample data

5. **Access the Application**
   - Frontend: http://localhost/MUZURO%20ECOMMERCE/public/
   - Admin Panel: http://localhost/MUZURO%20ECOMMERCE/public/admin/

### Default Admin Login
- Username: `admin`
- Password: `password` (change this after first login)

## Database Schema

### Tables
- **users** - User accounts (id, name, email, username, password, is_admin)
- **products** - Product catalog (id, title, description, price, image, category, stock)
- **categories** - Product categories
- **cart** - Shopping cart items (handled via sessions)
- **orders** - Order records (id, user_id, amount, transaction, status, date)
- **reports** - Order line items (product details per order)

## File Structure

```
MUZURO ECOMMERCE/
├── public/                 # Public web files
│   ├── index.php          # Homepage
│   ├── register.php       # NEW: User registration
│   ├── login.php          # User login
│   ├── dashboard.php      # NEW: User dashboard
│   ├── shop.php           # Product browsing
│   ├── checkout.php       # UPDATED: Simple checkout
│   ├── success.php        # UPDATED: Order confirmation
│   ├── order_history.php  # NEW: User order history
│   ├── user_profile.php   # NEW: User profile
│   ├── logout.php         # NEW: Logout functionality
│   ├── admin/             # Admin panel
│   └── css/, js/, fonts/  # Static assets
├── kresources/            # Backend resources
│   ├── config.php         # Database configuration
│   ├── functions.php      # UPDATED: Added new functions
│   ├── cart.php           # UPDATED: Cart management
│   └── ktemplates/        # Template files
└── database_updates.sql   # NEW: Database schema updates
```

## New Functions Added

### In `functions.php`:
- `register_user()` - User registration with validation
- `login_user()` - Updated login for admin/user routing
- `display_user_orders()` - Display user order history
- `process_order_checkout()` - Process orders without PayPal

## Usage Guide

### For Customers:
1. Visit the homepage
2. Register a new account or login
3. Browse products in the shop
4. Add items to cart
5. Proceed to checkout
6. Place order (cash on delivery)
7. View order history in dashboard

### For Administrators:
1. Login with admin credentials
2. Access admin panel
3. Manage products and categories
4. View all orders and reports
5. Manage user accounts

## Security Features

- Password hashing using `password_hash()`
- SQL injection protection
- Input validation and sanitization
- Session management
- CSRF protection (recommended for production)

## Future Enhancements (Optional)

- Product search and filtering
- Advanced admin dashboard
- Email notifications
- Payment gateway integration
- Product reviews and ratings
- Inventory management
- Order status tracking

## Support

For issues or questions, please refer to the code comments or contact the development team.

---

**Project Status**: ✅ All major requirements implemented and functional
**Last Updated**: July 2025
