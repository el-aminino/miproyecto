<?php include "headerandside.php"; ?>
<div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">
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
              <a class="nav-link" href="users.php">
                <span data-feather="users"></span>
                Users
              </a>
            </li>
          </ul>

          
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">





      

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Change site title</h1>
    <div class="btn-toolbar mb-2 mb-md-0">


    </div>

</div>
<main class="form-signin">
    <form method="post" action="change-title.php">



        <div class="form-floating">
            <input type="text" name="title" class="form-control" id="floatingInput" placeholder="<?php echo ($title_data['title']); ?>">
            <label for="floatingInput"><?php echo ($title_data['title']); ?></label>
        </div>

        <div class="form-floating">
            <input type="text" name="subtitle" class="form-control" id="floatingInput" placeholder="<?php echo ($title_data['subtitle']); ?>">
            <label for="floatingInput"><?php echo ($title_data['subtitle']); ?></label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">save</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
    </form>



<?php include "footerandothers.php" ?>
