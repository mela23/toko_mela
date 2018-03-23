<?php
session_destroy();
echo "<div class='alert alert-danger'>Anda telah logout</div>";
echo "<meta http-equiv='refresh' content='1;login.php'>";
?>