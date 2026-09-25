<?php
require_once 'functions.php'; harus_role(['Administrator']);
$msg='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $username=trim($_POST['username']??''); $nama=trim($_POST['nama']??''); $nip=trim($_POST['nip']??''); $prodi=(int)($_POST['id_prodi']??0); $password=$_POST['password']??'';
  if($username && $nama && strlen($password)>=8 && $prodi>0){
    $hash=password_hash($password,PASSWORD_DEFAULT);
    $roleid=(int)mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT id_role FROM role WHERE nama_role='Operator Prodi'"))['id_role'];
    $stmt=mysqli_prepare($koneksi,"INSERT INTO pengguna(username,password,nama_lengkap,nip,id_role,id_prodi) VALUES(?,?,?,?,?,?)");
    mysqli_stmt_bind_param($stmt,'ssssii',$username,$hash,$nama,$nip,$roleid,$prodi);
    $msg=mysqli_stmt_execute($stmt)?'Operator berhasil dibuat.':'Gagal membuat operator. Username/NIP mungkin sudah digunakan.';
  } else $msg='Lengkapi data; password minimal 8 karakter.';
}
header_html('Pengguna'); echo '<h2>Kelola Operator Prodi</h2><p><a href="dashboard.php">Kembali ke dashboard</a></p>';
if($msg) echo '<div class="alert alert-info">'.e($msg).'</div>';
$ps=mysqli_query($koneksi,"SELECT id_prodi,nama_prodi FROM prodi ORDER BY nama_prodi");
echo '<div class="card border-0 shadow-sm p-3 mb-4"><form method="post" class="row g-3"><div class="col-md-3"><input class="form-control" name="username" placeholder="Username" required></div><div class="col-md-3"><input class="form-control" name="nama" placeholder="Nama lengkap" required></div><div class="col-md-2"><input class="form-control" name="nip" placeholder="NIP (opsional)"></div><div class="col-md-2"><select class="form-select" name="id_prodi" required><option value="">Pilih prodi</option>';
while($p=mysqli_fetch_assoc($ps)) echo '<option value="'.(int)$p['id_prodi'].'">'.e($p['nama_prodi']).'</option>';
echo '</select></div><div class="col-md-2"><input class="form-control" type="password" name="password" placeholder="Password min. 8" minlength="8" required></div><div class="col-12"><button class="btn btn-primary">Buat Operator</button></div></form></div>';
$res=mysqli_query($koneksi,"SELECT p.username,p.nama_lengkap,p.nip,p.status_aktif,d.nama_prodi FROM pengguna p JOIN prodi d ON d.id_prodi=p.id_prodi JOIN role r ON r.id_role=p.id_role WHERE r.nama_role='Operator Prodi' ORDER BY p.nama_lengkap");
echo '<div class="table-responsive"><table class="table table-striped bg-white"><thead><tr><th>Username</th><th>Nama</th><th>NIP</th><th>Prodi</th><th>Status</th></tr></thead><tbody>';
while($r=mysqli_fetch_assoc($res)) echo '<tr><td>'.e($r['username']).'</td><td>'.e($r['nama_lengkap']).'</td><td>'.e($r['nip']).'</td><td>'.e($r['nama_prodi']).'</td><td>'.e($r['status_aktif']).'</td></tr>';
echo '</tbody></table></div>'; footer_html();
