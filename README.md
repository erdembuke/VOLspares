<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="340" alt="Laravel Logo">
</p>
<h2 align="center">VOLspares</h2>
<p align="center">
  A spare parts e-commerce platform for Volvo owners. <br>
  <b>Find, order and manage Volvo spare parts - powered by Laravel 11</b>
</p>

---

## Table of Contents
- [About the Project](#about-the-project)
- [Tech Stack](#tech-stack)
- [Main Features](#main-features)
- [Installation](#installation)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [Screenshots](#screenshots)
- [License](#license)

---

## About the Project

**VOLspares** is a web application designed for Volvo car owners and repair stations to easily search, find, and purchase spare parts.  
The platform is built with a **modular, scalable architecture** using Laravel 11 and Tailwind CSS, featuring a fully functional admin panel, user roles, order management, and a modern shopping cart experience.

---

## Tech Stack

- **Framework:** Laravel 11 (PHP 8.2+)
- **Frontend:** Blade, Tailwind CSS
- **Database:** MySQL
- **Auth:** Laravel Breeze (roles: admin, customer)
- **Other:** File uploads (images), session-based cart, RESTful controllers

---

## Main Features

- 🔒 **Role-based Access Control:**  
  - Admin and Customer separation  
  - Only admins can access the admin dashboard and manage products

- 🛒 **Shopping Cart:**  
  - Add/remove/increase/decrease items  
  - Live cart summary and checkout modal

- 🏷️ **Product Management:**  
  - Admin can add, edit, delete, and list spare parts (with images & details)

- 🔍 **Advanced Search & Filtering:**  
  - Filter by brand, model, year, category, price, etc.

- 💳 **Order Management:**  
  - On checkout, orders are recorded in DB  
  - Admin can see live order count

- 👤 **User Registration & Profiles:**  
  - Customers can register/login; admin role only assignable manually

- 🎨 **Responsive UI:**  
  - Modern, clean, mobile-friendly design  
  - Fixed header, dynamic modals

---

## Installation

```bash
# 1. Clone the repository
git clone https://github.com/yourusername/volspares.git
cd volspares

# 2. Install dependencies
composer install
npm install && npm run build

# 3. Configure environment
cp .env.example .env
# Update DB and other settings in .env

# 4. Generate app key & run migrations
php artisan key:generate
php artisan migrate
php artisan storage:link

# 5. Run the server
php artisan serve
