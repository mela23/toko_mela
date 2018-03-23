<?php include "../assets/config/class.php" ?>
		
<!DOCTYPE html>
<html>
<head>
	<title>Login Admin</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/font-awesome-4.7.0/css/font-awesome.css">
	
</head>
<body>
	<div class="container" style="margin-top: 150px">
		<div class="login">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="panel panel-primary">
						<div class="panel-heading text-center">
							<h4><i class="fa fa-lock">Login Admin</i></h4>						
						</div>
						<div class="panel-body">
							<form method="POST">
								<div class="form-group">
									<input type="text" name="username" class="form-control" placeholder="Masukan Username">
								</div>
								<div class="form-group">
									<input type="password" name="password" class="form-control" placeholder="Masukan Password">
								</div>
								<button name="login" class="btn btn-primary">Login</button>
							</form>
							<br>
							<?php 
							if (isset ($_POST['login']))
							{
								$cek = $admin->login_admin($_POST['username'], $_POST['password']);
								if ($cek=="sukses")
								{
									echo "<div class='alert alert-success text-center'><h4>Login sukses</h4></div>";
									echo "<meta http-equiv='refresh' content='1;url=index.php'>";
								}
								else
								{
									echo "<div class='alert alert-danger text-center'><h4>Login gagal</h4></div>";
									echo "<meta http-equiv='refresh' content='1;url=login.php'>";
								}
							}

							 ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>