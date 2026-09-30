<?php
include '../class/include.php';
include './auth.php';
if (!isset($_SESSION)) {
    session_start();
}
date_default_timezone_set('Asia/Colombo');
$STUDENT = new Student($_SESSION['id']);
$course = Course::getCourseByCourseID($STUDENT->course_id);
$exam = SheduleExam::getUpcomingScheduledExamByCourse($STUDENT->course_id);
if ($exam) {
    $currentTime = new DateTime($exam['time']);
    $exam_end_time = $currentTime->modify('+' . $exam['duration'] . ' seconds');
    $exam_end_time = $exam_end_time->format('H:i');


    $exam_date = $exam['start_date'] . ' ' . $exam['time'];
    $refreshTime = strtotime($exam_date); // Replace with your desired time
    $currentTimestamp = time();
    $timeUntilRefresh = $refreshTime - $currentTimestamp;
}
$COURSE = new Course($STUDENT->course_id);
// dd(date("h:i a"));
// dd($exam['time'] <= date("h:i a"));
// dd($exam && $exam['start_date'] == date("Y-m-d") && $exam['time'] <= date("h:i a") && date("H:i") <= $exam_end_time);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta http-equiv="refresh" content="<?= $timeUntilRefresh ?>">

    <!-- <meta http-equiv="refresh" content="10"> 300 seconds = 5 minutes -->
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="plugin/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="assets/css/preloader.css" rel="stylesheet" type="text/css" />

