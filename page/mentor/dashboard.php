<?php

use Config\Database;
use Config\Session;
use Config\Storage;

require_once(__DIR__ . "../../../config/config.php");
middleware(["auth", "mentor"]);
require_once('layouts/template.php');
$course=Database::getAll("
SELECT course.*, COUNT(learning_materials.id) AS number_of_meetings, MAX(learning_materials.created_at) AS last_material
FROM course
LEFT JOIN learning_materials ON course.id = learning_materials.course_id
GROUP BY course.id;
");
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Kasipaham <?= Session::auth()['name'] ?></title>
  <?php require($template['css']) ?>
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
                Selamat datang di Kasipaham!
              </h1>
              <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                Halo, <?= Session::auth()['name'] ?>
              </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">
                  <a class="link-fx" href="javascript:void(0)">Dashboard</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  Dashboard
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
      <!-- END Hero -->
      <!-- Page Content -->
      <div class="content">
        <div class="content content-boxed">
          <nav class="navbar bg-transparent p-0">
            <div class="container-fluid">
            <h3 class="block-title">
              Course Tersedia
            </h3>
              <!-- <span class="navbar-brand">Course</span> -->
              <form class="d-flex input-group-sm" role="search" method="get">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="input-search" name="search">
                <button class="btn btn-outline-primary" type="submit">Search</button>
              </form>
            </div>
          </nav>
          <!-- navbar -->
          <div class="row items-push py-4" id="course">
            <?php
            foreach($course as $cours){
            ?>
            <!-- Course -->
            <div class="col-md-6 col-lg-4 col-xl-3">
               <a class="block block-rounded block-link-pop h-100 mb-0 bg-skeleton" href="<?=url('/mentor/detail-course?id='.$cours['id'])?>">
                  <div class="block-content block-content-full text-center bg-city">
                      <div class="item item-2x item-circle bg-white-10 py-3 my-3 mx-auto">
                          <i class="fab fa-html5 fa-2x text-white-75"></i>
                      </div>
                      <div class="fs-sm text-white-75 skeleton">
                        <?=$cours['number_of_meetings']?> Materi &bull; Kelas <?=$cours['class']?>
                      </div>
                            </div>
                            <div class="block-content block-content-full">
                                <h4 class="h5 mb-1 skeleton">
                                    <?=$cours['course_title']?> :
                                    <small class="course-description">
                                        <?=$cours['description']?>
                                    </small>
                                </h4>
                                <div class="fs-sm text-muted skeleton last-material"><?=$cours['last_material']?></div>
                            </div>
                        </a>
                    </div>
                    <!-- END Course -->
                    <?php } ?>   
              </div>
            </div>
          <!-- Content Course disini -->
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
  
  <?php include($notif)?>
</body>

</html>