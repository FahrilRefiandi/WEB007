<?php
    require_once('config/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasipaham | Bikin EZ aja!</title>
    <link rel="icon" type="icon" href="<?=asset('images/ico.svg')?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
    <link rel="stylesheet" href="<?= asset('main.css') ?>">
    <style>
        body {
            margin: 0;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg px-5 py-3 sticky-top bg-light shadow">
  <div class="container-fluid">
    <a class="navbar-brand me-2" href="#"><img src="<?=asset('images/kasipaham.svg')?>" alt="kasipaham logo" height="32"></a>
    <ul class="navbar-nav nav-underline">
        <li class="nav-item">
          <a class="nav-link active text-primary" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Tentang Kami</a>
        </li>
      </ul>
      <div>
      <a  class="btn btn-outline-primary me-2" href="<?=url('/login')?>">Masuk</a>
      <a  class="btn btn-primary" href="<?=url('/register')?>">Daftar</a>
      </div>
  </div>
</nav>

<div class="container-fluid-lg m-0">
    <img src="assets/images/Title-Header.png" class="img-fluid vw-100" alt="Header">
</div>

<div class="container-fluid d-flex lg mx-auto p-5 justify-content-center bg-info">
    <img src="assets/images/card%20tryout.png" class="img-fluid" style="mw-50" alt="Tryout">
</div>

<div class="container d-flex flex-column px-4 py-5 justify-content-center">
    <h1 class="fs-2 text-primary fw-bold justify-content-center">Kenapa harus #KasipahamAja?</h1>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
      <div class="feature col">
        <div class="img-fluid d-inline-flex align-items-center justify-content-center fs-2 mb-3">
        <lord-icon src="https://cdn.lordicon.com/dxoycpzg.json" trigger="loop" delay="2000" colors="primary:#f24c00,secondary:#646e78,tertiary:#4bb3fd,quaternary:#ebe6ef,quinary:#f9c9c0">
        </lord-icon>
        </div>
        <h3 class="fs-2 text-info fw-bold">Materi Asique</h3>
        <p class="text-secondary">Ya dong, dengan Kasipaham, materi yang dikasih pasti selalu asqiue</p>
      </div>
      <div class="feature col">
        <div class="img-fluid d-inline-flex align-items-center justify-content-center fs-2 mb-3">
        <lord-icon src="https://cdn.lordicon.com/ajkxzzfb.json" trigger="loop" delay="2000" colors="primary:#ffc738,secondary:#4bb3fd" state="hover-looking-around">
        </lord-icon>
        </div>
        <h3 class="fs-2 text-info fw-bold">Mentor Ketjeh</h3>
        <p class="text-secondary">Dengan mentor yang ketjeh badai, belajar kalian lebih menyenangkan
                    dan seru. Kesusahan dengan materi? Mentor Kasipaham bakal kasih paham kalian
                    dengan sepenuh hati dong.</p>
      </div>
      <div class="feature col">
        <div class="bd-placeholder-img d-inline-flex align-items-center justify-content-center fs-2 mb-3" width="140" height="140">
        <lord-icon src="https://cdn.lordicon.com/oqhlhtfq.json" trigger="loop" delay="2000" colors="primary:#4bb3fd,secondary:#ebe6ef" state="hover-2">
        </lord-icon>
        </div>
        <h3 class="fs-2 text-info fw-bold">Support 24/7</h3>
        <p class="text-secondary">Dengan support 24/7, kalian bisa mengakses Kasipaham kapan aja dan dimana aja loh.
                    So, jaman now belajar bisa lebih EZ PZ ya.</p>
      </div>
    </div>
</div>

<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 px-5 border-top bg-dark">
    <div class="col-md-4 d-flex align-items-center">
      <span class="mb-3 mb-md-0 text-light">© 2023 Kasipaham</span>
    </div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
      <li class="ms-3"><a class="text-light" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg></a></li>
      <li class="ms-3"><a class="text-light" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg></a></li>
      <li class="ms-3"><a class="text-light" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg></a></li>
    </ul>
</footer>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>