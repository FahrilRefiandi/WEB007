<?php
// require_once("../config/config.php");
use Config\Session;
use Config\Locale;

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