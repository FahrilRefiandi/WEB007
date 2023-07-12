<div class="container-fuild top-navbar">
  <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 px-3 mb-4 border-bottom">
    <div class="col-md-3 mb-2 mb-md-0">
      <a href="<?=url()?>" class="d-inline-flex link-body-emphasis text-decoration-none">
        <!-- <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap">
          <use xlink:href="#bootstrap" />
        </svg> -->
        <img src="<?=asset('images/logo.png')?>" width="100px" alt="">
      </a>
    </div>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
      <!-- <li><a href="#" class="nav-link  px-2 link-secondary">Home</a></li> -->
      <li><a href="#" class="nav-link  px-2">Home</a></li>
      <li><a href="#" class="nav-link px-2">Features</a></li>
      <li><a href="#" class="nav-link px-2">Pricing</a></li>
      <li><a href="#" class="nav-link px-2">FAQs</a></li>
      <li><a href="#" class="nav-link px-2">About</a></li>
    </ul>

    <div class="col-md-3 text-end">
      <a href="<?= url('/login') ?>" class="btn btn-sm me-2">Masuk/Daftar</a>
    </div>
  </header>
</div>