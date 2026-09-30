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
    <title> View All Questions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- plugin css -->
    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet" type="text/css">
    <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/libs/@chenfengyuan/datepicker/datepicker.min.css">
    <link href="plugin/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/preloader.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="assets/libs/jquery/jquery-2.2.4.min.js"></script>

</head>


<body class="someBlock">

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
                                <h4 class="mb-0">View All Questions - <?= $course_id ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="manage-instructor-courses.php?id=<?= $period_id ?>">Courses</a></li>
                                        <li class="breadcrumb-item active"> View All Questions </li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    if (count($modules) > 0) {
                                        foreach ($modules as $key => $module) {
                                    ?>
                                            <hr>
                                            <h4 class="module-title"><?= $module['name'] . ' - ' . $module['code'] ?></h4>
                                            <hr>
                                            <?php
                                            $QUESTION = new Question(NULL);
                                            $questions = $QUESTION->getQuestionByCourseAndModule($course_id, $module['id']);
                                            if (count($questions) > 0) {
                                                foreach ($questions as $key => $question) {
                                                    $key++;
                                            ?>
                                                    <h4 class="card-title mb-4">
                                                        <span style="display: block;">
                                                            <?= $key . '.'  ?>
                                                            <?php
                                                            if ($COURSE->english_lang == 1) {
                                                                echo strip_tags($question['question']);
                                                            }
                                                            if ($COURSE->sinhala_lang == 1) {
                                                                echo strip_tags($question['question_sinhala']);
                                                            }
                                                            if ($COURSE->tamil_lang == 1) {
                                                                echo strip_tags($question['question_tamil']);
                                                            }
                                                            ?>
                                                            <a href="edit-questions.php?id=<?php echo $question['id'] ?>" target="_blank"> <button class="btn btn-primary btn-sm pull-right add-btn">Edit</button> </a>
                                                        </span>
                                                    </h4>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div>
                                                                <div class="form-check mb-3">

                                                                    <label class="form-check-label <?= $question['correct_answer'] == 1 ? 'text-success' : '' ?>">

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
                                                                    </label>
                                                                </div>
                                                                <div class="form-check mb-3">

                                                                    <label class="form-check-label <?= $question['correct_answer'] == 2 ? 'text-success' : '' ?>">
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

                                                                    </label>
                                                                </div>
                                                                <div class="form-check mb-3">

                                                                    <label class="form-check-label <?= $question['correct_answer'] == 3 ? 'text-success' : '' ?>">
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

                                                                    </label>
                                                                </div>
                                                                <div class="form-check mb-3">

                                                                    <label class="form-check-label <?= $question['correct_answer'] == 4 ? 'text-success' : '' ?>">
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

                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                <?php }
                                            } else {
                                                ?>
                                                <span>No questions found.</span>
                                    <?php
                                            }
                                        }
                                    } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- END layout-wrapper -->


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {

            $('.date').datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: "today"
            })
            $('#departure-date').datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: +1

            })
        });
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.time').timepicker({});
        });
    </script>
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
    <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <!-- init js -->
    <script src="assets/js/pages/ecommerce-datatables.init.js"></script>
    <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>
    <script src="ajax/js/schedule-exam.js" type="text/javascript"></script>
    <!-- App js -->

    <!-- pl        <!-- JAVASCRIPT -->
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

    <script src="assets/libs/select2/js/select2.min.js"></script>
    <script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
    <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="assets/libs/@chenfengyuan/datepicker/datepicker.min.js"></script>

    <!-- init js -->
    <script src="assets/js/pages/form-advanced.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

</body>

</html>