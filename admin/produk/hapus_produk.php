<?php  
$id_produk = $_GET['id'];
$produk->hapus_produk($id_produk);
echo "<script>alert('produk terhapus');</script>";
echo "<script>location='index.php?halaman=produk';</script>";
 ?>