<?php
include '../class/include.php';
include './auth.php';
$USERS = new User($_SESSION['id']);
$year = '';
$batch = '';
if (isset($_GET['year'])) {
    $year = $_GET['year'];
}
if (isset($_GET['batch'])) {
    $batch = $_GET['batch'];
}
?>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Final Application Report | Sl Youth Sri Lanka</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />
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

    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            if ($('#get_year').val() != '') {
                $('#btn-print-report').removeClass('hidden');
                $('.loading').addClass('hidden');
            }
        });
    </script>
    <script>
    </script>
    <style>
        .assign-student-section .select2 {
            width: 100% !important;
        }

        .dt-button {
            padding: 10px 20px 10px 20px;
            margin-bottom: 20px;
            color: white;
            background-color: #28a745;
            border-radius: 5px;
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
                                <h4 class="mb-0"> All Final Student Report </h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                        <li class="breadcrumb-item active">All Final Student Report</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form id="report-form" class="mb-3 text-danger" action="final-course-request-count-report.php" method="get">
                                        <div class="mb-3 row">
                                            <div class="col-md-4">
                                                <label class="col-md-12 col-form-label"> Select course Year *</label>
                                                <select class="form-select form-control mb-3 " id="course_year" name="year" autocomplete="off" required="">
                                                    <option selected="" value=""> -- Course Year -- </option>
                                                    <?php
                                                    $DEFUL_DATA = new DefaultData();
                                                    foreach ($DEFUL_DATA->CourseYear() as $key => $course_year) {
                                                        if ($key > 2022) {
                                                            $selected = '';
                                                            if ($course_year == $year) {
                                                                $selected = "selected";
                                                            }
                                                    ?>
                                                            <option value="<?= $key ?>" <?= $selected ?>><?= $course_year ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="col-md-12 col-form-label"> Select Batch *</label>
                                                <select class="form-select form-control mb-3 " id="course_year" name="batch" autocomplete="off" required="">
                                                    <option selected="" value=""> -- Batch -- </option>
                                                    <option value="0"> All</option>
                                                    <option value="1" <?= $batch == 1 ? 'selected' : '' ?>>1</option>
                                                    <option value="2" <?= $batch == 2 ? 'selected' : '' ?>>2</option>
                                                    <option value="3" <?= $batch == 3 ? 'selected' : '' ?>>3</option>
                                                </select>
                                            </div>

                                            <div class="col-md-1">
                                                <label class="col-md-12 col-form-label"></label>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light" id="btn-report-1" style="margin-top:20px;">Filter</button>
                                                <!-- <input type="hidden" name="row_height" value="20"> -->
                                            </div>
                                            <div class="col-md-1">
                                                <label class="col-md-12 col-form-label"></label>
                                                <a href="final-course-request-count-report-print.php?year=<?= $year ?>&batch=<?= $batch ?>" class="btn btn-success waves-effect waves-light hidden" id="btn-print-report" style="margin-top:20px;">Report</a>
                                                <input type="hidden" id="get_year" value="<?= $year ?>">
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- <span class="text-success">A = Applications </span> | <span class="text-warning"> S = Student  </span> | <span class="text-primary"> D = Dropout </span> | <span class="text-danger"> C = Complete </span> -->
                    <div class="row" style="margin-top: 30px;">

                        <div class="col-lg-12 loading">
                            <h3 class="text-center text-danger">Loading...</h3>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <div class="table-responsive mb-4">
                                    <table class="table table-centered dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;" id="students-table">
                                        <thead>
                                            <tr class="bg-transparent">
                                                <th>No#</th>
                                                <th>Province </th>
                                                <th>District </th>
                                                <th>Training Center </th>
                                                <th>Course Name</th>
                                                <th>Full / Part / Short </th>
                                                <th>NVQ Level </th>
                                                <th>Durarion (Month)</th>
                                                <th>Batch</th>
                                                <th>Students</th>
                                                <th>Male</th>
                                                <th>FeMale</th>
                                                <th>Drop Out</th>
                                                <th>Male</th>
                                                <th>FeMale</th> 
                                                <th>Passed Exam</th>
                                                <th>Repeat Students</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $COURSE_REQUEST  = new CourseRequest(NULL);
                                            $requests = $COURSE_REQUEST->getCourseIdByYearAndBatch($year, $batch);

                                            foreach ($requests as $key => $request) {
                                                $CENTERS = new Centers($request['center_id']);
                                                $DISTRICT = new Districts($CENTERS->districid);
                                                $PROVINCE = new Province($DISTRICT->province);
                                                $COURSE = new Course($request['course_id']);
                                                $STUDENT = new Student(NULL);

                                                $key++;


                                                if ($COURSE->fullpart == 1) {
                                                    $type = '<span class="text-warning"> Full Time </span>';
                                                } else if ($COURSE->fullpart == 2) {
                                                    $type = '<span class="text-info">  Part Time </span>';
                                                } else {
                                                    $type = '<span class="text-info">  Short Time </span>';
                                                }



                                            ?>
                                                <tr>
                                                    <td><?= $key ?></td>
                                                    <td><?= $PROVINCE->name ?></td>
                                                    <td><?= $DISTRICT->name ?></td>
                                                    <td><?= $CENTERS->center_name ?></td>
                                                    <td><?= $COURSE->courseid  .' - '.$COURSE->cname ?></td>
                                                    <td><?= $type ?></td>
                                                    <td><?= $COURSE->level; ?></td>
                                                    <td><?= $COURSE->durationm; ?> months</td>
                                                    <td><?php echo $request['batch'] ?></td>
                                                    <td>
                                                        <?php

                                                        $rest =  $STUDENT->getStudentIDArrayByCourseAndBatchCount($request['course_id'], $year, $request['batch'], $request['center_id']);
                                                        echo $rest;
                                                        ?>
                                                    </td>
                                                     <td>
                                                        <?php

                                                        $rest =  $STUDENT->getStudentIDArrayByCourseAndBatchCountGender($request['course_id'], $year, $request['batch'], $request['center_id'],'Male');
                                                        echo $rest;
                                                        ?>
                                                    </td>
                                                     <td>
                                                        <?php

                                                        $rest =  $STUDENT->getStudentIDArrayByCourseAndBatchCountGender($request['course_id'], $year, $request['batch'], $request['center_id'],'Female');
                                                        echo $rest;
                                                        ?>
                                                    </td>
                                                     
                                                    <td>
                                                        <?php

                                                        $rest =  $STUDENT->getStudentIDArrayByCourseAndBatchWithDropCount($request['course_id'], $year, $request['batch'], $request['center_id']);
                                                        echo $rest;
                                                        ?>
                                                    </td>

   <td>
                                                        <?php

                                                        $rest =  $STUDENT->getStudentIDArrayByCourseAndBatchCountGenderDropout($request['course_id'], $year, $request['batch'], $request['center_id'],'Male');
                                                        echo $rest;
                                                        ?>
                                                    </td>
                                                     <td>
                                                        <?php

                                                        $rest =  $STUDENT->getStudentIDArrayByCourseAndBatchCountGenderDropout($request['course_id'], $year, $request['batch'], $request['center_id'],'Female');
                                                        echo $rest;
                                                        ?>
                                                    </td>
                                                    
                                                    <td>
                                                        <?php

                                                        $EXAMSTUDENT = new ExamStudent(null);
                                                        $stu_count = $EXAMSTUDENT->getPassStudentCount($year, $request['batch'], $request['course_id'], $request['center_id']);
                                                        echo $stu_count;
                                                        ?>

                                                    </td>
                                                    <td>
                                                        <?php

                                                        $EXAMSTUDENT = new ExamStudent(null);
                                                        $stu_count_AB = $EXAMSTUDENT->getAbStudentsByCenterYearAndBatch($request['center_id'], $year, $request['batch']);
                                                        $stu_count = $EXAMSTUDENT->getFaillStudentCount($year, $request['batch'], $request['course_id'], $request['center_id']);
                                                        $final =  $stu_count +$stu_count_AB;
                                                        echo $final;
                                                        ?>

                                                    </td>
                                                    

                                                </tr>
                                            <?php
                                            }
                                            ?>

                                            </tr>
                                        </tbody>
                                    </table>
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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
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
    //////////////////////////////////////
    <!-- <script src="ajax/js/course.js" type="text/javascript"></script>
    <script src="ajax/js/course-requests.js" type="text/javascript"></script> -->
    <!-- init js -->
    <script src="assets/js/pages/form-advanced.init.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

    <script>
        $(document).ready(function() {
            // $('#students-table').DataTable({
            //     dom: 'Bfrtip',
            //     buttons: [
            //         'copy', 'csv', 'excel', 'pdf', 'print'
            //     ]
            // });
            var empDataTable = $('#students-table').DataTable({
                dom: 'Blfrtip',
                buttons: [{
                    extend: 'excel',
                    exportOptions: {
                        // columns: [0, 1] // Column index which needs to export
                    }
                }]

            });
        });
    </script>
</body>

</html>