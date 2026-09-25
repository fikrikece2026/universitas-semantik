<?php
require_once 'functions.php'; harus_login();
$role=user_role(); header_html('Dashboard');
echo '<h2 class="fw-bold">Dashboard</h2><p class="text-secondary">Selamat datang, '.e($_SESSION['user']['nama']).'.</p><div class="row g-3">';
if($role==='Mahasiswa'){
  $npm=$_SESSION['user']['id'];
  $stmt=mysqli_prepare($koneksi,"SELECT m.*,p.nama_prodi,f.nama_fakultas FROM mahasiswa m JOIN prodi p ON p.id_prodi=m.id_prodi JOIN fakultas f ON f.id_fakultas=p.id_fakultas WHERE m.npm=?");
  mysqli_stmt_bind_param($stmt,'s',$npm); mysqli_stmt_execute($stmt); $m=mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
  echo '<div class="col-lg-8"><div class="card border-0 shadow-sm"><div class="card-body"><h5>Biodata Mahasiswa</h5>';
  if($m){ echo '<dl class="row mb-0">'; foreach(['npm'=>'NPM','nama_mahasiswa'=>'Nama','nama_fakultas'=>'Fakultas','nama_prodi'=>'Program Studi','jenis_kelamin'=>'Jenis Kelamin','tempat_lahir'=>'Tempat Lahir','tanggal_lahir'=>'Tanggal Lahir','tanggal_masuk'=>'Tanggal Masuk','alamat'=>'Alamat','status_aktif'=>'Status'] as $k=>$label) echo '<dt class="col-sm-4">'.e($label).'</dt><dd class="col-sm-8">'.e($m[$k]).'</dd>'; echo '</dl>'; }
  echo '</div></div></div>';
} else {
  echo '<div class="col-md-4"><div class="card border-0 shadow-sm"><div class="card-body"><h5>Data Mahasiswa</h5><p>Kelola data mahasiswa.</p><a class="btn btn-primary" href="mahasiswa.php">Buka Data Mahasiswa</a></div></div></div>';
  if($role==='Administrator') echo '<div class="col-md-4"><div class="card border-0 shadow-sm"><div class="card-body"><h5>Pengguna</h5><p>Buat akun operator prodi.</p><a class="btn btn-outline-primary" href="pengguna.php">Kelola Pengguna</a></div></div></div><div class="col-md-4"><div class="card border-0 shadow-sm"><div class="card-body"><h5>Fakultas & Prodi</h5><p>Lihat data master.</p><a class="btn btn-outline-secondary" href="master.php">Data Master</a></div></div></div>';
}
echo '</div>'; footer_html();
