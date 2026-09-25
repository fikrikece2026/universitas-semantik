# SIM Mahasiswa Universitas Semantik

Aplikasi PHP Native + MySQLi dengan RBAC tiga peran: Mahasiswa, Operator Prodi, Administrator.

## Instalasi lokal (XAMPP/Laragon)
1. Salin folder `sim_mahasiswa_semantik` ke `htdocs`.
2. Buat database `universitassemantik` melalui phpMyAdmin.
3. Import `database.sql`.
4. Sesuaikan `config.php` (default lokal XAMPP).
5. Buka `http://localhost/sim_mahasiswa_semantik/`.

## Akun awal
Setelah import database, jalankan `buat_admin.php` sekali untuk membuat akun administrator:
- username: `admin`
- password: `Admin123!`

Segera login, lalu hapus `buat_admin.php` dari server.

Akun operator dibuat oleh administrator melalui menu Pengguna. Data mahasiswa dapat ditambahkan melalui menu Mahasiswa. Password awal mahasiswa saat dibuat adalah `Mahasiswa123!` dan wajib diganti dengan mekanisme perubahan password (fitur dapat dikembangkan).

## Hosting InfinityFree
1. Buat database MySQL melalui Control Panel InfinityFree.
2. Import `database.sql` melalui phpMyAdmin hosting.
3. Ubah konfigurasi `config.php` sesuai detail MySQL hosting (hostname, username, password, nama database).
4. Upload isi folder ini ke `htdocs` melalui File Manager/FTP.
5. Pastikan situs memakai HTTPS agar Service Worker/PWA dapat berjalan.
6. Jangan unggah kredensial database ke GitHub. Untuk publikasi, gunakan konfigurasi contoh dan simpan konfigurasi asli di luar repository.

## Catatan
- Menu ditentukan melalui kode, sesuai instruksi tugas.
- Operator hanya dapat mengelola mahasiswa pada prodi yang terhubung ke akunnya.
- Password disimpan menggunakan `password_hash()` dan diverifikasi dengan `password_verify()`.
