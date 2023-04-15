<?php 
$msserver='127.0.0.1';
$user="admin";
$password_db = "Admin.1234";
$utilites_db='utils';
$connect_db=mysqli_connect($msserver,$user,$password_db,$utilites_db);
$usersql = "SELECT title FROM contents";
$chkdplx = mysqli_query($connect_db,$usersql);
$post = $_POST;
if($post['title']&&$post['content']){
    $title = $post['title'];
    $content = $post['content'];

    for ($i = 0; $i <= mysqli_num_rows($chkdplx); $i++) {
        $row = mysqli_fetch_assoc($chkdplx);
        if($row['title']==$title){
            header("Location:/dashboard/contents.php?duplex=true");
        }
        echo("checking");
    }
    echo("checked");
    $sql = "INSERT INTO `contents` (`id`, `title`, `content`) VALUES (NULL, '$title', '$content');";
    //$sql = "INSERT INTO users('username', 'name', 'password') VALUES ('$uname','$name','$passwd')";
    $query = mysqli_query($connect_db,$sql);
    header("Location:/dashboard/contents.php?created=true");

}
else {
    header("Location:/dashboard/contents.php?empty=true");
}




?>