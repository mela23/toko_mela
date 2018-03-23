<?php 
$data_keranjang = $produk->tampil_keranjang();
 ?>

<form method="POST">
	
		<div class="keranjang">
			<div class="container">
				<h1>Keranjang Belanja</h1>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Produk</th>
							<th width="10%">Jumlah</th>
							<th>Berat(gr)</th>
							<th>Harga(Rp.)</th>
							<th>Subberat</th>
							<th>Subtotal</th>
							<th>Batal?</th>
						</tr>
					</thead>
					<tbody>
						<?php if (isset($_SESSION['keranjang'])): ?>
							
						
						<?php foreach ($data_keranjang as $key => $value): ?>
							<?php if ($key !== 'total_berat' && $key !=='total_belanja'): ?>							
						<tr>
							<td><?php echo $key+1 ?></td>
							<td><?php echo $value['nama_produk'] ?></td>
							<td><input type="number" name="jumlah_beli[<?php echo $value['id_produk'] ?>]" class="form-control" value="<?php echo $value['jumlah_beli'] ?>"></td>
							<td><?php echo $value['berat_produk'] ?></td>
							<td>Rp<?php echo number_format($value['harga_produk']) ?></td>
							<td><?php echo $value['sub_berat'] ?>Kg</td>
							<td>Rp<?php echo number_format($value['sub_total']) ?></td>
							<td>
								<a href="index.php?halaman=cancel&id=<?php echo $value['id_produk'] ?>" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></a>
							</td>
						</tr>
							<?php endif ?>
						<?php endforeach ?>
						
					</tbody>
					<tfoot>
						<tr>
							<th colspan="5">Total Belanja</th>
							<th><?php echo $value ['total_berat'] ?> Kg</th>
							<th>Rp<?php echo number_format($value['total_belanja']) ?></th>
						</tr>
					</tfoot>
					<?php else: ?>
						<tr>
							<td colspan="8">
								<div class="alert alert-warning">No item</div>
							</td>
						</tr>
							
						<?php endif ?>
				</table>
				<button class="btn btn-warning" name="ubah_jumlah">Ubah Jumlah</button>
				<a href="index.php" class="btn btn-default">Lanjutkan Belanja</a>
				<a href="index.php?halaman=checkout" class="btn btn-primary">Check Out</a>
				<a href="index.php?halaman=reset" class="btn btn-danger">Reset</a>
			</div>
		</div>
		<hr>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
</form>
<?php 
if (isset($_POST['ubah_jumlah']))
{

	foreach ($_POST['jumlah_beli'] as $id_produk => $jumlah_beli) 
	{
		$_SESSION['keranjang'][$id_produk] = $jumlah_beli;
	}
	echo "<script>location='index.php?halaman=keranjang';</script>";
}
 ?>