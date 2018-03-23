<div class="panel panel-info">
	<div class="panel-heading">RESI</div>
	<div class="panel-body">
		<form class="form-horizontal" method="POST">
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">No Resi</label>
				<div class="col-md-10">
					<input type="text" name="noresi" class="form-control">
				</div>
			</div>
			<button class="btn btn-warning pull-right" name="simpan">Upload</button>
		</form>
		<?php 
		if (isset($_POST['simpan']))
		{
			$transaksi->simpan_resi($_POST['noresi'], $_GET['id']);
			echo "<div class = 'alert alert-info'>No Resi terkirim</div>";
		}
		 ?>
	</div>
</div>