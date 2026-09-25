<?php
require_once 'functions.php'; harus_role(['Administrator','Operator Prodi']);
$role=user_role(); $idprodi=$_SESSION['user']['id_prodi'];
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['tambah'])){
  $npm=trim($_POST['npm']??''); $nama=trim($_POST['nama']??''); $prodi=(int)($_POST['id_prodi']??0);
  $jk=$_POST['jk']??'L'; $tempat=trim($_POST['tempat']??''); $tgl=$_POST['tgl']??''; $masuk=$_POST['masuk']??''; $alamat=trim($_POST['alamat']??'');
  if($role==='Operator Prodi') $prodi=(int)$idprodi;
  if($npm && $nama && $prodi>0 && in_array($jk,['L','P'],true) && $tgl && $masuk && $alamat){
    $hash=password_hash('Mahasiswa123!',PASSWORD_DEFAULT);
    $stmt=mysqli_prepare($koneksi,"INSERT INTO mahasiswa(npm,password,id_prodi,nama_mahasiswa,jenis_kelamin,tempat_lahir,tanggal_lahir,tanggal_masuk,alamat) VALUES(?,?,?,?,?,?,?,?,?)");
    mysqli_stmt_bind_param($stmt,'ssissssss',$npm,$hash,$prodi,$nama,$jk,$tempat,$tgl,$masuk,$alamat);
    if(mysqli_stmt_execute($stmt)) $msg='Mahasiswa ditambahkan. Password awal: Mahasiswa123!';
    else $msg='Gagal menambah data. Pastikan NPM belum digunakan dan prodi valid.';
  } else $msg='Lengkapi semua kolom dengan benar.';
}
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['hapus']) && $role==='Administrator'){
  $npm=$_POST['hapus']; $stmt=mysqli_prepare($koneksi,"DELETE FROM mahasiswa WHERE npm=?"); mysqli_stmt_bind_param($stmt,'s',$npm); mysqli_stmt_execute($stmt); $msg='Permintaan penghapusan diproses.';
}
header_html('Data Mahasiswa');
echo '<div class="d-flex justify-content-between align-items-center mb-3"><h2>Data Mahasiswa</h2><a href="dashboard.php" class="btn btn-outline-secondary">Dashboard</a></div>';
if(!empty($msg)) echo '<div class="alert alert-info">'.e($msg).'</div>';
$prodis=mysqli_query($koneksi,"SELECT id_prodi,nama_prodi FROM prodi ORDER BY nama_prodi");
echo '<div class="card border-0 shadow-sm mb-4"><div class="card-body"><h5>Tambah Mahasiswa</h5><form method="post" class="row g-2"><input type="hidden" name="tambah" value="1"><div class="col-md-3"><input class="form-control" name="npm" placeholder="NPM" required></div><div class="col-md-5"><input class="form-control" name="nama" placeholder="Nama mahasiswa" required></div>';
if($role==='Administrator'){echo '<div class="col-md-4"><select class="form-select" name="id_prodi" required><option value="">Pilih prodi</option>'; while($p=mysqli_fetch_assoc($prodis)) echo '<option value="'.(int)$p['id_prodi'].'">'.e($p['nama_prodi']).'</option>'; echo '</select></div>';} else echo '<input type="hidden" name="id_prodi" value="'.(int)$idprodi.'">';
echo '<div class="col-md-3"><select class="form-select" name="jk"><option value="L">Laki-laki</option><option value="P">Perempuan</option></select></div><div class="col-md-3"><input class="form-control" name="tempat" placeholder="Tempat lahir" required></div><div class="col-md-3"><input class="form-control" type="date" name="tgl" required></div><div class="col-md-3"><input class="form-control" type="date" name="masuk" required></div><div class="col-md-9"><input class="form-control" name="alamat" placeholder="Alamat" required></div><div class="col-12"><button class="btn btn-primary">Simpan Mahasiswa</button></div></form><small class="text-muted">Password awal mahasiswa: Mahasiswa123!</small></div></div>';
$sql="SELECT m.npm,m.nama_mahasiswa,m.jenis_kelamin,m.status_aktif,p.nama_prodi FROM mahasiswa m JOIN prodi p ON p.id_prodi=m.id_prodi";
if($role==='Operator Prodi') $sql.=" WHERE m.id_prodi=".(int)$idprodi;
$sql.=" ORDER BY m.nama_mahasiswa";
$res=mysqli_query($koneksi,$sql);
echo '<div class="table-responsive card border-0 shadow-sm"><table class="table table-striped mb-0"><thead><tr><th>NPM</th><th>Nama</th><th>Prodi</th><th>JK</th><th>Status</th>'.($role==='Administrator'?'<th>Aksi</th>':'').'</tr></thead><tbody>';
while($r=mysqli_fetch_assoc($res)){echo '<tr><td>'.e($r['npm']).'</td><td>'.e($r['nama_mahasiswa']).'</td><td>'.e($r['nama_prodi']).'</td><td>'.e($r['jenis_kelamin']).'</td><td>'.e($r['status_aktif']).'</td>'; if($role==='Administrator') echo '<td><form method="post" onsubmit="return confirm(\\'Hapus mahasiswa ini?\\')"><button class="btn btn-sm btn-danger" name="hapus" value="'.e($r['npm']).'">Hapus</button></form></td>'; echo '</tr>';}
echo '</tbody></table></div>'; footer_html();
