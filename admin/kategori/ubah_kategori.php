<?php 
$id_kategori = $_GET['id'];
$hasil_kategori = $kategori->ambil_kategori($id_kategori);
 ?>
 <h2>Ubah Kategori</h2>
 <form method="POST">
 	<div class="form-group">
 		<label>Kategori</label>
 		<input type="text" class="form-control" name="nama" value="<?php echo $hasil_kategori['nama_kategori']; ?>">
 	</div>
 	<button class="btn btn-primary" name="ubah">Ubah</button>
 </form>
 <?php 
if(isset($_POST['ubah']))
{
	$kategori->ubah_kategori($_POST['nama'], $id_kategori);
	echo "<script>alert ('data telah diubah');</script>";
	echo "<script>location='index.php?halaman=kategori';</script>";
}
?>
