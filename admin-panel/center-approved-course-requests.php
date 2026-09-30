<?php
include '../class/include.php';
include './auth.php';

$USERS = new User($_SESSION['id']);
?>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title> Center Approved Course Requests | Sri Lanka Youth </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content=" " name="description" />
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
                                    <h4 class="mb-0">Manage Approved Course Request </h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                            <li class="breadcrumb-item active"> All Approved Course Request</li>
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
                                                    <th>Course Type</th>
                                                    <th>Course Name</th>
                                                    <th>Re. Date</th>
                                                    <th>Course Year</th>
                                                    <th>Course Fee</th>
                                                    <th>Teaching Dates</th> 
                                                    <th style="width: 120px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $COURSE_REQUEST = new CourseRequest(NULL);
                                                foreach ($COURSE_REQUEST->getCourseRequestByCenterIdWithStatus($USERS->center_id, 1) as $key => $course_request) {
                                                    $key++;
                                                    $COURSE = new Course($course_request['course_id']);
                                                    ?>
                                                    <tr id="div<?php echo $course_request['id'] ?>" >
                                                        <td><?php echo $key ?></td>
                                                        <?php
                                                        if ($COURSE->fullpart == 1) {
                                                            ?>
                                                            <td>Full Time</td>

                                                        <?php } else if ($COURSE->fullpart == 2) { ?>
                                                            <td>Part Time</td>
                                                        <?php } else { ?>
                                                            <td>Short Time </td>
                                                        <?php } ?>
                                                        <td><?php echo  $course_request['id'] . ' '. $COURSE->courseid . ' - ' .$COURSE->cname . ' / Level - ' . $COURSE->level ?></td>
                                                        <td><?php echo $course_request['request_date'] ?></td>
                                                        <td><?php echo $course_request['year'] . ' / Batch - ' . $course_request['batch'] ?></td>
                                                        <td><?php echo number_format($course_request['course_fee'], 0, 2) ?></td>
                                                        <td><?php echo $course_request['teaching_days'] . ' - <span class="text-danger"> (Min - ' . $course_request['num_students'] . ')</span>' ?></td>



                                                        <td>
                                                            <a href="manage-applied-student-course-vise.php?id=<?php echo base64_encode($course_request['id']) ?>">
                                                                <div class="badge bg-pill bg-soft-success    font-size-14" type="button" title="All Applications"><i class="bx bx-user  p-1"></i></div>
                                                            </a> |
                                                            <a href="accept-applied-course-students.php?id=<?php echo $COURSE->courseid?>&year=<?php echo $course_request['year'] ?>&batch=<?php echo $course_request['batch'] ?>"> 
                                                                <div class="badge bg-pill bg-soft-dark    font-size-14" type="button" title="Register Students"><i class="bx bx-user-check   p-1"></i></div>
                                                            </a> |
                                                            <a href="dropout-course-students.php?id=<?php echo base64_encode($course_request['id']) ?>"> 
                                                                <div class="badge bg-pill bg-soft-danger   font-size-14" type="button" title="Dropout Students"><i class="bx bx-user-x   p-1"></i></div>
                                                            </a> 
                                                            <?php
                                                            $REQUEST_OPEN_CLOSE = new RequestOpenClose(1);
                                                            if($REQUEST_OPEN_CLOSE->status == 1){
                                                            ?>
                                                            |
                                                            <a href="../application.php?id=<?php echo $course_request['id'] ?>">
                                                                <div class="badge bg-pill bg-soft-info    font-size-14"  title="Application Form " type="button"><i class="  bx bx-notepad  p-1"></i></div>
                                                            </a>
                                                            
                                                            </a> |
                                                            <a href="generate-qr.php?id=<?= $course_request['id'] ?>">
                                                                <div class="badge bg-pill bg-soft-warning    font-size-14"  title="Downloard QR " type="button"><i class="  bx bx-customize   p-1"></i></div>
                                                            </a>
<?php }?>

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
            $(function () {

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
            $(document).ready(function () {
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