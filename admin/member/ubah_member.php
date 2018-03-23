<h2>Ubah Member</h2> 
<?php 
$id_member = $_GET['id_member'];

$data_member=$member->ambil_member($id_member);
?> 
<div class="panel panel-primary">
	<div class="panel-heading"><h2>Ubah Member</h2></div>
	<div class="panel-body">
		<form method="POST" enctype="multipart/form-data"  class="form-horizontal">
			<div class="form-group">
				<label class="col-sm-3">Nama</label>
				<div class="col-sm-9">
					<input type="text" name="nama" class="form-control" value="<?php echo $data_member['nama_member']; ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3">Tanggal lahir</label>
				<div class="col-sm-9">
					<input type="date" name="tgllhr" class="form-control" value="<?php echo $data_member['tgl_lhr']; ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3">Email</label>
				<div class="col-sm-9">
					<input type="email" name="email" class="form-control" value=" <?php echo $data_member['email_member']; ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3">Username member</label>
				<div class="col-sm-9">
					<input type="text" name="username" class="form-control" value="<?php echo $data_member['username_member']; ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3">Password</label>
				<div class="col-sm-9">
					<input type="password" name="password" class="form-control" value="<?php echo $data_member ['password_member']; ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3">Alamat</label>
				<div class="col-sm-9">
					<textarea name="alamat" class="form-control"><?php echo $data_member['alamat_member']; ?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3">Nomor Telepon</label>
				<div class="col-sm-9">
					<input type="number" name="telp" class="form-control" value="<?php echo $data_member['telp_member']; ?>">
				</div>
			</div>
			<div class="form-group">
				<img src="../assets/img/member/<?php echo $data_member['foto_member']; ?>" width="200px" style="margin-left: 300px" class="img-responsive">
			</div>
			<div class="form-group">
				<label class="col-sm-3">Foto</label>
				<div class="col-sm-9">
					<input type="file" name="foto">
				</div>
			</div>
			<button name="ubah" class="btn btn-primary pull-right"><span class="fa fa-cloud-upload fa-lg"></span>&nbsp Ubah</button>
		</form>
	</div>
</div>

<?php  
if(isset($_POST['ubah']))
{
	$member->ubah_member($_POST['nama'], $_POST['tgllhr'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['alamat'], $_POST['telp'], $_FILES['foto'], $_GET['id_member']);
	echo "<script>alert ('data berhasil diubah');</script>";
	echo "<script>location='index.php?halaman=member';</script>";
}
?>