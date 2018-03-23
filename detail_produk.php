<?php 
$id_produk = $_GET['id'];
$data_produk = $produk->ambil_data_produk($id_produk);

if (isset($_POST['beli']))
{
	$jumlah_beli = $_POST['jumlah_beli'];
	// 2 kondisi
	// sebelumnya sudah pernah beli
	if (isset($_SESSION['keranjang'][$id_produk]))
	{
		$_SESSION['keranjang'][$id_produk] = $jumlah_beli;
	}
	else
	{
		// dan belum pernah beli
		$_SESSION['keranjang'][$id_produk] = $jumlah_beli;
	}
}
?>
<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<img src="assets/img/produk/<?php echo $data_produk['foto_produk'] ?>" alt="foto_produk.jpg" width="400px">
		</div>
		<div class="col-sm-6">
			<h3><?php echo $data_produk['nama_produk'] ?></h3>
			<form class="form-horizontal" method="POST">
				<div class="form-group">
					<label class="col-sm-3">Harga</label>
					<div class="col-sm-9"> :
						Rp<?php echo number_format($data_produk['harga_produk']) ?> 
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3">Berat Produk</label>
					<div class="col-sm-9"> :
						<?php echo $data_produk['berat_produk'] ?>gr
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-8">
						<input type="text" name="jumlah_beli" class="form-control" placeholder="Jumlah item">
					</div>
					<div class="col-sm-4">
						<button name="beli" class="btn btn-primary btn-block">Beli</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-sm-12">
			<p>
				<?php echo $data_produk['deskripsi_produk'] ?>
			</p>
		</div>
	</div>
</div>