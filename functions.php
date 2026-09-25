<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
require_once __DIR__ . '/config.php';

function e($value) { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function harus_login() {
    if (empty($_SESSION['user'])) { header('Location: login.php'); exit; }
}
function user_role() { return $_SESSION['user']['role'] ?? ''; }
function harus_role(array $roles) {
    harus_login();
    if (!in_array(user_role(), $roles, true)) {
        http_response_code(403);
        exit('Akses ditolak: Anda tidak memiliki hak untuk membuka halaman ini.');
    }
}
function header_html($judul = 'Dashboard') {
    $nama = e($_SESSION['user']['nama'] ?? 'Pengguna');
    echo '<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">';
    echo '<title>'.e($judul).' - SIM Mahasiswa</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">';
    echo '</head><body class="bg-light"><nav class="navbar navbar-dark" style="background:#1e3c72"><div class="container"><a class="navbar-brand" href="dashboard.php">SIM Mahasiswa</a><span class="text-white">'.$nama.' · '.e(user_role()).' <a class="btn btn-sm btn-outline-light ms-2" href="logout.php">Keluar</a></span></div></nav><main class="container py-4">';
}
function footer_html() { echo '</main><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script></body></html>'; }
