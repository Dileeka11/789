<?php
include '../class/include.php';
include './auth.php';

$paper_id = '';
$period_id = '';
$paper_id = $_GET['id'];
$period_id = $_GET['period'];

$EXAM_PAPER = new ExamPaper($paper_id);
$COURSE = new Course($EXAM_PAPER->course_id);
$COURSETRADE = new CourseTrade($COURSE->tradecode);
$EXAMPERIOD = new ExamPeriod($EXAM_PAPER->exam_period_id);

$PAPER_QUES = new ExamPaperQuestions(null);
$all_selected_questions = $PAPER_QUES->getQuestionsByExamPaperId($paper_id);
$all_selected_questions_ids = $PAPER_QUES->getQuestionIdsByExamPaperId($paper_id);

?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title> View Exam Paper Questions</title>
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
    <link href=assets/css/preloader.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="assets/libs/jquery/jquery-2.2.4.min.js"></script>
<style>
p{
padding-bottom:0px;
margin-bottom:0px
}
</style>

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
                                <h4 class="mb-0">View Exam Paper Questions - <?= $EXAM_PAPER->course_id ?> - <?= $EXAMPERIOD->year ?> Batch <?= $EXAMPERIOD->batch ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="manage-instructor-courses.php?id=<?= $period_id ?>">Courses</a></li>
                                        <li class="breadcrumb-item active"> View Exam Paper Questions </li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                            <div class="col-md-4">
                            
<button class="btn btn-primary mb-3 ms-2" onclick="printExamPaper()" style="margin-left: 10px; margin-top:30px;">
    <i class="fa fa-print"></i> Print
</button>
</div>
<!-- Print Header - Only visible when printing -->
<div class="print-header" style="display: none;">
    <h2 style="text-align: center; margin-bottom: 5px;"><?= htmlspecialchars($COURSE->name) ?> (<?= htmlspecialchars($EXAM_PAPER->course_id) ?>)</h2>
    <p style="text-align: center; margin-bottom: 10px;">
        <strong>Year:</strong> <?= $EXAMPERIOD->year ?> | 
        <strong>Batch:</strong> <?= $EXAMPERIOD->batch ?>
    </p>
    <hr style="border: 1px solid #333;">
