<?php 
$rmid=$_GET['id'];
$msserver = '127.0.0.1';
$user = "admin";
$password_db = "Admin.1234";
$utilites_db = 'utils';
$connect_db = mysqli_connect($msserver, $user, $password_db, $utilites_db);
$sql = "DELETE FROM `users` WHERE id='$rmid'";
$query = mysqli_query($connect_db, $sql);
header("Location:/dashboard/users.php?del=true");



?>