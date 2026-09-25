<?php

$host = 'HOST_DATABASE';
$username = 'USERNAME_DATABASE';
$password = 'PASSWORD_DATABASE';
$dbname = 'NAMA_DATABASE';
$port = 3306;

$koneksi = mysqli_connect(
    $host,
    $username,
    $password,
    $dbname,
    $port
);

if (!$koneksi) {
    die('Koneksi database gagal.');
}

mysqli_set_charset($koneksi, 'utf8mb4');