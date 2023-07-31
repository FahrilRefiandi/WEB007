<?php

use Config\Database;
use Config\Session;
use Controllers\CourseController;
use Validation\Validation;

require_once(__DIR__ . "../../../config/config.php");

middleware(["auth", "student"]);
require_once('layouts/template.php');
$data = Database::getAll("SELECT
course.id,
course.course_title,
JSON_ARRAYAGG(
    JSON_OBJECT(
        'id', learning_materials.id,
        'title', learning_materials.title,
        'created_at', learning_materials.created_at
    )
) AS materials
FROM
course
LEFT JOIN learning_materials ON course.id = learning_materials.course_id
JOIN courses_taken ON course.id = courses_taken.course_id

GROUP BY
course.id,
course.course_title");

// var_dump($data);
// die;


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
                                Materi
                            </h1>
                        </div>
                        <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-alt">
                                <li class="breadcrumb-item">
                                    <a class="link-fx" href="javascript:void(0)">Page</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    Materi
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- END Hero -->

            <!-- Page Content -->
            <div class="content">
                <div class="block block-rounded">
                    <div class="block-content text-center">


                        <!-- navbar -->
                        <nav class="navbar bg-transparent mb-2">
                            <div class="container-fluid">
                                <!-- <span class="navbar-brand">Course</span> -->
                                <form class="d-flex input-group-sm" role="search" method="get">
                                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="input-search" name="search">
                                    <button class="btn btn-outline-primary" type="submit">Search</button>
                                </form>
                        </nav>
                        <!-- navbar -->

                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <?php
                            $i = 1;
                            foreach ($data as $value) {
                                $value['materials'] = json_decode($value['materials'], true);
                            ?>
                                <div class="accordion-item bg-skeleton">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne<?= $i ?>" aria-expanded="false" aria-controls="flush-collapseOne<?= $i ?>">
                                            <span class="skeleton">
                                                <?= $value['course_title'] ?>
                                            </span>
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne<?= $i ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body text-start">
                                            <h5>Materi</h5>
                                            <ul>
                                                <?php

                                                if (count($value['materials']) != 1) {
                                                    foreach ($value['materials'] as $material) {
                                                        echo "<li><a class='text-decoration-none text-dark' href='" . url('/admin/meet?id=') . $material['id'] . "'>" . $material['title'] . "</a></li>";
                                                    }
                                                } else {
                                                    echo "<li><a class='text-decoration-none text-dark' href='#'>Tidak ada materi</a></li>";
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            <?php $i++;
                            } ?>


                        </div>






                    </div>
                </div>
                <!-- END Page Content -->
        </main>
        <!-- END Main Container -->

        <?php include($template['js']) ?>

        <?php include($notif) ?>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function() {
                // input-search
                $("#input-search").keyup(function() {
                    var value = $(this).val().toLowerCase();
                    $(".accordion-item .accordion-collapse").each(function() {
                        var text = $(this).text().toLowerCase();
                        $(this).toggle(text.indexOf(value) > -1);
                    });

                    if ($("accordion-item .accordion-collapse:visible").length === 0) {
                        if ($("#no-result-alert").length === 0) {
                            $("#course").append('<div id="no-result-alert" class="col-md-12"><div class="alert alert-danger">No result found</div></div>');
                        }
                    } else {
                        $("#no-result-alert").remove();
                        $("accordion-item").addClass("bg-skeleton");
                        $("accordion-item .accordion-button").addClass("skeleton");
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
        </script>

</body>

</html>