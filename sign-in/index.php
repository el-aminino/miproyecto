<?php
      if ($_GET['sudf']==true){
         $sudf = true ;
      }
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Signin Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
<link href="../src/assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .error-of-amz {
        color: red;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <?php 

      
    
    ?>
<main class="form-signin">
  <form method="post" action="action-login.php">
    <a href="/"> <img class="mb-4" src="../src/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> </a>


    <?php
    if ($_GET['empty']){ 
    ?>
    <h1 class="h3 mb-3 fw-normal error-of-amz">Username or password cant be empty</h1>
<?php }?>
<?php
    if ($_GET['failed']){ 
    ?>
    <h1 class="h3 mb-3 fw-normal error-of-amz">Username or password is incorrect</h1>
<?php }?>
  <?php if ($sudf==true){?>
    <h1 class="h3 mb-3 fw-normal error-of-amz">Sorry ! can't sign up now</h1>
    <h1 class="h3 mb-3 fw-normal">Please sign in instead</h1>
   <?php }
    else {
    ?>
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
    <?php }?>






    <div class="form-floating">
      <input type="text" name="uname" class="form-control" id="floatingInput" placeholder="username">
      <label for="floatingInput">Username</label>
    </div>
   
    
      
 
    <div class="form-floating">
      <input type="password" name="pwd" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
  </form>
</main>


    
  </body>
</html>
