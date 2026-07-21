# 🎓 E-Surat Mahasiswa

> Sistem Administrasi Pengajuan Surat Mahasiswa Berbasis Web menggunakan Laravel 12.

---

## 📌 Deskripsi

**E-Surat Mahasiswa** merupakan aplikasi berbasis web yang dirancang untuk mempermudah proses administrasi surat di lingkungan kampus.

Mahasiswa dapat:

- Mengajukan berbagai jenis surat secara online
- Memantau status pengajuan
- Mengunduh surat yang telah disetujui

Admin dapat:

- Mengelola data
- Memverifikasi pengajuan
- Menerbitkan surat
- Menghasilkan laporan PDF maupun Excel

---

# ✨ Fitur Utama

## 🔐 Authentication

- Login
- Register
- Email Verification
- Logout

---

## 👥 Role User

### Admin

- Dashboard Admin
- Kelola Mahasiswa
- Kelola Jenis Surat
- Verifikasi Pengajuan
- Cetak Surat
- Export PDF
- Export Excel

### Mahasiswa

- Dashboard Mahasiswa
- Ajukan Surat
- Lihat Status Pengajuan
- Download Surat
- Edit Profil

---

## 🛠️ Teknologi

- Laravel 12
- PHP 8.x
- MySQL
- Bootstrap 5
- JavaScript
- SweetAlert2

---

## 📷 Screenshot

![Dashboard](images/dashboard.png)

---

## 🚀 Instalasi

```bash
git clone https://github.com/username/e-surat.git
```

```bash
cd e-surat
```

```bash
composer install
```

```bash
cp .env.example .env
```

```bash
php artisan key:generate
```

```bash
php artisan migrate --seed
```

```bash
php artisan serve
```

---

## 👨‍💻 Developer

Nama Anda
