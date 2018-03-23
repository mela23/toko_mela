<?php  
// membuat function yang digunakan untuk menampilkan transaksi yang belum dikonfirmasi oleh member yang lagi login
$id_member = $_SESSION['member']['id_member'];
$transaksi_belum = $transaksi->transaksi_proses($id_member, 'Belum konfirmasi');
$menunggu = $transaksi->transaksi_proses($id_member, 'menunggu');
$proses = $transaksi->transaksi_proses($id_member, 'proses');
$batal = $transaksi->transaksi_proses($id_member, 'batal');
$histori = $transaksi->transaksi_histori($id_member);
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#belum_konfirmasi" aria-controls="belum_konfirmasi" role="tab" data-toggle="tab"><span class="badge"><?php echo count($transaksi_belum) ?></span> Belum Konfirmasi</a></li>
				<li role="presentation"><a href="#proses" aria-controls="profile" role="tab" data-toggle="tab"><span class="badge"><?php echo count($proses) ?></span> Proses</a></li>
				<li role="presentation"><a href="#menunggu" aria-controls="profile" role="tab" data-toggle="tab"><span class="badge"><?php echo count ($menunggu) ?></span> Menunggu</a></li>
				<li role="presentation"><a href="#batal" aria-controls="messages" role="tab" data-toggle="tab"><span class="badge"><?php echo count ($batal) ?></span> Batal</a></li>
				<li role="presentation"><a href="#histori" aria-controls="settings" role="tab" data-toggle="tab"><span class="badge"><?php echo count($histori) ?></span> Histori</a></li>
			</ul>
			<div class="panel panel-info">
				<div class="panel-body">
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="belum_konfirmasi">
							<table class="table table-stripped">
								<thead>
									<tr>
										<th>No</th>
										<th>Tanggal</th>
										<th>Total</th>
										<th></th>

									</tr>
								</thead>
								<tbody>
									<?php foreach ($transaksi_belum as $index_bk => $val_bk): ?>
										<tr>
											<td><?php echo $index_bk+1 ?></td>
											<td> <?php echo $val_bk['tgl_transaksi'] ?></td>
											<td><?php echo number_format($val_bk['total_bayar']) ?></td>
											<td><a href="index.php?halaman=konfirmasi&id=<?php echo $val_bk['id_transaksi'] ?> " class="btn btn-warning btn-sm">Konfirmasi</a></td>
										</tr>

									<?php endforeach ?>
								</tbody>
							</table>
						</div>
						<div role="tabpanel" class="tab-pane" id="proses">
							<table class="table table-stripped">
								<thead>
									<tr>
										<th>No</th>
										<th>Tanggal</th>
										<th>Total</th>
										<th></th>

									</tr>
								</thead>
								<tbody>
									<?php foreach ($proses as $index_proses => $val_proses): ?>
										<tr>
											<td><?php echo $index_proses+1 ?></td>
											<td> <?php echo $val_proses['tgl_transaksi'] ?></td>
											<td><?php echo number_format($val_proses['total_bayar']) ?></td>
											<td><a href="index.php?halaman=konfirmasi&id=<?php echo $val_proses['id_transaksi'] ?> " class="btn btn-warning btn-sm">Detail</a></td>
										</tr>

									<?php endforeach ?>
								</tbody>
							</table>
						</div>
						<div role="tabpanel" class="tab-pane" id="menunggu">
							
							<table class="table table-stripped">
								<thead>
									<tr>
										<th>No</th>
										<th>Tanggal</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($menunggu as $key => $value): ?>
										<tr>
											<td><?php echo $key+1 ?></td>
											<td> <?php echo $value['tgl_transaksi'] ?></td>
											<td><?php echo number_format($value['total_bayar']) ?></td>
											<td><td><a href="index.php?halaman=konfirmasi&id=<?php echo $val_proses['id_transaksi'] ?> " class="btn btn-warning btn-sm">Detail</a></td></td>
										</tr>

									<?php endforeach ?>
								</tbody>
							</table>
						
						</div>
						<div role="tabpanel" class="tab-pane" id="batal">
							<table class="table table-stripped">
								<thead>
									<tr>
										<th>No</th>
										<th>Tanggal</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($batal as $index_batal => $val_batal): ?>
										<tr>
											<td><?php echo $index_batal+1 ?></td>
											<td> <?php echo $val_batal['tgl_transaksi'] ?></td>
											<td><?php echo number_format($val_batal['total_bayar']) ?></td>
										</tr>

									<?php endforeach ?>
								</tbody>
							</table>
						</div>
						<div role="tabpanel" class="tab-pane" id="histori">
							<table class="table table-stripped">
								<thead>
									<tr>										
										<th>Tanggal</th>
										<th>Total</th>
										<th>Status Pembayaran</th>					
									</tr>
								</thead>
								<tbody>
									<?php foreach ($histori as $index_h => $val_h): ?>
										<tr>
								
											<td> <?php echo $val_h['tgl_transaksi'] ?></td>
											<td><?php echo number_format($val_h['total_bayar']) ?></td>
											<td><?php echo $val_h['status_pembayaran'] ?></td>
											<td><td><a href="index.php?halaman=konfirmasi&id=<?php echo $val_proses['id_transaksi'] ?> " class="btn btn-warning btn-sm">Detail</a></td></td>
										</tr>

									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>