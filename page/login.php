<?php
require_once("../config/config.php");
require_once("../controllers/AuthController.php");

use Config\Session;
use Controllers\AuthController;
if(isset($_POST['login'])){
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
  <link href="./assets/bootstrap-5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
  <link rel="icon" type="icon" href="<?=asset('/images/kasipaham.svg')?>">
  <link rel="stylesheet" href="<?= asset('main.css') ?>">
</head>

<body>
  
  <div class="row row-login">
    <div class="col col-4 px-5">
      <div class="login-form mx-auto mt-4">
        <h3>Selamat datang di Kasipaham</h3>
        <form class="mb-2" method="post">
          <span class="errors"><?=Session::session('errors')?></span>
          <div class="mb-3">
            <label for="username" class="form-label required">Username</label>
            <input type="text" class="form-control" id="username" name="username">
            <span class="errors"><?=errors('username')?></span>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label required">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            <span class="errors"><?=errors('password')?></span>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember-me">
            <label class="form-check-label" for="exampleCheck1">Remember </label>
          </div>
          <button type="submit" name="login" class="btn bg-kp-outline-blue w-100">Login</button>
        </form>
        <p>Belum punya akun? <a href="<?=url('/register')?>">Daftar</a></p>
      </div>
    </div>
    <div class="col col-image">
      <div class="image-login"></div>
    </div>
  </div>

  <script src="./assets/bootstrap-5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>