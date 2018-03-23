<div class="login">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="panel panel-success">
						<div class="panel-heading text-center">
							<h4>Login Member</h4>						
						</div>
						<div class="panel-body">
							<form method="POST">
								<div style="margin-bottom: 25px" class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
									<input type="text" name="username" class="form-control" placeholder="Masukan Username">
								</div>
								<div style="margin-bottom: 25px" class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
									<input type="password" name="password" class="form-control" placeholder="Masukan Password">
								</div>
								<button style="margin-top: 25px" name="login" class="btn btn-success btn-block pull-right">Login</button>
							</form>
							<br>
                            <br>
                            <br>
                            <br>
							<?php 
							if (isset ($_POST['login']))
							{
								$cek = $member->login_member($_POST['username'], $_POST['password']);
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