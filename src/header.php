<!DOCTYPE html>
<?php
if ($_GET['logout'] == true) {
    session_destroy();
    header("location:/");
}
session_start()
?>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<<<<<<< HEAD
        <?php 
            include 'navbar.php';
        ?>
        <?php 
        /* 
=======
    <title>Mi proyecto para mi universidad</title>
</head>

<body class="text-center">

    <?php
    include 'navbar.php';
    ?>
    <?php /* 
>>>>>>> 1323c9d (Database is now ready and working)
        <h1>Amin Mahdizade</h1>
        <h3>trying to make a CMS using php</h3>
        <hr>
        <div>
            <div id="leftside"> left block </div>
            <div id="contents"> content </div>
            */ ?>
    </div>