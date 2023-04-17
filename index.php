<?php


session_start();

include 'src/header.php';

// include Header
//connect to db
$msserver = '127.0.0.1';
$user = "admin";
$password_db = "Admin.1234";
$utilites_db = 'utils';
$connect_db = mysqli_connect($msserver, $user, $password_db, $utilites_db);
$title_query = "SELECT title,subtitle FROM data;";
$title_res = mysqli_query($connect_db, $title_query);
$content_query = "SELECT title,content FROM contents";
$content_res =  mysqli_query($connect_db, $content_query);
$title = " ";
$desc = " ";
while ($row = mysqli_fetch_assoc($title_res)) {
    $title = $row['title'];
    $desc = $row['subtitle'];
    break;
}




//get title and subtitle



?>
<style>
    #wrapper {
        position: relative;
        width: 100%;
        height: auto;
    }

    .header {
        padding: 60px;
        text-align: center;
        background: #1abc9c;
        color: white;
        font-size: 30px;
    }

    .bg-c {
        position: absolute;
        top: 0;
        left: 0;
        z-index: -100;
    }
</style>
<div class="header">
    <h1><?php echo ($title); ?></h1>
    <p><?php echo ($desc); ?></p>
</div>
<?php if ($_GET['login']) { ?>
    <h1>Welcome <?php echo ($_SESSION['username']) ?></h1>
<?php }
if ($_GET['admin']) { ?>
    <h1>administration page is not created yet <?php echo ($_SESSION['username']) ?></h1>
    <?php }
for ($i = 0; $i <= mysqli_num_rows($content_res); $i++) {
    $row = mysqli_fetch_assoc($content_res);
    if ($row['content']) {
    ?><h1><?php echo ($row['title']); ?></h1> <?php
    ?><p><?php echo ($row['content']); ?></p> <?php 
    ?> <hr> <?php }
    }
    //include footer
    include 'src/footer.php'
            ?>