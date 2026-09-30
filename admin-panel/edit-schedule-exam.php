<?php
include '../class/include.php';
include './auth.php';

$id = '';
$id = $_GET['id'];

$SHEDULE_EXAM = new SheduleExam($id);
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title> Shedule Exam - Edit </title>
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
                                <h4 class="mb-0">Schedule Exam </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                        <li class="breadcrumb-item active"> Edit Schedule Exam </li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form id="form-data">
                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Select Exam Course</label>
                                            <div class="col-md-10">
                                                <select class="form-control select2" name="course_id" id="course_id">
                                                    <option value="">-- Select the Course -- </option>
                                                    <?php
                                                    $COURSE = new Course(NULL);
                                                    foreach ($COURSE->all() as $course) {
                                                        if ($course['courseid'] == $SHEDULE_EXAM->course_id) {
                                                    ?>
                                                            <option value="<?php echo $course['courseid'] ?>" selected=""><?php echo $course['courseid'] . ' - ' . $course['cname'] ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $course['courseid'] ?>"><?php echo $course['courseid'] . ' - ' . $course['cname'] ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Select Year</label>
                                            <div class="col-md-10">
                                                <select class="form-control select2" name="year" id="year">
                                                    <option value="">-- Select Year -- </option>
                                                    <?php
                                                    $current_year = date('Y');
                                                    $current_year = $current_year + 2;
                                                    for ($i = 0; $i < 20; $i++) {
                                                        $year = $current_year - $i;
                                                    ?>
                                                        <option value="<?= $year ?>" <?= ($SHEDULE_EXAM->year == $year) ? 'selected' : '' ?>> <?= $year ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Select Batch</label>
                                            <div class="col-md-10">
                                                <select class="form-control select2" name="batch" id="batch">
                                                    <option value="">-- Select Batch -- </option>
                                                    <option value="1" <?= ($SHEDULE_EXAM->batch == 1) ? 'selected' : '' ?>>1</option>
                                                    <option value="2" <?= ($SHEDULE_EXAM->batch == 2) ? 'selected' : '' ?>>2</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Select Exam Type</label>
                                            <div class="col-md-10">
                                                <select class="form-control  " name="type" id="type">
                                                    <option value="">-- Select Exam Type -- </option>
                                                    <?php
                                                    $QUESTION_TYPE = new QuestionType(NULL);
                                                    foreach ($QUESTION_TYPE->all() as $question) {
                                                        if ($question['id'] == $SHEDULE_EXAM->type) {
                                                    ?>
                                                            <option value="<?php echo $question['id'] ?>" selected=""> <?php echo $question['type'] ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $question['id'] ?>"> <?php echo $question['type'] ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Is had Practical Exam </label>
                                            <div class="col-md-10">
                                                <select class="form-control " name="is_had_practical" id="is_had_practical">
                                                    <option value="1" <?= $SHEDULE_EXAM->is_had_practical == 1 ? 'selected' : '' ?>>Yes</option>
                                                    <option value="0" <?= $SHEDULE_EXAM->is_had_practical == 0 ? 'selected' : '' ?>>No</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label"> Exam Start Date</label>
                                            <div class="col-md-10">
                                                <input class="form-control date" type="text" id="start_date" name="start_date" placeholder="Select exam start date " value="<?= date("m/d/Y", strtotime($SHEDULE_EXAM->start_date)) ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label"> Start Time </label>
                                            <div class="col-md-10">
                                                <input class="form-control time" type="text" id="time" name="time" placeholder="Select start time" value="<?php echo $SHEDULE_EXAM->time ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Select Exam Duration</label>
                                            <div class="col-md-10">
                                                <select class="form-control  " name="duration" id="duration">
                                                    <option value="">-- Select Exam Duration -- </option>
                                                    <?php
                                                    $DEFUL_DATA = new DefaultData(NULL);
                                                    foreach ($DEFUL_DATA->ExamDuration() as $key => $duration) {
                                                        if ($key == $SHEDULE_EXAM->duration) {
                                                    ?>
                                                            <option value="<?php echo $key ?>" selected=""> <?php echo $duration ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $key ?>"> <?php echo $duration ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Number Of questions </label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="number" min="0" id="number_of_question" name="number_of_question" placeholder="Enter number of questions" value="<?php echo $SHEDULE_EXAM->number_of_question ?>">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Is Manual Exam </label>
                                            <div class="col-md-10">
                                                <select class="form-control " name="is_manual" id="is_manual">
                                                    <option value="1" <?= $SHEDULE_EXAM->is_manual == 1 ? 'selected' : '' ?>>Yes</option>
                                                    <option value="0" <?= $SHEDULE_EXAM->is_manual == 0 ? 'selected' : '' ?>>No</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row assign-student-section <?= $SHEDULE_EXAM->is_manual == 0 ? 'hidden' : '' ?>">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Assign Students</label>
                                            <div class="col-md-10">
                                                <select class="form-control select2" name="assign_students[]" id="assign-students" multiple>
                                                    <option value="">-- Select Student -- </option>
                                                    <?php
                                                    $STUDENT = new Student(null);
                                                    $students = $STUDENT->getStudentsByCourseAndBatch($SHEDULE_EXAM->course_id, $SHEDULE_EXAM->year, $SHEDULE_EXAM->batch);
                                                    $EXAMSTUDENT = new ExamStudent(null);
                                                    $exam_students = $EXAMSTUDENT->getStudentIdsByExamId($SHEDULE_EXAM->id);
                                                    foreach ($students as $student) {
                                                        $selected = '';
                                                        if(in_array($student['id'], $exam_students))  {
                                                            $selected = 'selected';
                                                        }
                                                    ?>
                                                        <option value="<?= $student['id'] ?>" <?= $selected; ?>><?= $student['id'] . ' - ' . $student['fname'] . ' ' . $student['lname'] ?></option>
                                                    <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12" style="display: flex; justify-content: flex-end;margin-top: 15px;">
                                                <button class="btn btn-primary " type="submit" id="update">Update</button>

                                            </div>
                                            <input type="hidden" name="update">
                                            <input type="hidden" name="id" value="<?php echo $id ?>">

                                        </div>
                                    </form>

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
    <!-- App js -->

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