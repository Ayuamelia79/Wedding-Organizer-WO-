# 💒 Wedding Organizer Management System

Sistem manajemen wedding organizer berbasis web yang dibangun dengan Laravel 12. Aplikasi ini memudahkan pengelolaan pemesanan paket pernikahan dengan fitur lengkap untuk admin dan customer (pengantin).

![Laravel](https://img.shields.io/badge/Laravel-12.36.1-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.4.1-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.x-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

---

## 📋 Table of Contents

- [✨ Fitur Utama](#-fitur-utama)
- [🛠 Tech Stack](#-tech-stack)
- [📋 Prerequisites](#-prerequisites)
- [🚀 Instalasi](#-instalasi)
- [👤 Default Credentials](#-default-credentials)
- [📁 Struktur Folder](#-struktur-folder)
- [🗺 Routes Overview](#-routes-overview)
- [🗄 Database Schema](#-database-schema)
- [🎨 UI Features](#-ui-features)
- [🔒 Security](#-security)
- [🧪 Testing](#-testing)
- [📝 Development](#-development)
- [🐛 Troubleshooting](#-troubleshooting)
- [📦 Production Deployment](#-production-deployment)
- [🔮 Future Features](#-future-features)

---

## ✨ Fitur Utama

### 👨‍💼 Admin
- **Dashboard Analytics** - Statistik pemesanan, revenue, dan customer
- **Manajemen Paket** - CRUD paket pernikahan (nama, deskripsi, harga, foto)
- **Manajemen Pemesanan** - Kelola semua pemesanan dengan status tracking:
  - ⏱ Menunggu Konfirmasi
  - ✓ Dikonfirmasi
  - ⚙ Sedang Dikerjakan
  - ★ Selesai
  - ✕ Dibatalkan
- **Manajemen Customer** - Lihat daftar customer dan detail pemesanan mereka
- **Laporan** - Revenue report dan booking analytics
- **Filter Status** - Filter pemesanan berdasarkan status dengan badge berwarna
- **Quick Actions** - Update status pemesanan dengan satu klik

### 💑 Pengantin (Customer)
- **Registrasi & Login** - Sistem autentikasi terpisah dari admin
- **Browse Paket** - Lihat katalog paket pernikahan dengan detail lengkap
- **Pemesanan Online** - Pesan paket dengan form lengkap:
  - Nama pemesan
  - Nomor HP
  - Tanggal acara
  - Lokasi acara
  - Jumlah tamu
  - Catatan khusus
- **Riwayat Pemesanan** - Lihat status pemesanan real-time dengan badge
- **Dashboard Personal** - Statistik pemesanan pribadi
- **Hubungi Kami** - Form kontak untuk pertanyaan

### 🌐 Publik
- **Halaman Kontak** - Form hubungi kami untuk calon customer
- **Role-Based Redirect** - Otomatis redirect ke dashboard sesuai role setelah login

---

## 🛠 Tech Stack

- **Framework**: Laravel 12.36.1
- **PHP**: 8.4.1
- **Database**: MySQL 8.x
- **Frontend**: 
  - Blade Templates
  - Tailwind CSS 3.x
  - Alpine.js (via Breeze)
- **Build Tool**: Vite
- **Authentication**: Laravel Breeze (custom role-based)

---

## 📋 Prerequisites

Pastikan sistem Anda sudah terinstall:
- PHP >= 8.2
- Composer
- MySQL/MariaDB
- Node.js & NPM
- Git

---

## 🚀 Installation

### 1. Clone the Repository

```bash
git clone https://github.com/Ayuamelia79/wedding-organizer.git
cd laravel_wedding_organizer
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Database Configuration

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wedding_organizer
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Buat Database

```bash
# Login ke MySQL
mysql -u root -p

# Buat database
CREATE DATABASE wedding_organizer;
exit;
```

### 7. Migrasi & Seeding

```bash
# Jalankan migrasi dan seeder
php artisan migrate --seed
```

**Seeder akan membuat:**
- Admin user default
- Sample data (opsional)

### 8. Build Assets

```bash
# Development
npm run dev

# atau untuk production
npm run build
```

### 9. Jalankan Server

```bash
composer run dev
```

Aplikasi akan berjalan di: `http://127.0.0.1:8000`

---

## 👤 Default Credentials

### Admin
- **Email**: `admin@gmail.com`
- **Password**: `12345678`

### Testing User (Pengantin)
Silakan registrasi melalui: `http://127.0.0.1:8000/pengantin/register`

---

## 📁 Struktur Folder

```
laravel_wedding_organizer/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminAuthController.php       # Admin authentication
│   │   │   ├── PengantinAuthController.php   # Customer authentication
│   │   │   ├── PaketController.php           # Package management
│   │   │   ├── PemesananController.php       # Booking management
│   │   │   ├── DashboardController.php       # Admin dashboard
│   │   │   └── ContactController.php         # Contact form
│   │   └── Middleware/
│   │       └── RoleMiddleware.php            # Role-based access control
│   └── Models/
│       ├── User.php                          # User model with roles
│       ├── Paket.php                         # Package model
│       ├── Pemesanan.php                     # Booking model
│       ├── Pembayaran.php                    # Payment model
│       └── Tamu.php                          # Guest list model
├── database/
│   ├── migrations/                           # Database migrations
│   └── seeders/
│       └── DatabaseSeeder.php                # Admin user seeder
├── resources/
│   ├── views/
│   │   ├── admin/                            # Admin views
│   │   │   ├── dashboard.blade.php
│   │   │   ├── paket/                        # Package CRUD views
│   │   │   ├── pemesanan/                    # Booking management views
│   │   │   ├── customers/                    # Customer management views
│   │   │   └── reports/                      # Reports views
│   │   ├── pengantin/                        # Customer views
│   │   │   ├── dashboard.blade.php
│   │   │   ├── paket/                        # Package browsing views
│   │   │   └── pemesanan/                    # Booking views
│   │   ├── layouts/
│   │   │   ├── app.blade.php                 # Main layout
│   │   │   └── navigation.blade.php          # Role-aware navigation
│   │   └── contact.blade.php                 # Contact page
│   └── css/
│       └── app.css                           # Tailwind CSS
└── routes/
    └── web.php                               # All web routes
```

---

## 🗺 Routes Overview

### Public Routes
- `GET /` - Home (redirect based on role)
- `GET /hubungi-kami` - Contact form
- `POST /hubungi-kami` - Submit contact form

### Admin Routes (`/admin/*`)
- `GET /admin/login` - Admin login page
- `GET /admin/dashboard` - Admin dashboard
- `GET|POST /admin/paket/*` - Package CRUD
- `GET|POST /admin/pemesanan/*` - Booking management (with status filter)
- `GET /admin/customers` - Customer list
- `GET /admin/customers/{id}` - Customer detail
- `GET /admin/reports` - Reports dashboard
- `POST /admin/logout` - Admin logout

### Pengantin Routes (`/pengantin/*`)
- `GET /pengantin/login` - Customer login
- `GET /pengantin/register` - Customer registration
- `GET /pengantin/dashboard` - Customer dashboard
- `GET /pengantin/paket` - Browse packages
- `GET /pengantin/paket/{id}` - Package detail
- `GET /pengantin/pemesanan` - My bookings
- `GET /pengantin/pemesanan/create` - Create booking
- `POST /pengantin/pemesanan` - Store booking
- `DELETE /pengantin/pemesanan/{id}` - Cancel booking
- `POST /pengantin/logout` - Customer logout

---

## 🗄 Database Schema

### Users Table
- `id` - Primary key
- `name` - User name
- `email` - Email (unique)
- `password` - Hashed password
- `role` - Enum: admin, pengantin
- `email_verified_at` - Verification timestamp
- Timestamps

### Pakets Table
- `id` - Primary key
- `nama` - Package name
- `deskripsi` - Description
- `harga` - Price
- `foto` - Photo path
- Timestamps

### Pemesanans Table
- `id` - Primary key
- `user_id` - Foreign key to users
- `paket_id` - Foreign key to pakets
- `nama_pemesan` - Orderer name
- `nomor_hp` - Phone number
- `tanggal_acara` - Event date
- `lokasi_acara` - Event location
- `jumlah_tamu` - Number of guests
- `catatan` - Notes
- `status` - Enum: pending, confirmed, in_progress, completed, cancelled
- Timestamps

### Pembayarans Table (Future)
- Payment tracking

### Tamus Table (Future)
- Guest list management

---

## 🎨 UI Features

- **Responsive Design** - Mobile-friendly interface
- **Gradient Themes** - Modern purple-pink gradient
- **Status Badges** - Color-coded status indicators:
  - 🟡 Menunggu (Yellow)
  - 🟢 Dikonfirmasi (Green)
  - 🔵 Sedang Dikerjakan (Blue)
  - 🟣 Selesai (Purple)
  - 🔴 Dibatalkan (Red)
- **Interactive Filters** - Click to filter by status
- **Quick Actions** - One-click status updates
- **Flash Messages** - Success/error notifications
- **Form Validation** - Client & server-side validation

---

## 🔒 Security

- **Role-Based Access Control** - Middleware untuk memisahkan akses admin dan pengantin
- **CSRF Protection** - Laravel built-in CSRF
- **Password Hashing** - Bcrypt hashing
- **Email Verification** - Optional email verification
- **Input Validation** - Request validation
- **SQL Injection Protection** - Eloquent ORM

---

## 🧪 Testing

```bash
# Run tests
php artisan test
```
| GET | `/admin/dashboard` | Admin dashboard |
| CRUD | `/admin/paket` | Package management |
| CRUD | `/admin/pemesanan` | Booking management |

### Pengantin (Customer) Routes
| Method | URI | Description |
|--------|-----|-------------|
| GET | `/pengantin/login` | Customer login |
| POST | `/pengantin/login` | Customer login action |
| GET | `/pengantin/register` | Customer registration |
| POST | `/pengantin/register` | Customer registration action |
| POST | `/pengantin/logout` | Customer logout |
| GET | `/dashboard-pengantin` | Customer dashboard |

### Shared Routes
| Method | URI | Description |
|--------|-----|-------------|
---

## 📝 Development

### Clear Cache

```bash
# Clear all cache
php artisan optimize:clear

# Clear specific cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### Database Fresh Seed

```bash
# Reset database dengan data fresh
php artisan migrate:fresh --seed
```

### List Routes

```bash
# Lihat semua routes
php artisan route:list

# Filter by name
php artisan route:list --name=admin
```

---

## 🐛 Troubleshooting

### Error: View not found
```bash
php artisan view:clear
php artisan config:clear
```

### Error: Class not found
```bash
composer dump-autoload
```

### Error: Migration failed
```bash
# Drop all tables and re-migrate
php artisan migrate:fresh --seed
```

### Error: Assets not loading
```bash
npm run dev
# or
npm run build
```

### Error: Column 'created_at' is ambiguous
Pastikan sudah menggunakan table prefix pada query yang join:
```php
->selectRaw('MONTH(pemesanans.created_at) as month')
```

---

## 📦 Production Deployment

### 1. Optimize Application

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Build assets for production
npm run build
```

### 2. Set Permissions

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 3. Environment

Pastikan `.env` untuk production:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database production
DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_DATABASE=your-db-name
DB_USERNAME=your-db-user
DB_PASSWORD=your-strong-password
```

---

## 🤝 Contributing

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📞 Support

Untuk pertanyaan atau dukungan, silakan:
- Buka issue di GitHub
- Hubungi melalui form kontak di aplikasi

---

## 🔮 Future Features

- [ ] Payment gateway integration (Midtrans/Xendit)
- [ ] Guest list management
- [ ] Email notifications untuk status update
- [ ] PDF invoice generation
- [ ] WhatsApp integration untuk notifikasi
- [ ] Photo gallery per event
- [ ] Event timeline management
- [ ] Vendor management (catering, decoration, dll)
- [ ] Multi-language support (ID/EN)
- [ ] Mobile app (Flutter/React Native)
- [ ] Real-time chat support
- [ ] Advanced analytics dashboard
- [ ] Export data (Excel/PDF)
- [ ] Calendar integration

---

## 📊 Status Pemesanan

Sistem menggunakan 5 status untuk tracking pemesanan:

1. **Menunggu Konfirmasi** - Pesanan baru masuk, menunggu review admin
2. **Dikonfirmasi** - Admin sudah menerima dan mengkonfirmasi pesanan
3. **Sedang Dikerjakan** - Persiapan acara sedang dalam proses
4. **Selesai** - Acara telah selesai dilaksanakan
5. **Dibatalkan** - Pesanan dibatalkan oleh admin atau customer

---

⭐ **Jika project ini bermanfaat, jangan lupa berikan star di GitHub!**

---

*Last updated: December 2025*

## 🙏 Acknowledgments

- Built with [Laravel](https://laravel.com)
- Styled with [Tailwind CSS](https://tailwindcss.com)
- Icons from [Heroicons](https://heroicons.com)

---


