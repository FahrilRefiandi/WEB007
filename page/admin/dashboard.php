<?php

use Config\Session;
use Config\Storage;

require_once(__DIR__."../../../config/config.php");
middleware(["auth","admin"]);
require_once('layouts/template.php');
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Kasipaham <?=Session::auth()['name']?></title>
    <?php include($template['css'])?>
  </head>

  <body>
    
    <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
      <!-- Side Overlay-->
      <?php include($template['sidebar'])?>
      
      <!-- END Sidebar -->

      <!-- Header -->
     <?php include($template['header'])?>
      <!-- END Header -->

      <!-- Main Container -->
      <main id="main-container">
        <!-- Hero -->
        <div class="bg-body-light">
          <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
              <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-1">
                  Blank with Block
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                  That feeling of delight when you start your awesome new project!
                </h2>
              </div>
              <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                  <li class="breadcrumb-item">
                    <a class="link-fx" href="javascript:void(0)">Generic</a>
                  </li>
                  <li class="breadcrumb-item" aria-current="page">
                    Blank with Block
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
          <div class="block block-rounded">
            <div class="block-header block-header-default">
              <h3 class="block-title">
                Block Title
              </h3>
              <div class="block-options">
                <button type="button" class="btn-block-option">
                  <i class="si si-settings"></i>
                </button>
              </div>
            </div>
            <div class="block-content">
              <p>Your content..</p>
            </div>
          </div>
          <!-- END Your Block -->
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->

      <?php include($template['footer'])?>
    </div>
    <!-- END Page Container -->

    
    <?php include($template['js'])?>
  </body>
</html>
