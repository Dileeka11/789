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
                                <h4 class="mb-0"> All Final Application Report </h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                        <li class="breadcrumb-item active">All Final Details Report</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form id="report-form" class="mb-3 text-danger" action="final-application-report.php" method="get">
                                        <div class="mb-3 row">
                                            <div class="col-md-4">
                                                <label class="col-md-12 col-form-label"> Select course Year *</label>
                                                <select class="form-select form-control mb-3 " id="course_year" name="year" autocomplete="off" required="">
                                                    <option selected="" value=""> -- Course Year -- </option>
                                                    <?php
                                                    $DEFUL_DATA = new DefaultData();
                                                    foreach ($DEFUL_DATA->CourseYear() as $key => $course_year) {
                                                        if($key>2023) {
                                                        $selected = '';
                                                        if ($course_year == $year) {
                                                            $selected = "selected";
                                                        }
                                                    ?>
                                                        <option value="<?= $key ?>" <?= $selected ?>><?= $course_year ?></option>
                                                    <?php }} ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="col-md-12 col-form-label"> Select course Batch *</label>
                                                <select class="form-select mb-3 " id="course_batch" name="batch" autocomplete="off" required="">
                                                    <option selected="" value=""> -- Course Batch -- </option>
                                                    <?php
                                                    foreach ($DEFUL_DATA->CourseBatch() as $key => $course_batch) {
                                                        $selected = '';
                                                        if ($key == $batch) {
                                                            $selected = "selected";
                                                        }
                                                    ?>
                                                        <option value="<?= $key ?>" <?= $selected ?>><?= $course_batch ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="col-md-12 col-form-label"></label>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light" id="btn-report-1" style="margin-top:20px;">Filter</button>
                                                <!-- <input type="hidden" name="row_height" value="20"> -->
                                            </div>
                                            <div class="col-md-1">
                                                <label class="col-md-12 col-form-label"></label>
                                                <a href="final-application-report-print.php?year=<?= $year ?>&batch=<?= $batch ?>" class="btn btn-success waves-effect waves-light hidden" id="btn-print-report" style="margin-top:20px;">Report</a>
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
                        <?php
                        if ($year != '' && $batch != '') {
                        ?>
                            <div class="col-lg-12 loading">
                                <h3 class="text-center text-danger">Loading...</h3>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <div class="table-responsive mb-4">
                                        <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                            <thead>
                                                <tr class="bg-transparent">
                                                    <th>Province</th>
                                                    <th>District</th>
                                                    <th>No</th>
                                                    <th>Center</th>
                                                    <th>Application</th>
                                                    <th>Students</th>
                                                    <th>Full time </th>
                                                    <th>Part time </th>
                                                    <th>Short time </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $PROVINCE = new Province(null);
                                                $provinces = $PROVINCE->all();
                                                $count = 0;
                                                $total_application_students = 0;
                                                $total_students = 0;
                                                $total_fulltime_students = 0;
                                                $total_parttime_students = 0;
                                                $total_shorttime_students = 0;
                                                foreach ($provinces as $key => $province) {
                                                    $DISTRICT = new Districts(null);
                                                    $districts = $DISTRICT->getDistrictByProvince($province['id']);
                                                    $center_count = 0;
                                                    foreach ($districts as $district) {
                                                        $CENTER = new Centers(null);
                                                        $centers = $CENTER->getCentersByDistrictId($district['id']);
                                                        if (count($centers) == 0) {
                                                            $center_count += 1;
                                                        } else {
                                                            $center_count += count($centers);
                                                        }
                                                    }
                                                    if ($key > 0) {
                                                ?>
                                                        <tr>
                                                        <?php
                                                    }
                                                    $key++;
                                                        ?>

                                                        <tr>
                                                            <td rowspan="<?= $center_count ?>"><?= $province['name'] ?></td>
                                                            <?php
                                                            foreach ($districts as $key1 => $district) {
                                                                $CENTER = new Centers(null);
                                                                $centers = $CENTER->getCentersByDistrictId($district['id']);
                                                                if ($key1 > 0) {
                                                            ?>
                                                        <tr>
                                                        <?php
                                                                }
                                                                $key1++;
                                                        ?>
                                                        <td rowspan="<?= count($centers) ?>"><?= $district['name'] ?></td>
                                                        <?php
                                                                if (count($centers) > 0) {
                                                                    foreach ($centers as $key2 => $center) {
                                                                        // if($key2 == 3) {
                                                                        $APPLICATION = new Applications(null);
                                                                        $STUDENT = new Student(NULL);
                                                                        
                                                                        $applications = $APPLICATION->getApplicationsCountByCenterYearAndBatch($center['centercode'], $year, $batch);
                                                                        $fulltime_applications = $APPLICATION->getApplicationsCountByTypeCenterYearAndBatch($center['centercode'], 1, $year, $batch);
                                                                        $parttime_applications = $APPLICATION->getApplicationsCountByTypeCenterYearAndBatch($center['centercode'], 2, $year, $batch);
                                                                        $shorttime_applications = $APPLICATION->getApplicationsCountByTypeCenterYearAndBatch($center['centercode'], 3, $year, $batch);
                                                                        $student_count = $STUDENT->AllgetStudentCountByCenterYearAndBatch($year,$batch,$center['centercode']);
                                                                        
                                                                        $total_application_students += $applications;
                                                                        $total_students += $student_count;
                                                                        $total_fulltime_students += $fulltime_applications;
                                                                        $total_parttime_students += $parttime_applications;
                                                                        $total_shorttime_students += $shorttime_applications;
                                                                        if ($key2 > 0) {
                                                        ?>
                                                        <tr>
                                                        <?php
                                                                        }
                                                                        $key2++;
                                                                        $count++;
                                                        ?>

                                                        <td><?= $count; ?></td>
                                                        <td><?= $center['center_name'] ?></td>
                                                        <td><?= $applications ?></td>
                                                        <td><?= $student_count ?> <td>
                                                        <td><?= $fulltime_applications ?> </td>
                                                        <td><?= $parttime_applications ?> </td>
                                                        <td><?= $shorttime_applications ?> </td>
                                                        </tr>
                                                    <?php
                                                                    }
                                                                    // }
                                                                } else {
                                                    ?>
                                                   
                                                     
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                     <td>-</td>
                                                    <td>-</td>
                                                    </tr>
                                            <?php
                                                                }
                                                            }
                                            ?>

                                            </tr>
                                        <?php
                                                }
                                        ?>
                                        <tr>
                                             <td></td> 
                                             
                                             <td></td>
                                            <td><b><?= $total_application_students ?></b></td>
                                            <td><b><?= $total_students ?></b></td>
                                            <td><b><?= $total_fulltime_students ?></b></td>
                                            <td><b><?= $total_parttime_students ?></b></td>
                                            <td><b><?= $total_shorttime_students ?></b></td>
                                        </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <h4 class="col-lg-12 text-danger">* Please select year and batch first.</h4>
                        <?php
                        }
                        ?>
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

</body>

</html>