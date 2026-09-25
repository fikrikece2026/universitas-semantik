<?php
require_once 'functions.php';
if (!empty($_SESSION['user'])) { header('Location: dashboard.php'); exit; }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $sql = "SELECT p.id_pengguna,p.username,p.password,p.nama_lengkap,p.id_prodi,p.status_aktif,r.nama_role
            FROM pengguna p JOIN role r ON r.id_role=p.id_role WHERE p.username=? LIMIT 1";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $u = mysqli_fetch_assoc($res);
    if ($u && $u['status_aktif']==='aktif' && password_verify($password, $u['password']) &&
        in_array($u['nama_role'], ['Administrator','Operator Prodi'], true)) {
        session_regenerate_id(true);
        $_SESSION['user'] = ['id'=>$u['id_pengguna'],'username'=>$u['username'],'nama'=>$u['nama_lengkap'],'role'=>$u['nama_role'],'id_prodi'=>$u['id_prodi']];
        header('Location: dashboard.php'); exit;
    }
    $error = 'Username atau password salah, atau akun tidak aktif.';
}
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Login Pengelola</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light"><div class="container py-5"><div class="card border-0 shadow-sm mx-auto p-4" style="max-width:440px"><h3 class="mb-1">Login Pengelola</h3><p class="text-secondary">Operator Prodi / Administrator</p>
<?php if($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
<form method="post"><label class="form-label">Username</label><input class="form-control mb-3" name="username" required autocomplete="username"><label class="form-label">Password</label><input class="form-control mb-3" type="password" name="password" required autocomplete="current-password"><button class="btn btn-primary w-100">Masuk</button></form><a class="mt-3 text-center" href="index.php">Kembali ke beranda</a></div></div></body></html>
