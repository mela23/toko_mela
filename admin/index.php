<?php   
include '../assets/config/class.php';
// proteksi index

// jika tidak ada session admin maka harus login dulu
if (!isset($_SESSION['admin']))
{
	echo "<script>alert('anda harus login')</script>";
	echo "<script>location='login.php'</script>";
	exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>  
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Mela</title>
	<link rel="shortcut icon" href="../assets/img/icon.jpg">
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../assets/css/dataTables.bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" href="../assets/css/sendiri.css">
</head>
<body>
	<div id="wrapper">
		<nav class="navbar navbar-default">
			<!-- mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".sidebar-collapse" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="../index.php">Toko Online</a>
			</div>
		</nav>
		<nav class="navbar-default navbar-side"> 
			<div class="sidebar-collapse">
				<div class="user">
					<img src="../assets/img/user.png">
					<h3>Inaya Melani</h3>
					<p>Administrator</p>
				</div>
				<ul class="nav" id="main-menu">
					<li><a href="index.php"><i class="fa fa-home fa-lg"></i> Home</a></li>
					<li><a href="index.php?halaman=kategori"><i class="fa fa-tags"></i> Kategori</a></li>
					<li><a href="index.php?halaman=produk"><i class="fa fa-pencil"></i> Produk</a></li>
					<li><a href="index.php?halaman=member"><i class="fa fa-user"> </i> Member</a></li>
					<li><a href="index.php?halaman=penjualan"><i class="fa fa-cube"></i> Penjualan</a></li>
					<li class="pengaturan">
						<a href="">
							<i class="fa fa-cog"></i> 
							Pengaturan 
							<i class="fa fa-angle-right pull-right"></i>
						</a>
						<ul class="pengaturan-menu">
							<li><a href="">Edit Admin</a></li>
							<li><a href="">Ubah Password</a></li>
						</ul>
					</li>
					<li><a href="index.php?halaman=logout"><i class="fa fa-sign-out"></i> Logout</a></li>
				</ul>
			</div>
		</nav>

		<div id="page-wrapper">
			<div id="page-inner">
				<?php 
				if (!isset($_GET['halaman']))
				{
					include 'home.php';
				}
				else
				{
					if ($_GET['halaman']=='kategori') 
					{
						include 'kategori/tampil_kategori.php';
					}
					elseif ($_GET['halaman']=='tambah_kategori')
					{
						include 'kategori/tambah_kategori.php';
					}  
					elseif ($_GET['halaman']=='ubah_kategori')
					{
						include 'kategori/ubah_kategori.php';
					}
					elseif ($_GET['halaman']=='hapus_kategori')
					{
						include 'kategori/hapus_kategori.php';
					}
					elseif ($_GET['halaman']=='produk')
					{
						include 'produk/tampil.php';
					}
					elseif ($_GET['halaman']=='hapus_produk')
					{
						include 'produk/hapus_produk.php';
					}
					elseif ($_GET['halaman']=='edit')
					{
						include 'produk/edit.php';
					}
					elseif ($_GET['halaman']=='tambah_produk')
					{
						include 'produk/tambah.php';
					}
					elseif ($_GET['halaman']=='member')
					{
						include 'member/member.php';
					}
					elseif($_GET['halaman']=='hapus_member')
					{
						include 'member/hapus_member.php';
					}
					elseif ($_GET['halaman']=='ubah_member')
					{
						include 'member/ubah_member.php';
					}
					elseif ($_GET ['halaman']=='logout') 
					{
						include 'logout.php';
					}
					elseif ($_GET['halaman']=='tambah_member')
					{
						include 'member/tambah_member.php';
					}
					elseif ($_GET['halaman'] == 'penjualan')
					{
						include 'penjualan/penjualan.php';
					}
					elseif ($_GET['halaman'] == 'acc')
					{
						include 'penjualan/acc.php';
					}
					elseif ($_GET['halaman'] == 'detail_transaksi')
					{
						include 'penjualan/detail_transaksi.php';
					}
					elseif ($_GET['halaman'] == 'resi')
					{
						include 'penjualan/resi.php';
					}

				}

				?> 

				
			</div>
		</div>
	</div>
	<footer class="panel-footer">
		Copyright &copy Inaya Melani Putri Alisa
	</footer>
	<!-- java script untuk memunculkan collapse pada div sidebare collapse ketika dibuka di mobile -->
	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/jquery.dataTables.min.js"></script>
	<script src="../assets/js/dataTables.bootstrap.min.js"></script>
	<script>
		$(document).ready(function() {
			$('.thetable').DataTable();
		} );
	</script>
	<script src="../assets/ckeditor/ckeditor.js"></script>
	<script>
		CKEDITOR.replace("theeditor");
	</script>
	<script src="../assets/js/sendiri.js"></script>
</body>
</html>