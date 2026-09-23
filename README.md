# User Management Module

A simple User Management Module developed using CodeIgniter 3.

## Technology Stack

- Framework: CodeIgniter 3.1.13
- PHP: 7.4
- Database: MySQL
- Frontend: HTML, CSS, Bootstrap 5, jQuery, AJAX

## Features

- Login and Logout
- Session-based Authentication
- Password Hashing using `password_hash()`
- Password Verification using `password_verify()`
- View Users
- Add User (Admin Only)
- Edit User
- Deactivate User (Admin Only)
- Search Users
- Filter by Role
- Filter by Status
- Pagination
- AJAX Status Update
- Role-Based Access Control

## Installation Steps

1. Download and extract the project ZIP file.
2. Copy the extracted project folder into the `htdocs` folder of XAMPP.
3. Open the XAMPP Control Panel.
4. Start **Apache** and **MySQL**.
5. Create a new MySQL database.
6. Import the `database.sql` file into the database.
7. Open `application/config/database.php` and update the database credentials.
8. Open your browser and run the project using your local URL.

## Default Login Credentials

### Admin
- Email: admin@example.com
- Password: admin123

### Operator
- Email: operator@example.com
- Password: operator123"# user-management-module" 
