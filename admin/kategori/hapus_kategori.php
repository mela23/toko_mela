<?php 
$id_kategori = $_GET ['id'];
$kategori->hapus_kategori($id_kategori);
echo "<script>alert('data terhapus');</script>";
echo "<script>location = 'index.php?halaman=kategori';</script>";

 ?>