<?php
require_once 'config.php';
$username = 'admin';
$plain = 'Admin123!';
$nama = 'Administrator';
$role = mysqli_query($koneksi, "SELECT id_role FROM role WHERE nama_role='Administrator'");
$row = mysqli_fetch_assoc($role);
if (!$row) exit('Role Administrator tidak ditemukan. Import database.sql terlebih dahulu.');
$hash = password_hash($plain, PASSWORD_DEFAULT);
$stmt = mysqli_prepare($koneksi, "INSERT INTO pengguna (username,password,nama_lengkap,id_role) VALUES (?,?,?,?)");
mysqli_stmt_bind_param($stmt, 'sssi', $username, $hash, $nama, $row['id_role']);
if (mysqli_stmt_execute($stmt)) {
    echo 'Admin berhasil dibuat. Username: admin | Password: Admin123!<br>Hapus file buat_admin.php sekarang.';
} else {
    echo 'Admin mungkin sudah ada. Hapus file buat_admin.php dari server.';
}
