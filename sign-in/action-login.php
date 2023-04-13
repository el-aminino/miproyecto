<?php

session_start();


//connect to db
$msserver='127.0.0.1';
$user="admin";
$password_db = "Admin.1234";
$utilites_db='utils';
$connect_db=mysqli_connect($msserver,$user,$password_db,$utilites_db);


$post = $_POST;
$uname=$post['uname'];
$passwd=$post['pwd'];


if($uname && !empty($uname) && $passwd && !empty($passwd)){
    $sql="SELECT * FROM users WHERE username='$uname' AND password = '$passwd' ";
    $res=mysqli_query($connect_db,$sql);
    $rows=mysqli_fetch_assoc($res);
    if($uname==$rows['username'] && $passwd == $rows['password']){
        $_SESSION['login'] = true ; 
        $_SESSION['username'] = $uname;
        header("Location:../index.php?login=ture");
    }
    else{
        header("Location:index.php?failed=ture");
    }
}

else{
    header("Location:index.php?empty=ture");
}



//$sql="SELECT * FROM users WHERE username='$uname' AND password = '$passwd' ";


?>