<?php

use Config\Database;
use Config\Session;
use Controllers\CourseController;
use Validation\Validation;

require_once(__DIR__ . "../../../config/config.php");
middleware(["auth", "admin"]);
require_once('layouts/template.php');

require_once(__DIR__ . "../../../config/config.php");
$id = $_GET['id'];

$materi=Database::getFirst("SELECT * FROM learning_materials WHERE id='$id'");
$course=Database::getFirst("SELECT * FROM course WHERE id='$materi[course_id]'");


if (count($_POST) > 0) {
    CourseController::deleteMeet($_POST);
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
            <!-- END Hero Content -->

            <!-- Navigation -->
            <div class="bg-body-extra-light">
                <div class="content content-boxed py-3">
                    <nav aria-label="breadcrumb ">
                        <ol class="breadcrumb breadcrumb-alt">
                            <li class="breadcrumb-item">
                                <a class="link-fx" href="<?= url('/admin/dashboard') ?>">Mentor</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="link-fx" href="<?= url('/admin/course') ?>">Courses</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <a class="link-fx" href="<?= url('/admin/detail-course?id=' . $course['id']) ?>"><?= $course['course_title'] ?></a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <?= $materi['title'] ?>
                            </li>
                        </ol>
                    </nav>
                    <div class="justify-content-end d-flex" style="margin-top: -30px;">
                        <form method="post" id="deleteMeetForm">
                            <input type="hidden" name="courseId" value="<?= $course['id'] ?>">
                            <input type="hidden" name="deleteMeet" value="<?= $id ?>">
                            <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash-alt"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END Navigation -->

            <!-- Page Content -->
            <div class="content content-boxed">

                <!-- navbar -->
                <!-- navbar -->

                <!-- Lessons -->
                <div class="block block-rounded">
                    <div class="container-fluid ratio ratio-16x9 fs-sm p-5 justify-content-center" id="containerDetailMeet">
                        <?= $materi['embed_video'] ?>
                    </div>
                    <div role="separator" class="dropdown-divider m-0"></div>
                    <div class="container bg-body-extra-light px-5 py-3">
                        <?= $materi['description'] ?>
                    </div>
                </div>
                <!-- END Lessons -->
            </div>
            <!-- END Page Content -->
        </main>
        <!-- END Main Container -->


        <?php require($template['footer']) ?>
    </div>
    <!-- END Page Container -->





    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <?php require($template['js']) ?>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


    <script>
        tinymce.init({
            selector: 'textarea'
        });

        document.getElementById("deleteMeetForm").addEventListener("submit", function(e) {
            var form = this;
            e.preventDefault();
            Swal.fire({
                title: "Yakin course akan dihapus ?",
                text: `Sobat <?= Session::auth()['name'] ?> akan menghapus materi ini.`,
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Ya,hapus meet!',
                cancelButtonText: 'Tidak, batalkan!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    if (form && typeof form.submit === 'function') {
                        form.submit();
                    }
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire(
                        'Dibatalkan',
                        'Materi tidak dihapus :)',
                        'error'
                    )
                }
            });
        });
    </script>
    <?php include($notif) ?>

</body>

</html>