</div>

                                <?php
                                foreach ($all_selected_questions as $key => $question) {
                                    $QUESTION = new Question($question['qu_id']);
                                    $MODULE = new CourseModule($QUESTION->module_id);
                                    $key++;
                                ?>
                                    <div class="card-body" style="margin-bottom:0px;padding-bottom:0px;padding-top:5px;>
                                        <h4 class="card-title mb-4">
                                            <span style="display: block; padding-bottom:0px">
                                                <?= $key . '.'  ?>
                                                <?php
                                                if ($COURSE->english_lang == 1) {
                                                    echo strip_tags($QUESTION->question);
                                                }
                                                if ($COURSE->sinhala_lang == 1) {
                                                    echo strip_tags($QUESTION->question_sinhala);
                                                }
                                                if ($COURSE->tamil_lang == 1) {
                                                    echo strip_tags($QUESTION->question_tamil);
                                                }
                                                ?>
                                              
                                              <?php if($_SESSION['type']  == 1 ){ ?>
                                                <a href="edit-questions.php?id=<?php echo $QUESTION->id?>"> <button class="btn btn-primary btn-sm pull-right add-btn" >Edit</button> </a>
                                                <?php }?>
                                                
                                            </span>
                                        </h4>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div>
                                                    <div class="form-check ">

                                                        <label style="padding-bottom:0px" class="form-check-label <?= $QUESTION->correct_answer == 1 ? '' : '' ?>" >

                                                            <?php
                                                            if ($COURSE->english_lang == 1) {
                                                                echo $QUESTION->answer_1;
                                                            }
                                                            if ($COURSE->sinhala_lang == 1) {
                                                                echo $QUESTION->answer_1_sinhala;
                                                            }
                                                            if ($COURSE->tamil_lang == 1) {
                                                                echo $QUESTION->answer_1_tamil;
                                                            }
                                                            ?>
                                                        </label>
                                                    </div>
                                                    <div class="form-check ">

                                                        <label style="padding-bottom:0px" class="form-check-label <?= $QUESTION->correct_answer == 2 ? '' : '' ?>">
                                                            <?php
                                                            if ($COURSE->english_lang == 1) {
                                                                echo $QUESTION->answer_2;
                                                            }
                                                            if ($COURSE->sinhala_lang == 1) {
                                                                echo $QUESTION->answer_2_sinhala;
                                                            }
                                                            if ($COURSE->tamil_lang == 1) {
                                                                echo $QUESTION->answer_2_tamil;
                                                            }
                                                            ?>

                                                        </label>
                                                    </div>
                                                    <div class="form-check ">

                                                        <label style="padding-bottom:0px" class="form-check-label <?= $QUESTION->correct_answer == 3 ? '' : '' ?>">
                                                            <?php
                                                            if ($COURSE->english_lang == 1) {
                                                                echo $QUESTION->answer_3;
                                                            }
                                                            if ($COURSE->sinhala_lang == 1) {
                                                                echo $QUESTION->answer_3_sinhala;
                                                            }
                                                            if ($COURSE->tamil_lang == 1) {
                                                                echo $QUESTION->answer_3_tamil;
                                                            }
                                                            ?>

                                                        </label>
                                                    </div>
                                                    <div class="form-check ">

                                                        <label style="padding-bottom:0px" class="form-check-label <?= $QUESTION->correct_answer == 4 ? '' : '' ?>">
                                                            <?php
                                                            if ($COURSE->english_lang == 1) {
                                                                echo $QUESTION->answer_4;
                                                            }
                                                            if ($COURSE->sinhala_lang == 1) {
                                                                echo $QUESTION->answer_4_sinhala;
                                                            }
                                                            if ($COURSE->tamil_lang == 1) {
                                                                echo $QUESTION->answer_4_tamil;
                                                            }
                                                            ?>

                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                <?php } ?>
                                
   <?php 
   if($_SESSION['type']  == 14 | $_SESSION['type']  == 1){
   ?>
<div class="row" style="margin:10px">

    <!-- Approval 1 -->
    <div class="col-md-4">
        <?php
        if ($_SESSION['id'] == 441) {
        if ($EXAM_PAPER->approvel_1 == 1) { ?>
            <button class="btn btn-secondary btn-sm pull-right" disabled>
                Approved <i class="fa fa-check-circle"></i>
            </button>
        <?php } else { ?>
            <button class="btn btn-primary btn-sm pull-right add-btn"
                    data-approval="1" data-id="<?= $paper_id ?>">Approve 1</button>
        <?php }
        }?>
    </div>

    <!-- Approval 2 -->
    <div class="col-md-4">
        <?php 
       
if ($_SESSION['id'] == 442) {
        if ($EXAM_PAPER->approvel_2 == 1) { ?>
            <button class="btn btn-secondary btn-sm pull-right" disabled>
                Approved <i class="fa fa-check-circle"></i>
            </button>
        <?php } else { ?>
            <button class="btn btn-success btn-sm pull-right add-btn"
                    data-approval="2" data-id="<?= $paper_id ?>">Approve 2</button>
        <?php } } ?>
    </div>

    <!-- Approval 3 -->
    <div class="col-md-4">
        <?php 
        if ($_SESSION['id'] == 443) {
        if ($EXAM_PAPER->approvel_3 == 1) { ?>
            <button class="btn btn-secondary btn-sm pull-right" disabled>
                Approved <i class="fa fa-check-circle"></i>
            </button>
        <?php } else { ?>
            <button class="btn btn-info btn-sm pull-right add-btn"
                    data-approval="3" data-id="<?= $paper_id ?>">Approve 3</button>
        <?php }
        } ?>
    </div>

</div>




<?php } ?>

                                
                                
                                
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

<script>
$(document).ready(function () {
    $('.add-btn').click(function () {
        let approvalLevel = $(this).data('approval');
        let recordId = $(this).data('id');

        $.ajax({
            url: 'ajax/php/update-approval.php',
            method: 'POST',
            data: {
                id: recordId,
                level: approvalLevel
            },
            success: function (response) {
                if (response.trim() === 'success') {
                    alert("Approval Level " + approvalLevel + " updated!");
                } else {
                    alert("Update failed!");
                }
            },
            error: function () {
                alert("Server error.");
            }
        });
    });
});
</script>

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

    <!-- Print Styles -->
    <style type="text/css" media="print">
        @media print {
            /* Hide navigation and non-essential elements */
            #layout-wrapper > .vertical-menu,
            #layout-wrapper > header,
            .page-title-right,
            .page-title-box,
            .btn,
            .rightbar-overlay,
            a[href*="edit-questions"],
            button {
                display: none !important;
            }
            
            /* Show print header */
            .print-header {
                display: block !important;
            }
            
            /* Adjust main content for full width */
            .main-content {
                margin-left: 0 !important;
                padding: 0 !important;
            }
            
            .page-content {
                padding: 10px !important;
            }
            
            /* Question styling for print */
            .card-body {
                page-break-inside: avoid;
                padding: 10px 0 !important;
                border-bottom: 1px solid #eee;
            }
            
            .card-title {
                font-size: 12pt !important;
            }
            
            .form-check-label {
                font-size: 11pt !important;
            }
            
            /* Show correct answers in green */
            /*.text-success {*/
            /*    color: green !important;*/
            /*    font-weight: bold !important;*/
            /*    -webkit-print-color-adjust: exact !important;*/
            /*    print-color-adjust: exact !important;*/
            /*}*/
            
            /* Page title */
            .page-title-box h4 {
                font-size: 14pt !important;
                text-align: center;
                width: 100%;
            }
        }
    </style>
    
    <script>
    function printExamPaper() {
        window.print();
    }
    </script>

</body>

</html>