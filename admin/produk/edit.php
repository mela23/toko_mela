<?php     
$id_produk = $_GET['id'];
$detail = $produk->ambil_data_produk($id_produk);
$data_kategori = $kategori->tampil_kategori();
?>
<div class="panel panel-primary">
	<div class="panel-heading"><h4>Edit Produk</h4></div>
	<div class="panel-body">
		<form method="POST" enctype="multipart/form-data" class="form-horizontal">
			<div class="form-group">
				<label class="col-sm-3">Kategori</label>
				<div class="col-sm-9">
					<select name="kategori" class="form-control">
						<option>Pilih Kategori</option>
						<?php foreach ($data_kategori as $key => $value_kategori): ?>

							<option value="<?php echo $value_kategori['id_kategori'] ?>"
								<?php 
								if ($detail['id_kategori']==$value_kategori['id_kategori'])
								{
									echo "selected";
								}
								?>>
								
								<?php echo $value_kategori['nama_kategori'] ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3">Nama Produk</label>
				<div class="col-sm-9">
					<input type="text" name="produk" class="form-control" value="<?php echo $detail['nama_produk'] ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3">Harga</label>
				<div class="col-sm-9">
					<input type="text" name="harga" class="form-control" value="<?php echo ($detail['harga_produk'])?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3">Berat</label>
				<div class="col-sm-9">
					<input type="number" name="berat" class="form-control" value="<?php echo $detail['berat_produk'] ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3">Stok</label>
				<div class="col-sm-9">
					<input type="number" name="stok" class="form-control" value="<?php echo $detail ['stok_produk'] ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3">Deskripsi</label>
				<div class="col-sm-9">
					<textarea class="form-control" name="deskripsi" rows="5" id="theeditor">
						<?php echo $detail['deskripsi_produk']; ?>
					</textarea>
				</div>
			</div>
			<div class="form-group">
				<img src="../assets/img/produk/<?php echo $detail['foto_produk'] ?>" class='img-responsive' width="300" style="margin-left: 300px">
			</div>
			<div class="form-group">
				<label class="col-sm-3">Foto</label>
				<div class="col-sm-9">
					<input type="file" name="foto">
				</div>
			</div>
			<button name="ubah" class="btn btn-primary pull-right"><span class="fa fa-cloud-upload fa-lg"></span>&nbspUbah</button>
		</form>
		<?php 
		if (isset($_POST['ubah']))
		{
			$hasil=$produk->ubah_produk($_POST['kategori'],$_POST['produk'], $_POST['harga'],$_POST['berat'],$_POST['stok'], $_POST['deskripsi'],$_FILES['foto'], $id_produk);	
			if($hasil=="sukses")
			{
				echo "<script>alert('data produk berhasil diubah')</script>";
				echo "<script>location='index.php?halaman=produk'</script>";
			}
			else
			{
				echo "<script>alert('$hasil')</script>";
			}
		}
		 ?>
	</div>
</div>