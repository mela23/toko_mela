 <!-- 
dalam transaksi cuma ada 1 data, detail ada >1 maka harus diperulangkan
dan tidak bisa menggunakan 1 function
1. function yang isi sql nya untuk menampilkan transaksi saja
2. function yang isi sql nya menampilkan data detail transaksi berdasarkan id_transaksi
-->
<?php 
$data_transaksi = $transaksi->ambil_transaksi($_GET['id']);
$detail = $transaksi->ambil_detail_transaksi($_GET['id']);
$data_member = $member->ambil_member($data_transaksi['id_member']);
$total_berat = 0;

$tanggal = date('d, M, Y', strtotime($data_transaksi['tgl_transaksi']));
?>
 	<div class="container">
 		<div class="row">
 			<div class="panel panel-default">
 				<div class="panel-heading"><h5><?php echo $tanggal ?></h5></div>
 				<div class="panel-body">
 					<div class="col-md-4">
 						<small>From : </small>
 						<address>
 							<strong><?php echo $data_member['nama_member'] ?></strong><br>
 							<?php echo $data_member['alamat_member'] ?><br>
 							Phone : <?php echo $data_member['telp_member'] ?><br>
 						</address>
 					</div>
 					<div class="col-md-4">
 						<small>To : </small>
 						<address>
 							<strong><?php echo $data_transaksi['nama_penerima'] ?></strong><br>
 							<?php echo $data_transaksi['alamat_penerima'] ?><br>
 							Phone : <?php echo $data_transaksi['telp_penerima'] ?><br>
 						</address>
 					</div>
 					<div class="col-md-4">
 						<small>Informasi</small>
 						<address>
 							<strong>No Resi :<?php echo $data_transaksi['no_resi'] ?></strong><br>
 							<?php echo $data_transaksi['paket_ongkir'] ?>
 						</address>
 					</div>
 					<div class="col-md-12"> 
 					<table class="table table-bordered table-striped table-hover">
 						<thead>
 							<tr>
 								<th>No</th>
 								<th>Produk</th>
 								<th>Jumlah</th>
 								<th>Berat(gr)</th>
 								<th>Harga(Rp.)</th>
 								<th>Subberat</th>
 								<th>Subtotal</th>
 							</tr>
 						</thead>
 						<tbody>
 							<?php foreach ($detail as $key => $value): ?>
 								<tr>
 									<?php 
                  // sub berat
 									$data_produk = $produk->ambil_produk($value['id_produk']);
 									$sub_berat = $value['jumlah_produk'] * $data_produk['berat_produk'];
 									$sub_total = $value['jumlah_produk'] *$value['harga_produk'];
 									?>
 									<td><?php echo $key+1 ?></td>
 									<td><?php echo $data_produk['nama_produk'] ?></td>
 									<td><?php echo $value ['jumlah_produk'] ?></td>
 									<td><?php echo $data_produk ['berat_produk'] ?></td>
 									<td><?php echo $value ['harga_produk'] ?></td>
 									<td><?php echo $sub_berat ?></td>
 									<td><?php echo $sub_total ?></td>

 								</tr>
 								<?php 
 								$total_berat += $sub_berat;
 								?>
 							<?php endforeach ?>
 						</tbody>
 						<tfoot>
 							<tr>
 								<th colspan="5" class="text-right">Total </th>
 								<th><?php echo $total_berat ?>gr</th>
 								<th>Rp<?php echo number_format($data_transaksi['total_bayar']) ?></th>
 							</tr>
 						</tfoot>
 					</table>
 				</div>
 			</div>
 		</div>
 		<?php if ($data_transaksi['status_pembayaran'] == 'Belum konfirmasi'):?>
 			<a href="index.php?halaman=bayar&id=<?php echo $_GET['id'] ?>" class="btn btn-primary btn-lg pull-right" >Bayar</a>

 		<?php elseif ($data_transaksi['status_pembayaran'] == 'menunggu'): ?>
 			<!-- Jika status == menunggu maka button tidak tampil -->
 			<div class="alert alert-info text-center">
 				Transaksi anda sedang kami proses. Mohon menunggu
 			</div>
 		<?php endif ?>
 	</div>