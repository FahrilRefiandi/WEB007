<?php

use Config\Database;
use Config\Session;
use Controllers\CourseController;
use Validation\Validation;

require_once(__DIR__ . "../../../config/config.php");
middleware(["auth", "admin"]);
require_once('layouts/template.php');
$id = $_GET['id'];
$data = Database::getFirst("
SELECT * FROM learning_materials
WHERE id = '$id';
");
var_dump($data);

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
            <!-- Hero Content -->
            <div class="bg-image" style="background-image: url('assets/media/various/promo-code.png');">
                <div class="bg-primary-dark-op">
                    <div class="content content-full text-center py-7 pb-5">
                        <h1 class="h2 text-white mb-2">
                            <?= $data['title'] ?>
                        </h1>
                        <h2 class="h4 fw-normal text-white-75">
                            Oleh <?= $data['teacher_name'] ?>
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
                                <a class="link-fx" href="<?= url('/admin/course') ?>">Course</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="link-fx" href="<?= url('/admin/detail-course?id=') . $data['course_id']  ?>"><?= $data['course_title'] ?></a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <?= $data['title'] ?>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- END Navigation -->

            <!-- Page Content -->
            <div class="content content-boxed">

                <!-- Lesson -->
                <!-- Syntax Highlighting functionality is initialized in Helpers.jsHighlightjs() -->
                <!-- For more info and examples you can check out https://highlightjs.org/usage/ -->
                <div class="block block-rounded">
                    <div class="block-content">
                        <h3><?= $data['title'] ?></h3>
                        <div class="meet-content">
                            <?= $data['description'] ?>
                        </div>
                    </div>
                </div>
                <!-- END Lesson -->

            </div>
            <!-- END Page Content -->

            <!-- Get Started -->
            <div class="bg-body-dark">
                <div class="content content-full text-center py-6">
                    <h3 class="h4 mb-4">
                        Subscribe today and learn HTML5 in under 3 hours.
                    </h3>
                    <a class="btn btn-primary px-4 py-2" href="javascript:void(0)">Subscribe from $9/month</a>
                </div>
            </div>
            <!-- END Get Started -->
        </main>
        <!-- END Main Container -->


        <?php include($notif) ?>

</body>

</html>