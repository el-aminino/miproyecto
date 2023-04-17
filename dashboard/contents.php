<?php include "headerandside.php";
$sql = "SELECT * FROM contents";
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

  .error-of-amz {
    color: red;
  }

  .success-of-amz {
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
            <a class="nav-link active" href="contents.php">
              <span data-feather="file"></span>
              Contents
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="users.php">
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
      if ($_GET['empty'] == true) {
      ?><h2 class="h3 mb-3 fw-normal error-of-amz">fields cant be empty</h2>
      <?php
      }
      if ($_GET['duplex'] == true) {
      ?><h2 class="h3 mb-3 fw-normal error-of-amz">Title Already exist</h2>
      <?php
      }
      if ($_GET['created'] == true) {
      ?><h2 class="h3 mb-3 fw-normal success-of-amz">Article has been created</h2>
      <?php
      }
      if ($_GET['del'] == true) {
        ?><h2 class="h3 mb-3 fw-normal success-of-amz">Article has been deleted</h2>
        <?php
      }
      ?>
      <h2>Add new articele</h2>
      </br>
      <main class="form-signin">
        <form method="post" action="articleadd.php">



          <div class="form-floating">
            <input type="text" name="title" class="form-control" id="floatingInput" placeholder="Title">
            <label for="floatingInput">Title</label>
          </div>
          <div class="form-floating">
            <input type="textarea" name="content" class="form-control" id="floatingInput" placeholder="content">
            <label for="floatingInput">content</label>
          </div>
          <button class="w-100 btn btn-lg btn-primary" type="submit">add content</button>
        </form>
      </main>
      <hr>
      <h2>Manage articles</h2>
      <table>
        <tr>
          <!--th>ID</th-->
          <th>Title</th>
          <th>content</th>
          <th>Remove</th>
          <th>Edit</th>
        </tr>
        <?php for ($i = 0; $i <= mysqli_num_rows($resault); $i++) {
          $row = mysqli_fetch_assoc($resault);
          if (!empty($row['id'])) {
        ?>
            <tr>
              <!--th><?php //echo ($row['id']) ?> </th-->
              <th><?php echo ($row['title']) ?> </th>
              <th><?php echo ($row['content']) ?> </th>
              <th><a href="rmarticle.php?id=<?php echo ($row['id']); ?>"><i class="fa-solid fa-trash"></a></i></th>
              <th><a href="modarticle.php?id=<?php echo ($row['id']); ?>"><i class="fa-solid fa-pen"></a></i></th>
            </tr>
        <?php }
        } ?>
      </table>