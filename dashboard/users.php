<?php include "headerandside.php";
$sql = "SELECT * FROM users";
$resault = mysqli_query($connect_db, $sql);
?>
<style>
  table {
    border-collapse: collapse;
    width: 100%;
  }

  td,
  th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }

  tr:nth-child(even) {
    background-color: #dddddd;
  }
  .error-of-amz{
    color: red;
  }
  .success-of-amz{
    color: green;
  }
</style>
<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contents.php">
              <span data-feather="file"></span>
              Contents
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="users.php">
              <span data-feather="users"></span>
              Users
            </a>
          </li>
        </ul>


      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">



      <!-- here starts the user manager -->
      </br>
      <?php 
        if($_GET['empty']== true){
          ?><h2 class="h3 mb-3 fw-normal error-of-amz">Username or password or name cant be empty</h2>
          <?php
        }
        if($_GET['duplex']== true){
          ?><h2 class="h3 mb-3 fw-normal error-of-amz">Username Already exist</h2>
          <?php
        }
        if($_GET['created']== true){
          ?><h2 class="h3 mb-3 fw-normal success-of-amz">User has been created</h2>
          <?php
        }
        ?>
      <h2>Add new user</h2>
      </br>
      <main class="form-signin">
        <form method="post" action="usradd.php">



          <div class="form-floating">
            <input type="text" name="usrname" class="form-control" id="floatingInput" placeholder="Username">
            <label for="floatingInput">Username</label>
          </div>
          <div class="form-floating">
            <input type="text" name="name" class="form-control" id="floatingInput" placeholder="Name">
            <label for="floatingInput">Name</label>
          </div>
          <div class="form-floating">
            <input type="text" name="passwd" class="form-control" id="floatingInput" placeholder="Password">
            <label for="floatingInput">Password</label>
          </div>
          <button class="w-100 btn btn-lg btn-primary" type="submit">add user</button>
        </form>
      </main>
      <hr>
      <h2>Manage users</h2>
      <table>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Name</th>
          <th>Remove</th>
        </tr>
        <?php for ($i = 0; $i <= mysqli_num_rows($resault); $i++) {
          $row = mysqli_fetch_assoc($resault);
        ?>
          <tr>
            <th><?php echo ($row['id']) ?> </th>
            <th><?php echo ($row['username']) ?> </th>
            <th><?php echo($row['name'] ) ?> </th>
            <th>&nbsp; </th>
          </tr>
        <?php } ?>
      </table>













      <?php include "footerandothers.php" ?>