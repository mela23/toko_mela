<?php 
// login adalah menyimpan akun ke session
// logout adalah menghancurkan akun yang ada di session

session_destroy();
echo "<div class='alert alert-danger'>Anda telah logout</div>";
echo "<meta http-equiv='refresh' content='1;login.php'>";
// echo "<script>alert('anda berhasil logout')</script>";
// echo "<script>location='login.php'</script>";
 
 ?>