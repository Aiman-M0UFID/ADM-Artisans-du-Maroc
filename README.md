<p align="center">
  <img src="public/image/logo.png" width="120" alt="ADM Logo">
</p>

<h1 align="center">ADM — Artisans du Maroc 🇲🇦</h1>

<p align="center">
  A web platform connecting clients with Moroccan craftsmen — built with Laravel 10
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-red?logo=laravel" />
  <img src="https://img.shields.io/badge/PHP-8.1+-blue?logo=php" />
  <img src="https://img.shields.io/badge/TailwindCSS-3.x-38bdf8?logo=tailwindcss" />
  <img src="https://img.shields.io/badge/MySQL-8.x-orange?logo=mysql" />
  <img src="https://img.shields.io/badge/Security-Audited-green?logo=shield" />
</p>

---

## 📌 About

**ADM (Artisans du Maroc)** is a web application that allows clients to easily find qualified craftsmen in their city, browse their services, and communicate with them directly through an integrated real-time messaging system.

> Academic project — Bachelor's Degree in Computer Science

---

## ✨ Features

- 🔍 **Search craftsmen** by city and service category
- 💬 **Real-time chat** between clients and craftsmen (Chatify)
- 👤 **Client space** — search, browse profiles, messaging
- 🧰 **Craftsman space** — manage profile and listed services
- 🗂️ **Admin space** — manage service categories
- 🖼️ **Craftsman profile** with photo, title, years of experience and details
- 🔐 **Role-based access control** — secured spaces per user role

---

## 🔐 Security

This project has been audited and hardened from a cybersecurity perspective. See the full report in [`/security`](./security/).

### Vulnerabilities fixed

| # | Vulnerability | Severity | Status |
|---|---|---|---|
| 1 | No role check on `/admin` route | 🔴 Critical | ✅ Fixed |
| 2 | No role check on `/artisan` route | 🔴 Critical | ✅ Fixed |
| 3 | Unrestricted file upload (ServiceController) | 🔴 Critical | ✅ Fixed |
| 4 | Unrestricted file upload (CategorieController) | 🔴 Critical | ✅ Fixed |
| 5 | IDOR — artisan could edit other artisans' services | 🔴 Critical | ✅ Fixed |
| 6 | Privilege escalation via registration (`type_user=admin`) | 🟠 High | ✅ Fixed |
| 7 | Dead code — incorrect redirect logic | 🟡 Medium | ✅ Fixed |
| 8 | Predictable uploaded filenames (`time()`) | 🟡 Medium | ✅ Fixed |
| 9 | No logging of sensitive actions | 🟡 Medium | ✅ Fixed |

### What was already secure
- ✅ CSRF protection (Laravel default)
- ✅ Password hashing with bcrypt
- ✅ Input validation on forms
- ✅ Session regeneration after login
- ✅ `.env` excluded from Git

---

## 🗃️ Database Schema

### `users`
| Column | Type | Description |
|---|---|---|
| `id` | INT | Primary key |
| `name` | VARCHAR | Full name |
| `email` | VARCHAR | Email (unique) |
| `type_user` | VARCHAR | Role: `client`, `artisan`, `admin` |
| `ville` | VARCHAR | City |
| `telephone` | VARCHAR | Phone number |
| `password` | VARCHAR | Hashed password (bcrypt) |

### `services`
| Column | Type | Description |
|---|---|---|
| `id` | INT | Primary key |
| `nom` | VARCHAR | Service name |
| `title` | VARCHAR | Display title |
| `experience` | INT | Years of experience |
| `image` | VARCHAR | Service photo (UUID filename) |
| `details` | TEXT | Full description |
| `user_id` | INT | Reference to artisan |
| `categorie_id` | INT | Reference to category |

### `categories`
| Column | Type | Description |
|---|---|---|
| `id` | INT | Primary key |
| `title` | VARCHAR | Category name |
| `sub_title` | VARCHAR | Subtitle |
| `image` | VARCHAR | Representative image |

---

## 🏗️ Tech Stack

| Technology | Role |
|---|---|
| **Laravel 10** | PHP backend framework |
| **Laravel Breeze** | Authentication (register / login) |
| **Laravel Sanctum** | API session security |
| **Chatify** | Real-time messaging |
| **Tailwind CSS** | Responsive UI |
| **Alpine.js** | Frontend interactivity |
| **Vite** | Asset bundler |
| **MySQL** | Relational database |

---

## 🚀 Local Installation

### Requirements
- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL (XAMPP or Laragon recommended)

### Steps

```bash
# 1. Clone the repository
git clone https://github.com/Aiman-M0UFID/ADM-Artisans-du-Maroc.git
cd ADM-Artisans-du-Maroc

# 2. Install PHP dependencies
composer install

# 3. Install Node dependencies
npm install

# 4. Copy environment file
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Configure database in .env
# DB_DATABASE=adm
# DB_USERNAME=root
# DB_PASSWORD=

# 7. Run migrations
php artisan migrate

# 8. Compile assets
npm run build

# 9. Start the server
php artisan serve
```

Visit [http://localhost:8000](http://localhost:8000)

---

## 📁 Project Structure

```
ADM/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/               # Authentication
│   │   │   └── Front/
│   │   │       ├── Admin/          # Category management
│   │   │       ├── Artisan/        # Service management
│   │   │       └── HomeController  # Home & search
│   │   └── Middleware/
│   │       ├── AdminMiddleware.php     # 🔐 Role check: admin
│   │       └── ArtisanMiddleware.php   # 🔐 Role check: artisan
│   └── Models/
│       ├── User.php
│       └── Front/
│           ├── Admin/Categorie.php
│           └── Artisan/Service.php
├── database/migrations/
├── resources/views/Front/
├── routes/web.php
└── security/                       # 🔐 Security audit & report
    ├── SECURITY_REPORT.md
    └── PENTEST.md
```

---

## 👨‍💻 Author

**Aiman MOUFID**
Bachelor's Degree in Computer Science

---

## 📄 License

This project is developed for academic purposes only.
