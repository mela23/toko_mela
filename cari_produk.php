<?php 
$cari_produk = $produk->cari_produk ($_GET['keyword']);
 ?>
 <?php if (empty($cari_produk)): ?>
 	<?php echo "<div class='alert alert-danger text-center'><h4>Produk tidak ditemukan</h4></div>";
 	echo "<meta http-equiv='refresh' content='1; url=index.php'>";
 	 ?>
 <?php else: ?>
 	<div class="row container">
				<?php foreach ($cari_produk as $key => $value): ?>

					<div class="col-md-3">
						<div class="thumbnail">
							<img src="assets/img/produk/<?php echo $value['foto_produk']; ?>">
							<div class="caption text-center">
								<h2><?php echo $value['nama_produk'] ?></h2>
								<p><strong>Rp<?php echo number_format($value['harga_produk']) ?></strong></p>
								<p>
									<a href="index.php?halaman=beli&id=<?php echo $value['id_produk']; ?>" class="btn btn-success">Beli</a>
									<a href="index.php?halaman=detail_produk&id=<?php echo $value ['id_produk'] ?>" class="btn btn-default">Detail</a>
								</p>
							</div>
						</div>
					</div>
				<?php endforeach ?>

			</div>
 <?php endif ?>
