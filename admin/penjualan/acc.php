<?php 
$id = $_GET['id'];
$status = $_GET['status'];

$transaksi->ubah_status($id, $status);
// jika status = 'proses'
if($status == 'proses')
{
	// resi
	echo "<script>
 	alert('Status transaksi berhasil diubah');
 	location = 'index.php?halaman=resi&id=$id';
 </script>";
}
// else
 else
 {
 	// ke penjualan
 	echo "<script>
 	alert('Status transaksi berhasil diubah');
 	location = 'index.php?halaman=penjualan';
 </script>";
 }


 ?>
 