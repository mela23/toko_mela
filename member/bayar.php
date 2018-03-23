<div class="container">
	<div class="row">
		<div class="panel panel-info">
			<div class="panel-heading"><h4>Bayar Transaksi (Tanggal)</h4></div>
		</div>
		<div class="panel-body">
			<?php 
			if (isset($_POST['submit']))
			{
				$data_transaksi = $transaksi->ambil_transaksi($_GET['id']);
				$jumlah_bayar = $data_transaksi['total_bayar'];
				$id_member = $data_transaksi['id_member'];
				$tgl_konfirmasi = date("Y-m-d");
				$id = $_GET['id'];

				$transaksi-> konfirmasi($_FILES['bukti'], $_POST['tgl_transfer'], $_POST['nama_akun'], $_POST['nama_bank'], $tgl_konfirmasi, $jumlah_bayar, $_GET['id'], $id_member);
				echo "<script>location = 'index.php?halaman=konfirmasi&id=$id'</script>";
			}
			 ?>
			 <form method="POST" class="form-horizontal" enctype="multipart/form-data">
			 	<div class="form-group">
			 		<label class="col-md-2">Bukti Transfer</label>
			 		<div class="col-md-10">
			 			<input type="file" name="bukti">
			 		</div>
			 	</div>
			 	<div class="form-group">
			 		<label class="col-md-2">Tanggal Transfer</label>
			 		<div class="col-md-10">
			 			<input type="date" name="tgl_transfer" class="form-control">
			 		</div>
			 	</div>
			 	<div class="form-group">
			 		<label class="col-md-2">Nama Akun</label>
			 		<div class="col-md-10">
			 			<input type="text" name="nama_akun" class="form-control">
			 		</div>
			 	</div>
			 	<div class="form-group">
			 		<label class="col-md-2">Nama Bank</label>
			 		<div class="col-md-10">
			 			<input type="text" name="nama_bank" class="form-control">
			 		</div>
			 	</div>
			 	<button name="submit" class="btn btn-warning pull-right">Submit</button>
			 </form>
		</div>
	</div>
</div>