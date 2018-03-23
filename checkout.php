<?php   

if (!isset($_SESSION['member']))
{
	echo "<script>alert('anda harus login')</script>";
	echo "<script>location='index.php?halaman=login'</script>";
	exit();	
}
$data_keranjang = $produk->tampil_keranjang();
$data_provinsi = $ongkir->tampil_provinsi();
?>
<div class="checkout">
	<div  class="container">
		<form method="post">
			<?php 
			// jika ada $_POST[''] masukan ke variabel
			if (isset($_POST['provinsi']))
			{
				$id_prov = $_POST['provinsi'];
			}
			else
			{
				$id_prov = "";
			}
			if (isset($_POST['kota']))
			{
				$id_kota = $_POST['kota'];
			}
			else
			{
				$id_kota = "";
			}
			if (isset($_POST['ekspedisi']))
			{
				$ekspedisi = $_POST ['ekspedisi'];
			}
			else
			{
				$ekspedisi = "";
			}
			if (isset($_POST['paket']))
			{
				$id_ongkir = $_POST ['paket']; 
			}
			else
			{
				$id_ongkir = "";
			}

			$data_kota = $ongkir->tampil_kota_provinsi($id_prov);		
			$detail = $ongkir->detail_ongkir($id_ongkir);
			//  2 syarat untuk menampilkan paket ekspedisi
			// 1. kota asal (501), kota tujuan = $id_kota
			// 2. ekspedisi
			//  bikin function yang digunakan untuk menampilkan data tersebut
			$id_kota_asal = 501;
			$data_paket = $ongkir->tampil_paket($id_kota_asal, $id_kota, $ekspedisi);
			// untuk menampilkan total ongkir butuh detail ongkir
			if (isset($_POST['selesai']))
			{
				$tgl_transaksi = date("Y-m-d");
				$id_member = $_SESSION ['member']['id_member'];
				$biaya_ongkir = $detail ['biaya_ongkir'] * $data_keranjang ['total_berat'];
				$paket_yang_dipilih = $detail['paket_ongkir'];
				$total_bayar = $data_keranjang['total_belanja'] + $biaya_ongkir;

				$id = $transaksi -> simpan_transaksi($tgl_transaksi, $data_keranjang,$id_member, $_POST['alamat_penerima'], $_POST['telp_penerima'], $_POST['kode_pos'], $biaya_ongkir, $_POST['nama_penerima'], $id_kota, $paket_yang_dipilih, 'Belum konfirmasi', $id_ongkir, $total_bayar);

				unset($_SESSION['keranjang']);
				echo "<div class= 'alert alert-info'><a href = 'index.php?halaman=konfirmasi&id=$id'><b>Silahkan melakukan konfirmasi</b></a></div>";
			}
			?>
			<div class="row">
				<div class="col-md-3">
					<label>Provinsi</label>
					<select class="form-control" name="provinsi" onchange="submit()">
						<option>Pilih Provinsi</option>
						<?php foreach ($data_provinsi as $id_prov1 => $value_prov): ?>
							<option value="<?php echo $value_prov['id_provinsi'] ?>"
								<?php 
								if($value_prov['id_provinsi']== $id_prov)
								{
									echo "selected";
								}
								?>
								> <?php echo $value_prov['nama_provinsi'] ?> </option>

							<?php endforeach ?>
						</select>
					</div>
					<div class="col-md-3">

						<label>Kota</label>
						<select class="form-control" name="kota" onchange="submit()">
							<option>Pilih Kota</option>
							<?php foreach ($data_kota as $id_kota1 => $value_kota): ?>
								<option value="<?php echo $value_kota ['id_kota'] ?>"
									<?php 
									if ($value_kota['id_kota'] == $id_kota)
									{
										echo "selected";
									}
									?>
									> <?php echo $value_kota['nama_kota'] ?> 
								</option>
								
							<?php endforeach ?>
							
						</select>
					</div>
					<div class="col-md-3"> 
						<label>Ekspedisi</label>
						<select class="form-control" name="ekspedisi" onchange="submit()">
							<option>Pilih Ekspedisi</option>
							<option value="jne"<?php if($ekspedisi == "jne"){ echo "selected";} ?>>JNE</option>
							<option value="pos"<?php if($ekspedisi == "pos"){ echo "selected";} ?>>POS</option>
							<option value="tiki"<?php if($ekspedisi == "tiki"){ echo "selected";} ?>>TIKI</option>
						</select>
					</div>
					<div class="col-md-3">
						<label>Paket Ekspedisi</label>
						<select class="form-control" name="paket" onchange="submit()">
							<option>Pilih Ongkir</option>
							<?php foreach ($data_paket as $id_ongkir1 => $value_ongkir): ?>
								<option value="<?php echo $value_ongkir['id_ongkir'] ?>"
									<?php 
									if ($value_ongkir['id_ongkir'] == $id_ongkir)
									{
										echo "selected";
									}
									?>
									><?php echo $value_ongkir['paket_ongkir'] ?></option>
									
								<?php endforeach ?>
							</select>
						</div>

					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Nama Penerima</label>
								<input type="text" name="nama_penerima" class="form-control">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Telepon Penerima</label>
								<input type="number" name="telp_penerima" class="form-control">
							</div>

						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label> Kode Pos</label>
								<input type="number" name="kode_pos" class="form-control">
							</div>
						</div>

						<div class="form-group">
							<label>Alamat Penerima</label>
							<textarea class="form-control" name="alamat_penerima"></textarea>
						</div>
						<h1>Keranjang Belanja</h1>
						<table class="table table-bordered">
							<thead>
								<tr class="info">
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
								<?php if (isset($_SESSION['keranjang'])): ?>
									<?php foreach ($data_keranjang as $key => $value): ?>
										<?php if ($key !== 'total_belanja' && $key !== 'total_berat'): ?>

										<tr>
											<td><?php echo $key+1 ?></td>
											<td><?php echo $value['nama_produk'] ?></td>
											<td><?php echo $value['jumlah_beli'] ?></td>
											<td><?php echo $value['berat_produk'] ?></td>
											<td>Rp <?php echo number_format($value['harga_produk']) ?></td>
											<td><?php echo $value['sub_berat'] ?>Kg</td>
											<td>Rp <?php echo number_format($value['sub_total']) ?></td>
										</tr>
										<?php endif ?>
									<?php endforeach ?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="6">Total Belanja</th>
										<th>Rp <?php echo number_format($data_keranjang['total_belanja']) ?></th>
									</tr>
									<tr>
										<?php 
										$detail = $ongkir->detail_ongkir($id_ongkir);
										$total_biaya_ongkir = $detail['biaya_ongkir'] * $data_keranjang['total_berat'];
										$total_bayar = $data_keranjang['total_belanja'] + $total_biaya_ongkir;
										?>
									</tr>
									<tr>
										<th colspan="6">Total ongkos kirim</th>
										<th>Rp <?php echo number_format($total_biaya_ongkir) ?></th>
									</tr>
									<tr class="danger">
										<th colspan="6">Total Bayar</th>
										<th>Rp <?php echo number_format($total_bayar) ?></th>
									</tr>
								</tfoot>
							<?php else: ?>
								<tr>
									<td colspan="7">
										<div class="alert alert-info">no item</div>
									</td>
								</tr>
							<?php endif ?>
						</table>
						<button class="btn btn-primary" name="selesai">Selesai Belanja</button>
					</form>
				</div>