<?php
include '../class/include.php';
include './auth.php';
date_default_timezone_set('Asia/Colombo');

$year = '';
$year = $_GET['year'];

$batch = '';
$batch = $_GET['batch'];

$exam_type = '';
$exam_type = $_GET['exam_type'];


?>
<!doctype html>

<html lang="en">

<head>

    <meta charset="utf-8" />
    <title> Shedule Exam</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="#" name="description" />
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
    <style>
        .assign-student-section .select2 {
            width: 100% !important;
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
                                <h4 class="mb-0">Manage Exam - <span class="text-danger">  <?php echo $year ?> | Batch - <?php echo $batch ?>  </span> </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                        <li class="breadcrumb-item active"> Schedule Exam </li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

 

                                    <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                        <thead>
                                            <tr class="bg-transparent">

                                                <th> Id</th>
                                                <th>Course Name</th>
                                                <th>Qu. Type</th>
                                                <th>Practical<br /> Exam</th>
                                                <th>Start Date</th>
                                                <th>Start Time</th>
                                                <th>Duration</th>
                                                <th>Nu<br /> of Qu.</th>
                                                <th style="width: 120px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
    <?php
    $QUESTION_TYPE = new QuestionType(NULL);
    $SHEDULE_EXAM = new SheduleExam(NULL);
    $STUDENT = new Student(NULL);

    foreach ($SHEDULE_EXAM->getExamByYearAndBatchShowByCategory($year, $batch, $exam_type) as $key => $shedule_exam) {

        $COURSE = new Course($shedule_exam['course_id']);
        $pendingCount = $STUDENT->getPendingCertificateCountByCenterCourseYearBatch($COURSE->courseid, $year, $batch);
 
        $key++;
        $currentTime = new DateTime($shedule_exam['time']);
        $exam_end_time = $currentTime->modify('+' . $shedule_exam['duration'] . ' seconds');
        $exam_end_time = $exam_end_time->format('H:i');

        // Add row color classes
        $rowClass = '';
        if (($shedule_exam['start_date'] < date("Y-m-d") || ($shedule_exam['start_date'] == date("Y-m-d") && date("H:i") >= $exam_end_time)) && $shedule_exam['is_result_released'] == 0) {
            $rowClass = 'table-warning';
        }
        if ($pendingCount > 0) {
            $rowClass .= ' table-danger'; // Append red if there are pending certificates
        }
    ?>
        <tr id="div<?php echo $shedule_exam['id'] ?>" class="<?= trim($rowClass) ?>">
            <td><?php echo $key . ' - ' . $shedule_exam['id'].'-'. $pendingCount  ?></td>
            <td><?php echo $COURSE->courseid . ' - ' . $COURSE->cname ?></td>
            <?php
            $questionTypeLabel = '';
            foreach ($QUESTION_TYPE->all() as $question) {
                if ($question['id'] == $shedule_exam['type']) {
                    $questionTypeLabel = $question['type'];
                    break;
                }
            }
            ?>
            <td><?php echo $questionTypeLabel ?></td>
            <td><?= $shedule_exam['is_had_practical'] == 1 ? 'Yes' : 'No' ?></td>
            <td><?= date("m/d/Y", strtotime($shedule_exam['start_date'])) ?></td>
            <td><?= $shedule_exam['time'] ?></td>
            <td><?= $shedule_exam['duration'] ?></td>
            <td><?= $shedule_exam['number_of_question'] ?></td>
            <td>
                <?php
                if ($shedule_exam['start_date'] < date("Y-m-d") || ($shedule_exam['start_date'] == date("Y-m-d") && date("H:i") >= $exam_end_time)) {
                ?>
                    <a href="view-exam-students.php?id=<?php echo $shedule_exam['id'] ?>">
                        <div class="badge bg-pill bg-soft-success font-size-14" type="button"><i class="fas fa-users p-1"></i></div>
                    </a> |
                    <div class="badge bg-pill <?= $shedule_exam['is_result_released'] == 1 ? 'bg-soft-danger' : 'bg-soft-info' ?> font-size-14 released-result" data-id="<?= $shedule_exam['id'] ?>" exam-status="<?= $shedule_exam['is_result_released'] ?>" title="<?= $shedule_exam['is_result_released'] == 1 ? 'Hold results' : 'Release results' ?>">
                        <i class="fas <?= $shedule_exam['is_result_released'] == 1 ? 'fa-pause' : 'fa-share' ?>  p-1"></i>
                    </div>
                <?php
                }
                if (!($shedule_exam['start_date'] < date("Y-m-d") || ($shedule_exam['start_date'] == date("Y-m-d") && date("H:i") >= $exam_end_time))) {
                ?>
                    <a href="edit-schedule-exam.php?id=<?php echo $shedule_exam['id'] ?>">
                        <div class="badge bg-pill bg-soft-primary font-size-14" type="button"><i class="fas fa-pencil-alt p-1"></i></div>
                    </a> |
                    <div class="badge bg-pill bg-soft-danger font-size-14 schedule-exam" data-id="<?php echo $shedule_exam['id'] ?>"><i class="fas fa-trash p-1"></i></div>
                <?php
                }

                if ($shedule_exam['is_manual'] == 1) {
                ?>
                    |
                    <a href="edit-schedule-exam.php?id=<?php echo $shedule_exam['id'] ?>">
                        <div class="badge bg-pill bg-soft-primary font-size-14" type="button"><i class="fas fa-pencil-alt p-1"></i></div>
                    </a>
                <?php } ?>
                   
                   |
                   <a href="manage-students-by-course-year-batch.php?year=<?php echo $year ?>&batch=<?php echo $batch ?>&course_id=<?php echo $COURSE->courseid ?>">
                        <div class="badge bg-pill bg-soft-success font-size-14" type="button">
                           <i class="fas fa-users p-1"></i>
                        </div>
                   </a>
            </td>
        </tr>
    <?php } ?>
</tbody>

                                    </table>

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
  
    <script src="delete/js/schedule-exam.js" type="text/javascript"></script>
    <!-- App js -->

    <!-- pl  JAVASCRIPT -->
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="assets/libs/select2/js/select2.min.js"></script>
    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>


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