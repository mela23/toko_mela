<?php $data_produk = $produk->tampil_produk();
 ?>
<div class="panel panel-primary">
	<div class="panel-heading"><h4>Produk</h4></div>
	<div class="panel-body">
		<table class="table table-stripped thetable" >
			<thead>
				<tr>
					<th>No</th>
					<th>Kategori</th>
					<th>Produk</th>
					<th>Harga</th>
					<th>Berat</th>
					<th>Stok</th>
					<th>Foto</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data_produk as $key => $value): ?>
			<?php $detail_kategori=$kategori->ambil_kategori($value['id_kategori']); ?> 
				<tr>
					<td><?php echo $key+1; ?></td>
					<td><?php echo $detail_kategori ['nama_kategori'] ?></td>
					<td><?php echo $value['nama_produk'] ?></td>
					<td><?php echo $value['harga_produk'] ?></td>
					<td><?php echo $value['berat_produk'] ?>gr</td>
					<td><?php echo $value['stok_produk'] ?></td>
					<td><img src="../assets/img/produk/<?php echo $value['foto_produk']; ?>" class="img-responsive" width = 100px></td>
					<td>
						<a href="index.php?halaman=edit&id=<?php echo $value['id_produk'] ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
						<a href="index.php?halaman=hapus_produk&id=<?php echo $value['id_produk']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>			
		</table>
		<a href="index.php?halaman=tambah_produk" class="btn btn-primary">Tambah Produk</a>
	</div>
</div>