<?php
include '../class/include.php';
include './auth.php';

$id = '';
$id = $_GET['id'];

$STUDENT = new Student($id);
$CENTER = new Centers($STUDENT->centercode);
$COURSE = new Course($STUDENT->course_id);

$APPLICATIONS = new Applications($STUDENT->application_id);
?>
<!doctype html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <title>View Student | Sri Lanka Youth Services</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- DataTables -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />  

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <link href="plugin/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/preloader.css" rel="stylesheet" type="text/css"/>

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
                                    <h4 class="mb-0">View Student</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="manage-students-by-course.php?id=<?= $STUDENT->course_id ?>"> Students</a></li>
                                            <li class="breadcrumb-item active">View Student</li>
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
                                        <form id="form-data">
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Student Id</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" id="name" name="name" placeholder="Enter full name" value="<?php echo $STUDENT->id ?>" readonly="">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">NIC Number</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="url" id="username" name="username" placeholder="Enter username" value="<?php echo $STUDENT->nic ?>" readonly="">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">First Name - (Full Name) </label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="url" id="username" name="username" placeholder="Enter username" value="<?php echo $STUDENT->fname ?>" readonly="">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Last Name</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="url" id="username" name="username" placeholder="Enter username" value="<?php echo $STUDENT->lname ?>" readonly="">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Course</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="url" id="username" name="username" placeholder="Enter username" value="<?php echo $STUDENT->course_id . ' - ' . $COURSE->cname ?>" readonly="">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Center</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="url" id="username" name="username" placeholder="Enter username" value="<?php echo $STUDENT->centercode . ' - ' . $CENTER->center_name ?>" readonly="">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Year</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="url" id="username" name="username" placeholder="Enter username" value="<?php echo $STUDENT->year ?>" readonly="">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Batch</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="url" id="username" name="username" placeholder="Enter username" value="Batch 0<?php echo $STUDENT->batch ?>" readonly="">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Mobile Number</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text"   placeholder="Enter mobile number" id="mobile_number" name="mobile_number" value="<?php echo $APPLICATIONS->mobile_number ?>" readonly="">
                                            </div>
                                        </div>
                                         <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Whatsapp Number</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text"   placeholder="Enter whatsapp number" id="whatsapp_number" name="whatsapp_number" value="<?php echo $APPLICATIONS->whatsapp_number ?>" readonly="">
                                            </div>
                                        </div>
                                         <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Email</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text"   placeholder="Enter email address" id="email" name="email"  value="<?php echo $APPLICATIONS->email ?>" readonly="">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Gn Division</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text"   placeholder="Enter whatsapp number" id="whatsapp_number" readonly="" name="whatsapp_number" value="<?php 
                                                $GNDIVISION = new Gndivision($APPLICATIONS->gn_id);
                                                echo $GNDIVISION->name ?>" readonly="">
                                            </div>
                                        </div>
                                        </form>

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>

                    </div>
                </div>
                <!-- End Page-content -->


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
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>

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
        <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script> 

        <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>


        <!-- App js -->


    </body>

</html>