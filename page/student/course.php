<?php

use Config\Database;
use Config\Session;

require_once(__DIR__ . "../../../config/config.php");
middleware(["auth", "student"]);
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
        <!-- Main Container -->
        <main id="main-container">
            <!-- Hero Content -->
            <div class="bg-info">
                <div class="content content-full text-center pt-7 pb-5">
                    <h1 class="h2 text-white mb-2">
                        Belajar? Kasipaham aja!
                    </h1>
                    <h2 class="h4 fw-normal text-white-75">
                        Solusi Bimbel Online kamu
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
                    </div>
                </nav>
                <!-- navbar -->

                <div class="row items-push py-4" id="course">
                    <?php
                    foreach($course as $cours){
                    ?>
                    <!-- Course -->
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a class="block block-rounded block-link-pop h-100 mb-0 bg-skeleton" href="<?=url('/student/detail-course?id='.$cours['id'])?>">
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
            <!-- END Page Content -->
        </main>

        <!-- END Main Container -->

        <?php require($template['footer']) ?>
    </div>
    <!-- END Page Container -->


    <?php require($template['js']) ?>
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

</script>

</body>

</html>