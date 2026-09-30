<?php
include '../class/include.php';
include './auth.php';

$course_id = $_GET['id'];
$period_id = $_GET['period'];
$COURSE = new Course($course_id);
$COURSETRADE = new CourseTrade($COURSE->tradecode);
$EXAMPERIOD = new ExamPeriod($period_id);

$COURSE_MODULES = new CourseModule(NULL);
$modules = $COURSE_MODULES->getModulesByCourse($course_id);
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Create Paper | Sri Lanka Youth Services</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="plugin/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/preloader.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css" />
</head>

<body class="someBlock exam-paper">

    <!-- <body data-layout="horizontal" data-topbar="colored"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <?php include './top-header.php'; ?>
        <!-- ========== Left Sidebar Start ========== -->
        <?php include './navigation.php'; ?>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">Create Paper</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="manage-instructor-courses.php?id=<?= $period_id ?>">Courses</a></li>
                                        <li class="breadcrumb-item active">Manage Paper</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Add questions to the paper</h4>
                                    <div class="row">
                                        <div id="left">
                                            <h2 class="paper-title">All Questions</h2>
                                            <hr>
                                            <?php
                                            $count1 = 0;
                                            if (count($modules) > 0) {
                                                foreach ($modules as $key => $module) {

                                                    $QUESTION = new Question(NULL);
                                                    $questions = $QUESTION->getQuestionByCourseAndModule($course_id, $module['id']);
                                                   
                                            ?>
                                                    <h4 class="module-title"><?= $module['name'] . ' - ' . $module['code'] ?></h4>
                                                    <?php
                                                    if (count($questions) > 0) {
                                                        $count = 0;
                                                    ?>
                                                        <div class="accordion" id="accordionExample-l-<?= $module['id'] ?>">
                                                            <?php
                                                            foreach ($questions as $key => $question) {
                                                                $count++;
                                                                $count1++;
                                                            ?>

                                                                <div class="accordion-item">
                                                                    <h2 class="accordion-header" id="heading<?= $count1 ?>">
                                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $count1 ?>" aria-expanded="true" aria-controls="collapse<?= $count1 ?>">
                                                                            <?= $count . ') ' ?>
                                                                            <?php
                                                                            if ($COURSE->english_lang == 1) {
                                                                                echo strip_tags($question['question']);
                                                                            } 
                                                                            if ($COURSE->sinhala_lang == 1) {
                                                                                echo "<br />" . strip_tags($question['question_sinhala']);
                                                                            } 
                                                                            if ($COURSE->tamil_lang == 1) {
                                                                                echo "<br />" . strip_tags($question['question_tamil']);
                                                                            }
                                                                            ?>
                                                                        </button>
                                                                    </h2>
                                                                    <div id="collapse<?= $count1 ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $count1 ?>" data-bs-parent="#accordionExample-l-<?= $module['id'] ?>">
                                                                        <div class="accordion-body">
                                                                            <ul>
                                                                                <li class="<?= $question['correct_answer'] == 1 ? 'text-success' : '' ?>">
                                                                                    <?php
                                                                                    if ($COURSE->english_lang == 1) {
                                                                                        echo $question['answer_1'];
                                                                                    } 
                                                                                    if ($COURSE->sinhala_lang == 1) {
                                                                                        echo $question['answer_1_sinhala'];
                                                                                    } 
                                                                                    if ($COURSE->tamil_lang == 1) {
                                                                                        echo $question['answer_1_tamil'];
                                                                                    }
                                                                                    ?>
                                                                                </li>
                                                                                <li class="<?= $question['correct_answer'] == 2 ? 'text-success' : '' ?>">
                                                                                    <?php
                                                                                    if ($COURSE->english_lang == 1) {
                                                                                        echo $question['answer_2'];
                                                                                    } 
                                                                                    if ($COURSE->sinhala_lang == 1) {
                                                                                        echo $question['answer_2_sinhala'];
                                                                                    } 
                                                                                    if ($COURSE->tamil_lang == 1) {
                                                                                        echo $question['answer_2_tamil'];
                                                                                    }
                                                                                    ?>
                                                                                </li>
                                                                                <li class="<?= $question['correct_answer'] == 3 ? 'text-success' : '' ?>">
                                                                                    <?php
                                                                                    if ($COURSE->english_lang == 1) {
                                                                                        echo $question['answer_3'];
                                                                                    } 
                                                                                    if ($COURSE->sinhala_lang == 1) {
                                                                                        echo $question['answer_3_sinhala'];
                                                                                    } 
                                                                                    if ($COURSE->tamil_lang == 1) {
                                                                                        echo $question['answer_3_tamil'];
                                                                                    }
                                                                                    ?>
                                                                                </li>
                                                                                <li class="<?= $question['correct_answer'] == 4 ? 'text-success' : '' ?>">
                                                                                    <?php
                                                                                    if ($COURSE->english_lang == 1) {
                                                                                        echo $question['answer_4'];
                                                                                    } 
                                                                                    if ($COURSE->sinhala_lang == 1) {
                                                                                        echo $question['answer_4_sinhala'];
                                                                                    } 
                                                                                    if ($COURSE->tamil_lang == 1) {
                                                                                        echo $question['answer_4_tamil'];
                                                                                    }
                                                                                    ?>
                                                                                </li>
                                                                            </ul>
                                                                            <button class="btn btn-primary btn-sm pull-right add-btn" row-id="<?= $question['id'] ?>" module-id="<?= $module['id'] ?>">Add</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php

                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="empty-data-text empty-data-text-l-<?= $module['id'] ?> hidden">No data found.</div>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <div class="empty-data-text empty-data-text-l-<?= $module['id'] ?>">No data found.</div>
                                            <?php
                                                    }
                                                }
                                            }

                                            ?>
                                        </div>

                                        <div id="right">
                                            <h2 class="paper-title"><?= $EXAMPERIOD->year . ' - Batch ' . $EXAMPERIOD->batch ?> Paper Questions - <span class="paper-qu-count">0</span>/<?= $COURSE->qu_count ?></h2>
                                            <hr>
                                            <?php
                                            if (count($modules) > 0) {
                                                foreach ($modules as $key => $module) {


                                            ?>
                                                    <h4 class="module-title"><?= $module['name'] . ' - ' . $module['code'] ?></h4>
                                                    <div class="accordion" id="accordionExample-r-<?= $module['id'] ?>">
                                                        <div class="empty-data-text empty-data-text-r-<?= $module['id'] ?>">No data found.</div>
                                                    </div>
                                            <?php

                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row" style="">
                                        <input type="hidden" value="<?= $COURSE->qu_count ?>" id="qu-count" />
                                        <input type="hidden" value="" id="selected-questions" />
                                        <input type="hidden" value="<?= $period_id ?>" id="exam-period-id" />
                                        <input type="hidden" value="<?= $course_id ?>" id="course-id" />
                                        <button class="btn btn-primary col-sm-2" id="save-paper">Save Paper</button>
                                        <button class="btn btn-success col-sm-2 ml-3" id="submit-paper">Submit Paper</button>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END layout-wrapper -->



    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>

    <script src="assets/libs/select2/js/select2.min.js"></script>
    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- init js -->
    <script src="assets/js/pages/ecommerce-datatables.init.js"></script>
    <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <script src="ajax/js/qu-paper.js" type="text/javascript"></script>

    <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <script src="assets/js/pages/form-advanced.init.js"></script>
    <!-- ckeditor -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.2.2/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '.question'
        });
    </script>


</body>

</html>