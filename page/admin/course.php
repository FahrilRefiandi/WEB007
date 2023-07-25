<?php

use Config\Database;
use Config\Session;
use Controllers\CourseController;
use Validation\Validation;

require_once(__DIR__ . "../../../config/config.php");
middleware(["auth", "admin"]);
require_once('layouts/template.php');
$course = Database::getAll("
SELECT course.*, COUNT(learning_materials.id) AS number_of_meetings, MAX(learning_materials.created_at) AS last_material
FROM course
LEFT JOIN learning_materials ON course.id = learning_materials.course_id
GROUP BY course.id;
");
$teachers = Database::getAll("SELECT * FROM users WHERE role='mentor'");
$class = Database::getAll("SELECT * FROM class");


if (isset($_POST['tambah'])) {
    CourseController::insert($_POST);
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Kasipaham <?= Session::auth()['name'] ?></title>
    <?php require($template['css']) ?>
    <?php require($template['js']) ?>
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
        <!-- Main Container -->
        <main id="main-container">
            <!-- Hero Content -->
            <div class="bg-primary-dark">
                <div class="content content-full text-center pt-7 pb-5">
                    <h1 class="h2 text-white mb-2">
                        Course Development System
                    </h1>
                    <h2 class="h4 fw-normal text-white-75">
                        Laman Management Course Kasipaham
                    </h2>
                </div>
            </div>
            <!-- END Hero Content -->

            <!-- Page Content -->
            <div class="content content-boxed">
                <!-- navbar -->
                <nav class="navbar bg-transparent">
                    <div class="container-fluid">
                        <!-- <span class="navbar-brand">Course</span> -->
                        <form class="d-flex input-group-sm" role="search" method="get">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="input-search" name="search">
                            <button class="btn btn-outline-primary" type="submit">Search</button>
                        </form>
                        <div class="text-end">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Data</button>
                        </div>
                    </div>
                </nav>
                <!-- navbar -->

                <div class="row items-push py-4" id="course">
                    <?php
                    foreach ($course as $cours) {
                    ?>

                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="card bg-skeleton">
                                <a href="<?= url('/admin/detail-course?id=' . $cours['id']) ?>" class="text-decoration-none text-dark">
                                    <div class="block-content block-content-full text-center bg-city">
                                        <div class="item item-2x item-circle bg-white-10 py-3 my-3 mx-auto">
                                            <i class="fab fa-html5 fa-2x text-white-75"></i>
                                        </div>
                                        <div class="fs-sm text-white-75 skeleton">
                                            <?= $cours['number_of_meetings'] ?> Materi &bull; Kelas <?= $cours['class'] ?>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title skeleton"><?= $cours['course_title'] ?></h5>
                                        <div class="course-description skeleton"><?= $cours['description'] ?></div>
                                    </div>
                                    <div class="card-footer bg-transparent border-top-0">
                                        <span class="last-material skeleton"><?= $cours['last_material'] ?></span>
                                    </div>
                            </div>
                            </a>
                        </div>
                    <?php } ?>



                </div>
            </div>
            <!-- END Page Content -->
        </main>

        <!-- END Main Container -->

        <?php require($template['footer']) ?>
    </div>
    <!-- END Page Container -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <ul class="errors">
                            <?php
                            if ($errors = Validation::errors()) {
                                echo '<script>var myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {});
                                document.onreadystatechange = function() {
                                    myModal.show();
                                };</script>';
                                foreach ($errors as $error) {
                                    echo "<li>$error</li>";
                                }
                            }
                            ?></ul>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="course-title" placeholder="Bahasa Indonesia" value="<?= Session::old('course_title') ?>" name="course_title">
                            <label for="course-title">Course Title</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="teacher" aria-label="Floating label select example" name="teacher_id">

                                <?php
                                if ($teacher = Session::old('teacher_id')) {
                                    $data = Database::getFirst("SELECT name FROM users WHERE id='$teacher'");
                                    echo '<option selected value="' . $teacher . '">' . $data['name'] . '</option>';
                                } else {
                                    echo '<option value="" selected>Pilih Mentor</option>';
                                }

                                foreach ($teachers as $t) { ?>
                                    <option value="<?= $t['id'] ?>"><?= $t['name'] ?></option>
                                <?php } ?>

                            </select>
                            <label for="teacher">Pilih Mentor</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" id="class" aria-label="Floating label select example" name="class">
                                <?php
                                if ($session = Session::old('class')) {
                                    $session = explode("|", $session);
                                    echo '<option selected value="' . $session[0] . '|' . $session[1] . '">' . $session[0] . ' ' . $session[1] . '</option>';
                                } else {
                                    echo '<option value="" selected>Pilih Kelas</option>';
                                }


                                foreach ($class as $t) { ?>
                                    <option value="<?= $t['class'] ?>|<?= $t['major'] ?>"><?= $t['class'] ?> <?= $t['major'] ?></option>
                                <?php } ?>

                            </select>
                            <label for="class">Pilih Kelas</label>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control" id="basic-example" cols="30" rows="10"><?= Session::old('description') ?></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="tambah" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script>
        $(document).ready(function() {
            // input-search
            $("#input-search").keyup(function() {
                var value = $(this).val().toLowerCase();
                $("#course .col-xl-3").each(function() {
                    var text = $(this).text().toLowerCase();
                    $(this).toggle(text.indexOf(value) > -1);
                });

                if ($("#course .col-xl-3:visible").length === 0) {
                    if ($("#no-result-alert").length === 0) {
                        $("#course").append('<div id="no-result-alert" class="col-md-12"><div class="alert alert-danger">No result found</div></div>');
                    }
                } else {
                    $("#no-result-alert").remove();
                    $("#course .col-xl-3 a").addClass("bg-skeleton");
                    $("#course .col-xl-3 a .fs-sm").addClass("skeleton");
                    $("#course .col-xl-3 a div h4").addClass("skeleton");
                    setTimeout(removeSekeleton, 2000);
                }
            });
        });

        function removeSekeleton() {
            $(".skeleton").removeClass("skeleton");
            $(".bg-skeleton").removeClass("bg-skeleton");
        }

        $("document").ready(function() {
            setTimeout(removeSekeleton, 2000);
        });

        $('.last-material').each(function() {
            var date = $(this).text();
            var date = moment(date, "YYYY-MM-DD HH:mm:ss").fromNow();
            $(this).text(date);
            if (date == "Invalid date") {
                $(this).text("No material yet");
            }
        });

        $(".course-description").each(function() {
            var text = $(this).text().trim();
            text = text.replace(/<[^>]*>/g, '');
            
            if (text.length > 100) {
                text = text.substring(0, 100);
                text = text + "...";
            }
            $(this).text(text);
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