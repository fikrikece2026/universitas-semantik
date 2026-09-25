<?php
require_once 'functions.php';
if (!empty($_SESSION['user'])) { header('Location: dashboard.php'); exit; }
$error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $npm=trim($_POST['npm']??''); $password=$_POST['password']??'';
    $stmt=mysqli_prepare($koneksi,"SELECT npm,password,nama_mahasiswa,id_prodi,status_aktif FROM mahasiswa WHERE npm=? LIMIT 1");
    mysqli_stmt_bind_param($stmt,'s',$npm); mysqli_stmt_execute($stmt);
    $m=mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    if($m && $m['status_aktif']==='aktif' && password_verify($password,$m['password'])){
        session_regenerate_id(true);
        $_SESSION['user']=['id'=>$m['npm'],'username'=>$m['npm'],'nama'=>$m['nama_mahasiswa'],'role'=>'Mahasiswa','id_prodi'=>$m['id_prodi']];
        header('Location: dashboard.php'); exit;
    }
    $error='NPM atau password salah, atau akun tidak aktif.';
}
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Login Mahasiswa</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light"><div class="container py-5"><div class="card border-0 shadow-sm mx-auto p-4" style="max-width:440px"><h3>Login Mahasiswa</h3><p class="text-secondary">Masuk menggunakan NPM</p><?php if($error): ?><div class="alert alert-danger"><?=e($error)?></div><?php endif; ?><form method="post"><label class="form-label">NPM</label><input class="form-control mb-3" name="npm" required><label class="form-label">Password</label><input class="form-control mb-3" type="password" name="password" required><button class="btn btn-primary w-100">Masuk</button></form><a class="mt-3 text-center" href="index.php">Kembali ke beranda</a></div></div></body></html>
