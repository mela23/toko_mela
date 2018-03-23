<?php 
// 2 kondisi
$id_produk = $_GET['id'];

// 2 kondisi
	// sebelumnya sudah pernah beli
if (isset($_SESSION['keranjang'][$id_produk]))
{
	$_SESSION['keranjang'][$id_produk] += 1;
}
else
{
		// dan belum pernah beli
	$_SESSION['keranjang'][$id_produk] = 1;
}

?>
<script>location = 'index.php';</script>