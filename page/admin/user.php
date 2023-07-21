<?php

use Config\Database;
use Config\Session;
use Config\Storage;

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
  <style>
    .dropdown-menu li {
      position: relative;
      }
      .dropdown-menu .dropdown-submenu {
      display: none;
      position: absolute;
      left: 100%;
      top: -7px;
      }
      .dropdown-menu .dropdown-submenu-left {
      right: 100%;
      left: auto;
      }
      .dropdown-menu > li:hover > .dropdown-submenu {
      display: block;
      }
  </style>
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
                  User
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
            <div class="btn-group me-2">
              <button class="btn btn-danger" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-trash me-2"></i>
                Delete
              </button>
              <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false" data-bs-reference="parent">
                <span class="visually-hidden">Toggle Dropdown</span>
              </button>
              <form method="get">
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><button type="submit" name="filter" value="select" class="dropdown-item">Pilih</button></li>
                  <li><button type="submit" name="filter" value="select-all" class="dropdown-item">Pilih Semua</button></li>
                  
                </ul>
              </form>
            </div>
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
                    <ul class="dropdown-menu dropdown-submenu dropdown-submenu-left">
                      <li><button class="dropdown-item" type="submit" name="filter" value="admin" href="#">Admin</button></li>
                      <li><button class="dropdown-item" type="submit" name="filter" value="student" href="#">Student</button></li>
                      <li><button class="dropdown-item" type="submit" name="filter" value="mentor" href="#">Mentor</button></li>
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
              <tbody id="user-table-body">
                <p><?php
                    // filter 
                    if (isset($_GET['filter'])) {
                      $filter = $_GET['filter'];
                      if ($filter == "asc") {
                        $data = Database::getAll("SELECT * FROM users ORDER BY name ASC");
                      }elseif ($filter == "desc") {
                        $data = Database::getAll("SELECT * FROM users ORDER BY name DESC");
                      }elseif ($filter == "admin") {
                        $data = Database::getAll("SELECT * FROM users WHERE role='admin' ORDER BY name ASC");
                      }elseif ($filter == "student") {
                        $data = Database::getAll("SELECT * FROM users WHERE role='student' ORDER BY name ASC");
                      }elseif ($filter == "mentor") {
                        $data = Database::getAll("SELECT * FROM users WHERE role='mentor' ORDER BY name ASC");
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
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
  <script>
  function handleSearch() {
    var searchKeyword = document.getElementById('page-header-search-input2').value.toLowerCase();
    var rows = document.querySelectorAll('#user-table-body tr');

    rows.forEach(function(row) {
      var dataCells = row.querySelectorAll('td');
      var matchFound = false;

      dataCells.forEach(function(cell) {
        if (cell.textContent.toLowerCase().includes(searchKeyword)) {
          matchFound = true;
        }
      });

      if (matchFound) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }

  document.getElementById('page-header-search-input2').addEventListener('input', handleSearch);

  handleSearch();
</script>
</body>

</html>