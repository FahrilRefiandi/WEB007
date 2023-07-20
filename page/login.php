<?php
require_once("../config/config.php");
require_once("../controllers/AuthController.php");

use Config\Locale;
use Config\Session;
use Controllers\AuthController;
use Validation\Validation;

if (isset($_POST['login'])) {
  AuthController::login($_POST);
}

middleware('guest');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login page - Kasipaham</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
  <link href="<?= asset('bootstrap-5.3.0/dist/css/bootstrap.min.css') ?>" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="icon" type="icon" href="<?= asset('images/ico.svg') ?>">
  <link rel="stylesheet" href="<?= asset('main.css') ?>">
</head>

<body class="d-flex bg-info">
  <div class="position-fixed top-0 start-0 p-4">
    <a class="text-light" href="./"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
      </svg></a>
  </div>

  <div class="container-fluid w-25 m-auto p-4 rounded-3 shadow justify-content-center bg-light position-absolute top-50 start-50 translate-middle">
    <form method="post">
      <h1 class="h3 mb-4 fw-bold text-dark">Selamat Datang di Kasipaham</h1>

      <ul class="errors">
        <?php
        if ($errors = Validation::errors()) {
          foreach ($errors as $error) {
            echo "<li>$error</li>";
          }
        }
        ?></ul>





      <label class="form-label mb-2">Username</label>
      <div class="form-floating">
        <input class="form-control form-control-lg mb-3" type="text" placeholder="Username" aria-label=".form-control-lg example" name="username" value="<?= Session::old('username') ?>" autofocus>
        <span class="errors"><?= Session::session('username') ?></span>
        <label for="floatingInput">Username</label>
      </div>
      <label class="form-label mb-2">Password</label>
      <div class="form-floating">
        <input class="form-control form-control-lg mb-3" type="password" placeholder="Password" aria-label=".form-control-lg example" name="password" autofocus>
        <span class="errors"><?= Session::session('password') ?></span>
        <label for="floatingPassword">Password</label>
      </div>

      <div class="form-check text-start my-3">
        <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
          Remember me
        </label>
      </div>
      <button name="login" class="btn btn-primary w-100 py-2" type="submit">Masuk</button>
      <p class="mt-3 mb-3 ">Belum punya akun? <a class="text-decoration-none" href="<?= url('/register') ?>">Daftar</a></p>
      <p class="mt-5 mb-3 text-body-secondary">©2023</p>
    </form>
  </div>
  <script src="<?= asset('bootstrap-5.3.0/dist/js/bootstrap.bundle.min.js') ?>" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

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