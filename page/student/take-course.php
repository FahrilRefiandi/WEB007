<?php

use Config\Database;
use Config\Session;
use Config\Storage;
use Controllers\CourseController;

require_once(__DIR__ . "../../../config/config.php");
middleware(["auth", "student"]);
require_once('layouts/template.php');

$course = Database::getAll("SELECT course.*, users.name, users.avatar FROM course LEFT JOIN users ON course.teacher_id = users.id
WHERE course.id NOT IN (
  SELECT course_id
  FROM courses_taken
  WHERE user_id = " . Session::auth()['id'] . "
)
  ");

$countCourse = Database::getAll("SELECT COUNT(*) as count FROM course");




if (count($_POST) > 0) {
  CourseController::takeCourse($_POST);
}

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
                  <a class="link-fx" href="<?= url('/student/dashboard') ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  Take Course
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


          <div class="list-group mt-3 mb-3">

            <?php if (count($countCourse) == 0) { ?>
              <div class="alert alert-warning" role="alert">
                <strong>Maaf!</strong> Belum ada course yang tersedia saat ini. </strong>
              </div>

            <?php
            } elseif (count($countCourse) != 0 && count($course) == 0) { ?>
              <div class="alert alert-warning" role="alert">
                <strong><?=Session::auth()['name']?></strong> kamu sudah mengambil semua course. </strong>
              </div>


            <?php
            }
            foreach ($course as $c) {
            ?>
              <form method="post" id="takeCourse">
                <a class="list-group-item list-group-item-action mb-2 rounded" href="<?= url('/student/detail-course?id=' . $c['id']) ?>">
                  <div class="row">
                    <div class="col d-flex">
                      <img src="<?= Storage::getAvatar($c['avatar'], $c['name']) ?>" width="50" class="me-3 rounded" alt="">
                      <span class="fw-bold">
                        <?= $c['course_title'] ?>
                        Kelas <?= $c['class'] ?>
                        <br>
                        <small>Mentor <?= $c['name'] ?></small>
                      </span>
                    </div>
                    <div class="col d-flex justify-content-end py-1 px-2">
                      <input type="hidden" name="take_course" value="<?= $c['id'] ?>">
                      <input type="hidden" class="name_course" value="<?= $c['course_title'], ' Kelas ', $c['class'] ?>">
                      <input type="hidden" class="name_mentor" value="<?= $c['name'] ?>">
                      <button type="submit" class="btn btn-success btn-sm">Ambil kursus</button>
                    </div>
                  </div>
                </a>
              </form>
            <?php } ?>



            <!-- <small class="d-block text-end mt-3">
              <a href="#">All suggestions</a>
            </small> -->
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

  <script>
    // Wrap the JavaScript code in a DOMContentLoaded event listener to ensure it runs when the DOM is ready.
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('#takeCourse').forEach(form => {
        form.addEventListener('submit', function(event) {
          // get name course from hidden input 
          const nameCourse = event.currentTarget.querySelector('.name_course').value;
          const nameMentor = event.currentTarget.querySelector('.name_mentor').value;
          event.preventDefault();

          Swal.fire({

            title: "<?= Session::auth()['name'] ?> yakin mau mengambil kursus " + nameCourse + "?",
            text: "Sobat <?= Session::auth()['name'] ?> akan dimentori oleh " + nameMentor + " dalam kursus ini",
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Ya, ambil kursus!',
            cancelButtonText: 'Tidak, batalkan!',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
              if (form && typeof form.submit === 'function') {
                form.submit();
              }
            } else if (result.dismiss === Swal.DismissReason.cancel) {
              // If the user cancels, do nothing or perform any additional actions as needed
            }
          });
        });
      });
    });
  </script>

  <?php include($notif) ?>
</body>

</html>