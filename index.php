<?php


session_start();

 include 'src/header.php'; 

// include Header
 //connect to db
 $msserver='127.0.0.1';
 $user="admin";
 $password_db = "Admin.1234";
 $utilites_db='utils';
 $connect_db=mysqli_connect($msserver,$user,$password_db,$utilites_db);
 $title_query="SELECT title,subtitle FROM data;";
 $title_res = mysqli_query($connect_db,$title_query);
 $title = " ";
 $desc = " ";
 while($row = mysqli_fetch_assoc($title_res)){
    $title = $row['title'];
    $desc = $row['subtitle'];
    break;
}


 //get title and subtitle



?>
<style>

    #wrapper{
        position: relative;
        width: 100%;
        height: auto;
    }

    .header {
        /*
        color: white;
        position: relative;
        text-shadow: -1px -1px -1p #000, 1px 1px 1px #000;
        z-index: 100;*/
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
  <h1><?php echo($title); ?></h1>
  <p><?php echo($desc); ?></p>
</div>

<!--div id="wrapper">

    <div class="up-down">

    </div>
        
    <div class="header">
        
        <h1>Title</h1>
        <h3>Descripcion para esta proyecto</h3>
        
    </div>

    <div class="up-down">
        
    </div>


    <div class="bg-c">
        <img src="src/bluerose.jpg" width="100%" height="auto" style=" opacity: 80%;"/>
    </div>
</div-->
<?php if($_GET['login']){?>
<h1>Welcome <?php echo($_SESSION['username']) ?></h1>
<?php } if($_GET['admin']){?>
<h1>administration page is not created yet <?php echo($_SESSION['username']) ?></h1>
<?php }
 
//include footer
include 'src/footer.php' 
?>