</head>
<style>
    body {

        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .container {
        color: #333;
        text-align: center;
    }

    h1 {
        font-weight: normal;
    }

    li {
        display: inline-block;
        font-size: 1.5em;
        list-style-type: none;
        padding: 1em;
    }

    li span {
        display: block;
        font-size: 2.5rem;
    }
</style>

<body class="someBlock">

    <!-- Begin page -->
    <div>


        <!-- ========== Left Sidebar Start ========== -->

        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content" style="margin-left: 0px;">


            <div class="page-content" style="padding-top: 0px;">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">Your Personal Details </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <a class="dropdown-item " style="padding-top: 22px;" href="log-out.php"> <i class="bx bx-power-off  font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Sign out</span></a>

                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-md-6 col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-end mt-2" style="position: relative;">

                                        <div class="resize-triggers">
                                            <div class="expand-trigger">
                                                <div style="width: 71px; height: 41px;"></div>
                                            </div>
                                            <div class="contract-trigger"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 mt-1"><b>Student Id:- </b><span> <?= $STUDENT->id ?></span></h6>
                                        <h6 class="mb-1 mt-1"><b>Your Name:- </b><span> <?= $STUDENT->fname . ' ' . $STUDENT->lname ?></span></h6>
                                        <h6 class="mb-1 mt-1"><b>Your Course:- </b><span> <?= $COURSE->cname ?></span></h6>

                                    </div>

                                </div>
                            </div>
                        </div> <!-- end col-->
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row justify-content-center mt-4">
                                        <div class="col-lg-12">
                                            <div class="text-center">


                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-5">
                                        <div class="col-xl-3 col-sm-5 mx-auto">
                                            <div>
                                                <img src="assets/images/faqs-img.png" alt="" class="img-fluid mx-auto d-block">
                                            </div>
                                        </div>
                                        <div class="col-xl-8">

                                            <center>
                                                <h5 class="text-center text-danger">Please check your student Id, Name and your course before start the exam...</h5>
                                                <input type="hidden" id="exam_date" value="<?= date("m/d/Y H:i:s", strtotime($exam['start_date'] . ' ' . $exam['time'])) ?>" />
                                                <?php
                                                if ($exam) {
                                                    if ($exam && date("Y-m-d H:i:s", strtotime($exam_date)) > date("Y-m-d H:i:s")) {
                                                ?>
                                                        <h1>Exam start time schedule:</h1>
                                                        <ul>
                                                            <li><span id="days">0</span> </li>
                                                            <li><span id="hours">0</span> </li>
                                                            <li><span id="minutes">0</span> </li>
                                                            <li><span id="seconds">0</span> </li>
                                                        </ul>

                                                    <?php
                                                    } elseif ($exam && $exam['type'] == 2 && $exam['start_date'] == date("Y-m-d") && date("H:i:s", strtotime($exam['time'])) <= date("H:i:s") && date("H:i") <= $exam_end_time) {
                                                    ?>
                                                        <?php
                                                        if (($COURSE->english_lang == 1 && ($COURSE->sinhala_lang == 1 || $COURSE->tamil_lang == 1)) || ($COURSE->sinhala_lang == 1 && ($COURSE->english_lang == 1 || $COURSE->tamil_lang == 1)) || ($COURSE->tamil_lang == 1 && ($COURSE->english_lang == 1 || $COURSE->sinhala_lang == 1))) {
                                                        ?>
                                                            <div class="row mb-3">
                                                                <div class="col-md-2"></div>
                                                                <h5 class="col-md-4">Please select your exam language:</h5>
                                                                <div class="col-md-6 row">
                                                                    <?php
                                                                    if ($COURSE->english_lang == 1 && ($COURSE->sinhala_lang == 1 || $COURSE->tamil_lang == 1)) {
                                                                    ?>
                                                                        <div class="col-md-3 form-check mb-3">
                                                                            <input type="radio" name="exam_language" class="form-check-input exam_language" id="lang_english" value="english">
                                                                            <label class="form-check-label lang_english" for="lang_english">English</label>
                                                                        </div>
                                                                    <?php
                                                                    }
                                                                    if ($COURSE->sinhala_lang == 1 && ($COURSE->english_lang == 1 || $COURSE->tamil_lang == 1)) {
                                                                    ?>
                                                                        <div class="col-md-3 form-check mb-3">
                                                                            <input type="radio" name="exam_language" class="form-check-input exam_language" id="lang_sinhala" value="sinhala">
                                                                            <label class="form-check-label lang_sinhala" for="lang_sinhala">Sinhala</label>
                                                                        </div>
                                                                    <?php
                                                                    }
                                                                    if ($COURSE->tamil_lang == 1 && ($COURSE->english_lang == 1 || $COURSE->sinhala_lang == 1)) {
                                                                    ?>
                                                                        <div class="col-md-3 form-check mb-3">
                                                                            <input type="radio" name="exam_language" class="form-check-input exam_language" id="lang_tamil" value="tamil">
                                                                            <label class="form-check-label lang_tamil" for="lang_tamil">Tamil</label>
                                                                        </div>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                                    if(($COURSE->english_lang == 1 && $COURSE->sinhala_lang == 0 && $COURSE->tamil_lang == 0)) {
                                                                        ?>
                                                                       <input type="hidden" name="exam_language1" class="exam_language1" id="" value="english"> 
                                                                        <?php
                                                                    }
                                                                    if(($COURSE->english_lang == 0 && $COURSE->sinhala_lang == 1 && $COURSE->tamil_lang == 0)) {
                                                                        ?>
                                                                       <input type="hidden" name="exam_language1" class="exam_language1" id="" value="sinhala"> 
                                                                        <?php
                                                                    }
                                                                    if(($COURSE->english_lang == 0 && $COURSE->sinhala_lang == 0 && $COURSE->tamil_lang == 1)) {
                                                                        ?>
                                                                       <input type="hidden" name="exam_language1" class="exam_language1" id="" value="tamil"> 
                                                                        <?php
                                                                    }
                                                        ?>
                                                        <button class="btn btn-primary mt-3" type="button" id="start-written-exam" exam-id="<?= $exam['id'] ?>" student-id="<?= $_SESSION['id'] ?>">Start Exam</button>
                                                    <?php
                                                    } elseif ($exam && $exam['start_date'] == date("Y-m-d") && date("H:i:s", strtotime($exam['time'])) <= date("H:i:s") && date("H:i") <= $exam_end_time) {
                                                    ?>
                                                        <?php
                                                        if (($COURSE->english_lang == 1 && ($COURSE->sinhala_lang == 1 || $COURSE->tamil_lang == 1)) || ($COURSE->sinhala_lang == 1 && ($COURSE->english_lang == 1 || $COURSE->tamil_lang == 1)) || ($COURSE->tamil_lang == 1 && ($COURSE->english_lang == 1 || $COURSE->sinhala_lang == 1))) {
                                                        ?>
                                                            <div class="row mb-3">
                                                                <div class="col-md-2"></div>
                                                                <h5 class="col-md-4">Please select your exam language:</h5>
                                                                <div class="col-md-6 row">
                                                                    <?php
                                                                    if ($COURSE->english_lang == 1 && ($COURSE->sinhala_lang == 1 || $COURSE->tamil_lang == 1)) {
                                                                    ?>
                                                                        <div class="col-md-3 form-check mb-3">
                                                                            <input type="radio" name="exam_language" class="form-check-input exam_language" id="lang_english" value="english">
                                                                            <label class="form-check-label lang_english" for="lang_english">English</label>
                                                                        </div>
                                                                    <?php
                                                                    }
                                                                    if ($COURSE->sinhala_lang == 1 && ($COURSE->english_lang == 1 || $COURSE->tamil_lang == 1)) {
                                                                    ?>
                                                                        <div class="col-md-3 form-check mb-3">
                                                                            <input type="radio" name="exam_language" class="form-check-input exam_language" id="lang_sinhala" value="sinhala">
                                                                            <label class="form-check-label lang_sinhala" for="lang_sinhala">Sinhala</label>
                                                                        </div>
                                                                    <?php
                                                                    }
                                                                    if ($COURSE->tamil_lang == 1 && ($COURSE->english_lang == 1 || $COURSE->sinhala_lang == 1)) {
                                                                    ?>
                                                                        <div class="col-md-3 form-check mb-3">
                                                                            <input type="radio" name="exam_language" class="form-check-input exam_language" id="lang_tamil" value="tamil">
                                                                            <label class="form-check-label lang_tamil" for="lang_tamil">Tamil</label>
                                                                        </div>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        
                                                                    if(($COURSE->english_lang == 1 && $COURSE->sinhala_lang == 0 && $COURSE->tamil_lang == 0)) {
                                                                        ?>
                                                                       <input type="hidden" name="exam_language1" class="exam_language1" id="" value="english"> 
                                                                        <?php
                                                                    }
                                                                    if(($COURSE->english_lang == 0 && $COURSE->sinhala_lang == 1 && $COURSE->tamil_lang == 0)) {
                                                                        ?>
                                                                       <input type="hidden" name="exam_language1" class="exam_language1" id="" value="sinhala"> 
                                                                        <?php
                                                                    }
                                                                    if(($COURSE->english_lang == 0 && $COURSE->sinhala_lang == 0 && $COURSE->tamil_lang == 1)) {
                                                                        ?>
                                                                       <input type="hidden" name="exam_language1" class="exam_language1" id="" value="tamil"> 
                                                                        <?php
                                                                    }
                                                        ?>
                                                        <button class="btn btn-primary mt-3" type="button" id="start-quiz" exam-id="<?= $exam['id'] ?>" student-id="<?= $_SESSION['id'] ?>">Start Quiz</button>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <h4>You don't have an upcoming scheduled exam.</h4>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <h4>You don't have an upcoming scheduled exam.</h4>
                                                <?php
                                                }
                                                ?>
                                            </center>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- container-fluid -->
            </div>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->




    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>

    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->

    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>
    <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <script src="ajax/js/start-quiz.js" type="text/javascript"></script>

    <!-- Datatable init js -->
    <script src="assets/js/pages/datatables.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>


    <script src="assets/js/yscountdown.min.js" type="text/javascript"></script>
    <script>
        function makeTimer() {
            let date = $('#exam_date').val();
            //		var endTime = new Date("29 April 2018 9:56:00 GMT+01:00");	
            var endTime = new Date(date);
            endTime = (Date.parse(endTime) / 1000);

            var now = new Date();
            now = (Date.parse(now) / 1000);

            var timeLeft = endTime - now;

            var days = Math.floor(timeLeft / 86400);
            var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
            var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
            var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

            if (hours < "10") {
                hours = "0" + hours;
            }
            if (minutes < "10") {
                minutes = "0" + minutes;
            }
            if (seconds < "10") {
                seconds = "0" + seconds;
            }

            $("#days").html(days + "<span>Days</span>");
            $("#hours").html(hours + "<span>Hours</span>");
            $("#minutes").html(minutes + "<span>Minutes</span>");
            $("#seconds").html(seconds + "<span>Seconds</span>");

        }

        setInterval(function() {
            makeTimer();
        }, 1000);
    </script>
</body>

</html>