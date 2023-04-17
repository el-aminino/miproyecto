<?php
$msserver = '127.0.0.1';
$user = "admin";
$password_db = "Admin.1234";
$utilites_db = 'utils';
$connect_db = mysqli_connect($msserver, $user, $password_db, $utilites_db);
$post = $_POST;
$sql =  "UPDATE title,content VALUES ('$post[title]','$post[content]) WHERE id='$_POST[id]';";

?>
