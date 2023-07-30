<?php
require_once("../config/config.php");
require_once("../controllers/AuthController.php");

use Config\Session;
use Controllers\AuthController;
use Validation\Validation;

if (isset($_POST['register'])) {
  AuthController::register($_POST);
}

middleware('guest');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register page - Kasipaham</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="icon" type="icon" href="<?= asset('images/ico.svg') ?>">
  <link rel="stylesheet" href="<?= asset('main.css') ?>">
</head>

<body class="d-flex bg-info">
  <div class="position-fixed top-0 start-0 p-4">
    <a class="text-light" href="./"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
      </svg></a>
  </div>

  <div class="container-fluid w-50 p-4 rounded-3 shadow justify-content-center bg-light position-absolute top-50 start-50 translate-middle mt-5 mb-5">
    <h1 class="h3 mb-4 fw-bold text-dark">Selamat Datang di Kasipaham</h1>
    <ul class="errors">
      <?php
      if ($errors = Validation::errors()) {
        foreach ($errors as $error) {
          echo "<li>$error</li>";
        }
      }
      ?>
    </ul>
    <form method="POST">
      <span class="errors"><?= Session::session('errors') ?></span>

      <div class="row row-form-role">
        <div class="col">
          <div class="form-role">
            <input type="radio" value="student" class="role" id="student" name="role" checked>
            <label for="student">
              
              Student
            </label>
          </div>
        </div>
        <div class="col">
          <div class="form-role">
            <input type="radio" value="mentor" class="role" id="mentor" name="role">
            <label for="mentor">
              Mentor
            </label>
          </div>
        </div>
      </div>


      <label class="form-label mb-2">Nama Lengkap</label>
      <div class="form-floating">
        <input class="form-control mb-3" type="text" placeholder="Nama Lengkap" aria-label=".form-control-lg example" name="name" value="<?= Session::old('name') ?>">
        <label class="form-label">Nama Lengkap</label>
      </div>
      <label class="form-label mb-2">E-Mail</label>
      <div class="form-floating">
        <input class="form-control mb-3" type="text" placeholder="E-Mail" aria-label=".form-control-lg example" name="email" value="<?= Session::old('email') ?>">
        <label class="form-label">E-Mail</label>
      </div>
      <label class="form-label mb-2">Username</label>
      <div class="form-floating">
        <input class="form-control mb-3" type="text" placeholder="E-Mail" aria-label=".form-control-lg example" name="username" value="<?= Session::old('username') ?>">
        <label class="form-label">Username</label>
      </div>
      <label class="form-label mb-2">No. Telepon</label>
      <div class="form-floating">
        <input class="form-control mb-3" type="number" placeholder="No. telepon" aria-label=".form-control-lg example" name="phone_number" value="<?= Session::old('phone_number') ?>">
        <label class="form-label">No. Telepon</label>
      </div>
      <label class="form-label mb-2">Password</label>
      <div class="form-floating">
        <input class="form-control mb-3" type="password" placeholder="Password" aria-label=".form-control-lg example" name="password" value="<?= Session::old('password') ?>">
        <label class="form-label">Password</label>
      </div>
      <button name="register" class="btn btn-primary mt-4 w-25 py-2 d-flex mx-auto justify-content-center" type="submit">Daftar</button>
      <p class="mt-5 mb-3 text-body-secondary">©2023 Kasipaham</p>
    </form>
  </div>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



</body>

</html>