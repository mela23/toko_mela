<?php 
$id_member =$_GET['id_member'];

$member->hapus_member($id_member);
echo "<script>alert ('member terhapus')</script>";
echo "<script>location='index.php?halaman=member'</script>";
 ?>