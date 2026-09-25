# Sistem Informasi Manajemen Mahasiswa
## Universitas Semantik

Sistem Informasi Manajemen Mahasiswa Universitas Semantik merupakan aplikasi berbasis web yang digunakan untuk mengelola data mahasiswa berdasarkan Program Studi.

Aplikasi ini dibuat menggunakan PHP Native, MySQL, Bootstrap 5, dan menerapkan konsep Role-Based Access Control (RBAC) untuk membedakan hak akses Administrator, Operator/Program Studi, dan Mahasiswa.

## Fitur Sistem

### 1. Administrator
Administrator memiliki akses untuk:
- Login sebagai Administrator
- Mengelola data mahasiswa
- Mengelola pengguna/operator
- Mengelola data Fakultas dan Program Studi
- Melihat informasi sistem

### 2. Operator / Program Studi
Operator memiliki akses untuk:
- Login sebagai Operator
- Mengelola data mahasiswa sesuai kebutuhan Program Studi
- Melihat data mahasiswa

### 3. Mahasiswa
Mahasiswa memiliki akses untuk:
- Login menggunakan NPM dan password
- Mengakses halaman mahasiswa

## Role Pengguna

| Role | Akses |
|---|---|
| Administrator | Pengelolaan sistem dan pengguna |
| Operator | Pengelolaan data mahasiswa |
| Mahasiswa | Akses data mahasiswa |

## Teknologi

- PHP Native
- MySQL
- MySQLi
- Bootstrap 5
- HTML5
- CSS3
- JavaScript
- Progressive Web App (PWA)

## Struktur Database

Database menggunakan nama:

`universitassemantik`

Tabel utama:

- `fakultas`
- `prodi`
- `role`
- `pengguna`
- `mahasiswa`

Relasi utama:

```text
Fakultas
   │
   └── Prodi
          │
          └── Mahasiswa

Role
   │
   └── Pengguna