<?php 
$data_kategori = $kategori->tampil_kategori(); 
?> 
<div class="panel panel-primary">
	<div class="panel-heading"><h4>Tambah Produk</h4></div>
	<div class="panel-body">
		<form method="POST" enctype="multipart/form-data" class="form-horizontal">
			<div class="form-group">
				<label class="col-sm-3">Kategori</label>
				<div class="col-sm-9">
					<select name="kategori" class="form-control">
						<option>Pilih Kategori</option>
						<?php foreach ($data_kategori as $key => $value_kategori): ?>
							<option value="<?php echo $value_kategori ['id_kategori'] ?>"><?php echo $value_kategori['nama_kategori'] ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3">Nama Produk</label>
				<div class="col-sm-9">
					<input type="text" name="produk" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3">Harga</label>
				<div class="col-sm-9">
					<input type="number" name="harga" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3">Berat</label>
				<div class="col-sm-9">
					<input type="number" name="berat" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3">Stok</label>
				<div class="col-sm-9">
					<input type="number" name="stok" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3">Deskripsi</label>
				<div class="col-sm-9">
					<textarea class="form-control" name="deskripsi" rows="5" id="theeditor"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3">Foto</label>
				<div class="col-sm-9">
					<input type="file" name="foto">
				</div>
			</div>
			<button name="simpan" class="btn btn-info pull-right"><span class="fa fa-cloud-upload"></span>&nbspSimpan</button>
		</form>
		<?php 
		if (isset($_POST['simpan']))
		{
			$produk->simpan_produk($_POST['kategori'], $_POST['produk'],$_POST['harga'], $_POST['berat'], $_POST['stok'], $_POST['deskripsi'], $_FILES['foto']);
			echo "<script>location='index.php?halaman=produk';</script>";
		}
		?>
	</div>
</div>