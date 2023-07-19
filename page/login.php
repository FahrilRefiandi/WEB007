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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="icon" type="icon" href="<?=asset('images/ico.svg')?>">
  <link rel="stylesheet" href="<?= asset('main.css') ?>">
</head>

<body class="d-flex bg-info">  
<div class="position-fixed top-0 start-0 p-4">
<a class="text-light" href="../index.php"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
  <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
</svg></a>
</div>

<div  class="container-fluid w-25 m-auto p-4 rounded-3 shadow justify-content-center bg-light position-absolute top-50 start-50 translate-middle">
    <form>
      <h1 class="h3 mb-4 fw-bold text-dark">Selamat Datang di Kasipaham</h1>
      <span class="errors"><?=Session::session('errors')?></span>
      <label class="form-label mb-2">Username</label>
      <div class="form-floating">
        <input class="form-control form-control-lg mb-3" type="text" placeholder="Username" aria-label=".form-control-lg example">
        <label for="floatingInput">Username</label>
        <span class="errors"><?=errors('username')?></span>
      </div>
      <label class="form-label mb-2">Password</label>
      <div class="form-floating">
      <input class="form-control form-control-lg mb-3" type="password" placeholder="Password" aria-label=".form-control-lg example">
        <label for="floatingPassword">Password</label>
        <span class="errors"><?=errors('password')?></span>
      </div>

      <div class="form-check text-start my-3">
        <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
          Remember me
        </label>
      </div>
      <button name="login" class="btn btn-primary w-100 py-2" type="submit">Masuk</button>
      <p class="mt-3 mb-3 ">Belum punya akun? <a class="text-decoration-none" href="<?=url('/page/register.php')?>">Daftar</a></p>
      <p class="mt-5 mb-3 text-body-secondary">©2023</p>
    </form>
  </div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    

</body>
</html>