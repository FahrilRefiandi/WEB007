<?php

use Config\Database;
use Config\Session;
use Config\Storage;
use Validation\Validation;

require_once(__DIR__ . "../../../config/config.php");
require_once(__DIR__ . "../../../config/database.php");
middleware(["auth", "admin"]);
require_once('layouts/template.php');

if (isset($_POST['edit'])) {
  database::edit($_POST);
}
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

      </div>
      <!-- END Hero -->
      <!-- Page Content -->
      <div class="content">
        <!-- Your Block -->
        <div class="block block-rounded-2">
          <div class="block-header block-header-default">
            <h3 class="block-title text-center">
              EDIT PROFILE
            </h3>
          </div>
          <form class="container-fluid w-75 m-auto p-4" method="POST">
            <div class="form-floating">
              <input class="form-control form-control-lg mb-3" type="text" placeholder="Nama" aria-label=".form-control-lg example" name="name" value="<?=Session::auth()['name']?>" autofocus>
              <label for="floatingInput">Nama</label>
            </div>
            <div class="form-floating">
              <input class="form-control form-control-lg mb-3" type="text" placeholder="E-Mail" aria-label=".form-control-lg example" name="email" value="<?=Session::auth()['email']?>" autofocus>
              <label for="floatingInput">E-Mail</label>
            </div>
            <div class="form-floating">
              <input class="form-control form-control-lg mb-3" type="text" placeholder="Username" aria-label=".form-control-lg example" name="username" value="<?=Session::auth()['username']?>" autofocus>
              <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating">
              <input class="form-control form-control-lg mb-3" type="text" placeholder="No. Telepon" aria-label=".form-control-lg example" name="phone_number" value="<?=Session::auth()['phone_number']?>" autofocus>
              <label for="floatingInput">No. Telepon</label>
            </div>
            <div class="form-floating">
              <input class="form-control form-control-lg mb-3" type="password" placeholder="Password" aria-label=".form-control-lg example" name="password" autofocus>
              <label for="floatingInput">Password</label>
            </div>
            <div class="button position-relative mx-auto justify-content-center">
                <button name="edit" class="btn btn-info" type="submit" aria-expanded="false" type="submit">
                  update
                </button>
            </div>
          </form>
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