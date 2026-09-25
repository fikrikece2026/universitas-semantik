<?php
require_once 'functions.php'; harus_role(['Administrator']); header_html('Data Master');
echo '<h2>Data Fakultas dan Program Studi</h2><p><a href="dashboard.php">Kembali ke dashboard</a></p>';
$r=mysqli_query($koneksi,"SELECT f.nama_fakultas,p.nama_prodi FROM fakultas f LEFT JOIN prodi p ON p.id_fakultas=f.id_fakultas ORDER BY f.nama_fakultas,p.nama_prodi");
echo '<div class="table-responsive"><table class="table table-striped bg-white"><thead><tr><th>Fakultas</th><th>Program Studi</th></tr></thead><tbody>';
while($x=mysqli_fetch_assoc($r)) echo '<tr><td>'.e($x['nama_fakultas']).'</td><td>'.e($x['nama_prodi']??'-').'</td></tr>';
echo '</tbody></table></div><div class="alert alert-info">Untuk menjaga integritas data, penambahan master fakultas/prodi dapat dilakukan melalui phpMyAdmin atau dikembangkan menjadi formulir CRUD.</div>';
footer_html();
