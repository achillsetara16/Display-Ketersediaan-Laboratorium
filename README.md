
---

## 🔧 Cara Instalasi Aplikasi

### 1️⃣ Instalasi Lokal (XAMPP / Laragon)
> ⚠️ Langkah ini hanya untuk penggunaan di localhost

1. Install XAMPP atau Laragon
2. Pindahkan folder proyek ini ke dalam direktori `htdocs/`
3. Import file `.sql` dari folder `database/` ke **phpMyAdmin**
4. Sesuaikan konfigurasi koneksi database pada:
   - `config/config.php` (untuk proyek PHP biasa)
   - `.env` (jika menggunakan Laravel)
5. Jalankan `http://localhost/Display-Ketersediaan-Laboratorium/auth/login.php` di browser

---

### 2️⃣ Instalasi di Hosting
1. Upload seluruh file ke layanan hosting (contoh: 000webhost, Vercel, InfinityFree)
2. Upload dan koneksikan database di panel hosting (phpMyAdmin atau serupa)
3. Sesuaikan path, URL, dan konfigurasi file `.htaccess` jika perlu

---

### 3️⃣ Instalasi Perangkat IoT
1. Siapkan perangkat **Raspberry Pi** dengan OS **Raspbian**
2. Hubungkan **sensor PIR** ke GPIO pin sesuai kebutuhan
3. Jalankan script Python dari folder `iot/` untuk membaca sensor dan mengirim data ke server melalui API
4. Atur Raspberry Pi agar membuka halaman web display ruangan secara fullscreen menggunakan Chromium dengan autostart

---

## 👥 Panduan Penggunaan Aplikasi (Berdasarkan Role Pengguna)

### 👩‍🎓 Mahasiswa
- Tidak memerlukan login
- Mengakses tampilan monitor atau halaman web untuk melihat:
  - Status ruang kelas
  - Status kehadiran dosen secara real-time
- Hanya memiliki akses **tampilan display**
- Tidak memiliki akses ke dashboard atau pengaturan sistem

---

### 👨‍🏫 Dosen
- Melakukan **login** atau **registrasi mandiri** pada website
- Setelah login, dosen dapat:
  - Melihat status kehadiran dosen lain di ruang dosen
  - Mengakses dan memperbarui **profil pribadi**
  - Melihat **jadwal ruang** dan **status dosen**
---

### 🧪 Laboran
- Melakukan login sebagai **Laboran**
- Memiliki akses ke **dashboard pengelolaan**:
  - Menambahkan dan mengelola **data ruangan**
  - Menambahkan dan mengelola **mata kuliah**
  - Meninjau dan mengatur **jadwal kuliah**
  - Mengelola **informasi akun pribadi**

---

### 🛡 Super Admin
- Memiliki **akses penuh** terhadap seluruh sistem
- Fitur utama:
  - Mengelola semua akun pengguna (dosen & laboran)
  - Melihat, mengubah, dan menghapus data ruangan, mata kuliah, serta jadwal
  - Mengakses dan mengintegrasikan data dari **API PenRu**
  - Melakukan monitoring serta perubahan langsung pada tampilan dan fungsi sistem

---

## 📚 Catatan Penting
- Proyek ini merupakan bagian dari tugas **Proyek Berbasis Pembelajaran (PBL)** untuk program studi Teknik Informatika - Politeknik Negeri Batam
- Silakan tambahkan dosen pembimbing sebagai kolaborator di GitHub (username dosen akan diinformasikan)
- Gunakan repository **private** untuk menjaga kerahasiaan

---

## 🧠 Kontributor
- Mahasiswa IF-45C Malam – Politeknik Negeri Batam
- Tim Pengembang NoLab

---

## 📎 Lisensi
Proyek ini bersifat akademik dan tidak untuk distribusi publik. Hak cipta sepenuhnya dimiliki oleh tim pengembang dan institusi terkait.
