<?php
$msserver = '127.0.0.1';
$user = "admin";
$password_db = "Admin.1234";
$utilites_db = 'utils';
$connect_db = mysqli_connect($msserver, $user, $password_db, $utilites_db);


if ($_POST['title']) {
    $title = $_POST['title'];
    $sql = "UPDATE data SET title = '$title' WHERE id = 1;";
    $res = mysqli_query($connect_db, $sql);
}



if ($_POST['subtitle']) {
    $subtitle = $_POST['subtitle'];
    echo($subtitle);
    $sql = "UPDATE data SET subtitle = '$subtitle' WHERE id = 1;";
    $res = mysqli_query($connect_db, $sql);
}


header("Location:/");


?>