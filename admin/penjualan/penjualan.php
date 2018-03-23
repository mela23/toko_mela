<ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active"><a href="#belum_konfirmasi" aria-controls="home" role="tab" data-toggle="tab">Belum Konfirmasi</a></li>
	<li role="presentation"><a href="#konfirmasi" aria-controls="profile" role="tab" data-toggle="tab">Konfirmasi</a></li>
	<li role="presentation"><a href="#proses" aria-controls="profile" role="tab" data-toggle="tab">Proses</a></li>
	<li role="presentation"><a href="#batal" aria-controls="batal" role="tab" data-toggle="tab">Batal</a></li>
	<li role="presentation"><a href="#histori" aria-controls="histori" role="tab" data-toggle="tab">Histori</a></li>
</ul>
<div class="panel panel-info">
	<div class="panel-body">
		<div class="tab-content">
			<!-- menampilkan transaksi oleh member yang belum konfirmasi == 'status_pembayaran' == 'belum konfirmasi' -->
			<?php 
			$belum = $transaksi->tampil_status_transaksi('Belum konfirmasi');
			$konfirmasi = $transaksi->tampil_status_transaksi('menunggu');
			$proses = $transaksi->tampil_status_transaksi('proses');
			$batal = $transaksi->tampil_status_transaksi('batal');
			$histori = $transaksi->tampil_transaksi_histori();

			?>
			<div role="tabpanel" class="tab-pane active" id="belum_konfirmasi">
				<table class="table table-striped thetable">
					<thead>
						<tr>
							<th>No</th>
							<th>Member</th>
							<th>Tanggal</th>
							<th>Total</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($belum as $index_belum => $val_belum): ?>
							<?php 
							$data_member = $member->ambil_member($val_belum['id_member']);
							?>
							<tr>
								<td><?php echo $index_belum+1 ?></td>
								<td><?php echo $data_member['nama_member'] ?></td>
								<td><?php echo $val_belum['tgl_transaksi'] ?></td>
								<td><?php echo $val_belum['total_bayar'] ?></td>
								<td><?php echo $val_belum['status_pembayaran'] ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div role="tabpanel" class="tab-pane" id="konfirmasi">
				<table class="table table-striped thetable">
					<thead>
						<tr>
							<th>No</th>
							<th>Member</th>
							<th>Tgl Konfirmasi</th>
							<th>Tgl Transfer</th>
							<th>Tgl Pembelian</th>
							<th>Total</th>
							<th>Status</th>
							<th>Acc</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($konfirmasi as $index_konf => $val_konfirmasi): ?>
							<?php 
							$data_member1 = $member->ambil_member($val_konfirmasi['id_member']);

							$detail_pembayaran = $transaksi->pembayaran($val_konfirmasi['id_transaksi']);
							?>
							<tr>
								<td><?php echo $index_konf+1 ?></td>
								<td><?php echo $data_member1['nama_member'] ?></td>
								<td><?php echo $detail_pembayaran['tgl_konfirmasi'] ?></td>
								<td><?php echo $detail_pembayaran['tgl_transfer'] ?></td>
								<td><?php echo $val_konfirmasi['tgl_transaksi'] ?></td>
								<td>Rp<?php echo number_format($val_konfirmasi['total_bayar']) ?></td>
								<td><?php echo $val_konfirmasi['status_pembayaran'] ?></td>
								<td>
									<a href="index.php?halaman=detail_transaksi&id=<?php echo $val_konfirmasi['id_transaksi'] ?>" class="btn btn-primary btn-sm">
										<i class="fa fa-search"></i>
									</a>
									<a href="index.php?halaman=acc&id=<?php echo $val_konfirmasi['id_transaksi'] ?>&status=proses" class="btn btn-warning btn-sm">
										<i class="fa fa-check"></i>
									</a>
									<a href="index.php?halaman=acc&id=<?php echo $val_konfirmasi['id_transaksi'] ?>&status=batal" class="btn btn-danger btn-sm">
										<i class="fa fa-remove"></i>
									</a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>		
			</div>
			<div role="tabpanel" class="tab-pane" id="proses">
				<table class="table table-striped thetable">
					<thead>
						<tr>
							<th>No</th>
							<th>Member</th>
							<th>Tgl Konfirmasi</th>
							<th>Tgl Transfer</th>
							<th>Tgl Pembelian</th>
							<th>Total</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($proses as $index_konf => $val_konfirmasi): ?>
							<?php 
							$data_member1 = $member->ambil_member($val_konfirmasi['id_member']);

							$detail_pembayaran = $transaksi->pembayaran($val_konfirmasi['id_transaksi']);
							?>
							<tr>
								<td><?php echo $index_konf+1 ?></td>
								<td><?php echo $data_member1['nama_member'] ?></td>
								<td><?php echo $detail_pembayaran['tgl_konfirmasi'] ?></td>
								<td><?php echo $detail_pembayaran['tgl_transfer'] ?></td>
								<td><?php echo $val_konfirmasi['tgl_transaksi'] ?></td>
								<td>Rp<?php echo number_format($val_konfirmasi['total_bayar']) ?></td>
								<td><?php echo $val_konfirmasi['status_pembayaran'] ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>		
			</div>
			<div role="tabpanel" class="tab-pane" id="batal">
				<table class="table table-striped thetable">
					<thead>
						<tr>
							<th>No</th>
							<th>Member</th>
							<th>Tgl Konfirmasi</th>
							<th>Tgl Transfer</th>
							<th>Tgl Pembelian</th>
							<th>Total</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						
						<?php foreach ($batal as $index_batal => $val_batal): ?>
							<tr>
								<?php 
								$data_member1 = $member->ambil_member($val_batal['id_member']);
								$detail_pembayaran = $transaksi->pembayaran($val_batal['id_transaksi']);
								?>
								<td><?php echo $index_batal+1 ?></td>
								<td><?php echo $data_member1['nama_member'] ?></td>
								<td><?php echo $detail_pembayaran['tgl_konfirmasi'] ?></td>
								<td><?php echo $detail_pembayaran['tgl_transfer'] ?></td>
								<td><?php echo $val_batal['tgl_transaksi'] ?></td>
								<td>Rp<?php echo number_format($val_batal['total_bayar']) ?></td>
								<td><?php echo $val_batal['status_pembayaran'] ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div role="tabpanel" class="tab-pane" id="histori">
				<table class="table table-striped thetable">
					<thead>
						<tr>
							<th>No</th>
							<th>Member</th>
							<th>Tgl Konfirmasi</th>
							<th>Tgl Transfer</th>
							<th>Tgl Pembelian</th>
							<th>Total</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($histori as $key => $value): ?>
							<?php 
							$data_member1 = $member->ambil_member($value['id_member']);

							$detail_pembayaran = $transaksi->pembayaran($value['id_transaksi']);
							?>
							<tr>
								<td><?php echo $key+1 ?></td>
								<td><?php echo $data_member1['nama_member'] ?></td>
								<td><?php echo $detail_pembayaran['tgl_konfirmasi'] ?></td>
								<td><?php echo $detail_pembayaran['tgl_transfer'] ?></td>
								<td><?php echo $value['tgl_transaksi'] ?></td>
								<td>Rp<?php echo number_format($value['total_bayar']) ?></td>
								<td><?php echo $value['status_pembayaran'] ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>		
			</div>
		</div>
	</div>
</div>