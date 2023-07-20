<?php

use Config\Database;
use Config\Session;
use Config\Storage;
use Config\Locale;

require_once(__DIR__ . "../../../config/config.php");
middleware(["auth", "admin"]);
require_once('layouts/template.php');
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Kasipaham <?= Session::auth()['name'] ?></title>
  <?php require($template['css']) ?>
</head>

<body>

  <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
    <!-- Side Overlay-->
    <?php require($template['sidebar']) ?>

    <!-- END Sidebar -->

    <!-- Header -->
    <?php require($template['header']) ?>
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
      <!-- Hero -->
      <div class="bg-body-light">
        <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
              <h1 class="h3 fw-bold mb-1">
                Kasipaham Database Management
              </h1>
              <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                Welcome, <?= Session::auth()['name'] ?>
              </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">
                  <a class="link-fx" href="javascript:void(0)">Dashboard</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  Dashboard
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
      <!-- END Hero -->
      <!-- Page Content -->
      <div class="content">
        <!-- Your Block -->
        <div class="block block-rounded-2">
          <div class="block-header block-header-default">
            <h3 class="block-title">
              Data User
            </h3>
            <div class="button">
              <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-sliders me-2"></i>
                filter
              </button>
              <form method="get">
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><button type="submit" name="filter" value="asc" class="dropdown-item"><i class="bi bi-sort-alpha-down me-2"></i>Urutkan A-Z</button></li>
                  <li><button type="submit" name="filter" value="desc" class="dropdown-item"><i class="bi bi-sort-alpha-down-alt me-2"></i>Urutkan Z-A</button></li>
                  <li>
                    <a class="dropdown-item" href="#"><i class="bi bi-binoculars me-2"></i>Tampilkan</a>
                    <ul class="dropdown-menu dropdown-submenu">
                      <li><a class="dropdown-item" href="#">Admin</a></li>
                      <li><a class="dropdown-item" href="#">Student</a></li>
                      <li><a class="dropdown-item" href="#">Mentor</a></li>
                    </ul>
                  </li>
                </ul>
              </form>
            </div>
          </div>

          <!-- Buatkan agar bisa global search(ntah username, role atau yang lain) dan menampilkannya di tabel -->
          <div class="block-content">
            <form class="d-none d-md-inline-block" method="POST">
              <div class="input-group input-group-sm">
                <input type="text" class="form-control form-control-alt" placeholder="Search.." id="page-header-search-input2" name="page-header-search-input2">
                <span class="input-group-text border-0">
                  <i class="fa fa-fw fa-search"></i>
                </span>
              </div>
            </form>
          </div>

          <div class="block-content">
            <table class="table table-hover table-striped">
              <thead class="table-dark">
                <tr>
                  <td>No</td>
                  <td>Nama</td>
                  <td>Username</td>
                  <td>Role</td>
                </tr>
              </thead>
              <tbody>
                <p><?php
                    // filter 
                    if (isset($_GET['filter'])) {
                      $filter = $_GET['filter'];
                      if ($filter == "asc") {
                        $data = Database::getAll("SELECT * FROM users ORDER BY name ASC");
                      }elseif ($filter == "desc") {
                        $data = Database::getAll("SELECT * FROM users ORDER BY name DESC");
                      }
                      
                    } else {
                      $data = Database::getAll('SELECT * FROM users');
                    }
                    
                    $counter = 1;
                    foreach ($data as $value) {
                    ?>
                    <tr>
                      <td><?= $counter++ ?></td>
                      <td><?= $value['name'] ?></td>
                      <td><?= $value['username'] ?></td>
                      <td><?= $value['role'] ?></td>
                    </tr>
                  <?php } ?>
              </tbody>
            </table>
            </p>
          </div>
        </div>
        <!-- END Your Block -->
      </div>
      <!-- END Page Content -->
    </main>
    <!-- END Main Container -->

    <?php require($template['footer']) ?>
  </div>
  <!-- END Page Container -->


  <?php require($template['js']) ?>

  
  <?php
  if ($session=Session::session('success')) {
  ?>
    <div class="toast-container top-0 end-0 p-3">
      <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <img src="<?=asset('images/Kasipaham ico.svg')?>" class="rounded me-2" alt="Logo Kasipaham" width="25px">
          <strong class="me-auto">Kasipaham</strong>
          <small><?=Locale::now()?></small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          <?=$session?>
        </div>
      </div>
    </div>
    <script>
      var toast = new bootstrap.Toast(document.getElementById('liveToast'))
      toast.show()
    </script>
  <?php } ?>
</body>

</html>