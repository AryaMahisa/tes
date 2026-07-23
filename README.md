# 📝 Sistem Absensi Pegawai

> Sistem Pengajuan Absensi Untuk Pegawai Berbasis Web menggunakan Laravel 13.

---

## 📌 Deskripsi

**Sistem Absensi Pegawai** merupakan aplikasi berbasis web yang dirancang untuk mempermudah proses absensi pada lingkungan kerja.

Pegawai dapat:

- Mengajukan absensi secara online
- Melakukan absensi keluar
- Mengajukan izin, libur atau sakit

Admin dapat:

- Mengelola data pegawai
- Melihat data absensi pegawai
- Menyetujui atau menolak pengajuan izin/cuti

---

# ✨ Fitur Utama

## 🔐 Authentication

- Login
- Email Verification
- Logout

---

## 👥 Role User

### Admin

- Dashboard Admin
- Kelola Pegawai
- Rekap Absensi
- Persetujuan Izin
- Edit Profil
- Ganti Akun

### Mahasiswa

- Dashboard Pegawai
- Ajukan Izin tidak masuk
- Melakukan Absensi
- Download Surat
- Edit Profil
- Ganti Akun

---

## 🛠️ Teknologi

- Laravel 13
- PHP 8.x
- MySQL
- Bootstrap 5
- JavaScript

---

### Langkah Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/missjok/autostock-showroom.git
   cd autostock-showroom
   ```

2. **Install dependency PHP**
   ```bash
   composer install
   ```

3. **Install dependency JavaScript**
   ```bash
   npm install
   ```

4. **Salin file environment**
   ```bash
   cp .env.example .env
   ```

5. **Generate application key**
   ```bash
   php artisan key:generate
   ```

6. **Buat database**
   
   Buat database baru bernama `db_inventaris` melalui phpMyAdmin (atau nama lain sesuai keinginan).

7. **Konfigurasi database di file `.env`**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=8111
   DB_DATABASE=tugas_akhir
   DB_USERNAME=root
   DB_PASSWORD=
   ```

8. **Jalankan migrasi dan seeder**
   ```bash
   php artisan migrate --seed
   ```
   
   Perintah ini akan membuat seluruh tabel database sekaligus akun demo (lihat bagian [Akun Demo](#akun-demo)).

9. **Build asset frontend**
   ```bash
   npm run build
   ```

10. **Jalankan server**
    ```bash
    php artisan serve
    ```

11. Buka browser dan akses `http://127.0.0.1:8000`

---

## Akun Demo

| Role  | Email                      | Password |
|-------|-------------------------|----------------|
| Admin | arya@gmail.com             |  arya123  |
| User  | andi@gmail.com             |  andi123  |

---

## Dokumentasi REST API

Base URL: `http://127.0.0.1:8000/api`

| Method | Endpoint                                       | Keterangan                                           | Autentikasi |
| ------ | ---------------------------------------------- | ---------------------------------------------------- | ----------- |
| GET    | `/`                                            | Menampilkan informasi dasar REST API                 | Tidak       |
| POST   | `/login`                                       | Login dan mendapatkan token akses                    | Tidak       |
| POST   | `/logout`                                      | Logout (menghapus token akses yang sedang digunakan) | Ya          |
| GET    | `/me`                                          | Menampilkan informasi pengguna yang sedang login     | Ya          |
| GET    | `/attendance`                                  | Menampilkan riwayat absensi pengguna                 | Ya (User)   |
| GET    | `/attendance/today`                            | Menampilkan data absensi pengguna pada hari ini      | Ya (User)   |
| POST   | `/attendance/check-in`                         | Melakukan absensi masuk (check-in)                   | Ya (User)   |
| POST   | `/attendance/check-out`                        | Melakukan absensi pulang (check-out)                 | Ya (User)   |
| GET    | `/leave-requests`                              | Menampilkan daftar pengajuan izin pengguna           | Ya (User)   |
| POST   | `/leave-requests`                              | Mengajukan izin baru                                 | Ya (User)   |
| DELETE | `/leave-requests/{leaveRequest}`               | Menghapus atau membatalkan pengajuan izin            | Ya (User)   |
| GET    | `/admin/users`                                 | Menampilkan daftar seluruh pengguna                  | Ya (Admin)  |
| POST   | `/admin/users`                                 | Menambahkan pengguna baru                            | Ya (Admin)  |
| GET    | `/admin/users/{user}`                          | Menampilkan detail pengguna                          | Ya (Admin)  |
| PUT    | `/admin/users/{user}`                          | Memperbarui data pengguna                            | Ya (Admin)  |
| DELETE | `/admin/users/{user}`                          | Menghapus data pengguna                              | Ya (Admin)  |
| GET    | `/admin/attendance`                            | Menampilkan seluruh data absensi pengguna            | Ya (Admin)  |
| GET    | `/admin/leave-requests`                        | Menampilkan seluruh pengajuan izin                   | Ya (Admin)  |
| POST   | `/admin/leave-requests/{leaveRequest}/approve` | Menyetujui pengajuan izin                            | Ya (Admin)  |
| POST   | `/admin/leave-requests/{leaveRequest}/reject`  | Menolak pengajuan izin                               | Ya (Admin)  |

## Dokumentasi Screenshot

> Screenshot berikut membuktikan seluruh fitur telah berjalan dengan baik.
### 1. Halaman Login & Autentikasi
![Halaman Login] ()

### 2. Verifikasi Email

### 3. Dashboard

### 4. CRUD (belum diisi)

### 5. REST API — Pengujian di Postman

### 6. Pemisahan Hak Akses Admin & Staff

### 7. Tampilan Responsive (Desktop & Mobile)



Autentikasi menggunakan Bearer Token (Laravel Sanctum). Token diperoleh dari endpoint `/login`, kemudian disertakan pada header `Authorization: Bearer {token}` untuk mengakses endpoint yang memerlukan autentikasi.















........

## 👨‍💻 Developer

Nama And
