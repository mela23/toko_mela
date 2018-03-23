<?php  
$data_kategori=$kategori->tampil_kategori();

?>
<div class="container">
	<h2>Data Kategori</h2>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Kategori</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($data_kategori as $key => $value): ?>
				<tr>
					<td><?php echo $key+1 ?></td>
					<td><?php echo $value['nama_kategori'] ?></td>
					<td>
						<a href="index.php?halaman=ubah_kategori&id=<?php echo $value['id_kategori']; ?>" class="btn btn-warning">Ubah</a>
						<a href="index.php?halaman=hapus_kategori&id=<?php  echo $value ['id_kategori']; ?>" class="btn btn-danger" onclick="return confirm('Yakin?')">Hapus</a>
					</td>
				</tr>
			<?php endforeach ?>
			
		</tbody>
	</table>
	<a href="index.php?halaman=tambah_kategori" class="btn btn-primary">Tambah Data</a>
</div>
