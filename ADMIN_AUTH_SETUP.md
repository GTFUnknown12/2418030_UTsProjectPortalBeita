# SETUP ADMIN AUTHENTICATION

Dokumentasi lengkap untuk mengatur dan menggunakan sistem autentikasi admin.

## 📋 File yang Dibuat/Diubah

### 1. **Migration** 
- `database/migrations/2026_04_22_000000_add_role_to_users_table.php`
  - Menambahkan kolom `role` ke tabel users dengan enum (admin/user)

### 2. **Model**
- `app/Models/User.php` (di-update)
  - Menambahkan 'role' ke Fillable array

### 3. **Controller**
- `app/Http/Controllers/Auth/AuthController.php` (baru)
  - `showLoginForm()` - Menampilkan form login
  - `login()` - Memproses login dengan validasi role admin
  - `logout()` - Memproses logout

### 4. **Middleware**
- `app/Http/Middleware/CheckAdminRole.php` (baru)
  - Memverifikasi user telah login dan memiliki role admin
  - Didaftarkan di `bootstrap/app.php`

### 5. **Views**
- `resources/views/auth/login.blade.php` (baru)
  - Form login dengan desain Bootstrap modern
  - Toggle password visibility
  - Responsive design
  
- `resources/views/admin/dashboard.blade.php` (di-update)
  - Menambahkan navbar dengan dropdown user
  - Logout button

### 6. **Routes**
- `routes/web.php` (di-update)
  - Authentication routes: `/auth/login` (GET & POST)
  - Admin routes dilindungi middleware 'auth' dan 'admin'
  - Logout route: `/admin/logout` (POST)

### 7. **Seeder**
- `database/seeders/DatabaseSeeder.php` (di-update)
  - Default admin user: `admin@mail.com` / `password`

---

## 🚀 Langkah Setup

### 1. **Jalankan Migration**
```bash
php artisan migrate
```

### 2. **Jalankan Seeder** (untuk membuat user admin default)
```bash
php artisan db:seed
```

### 3. **Bersihkan Cache** (opsional tapi disarankan)
```bash
php artisan config:clear
php artisan cache:clear
```

---

## 🔐 Menggunakan Admin Login

### URL Login
```
http://localhost:8000/auth/login
```

### Credentials Default
- **Email**: `admin@mail.com`
- **Password**: `password`

### Akses Admin Panel
Setelah login berhasil, redirect ke:
```
http://localhost:8000/admin/
```

---

## 🛡️ Fitur Keamanan

✅ **Password Hashing** - Password otomatis di-hash menggunakan bcrypt
✅ **Role-Based Access** - Hanya user dengan role 'admin' yang bisa akses dashboard
✅ **Session Management** - Regenerasi session token setelah login/logout
✅ **Auth Middleware** - Proteksi route admin dengan middleware 'auth' dan 'admin'
✅ **CSRF Protection** - Form login dilindungi CSRF token

---

## 📝 Membuat User Admin Baru

### Via Tinker Shell
```bash
php artisan tinker
```

```php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::create([
    'name' => 'Admin Baru',
    'email' => 'admin2@mail.com',
    'password' => Hash::make('password123'),
    'role' => 'admin'
]);
```

### Via Database Seeder (buat seeder baru)
```php
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Baru',
            'email' => 'admin2@mail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin'
        ]);
    }
}
```

Kemudian jalankan:
```bash
php artisan db:seed --class=CreateAdminUser
```

---

## 🔄 Flow Autentikasi

```
1. User akses /auth/login
   ↓
2. Masukkan email & password
   ↓
3. Sistem cek email ada di database
   ↓
4. Validasi password (bcrypt)
   ↓
5. Verifikasi role = 'admin'
   ↓
6. Jika valid → Login & Redirect ke /admin/
7. Jika gagal → Redirect ke /auth/login + error message
   ↓
8. User bisa logout via Navbar dropdown
```

---

## 🎨 Kustomisasi

### Ubah Email/Password Default
Edit di `database/seeders/DatabaseSeeder.php`:
```php
User::factory()->create([
    'name' => 'Nama Admin',
    'email' => 'email@anda.com',
    'password' => Hash::make('password_anda'),
    'role' => 'admin',
]);
```

### Ubah Styling Login Page
Edit `resources/views/auth/login.blade.php` - CSS ada di `<style>` tag

### Tambah Social Login
Integrasikan Laravel Socialite untuk login dengan Google, GitHub, dll.

---

## 🐛 Troubleshooting

### Error: "Anda tidak memiliki akses admin"
- Pastikan user yang login memiliki `role = 'admin'` di database
- Cek: `SELECT * FROM users WHERE email = 'your_email';`

### Error: "Middleware admin tidak ditemukan"
- Pastikan middleware sudah didaftarkan di `bootstrap/app.php`
- Clear cache: `php artisan config:clear`

### Form login tidak muncul
- Pastikan `resources/views/auth/login.blade.php` ada
- Clear view cache: `php artisan view:clear`

### Session tidak ter-simpan
- Cek session driver di `.env`: `SESSION_DRIVER=file` atau `database`
- Buat session table jika perlu: `php artisan session:table`

---

## 📚 Dokumentasi Tambahan

- [Laravel Authentication](https://laravel.com/docs/11.x/authentication)
- [Middleware](https://laravel.com/docs/11.x/middleware)
- [Authorization](https://laravel.com/docs/11.x/authorization)

---

**Setup Complete! 🎉**
