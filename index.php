<?php
include 'assets/config/class.php';
$data_produk = $produk->tampil_produk();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mela</title>
	<link rel="shortcut icon" href="assets/img/icon.jpg">
	<link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/toko.css">
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container">
			<!-- Tampilan pada mobile -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#naff" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">Toko Mela</a>
			</div>
			<div class="collapse navbar-collapse" id="naff">
				<ul class="nav navbar-nav">
					<?php
					if (isset($_SESSION['member']))
					{

						echo "<li><a href='index.php?halaman=checkout'>Checkout</a></li>";
					}
					?>
				</ul>
				<form method="POST">
					<div class="col-md-6 input-group cari">
						<div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
						<input type="text" class="form-control" placeholder="Cari produk" name="keyword">
					</div>
				</form>
				<?php
				// jika ada yang mencari produk
				if(isset($_POST ['keyword']))
				{
					echo "<script>location='index.php?halaman=cari_produk&keyword=$_POST[keyword]';</script>";
				}
				?>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="index.php?halaman=keranjang">
							<i class="fa fa-shopping-cart fa-lg"></i>
							<i class="badge">
								<?php
								if (isset($_SESSION['keranjang']))
								{
									echo count($_SESSION['keranjang']);
								}
								else
								{
									echo "0";
								}
								?>
							</i>
						</a>
					</li>
					<?php
					// jika ada session member
					if (isset($_SESSION['member']))
					{
						echo "<li><a href='index.php?halaman=logout'>Logout</a></li>";
						?>
						<li class = "dropdown">
							<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-user"></span>
								<?php echo $_SESSION['member']['nama_member'] ?>
								<span class = "caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="index.php?halaman=member">Profil</a></li>
								<li><a href="">Ubah password</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="index.php?halaman=pembelian">Pembelian</a></li>
								<li role="separator" class="divider"></li>
							</ul>
						</li>

						<?php
					}
					else
					{
						echo"<li><a href='index.php?halaman=login'>Login</a></li>";
						echo "<li><a href='index.php?halaman=daftar'>Daftar</a></li>";
					}
					?>
				</ul>
			</div>
		</div>
	</nav>

	<?php
	if(!isset($_GET['halaman']))
	{
		include 'home.php';
	}
	else
	{
		if ($_GET['halaman'] == 'detail_produk')
		{
			include 'detail_produk.php';
		}
		elseif ($_GET['halaman'] == 'keranjang')
		{
			include 'keranjang.php';
		}
		elseif ($_GET['halaman'] == 'home')
		{
			include 'home.php';
		}
		elseif ($_GET['halaman'] == 'beli')
		{
			include 'beli.php';
		}
		elseif ($_GET['halaman'] == 'reset')
		{
			// menghapus session yang diinginkan
			unset($_SESSION['keranjang']);
			echo "<script>location='index.php';</script>";
		}
		elseif ($_GET['halaman']== 'cancel')
		{
			$id_produk = $_GET['id'];
			unset($_SESSION['keranjang'][$id_produk]);
			echo "<script>location='index.php?halaman=keranjang';</script>";
		}
		elseif ($_GET['halaman']=='checkout')
		{
			include 'checkout.php';
		}
		elseif ($_GET['halaman'] == 'konfirmasi')
		{
			include 'konfirmasi.php';
		}
		elseif ($_GET ['halaman'] == 'logout')
		{
			session_destroy();
			echo "<script>alert ('Anda telah logout'); location = 'index.php';</script>";
		}
		elseif ($_GET['halaman'] == 'member')
		{
			include 'member/member.php';
		}
		elseif ($_GET['halaman'] == 'pembelian')
		{
			include 'member/pembelian.php';
		}
		elseif ($_GET['halaman'] == 'bayar')
		{
			include 'member/bayar.php';
		}
		elseif ($_GET['halaman']== 'daftar')
		{
			include 'daftar.php';
		}
		elseif ($_GET['halaman'] == 'cari_produk')
		{
			include 'cari_produk.php';
		}
		elseif ($_GET['halaman']=='login')
		{
			include 'login.php';
		}
	}

	?>

	<hr>
	<footer>
		<div class="container text-center">
			<p><strong>Inaya Melani Putri Alisa</strong></p>
		</div>
	</footer>
	<script src="assets/ajax/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
