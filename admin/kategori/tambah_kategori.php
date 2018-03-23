<div class="panel panel-primary">
	<div class="panel-heading"><h4>Tambah Kategori</h4></div>
	<div class="panel-body">
		<?php 
		if (isset($_POST['simpan']))
		{
			$kategori->simpan_kategori($_POST['kategori']);
			echo "<div class = 'alert alert-success'>Kategori berhasil disimpan</div>";	
		}
		?>
		<form method="POST" class="form-horizontal">
			<div class="form-group">
				<label class="col-sm-3">Nama Kategori</label>
				<div class="col-sm-9">
					<input type="text" name="kategori" class="form-control">		 				 		</div>
				</div>
				<button name="simpan" class="btn btn-info pull-right"><span class="fa fa-plus"></span>&nbsp;Simpan</button>
			</form>
		</div>
	</div> 