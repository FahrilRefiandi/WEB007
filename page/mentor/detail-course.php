<?php

use Config\Database;
use Config\Session;
use Controllers\CourseController;
use Validation\Validation;

require_once(__DIR__ . "../../../config/config.php");
middleware(["auth", "mentor"]);
require_once('layouts/template.php');

$id = $_GET['id'];
$data = Database::getFirst("
SELECT course.*,
       COUNT(learning_materials.id) AS number_of_meetings,
       COUNT(DISTINCT courses_taken.course_id) AS taken,
       MAX(learning_materials.created_at) AS last_material
FROM course
LEFT JOIN learning_materials ON course.id = learning_materials.course_id
LEFT JOIN courses_taken ON course.id = courses_taken.course_id
WHERE course.id = '$id'
GROUP BY course.id;
");

if ($data == null) {
    Session::session('success', 'Course not found');
    header("Location: " . url('/mentor/course'));
}

// MATERIALS
$materi = Database::getAll("
SELECT bab,MAX(created_at) AS last_material,
       CONCAT('[', GROUP_CONCAT(JSON_OBJECT('title', title, 'id', id,'created_at',DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s'))), ']') AS data
FROM learning_materials
WHERE course_id = '$id'
GROUP BY bab;
");
if (isset($_POST['tambah'])) {
    CourseController::saveLesson($_POST);
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Kasipaham <?= Session::auth()['name'] ?></title>
    <?php require($template['css']) ?>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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
            <!-- Hero Content -->
            <div class="bg-image" style="background-image: url('assets/media/various/promo-code.png');">
                <div class="bg-primary-dark-op">
                    <div class="content content-full text-center py-7 pb-5">
                        <h1 class="h2 text-white mb-2">
                            <?= $data['course_title'] ?>
                        </h1>
                        <h2 class="h4 fw-normal text-white-75">
                            <?= $data['number_of_meetings'] ?> Materi &bull; <?= $data['taken'] ?> Jumlah Peserta
                        </h2>
                    </div>
                </div>
            </div>
            <!-- END Hero Content -->

            <!-- Navigation -->
            <div class="bg-body-extra-light">
                <div class="content content-boxed py-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-alt">
                            <li class="breadcrumb-item">
                                <a class="link-fx" href="<?=url('/mentor/dashboard')?>">Mentor</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="link-fx" href="<?= url('/mentor/course') ?>">Courses</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <?= $data['course_title'] ?>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- END Navigation -->

            <!-- Page Content -->
            <div class="content content-boxed">

                <!-- navbar -->
                <nav class="navbar bg-transparent mb-3">
                    <div class="container-fluid">
                        <!-- <span class="navbar-brand">Course</span> -->
                        <form class="d-flex input-group-sm" role="search" method="get">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="input-search" name="search">
                            <button class="btn btn-outline-primary" type="submit">Search</button>
                        </form>
                        <!-- Button buat update course [belum] -->
                        <div class="button">
                        <button class="btn btn-danger me-2" type="button" id="btnDelete">
                            <i class="bi bi-trash me-2"></i>
                            Delete
                        </button>   
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addLessonModal" data-course-id="<?= $data['id'] ?>" data-course-title="<?= $data['course_title'] ?>">
                            <i class="bi bi-plus-circle me-2"></i>
                            Add
                        </button>
                        <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-gear-wide-connected"></i>
                        </button>
                        <form method="get">
                            <ul class="dropdown-menu dropdown-menu-end">
                            <li><a type="submit" name="filter" value="update" class="dropdown-item" href="<?= url('/mentor/update-course?id=' . $data['id']) ?>"><i class="bi bi-pencil me-2"></i>Update Course</a></li>
                            <li><button type="submit" name="filter" value="del" class="dropdown-item"><i class="bi bi-trash me-2"></i>Hapus Course</button></li>
                            </ul>
                        </form>
                        </div>
                    </div>
                </nav>
                <!-- navbar -->

                <!-- Lessons -->
                <div class="block block-rounded">
                    <div class="block-content fs-sm" id="containerDetailCourse">


                        <?php
                        if (count($materi) == 0) {
                            echo '<div class="alert alert-danger">Belum ada</div>';
                        }
                        foreach ($materi as $key => $value) {
                            $materi[$key]['data'] = json_decode($value['data']); ?>
                            <table class="table table-borderless table-vcenter skeleton">
                                <tbody>
                                    <tr class="table-active">
                                        <th colspan="2">Bab <?= $value['bab'] ?></th>
                                        <th class="text-end">
                                            <span class="text-muted dateTime"><?= $value['last_material'] ?></span>
                                        </th>

                                    </tr>
                                    <?php
                                    $i = 1;
                                    foreach ($materi[$key]['data'] as $key2 => $pertemuan) { ?>
                                        <tr class="index">
                                            <td class="table-success text-center">
                                                <?= $i++ ?>
                                            </td>
                                            <td class="text-align-center">
                                                <!-- Button Edit Lesson/Materi-->
                                                <a type="submit" name="filter" value="update" class="btn btn-outline-secondary me-2" href="<?= url('/mentor/update-lesson?id=' . $data['id']) ?>"><i class="bi bi-pencil"></i></a>
                                                <a class="fw-medium" href="<?= url('/mentor/meet?id=') . $pertemuan->id ?>">
                                                    <?= $pertemuan->title ?>
                                                </a>
                                            </td>
                                            <td class="text-end text-muted dateTime ">
                                                <?= $pertemuan->created_at ?>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } ?>
                        <!-- END Introduction -->

                    </div>
                </div>
                <!-- END Lessons -->
            </div>
            <!-- END Page Content -->
        </main>
        <!-- END Main Container -->
        <!-- Modal untuk menambahkan materi baru (addLessonModal) -->
        <div class="modal fade" id="addLessonModal" tabindex="-1" aria-labelledby="addLessonModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLessonModalLabel">Add New Lesson (Materi)</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post"> <!-- Perbaiki atribut action untuk menentukan skrip penyimpanan data -->
                        <div class="modal-body">
                            <ul class="errors">
                                <?php
                                if ($errors = Validation::errors()) {
                                    foreach ($errors as $error) {
                                        echo "<li>$error</li>";
                                    }
                                }
                                ?>
                            </ul>
                            <!-- Input fields untuk mengisi data -->
                            <input type="hidden" name="course_id" value="<?= $data['id'] ?>">
                            <div class="mb-3">
                                <label for="lessonTitle" class="form-label">Judul Materi</label>
                                <input type="text" class="form-control" id="lessonTitle" name="lesson_title">
                            </div>
                            <div class="mb-3">
                                <label for="lessonVideo" class="form-label">Embed Video (YouTube Link)</label>
                                <input type="text" class="form-control" id="lessonVideo" name="embed_video">
                            </div>
                            <div class="mb-3">
                                <label for="lessonDescription" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="lessonDescription" name="description" rows="5"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="lessonBab" class="form-label">Bab (Lesson Number)</label>
                                <input type="number" class="form-control" id="lessonBab" name="bab">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="tambah" class="btn btn-primary me-2">Save Lesson</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <?php require($template['footer']) ?>
    </div>
    <!-- END Page Container -->





    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#addLessonModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var courseId = button.data('course-id'); // Extract info from data-* attributes
                var courseTitle = button.data('course-title');
                var modal = $(this);
                modal.find('.modal-title').text('Add New Lesson for Course: ' + courseTitle);
                modal.find('#lessonCourseId').val(courseId);
            });
        });
    </script>
    <?php require($template['js']) ?>
    <script>
        $(document).ready(function() {
            // input-search
            $("#input-search").on("input",function() {
                
                var value = $(this).val().toLowerCase();
                $("table .index").each(function() {
                    var text = $(this).text().toLowerCase();
                    $(this).toggle(text.indexOf(value) > -1);
                });

                if ($("table .index:visible").length === 0) {
                    if ($("#no-result-alert").length === 0) {
                        $(".table-active").hide();
                        $("#containerDetailCourse").append('<div id="no-result-alert" class="col-md-12"><div class="alert alert-danger">No result found</div></div>');
                    }
                } else {
                    $("#no-result-alert").remove();
                    $(".table-active").show();
                    $("table tr").addClass("skeleton");
                    setTimeout(removeSekeleton, 500);
                }
            });
        });

        function removeSekeleton() {
            $(".skeleton").removeClass("skeleton");
            $(".bg-skeleton").removeClass("bg-skeleton");
        }

        $("document").ready(function() {
            setTimeout(removeSekeleton, 500);
        });

        $('.dateTime').each(function() {
            var date = $(this).text();
            var date = moment(date, "YYYY-MM-DD HH:mm:ss").fromNow();
            $(this).text(date);
            if (date == "Invalid date") {
                $(this).text("No material yet");
            }
        });
    </script>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


    <script>
        tinymce.init({
            selector: 'textarea'
        });
    </script>
    <?php include($notif) ?>
    
</body>

</html>