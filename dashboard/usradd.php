<?php 
$msserver='127.0.0.1';
$user="admin";
$password_db = "Admin.1234";
$utilites_db='utils';
$connect_db=mysqli_connect($msserver,$user,$password_db,$utilites_db);
$usersql = "SELECT username FROM users";
$chkdplx = mysqli_query($connect_db,$usersql);
$post = $_POST;
if($post['usrname']&&$post['name']&&$post['passwd']){
    $uname = $post['usrname'];
    $name = $post['name'];
    $passwd = $post['passwd'];
    for ($i = 0; $i <= mysqli_num_rows($chkdplx); $i++) {
        $row = mysqli_fetch_assoc($chkdplx);
        if($row['username']==$uname){
            header("Location:/dashboard/users.php?duplex=true");
        }
        echo("checking");
    }
    echo("checked");
    $sql = "INSERT INTO `users` (`id`, `username`, `name`, `password`) VALUES (NULL, '$uname', '$name', '$passwd');";
    //$sql = "INSERT INTO users('username', 'name', 'password') VALUES ('$uname','$name','$passwd')";
    $query = mysqli_query($connect_db,$sql);
    header("Location:/dashboard/users.php?created=true");

}
else {
    header("Location:/dashboard/users.php?empty=true");
}




?>