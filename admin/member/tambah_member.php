		<div class="panel panel-primary">
			<div class="panel-heading"><h2>Tambah Member</h2></div>
			<div class="panel-body">
				<form method="POST" enctype="multipart/form-data" class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-3">Nama</label>
						<div class="col-sm-9">
							<input type="text" name="nama" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3">Tanggal lahir</label>
						<div class="col-sm-9">
							<input type="date" name="tgllhr" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3">Email</label>
						<div class="col-sm-9">
							<input type="email" name="email" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3">Username member</label>
						<div class="col-sm-9">
							<input type="text" name="username" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3">Password</label>
						<div class="col-sm-9">
							<input type="password" name="password" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3">Alamat</label>
						<div class="col-sm-9">
							<textarea name="alamat" class="form-control"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3">Nomor Telepon</label>
						<div class="col-sm-9">
							<input type="number" name="telp" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3">Foto</label>
						<div class="col-sm-9">
							<input type="file" name="foto">
						</div>
					</div>
					<button name="simpan" class="btn btn-primary pull-right">Simpan</button>
				</form>
			</div>
		</div>
		<?php 
		if(isset($_POST['simpan']))
		{
			$member->simpan_member($_POST['nama'], $_POST['telp'],$_POST['email'], $_POST['username'], $_POST['password'], $_POST ['alamat'], $_FILES ['foto'], $_POST['tgllhr']);	
			echo "<script>alert ('data member disimpan');</script>";
			echo "<script>location = 'index.php?halaman=member';</script>";
		}
		?>
		