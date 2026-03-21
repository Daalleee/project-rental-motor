# Aplikasi Rental Motor Berbasis Web

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Filament](https://img.shields.io/badge/Filament-3.3-3B82F6?style=for-the-badge&logo=filament&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

**Sistem Manajemen Rental Motor dengan Multi-User Role**

[Fitur Utama](#fitur-utama) • [Teknologi](#teknologi) • [Role User](#role-user) • [Instalasi](#instalasi) • [Screenshots](#screenshots)

</div>

---

## Tentang Aplikasi

Aplikasi Rental Motor adalah sistem manajemen rental motor berbasis web yang dibangun menggunakan **Laravel 12** dan **Filament Admin Panel**. Sistem ini mendukung **multi-user role** (Admin, Kasir, dan User) untuk memudahkan pengelolaan bisnis rental motor.

---

## Screenshots Interface

### Authentication

**Login Page**

![Login](public/screenshots/auth-login.png)

---

**Register Page**

![Register](public/screenshots/auth-register.png)

---

### User Dashboard

**Daftar Motor**

![User Dashboard](public/screenshots/user-dashboard-motors.png)

---

### Admin Panel

**Kelola Pengguna**

![Kelola Pengguna](public/screenshots/kelola_pengguna_admin.png)

---

**Kelola Motor**

![Kelola Motor](public/screenshots/admin-motor-management.png)

---

**Penyewaan**

![Rentals](public/screenshots/admin-rentals.png)

---

### Kasir Panel

**Daftar Sewa**

![Kasir Dashboard](public/screenshots/kasir-daftar-sewa.png)

---

**Status Sewa**

![Status Sewa](public/screenshots/kasir-status-sewa.png)

---

## URL Login per Role

| Role | URL Login | Deskripsi |
|------|-----------|-----------|
| **Pelanggan / User** | `/login` | Login untuk user biasa (pelanggan) |
| **Admin** | `/admin/login` | Login untuk admin panel |
| **Kasir** | `/kasir/login` | Login untuk kasir panel |

### Contoh Akses:

```
# Login Pelanggan/User
http://localhost:8000/login

# Login Admin
http://localhost:8000/admin/login

# Login Kasir
http://localhost:8000/kasir/login
```

> **Catatan:** Setiap role hanya bisa mengakses panel sesuai dengan hak aksesnya.

---

## Fitur Utama

### Admin Dashboard

| Fitur | Deskripsi |
|-------|-----------|
| **Kelola Pengguna** | Tambah, edit, hapus user (Admin, Kasir, User) |
| **Kelola Motor** | Manajemen unit motor dengan foto, harga, dan status |
| **Manajemen Transaksi** | Monitor semua penyewaan dan status pembayaran |
| **Kelola Ulasan** | Pantau ulasan dan rating dari pelanggan |

### Kasir Dashboard

| Fitur | Deskripsi |
|-------|-----------|
| **Konfirmasi Pembayaran** | Setujui pembayaran dan ubah status transaksi |
| **Lihat Status Sewa** | Monitor penyewaan aktif dan riwayat |
| **Aksi Cepat** | Konfirmasi, Selesaikan, atau Batalkan transaksi |

### User Dashboard

| Fitur | Deskripsi |
|-------|-----------|
| **Lihat Daftar Motor** | Jelajahi motor tersedia dengan foto dan harga |
| **Buat Pesanan Sewa** | Pilih tanggal dan durasi sewa |
| **Riwayat Sewa** | Monitor status penyewaan pribadi |
| **Berikan Ulasan** | Tulis review setelah penyewaan selesai |

---

## Teknologi

| Kategori | Teknologi |
|----------|-----------|
| **Framework** | Laravel 12 |
| **Admin Panel** | Filament Admin 3.3 |
| **Backend** | PHP 8.2+ |
| **Database** | MySQL |
| **Frontend** | Blade Templates |
| **CSS** | Tailwind CSS |
| **JavaScript** | Alpine.js, Vite |
| **Authentication** | Laravel Breeze |

### Dependencies

```json
{
  "require": {
    "php": "^8.2",
    "filament/filament": "^3.3",
    "laravel/framework": "^12.0"
  },
  "require-dev": {
    "laravel/breeze": "^2.3",
    "pestphp/pest": "^3.8"
  }
}
```

---

## Role User

| Role | Akses | Deskripsi |
|------|-------|-----------|
| **Admin** | Admin Panel | Akses penuh: Kelola user, motor, transaksi, ulasan |
| **Kasir** | Kasir Panel | Konfirmasi pembayaran dan status sewa |
| **User** | User Dashboard | Sewa motor, lihat riwayat, beri ulasan |

### Access Control

```php
public function canAccessPanel(Panel $panel): bool
{
    return match ($panel->getId()) {
        'admin' => $this->role === 'admin',
        'kasir' => $this->role === 'kasir',
        default => false,
    };
}
```

---

## Instalasi

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL/MariaDB
- Git

### Langkah Instalasi

**1. Clone Repository**
```bash
git clone <repository-url>
cd project-rental-motor
```

**2. Install Dependencies**
```bash
composer install
npm install
```

**3. Setup Environment**
```bash
cp .env.example .env
php artisan key:generate
```

**4. Konfigurasi Database**
Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rental-motor
DB_USERNAME=root
DB_PASSWORD=your_password
```

**5. Migrate Database**
```bash
php artisan migrate
```

**6. Seed Data (Optional)**
```bash
php artisan db:seed
```

**7. Create Storage Link**
```bash
php artisan storage:link
```

**8. Build Assets**
```bash
npm run build
# atau untuk development
npm run dev
```

**9. Run Application**
```bash
php artisan serve
```

Aplikasi berjalan di `http://127.0.0.1:8000`

---

## Default Login

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@example.com | password |
| Kasir | kasir@example.com | password |
| User | user@example.com | password |

> **PENTING:** Ubah password default setelah instalasi!

---

<div align="center">

**Aplikasi Rental Motor Berbasis Web**

Dibuat menggunakan Laravel & Filament

</div>
