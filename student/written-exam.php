<?php
include '../class/include.php';
include './auth.php';
date_default_timezone_set('Asia/Colombo');
$exam_id = $_GET['id'];
$lang = $_GET['lang'];
$STUDENT = new Student($_SESSION['id']);
$EXAM = new SheduleExam($exam_id);
$exam_attempt = ExamStudent::getStudentExam($_SESSION['id'], $exam_id);
if (!$exam_attempt || ($exam_attempt && $exam_attempt['status'] != 3)) {
    header('Location:schedule-exam.php');
}
$currentTime = new DateTime();
$startTime = new DateTime($EXAM->time);
$exam_end_time = $startTime->modify('+' . $EXAM->duration . ' seconds');
$timeDifference = $startTime->diff($currentTime);

$hours = $timeDifference->h;
$minutes = $timeDifference->i;
$seconds = $timeDifference->s;
$timeDifferenceInSeconds = ($hours * 60 * 60) + ($minutes * 60) + $seconds;

$qu_paper = WrittingPapers::getPaperByCourse($EXAM->course_id);
if ($lang == 'sinhala') {
    $essay_paper = $qu_paper['pdf_doc_sinhala'];
} elseif ($lang == 'tamil') {
    $essay_paper = $qu_paper['pdf_doc_tamil'];
} elseif ($lang == '' || $lang == 'english') {
    $essay_paper = $qu_paper['pdf_doc'];
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="../admin-panel/assets/css/preloader.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="plugin/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="assets/css/timeTo.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css" />
</head>

<body class="exam-index someBlock">
    <!-- <body data-layout="horizontal" data-topbar="colored"> -->
    <!-- Begin page -->
    <div>


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
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div>
                                                <h6 class="mb-1 mt-1"><b>Student Id:- </b><span data-plugin="counterup"> <?php echo $STUDENT->id ?></span></h6>
                                                <h6 class="mb-1 mt-1"><b>Your Name:- </b><span> <?php echo $STUDENT->fname . ' ' . $STUDENT->lname ?></span></h6>
                                                <h6 class="mb-1 mt-1"><b>Your Course:- </b><span> <?php echo $STUDENT->course_id . ' - ' . $STUDENT->course_name ?></span></h6>

                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="btn_section " style="margin-top:20px;">
                                                <input type="hidden" id="exam" value="<?= $EXAM->id ?>" />
                                                <span class="btn btn-warning tiny-buff submit-btn m-b-20" id="submit" style="float:right;">Submit</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-2" style="margin-top: 20px;">
                                            <div id="countdown"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div> <!-- end col-->
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div>
                                                <div class="question_paper_section">
                                                    <iframe src="../nc_assets/uploads/essay-papers/<?= $essay_paper ?>" width="100%" height="600px"></iframe>
                                                </div>


                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end row -->

                </div> <!-- container-fluid -->
            </div>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <input type="hidden" value="<?= $timeDifferenceInSeconds ?>" id="remaining-time" />


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="assets/js/jquery.time-to.min.js" type="text/javascript"></script>
    <script src="../admin-panel/assets/js/jquery.preloader.min.js" type="text/javascript"></script>
    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/libs/jszip/jszip.min.js"></script>
    <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="ajax/js/essay-exam.js" type="text/javascript"></script>

    <!-- Datatable init js -->
    <script src="assets/js/pages/datatables.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("button").click(function() {
                history.go(0);
                alert('Reloading Page');
            });
        });
    </script>
</body>

</html>