<?php

use Config\Database;
use Config\Session;
use Controllers\CourseController;
use Validation\Validation;

require_once(__DIR__ . "../../../config/config.php");
middleware(["auth", "admin"]);
require_once('layouts/template.php');
$id = $_GET['id'];
$data = Database::getFirst("SELECT * FROM course WHERE id='$id'");
$teacher = Database::getAll("SELECT * FROM users WHERE role='mentor'");
$class = Database::getAll("SELECT * FROM class");
$materi = Database::getFirst("SELECT * FROM learning_materials WHERE id='$id'");

if (isset($_POST['update'])) {
    CourseController::updateLesson($_POST, $id);
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
                                Update Lesson
                            </h1>
                            <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                                <?=$data['course_title']?>
                            </h2>
                            <h3 class="fs-base lh-base fw-medium text-muted truncate mb-0">
                                <?=$materi['title']?>
                            </h3>
                        </div>
                        <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-alt">
                                <li class="breadcrumb-item">
                                    <a class="link-fx" href="<?=url('/admin/dashboard')?>">Admin</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="link-fx" href="<?=url('/admin/course')?>">Courses</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="link-fx" href="<?=url('/admin/detail-course?id=' . $data['id'])?>"><?=$data['course_title']?></a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    Update Lesson
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
                    <div class="block-content">

                        <ul class="errors">
                            <?php
                            if ($errors = Validation::errors()) {
                                foreach ($errors as $error) {
                                    echo "<li>$error</li>";
                                }
                            }
                            ?></ul>

                        <form method="POST">
                            <div class="mb-3">
                                <label for="title" class="form-label">Course Title</label>
                                <input type="text" class="form-control D" id="course-title" name="course_title" value="<?=$data['course_title']?>">
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">Lesson Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?=$materi['title']?>">
                            </div>

                            <div class="mb-3">
                                <label for="embed-video" class="form-label">Embed Video</label>
                                <input type="text" class="form-control" id="embed-video" name="embed_video" value="<?='https://www.youtube.com/watch?v=' . CourseController::getYouTubeIDFromEmbed($materi['embed_video']) ?>">
                            </div>


                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label> 
                                <textarea name="description"  class="form-control" id="basic-example" cols="30" rows="10"><?=$materi['description']?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">Bab</label>
                                <input type="text" class="form-control" id="bab" name="bab" value="<?=$materi['bab']?>">
                            </div>
                            
                            <button type="submit" name="update" class="btn btn-primary my-3">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
            <!-- END Page Content -->
        </main>
        <!-- END Main Container -->

        <?php require($template['footer']) ?>
    </div>
    <!-- END Page Container -->


    <?php require($template['js']) ?>

    <?php include($notif) ?>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>


    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

  
<script>tinymce.init({selector:'textarea'});</script>

</body>

</html>