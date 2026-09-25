<?php
require_once 'config.php';
?>
<!doctype html><html lang="id"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>SIM Mahasiswa - Universitas Semantik</title>
<meta name="theme-color" content="#1e3c72">
<meta name="description" content="Sistem Informasi Manajemen Mahasiswa Universitas Semantik">
<link rel="manifest" href="manifest.json">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
body{font-family:system-ui;background:#f5f7fb}.hero{background:linear-gradient(135deg,#1e3c72,#2a5298);color:white;padding:95px 0 80px;border-radius:0 0 42px 42px}
.portal{border:0;border-radius:20px;box-shadow:0 10px 28px #14213d12;transition:.2s}.portal:hover{transform:translateY(-5px)}
.roleicon{width:68px;height:68px;border-radius:50%;display:grid;place-items:center;margin:auto auto 18px;font-size:26px}
</style></head><body>
<nav class="navbar navbar-expand-lg navbar-dark position-absolute w-100"><div class="container">
<a class="navbar-brand fw-bold" href="#"><i class="fa-solid fa-graduation-cap me-2"></i>Universitas Semantik</a>
<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
<div id="nav" class="collapse navbar-collapse"><div class="navbar-nav ms-auto"><a class="nav-link" href="#akses">Akses Portal</a><a class="nav-link" href="#info">Informasi</a></div></div>
</div></nav>
<section class="hero text-center"><div class="container pt-4"><i class="fa-solid fa-building-columns fa-4x text-warning mb-3"></i>
<h1 class="display-5 fw-bold">Sistem Informasi<br>Manajemen Mahasiswa</h1>
<p class="lead mx-auto" style="max-width:700px">Portal terpadu pengelolaan data akademik mahasiswa per program studi Universitas Semantik.</p>
<a href="#akses" class="btn btn-warning btn-lg mt-3 fw-semibold">Masuk Portal <i class="fa-solid fa-arrow-right ms-2"></i></a>
</div></section>
<section id="akses" class="container py-5"><div class="text-center mb-4"><h2 class="fw-bold">Akses Portal Pengguna</h2><p class="text-secondary">Pilih portal sesuai peran Anda</p></div><div class="row g-4">
<div class="col-md-4"><div class="card portal h-100 text-center p-4"><div class="roleicon bg-primary-subtle text-primary"><i class="fa-solid fa-user-graduate"></i></div><h4>Mahasiswa</h4><p class="text-secondary">Lihat biodata dan informasi pribadi.</p><a class="btn btn-outline-primary mt-auto" href="login_mahasiswa.php">Login Mahasiswa</a></div></div>
<div class="col-md-4"><div class="card portal h-100 text-center p-4"><div class="roleicon bg-success-subtle text-success"><i class="fa-solid fa-user-gear"></i></div><h4>Operator Prodi</h4><p class="text-secondary">Kelola data mahasiswa program studi.</p><a class="btn btn-outline-success mt-auto" href="login.php">Login Operator</a></div></div>
<div class="col-md-4"><div class="card portal h-100 text-center p-4"><div class="roleicon bg-purple-subtle text-dark" style="background:#f3e5f5;color:#8e24aa"><i class="fa-solid fa-user-shield"></i></div><h4>Administrator</h4><p class="text-secondary">Kelola data dan akun sistem.</p><a class="btn btn-outline-dark mt-auto" href="login.php">Login Admin</a></div></div>
</div></section>
<section id="info" class="bg-white border-top py-5"><div class="container"><div class="row g-4"><div class="col-md-6"><h3><i class="fa-solid fa-mobile-screen text-primary me-2"></i>Dukungan PWA</h3><p class="text-secondary">Website responsif dan dapat dipasang sebagai aplikasi web pada browser yang mendukung.</p></div><div class="col-md-6"><h5>Petunjuk login</h5><p class="text-secondary">Mahasiswa menggunakan NPM. Operator dan administrator menggunakan username yang terdaftar.</p></div></div></div></section>
<footer class="text-center text-white py-4" style="background:#171923"><small>&copy; <?= date('Y') ?> Universitas Semantik</small></footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
if ('serviceWorker' in navigator && location.protocol.startsWith('http')) navigator.serviceWorker.register('sw.js').catch(console.error);
</script></body></html>
