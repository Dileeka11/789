<?php
include '../class/include.php';
include './auth.php';

$id = '';
$id = $_GET['id'];

$STUDENT = new Student($id);
$is_student_exist = ExamStudent::getStudentDetails($STUDENT->id);
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Practical Marks | Sri Lanka Youth Services</title>

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
    <link href="plugin/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/preloader.css" rel="stylesheet" type="text/css" />

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
                                <h4 class="mb-0">Test Marks</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="manage-students-by-course.php?id=<?= $STUDENT->course_id ?>">Students</a></li>
                                        <li class="breadcrumb-item active">Manage Exam Result</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">
                                    <form id="form-data">
                                        <div class=" row">
                                            <div class="col-md-2 ">
                                            </div>
                                            <div class="col-md-10">
                                                <!-- <p class="text-danger"> Please enter the correct marks. If any student absent enter the mark " 0 "</p> -->

                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-4 col-form-label">MCQ Test</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="number" id="mcq_mark" name="mcq_mark" placeholder="Enter MCQ Test Mark" min="0" value="<?= isset($is_student_exist) ? ($is_student_exist['mcq_grade']!=''?$is_student_exist['mcq_marks']:'') : '' ?>">
                                            </div>
                                            <div class="col-md-12">
                                                <p class="text-danger"> Please enter marks out of 100 if it's an MCQ-only test or marks out of 40 if both MCQ and Theory Test. If it's not a MCQ Test, please leave it empty (not as 0).</p>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-4 col-form-label">Theory Test</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="number" id="theory_mark" name="theory_mark" placeholder="Enter Theory Test Mark" min="0" value="<?= isset($is_student_exist) ? ($is_student_exist['essay_grade']!=''?$is_student_exist['essay_marks']:'') : '' ?>">
                                            </div>
                                            <div class="col-md-12">
                                                <p class="text-danger"> Please enter marks out of 100 if it's an Theory-only test or marks out of 60 if both MCQ and Theory Test. If it's not a Theory Test, please leave it empty (not as 0)</p>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-4 col-form-label">Practical Test</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="number" id="practical_mark" name="practical_mark" placeholder="Enter Practical Test Mark" min="0" value="<?= isset($is_student_exist) ? ($is_student_exist['practical_grade']!=''?$is_student_exist['practical_marks']:'') : '' ?>">
                                            </div>
                                            <div class="col-md-12">
                                                <p class="text-danger"> Please enter marks out of 100 if final test include practical test. If it's not, please leave it empty (not as 0)</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12" style="display: flex; justify-content: flex-end;margin-top: 15px;">
                                                <button class="btn btn-primary " type="submit" id="update1">Update</button>

                                            </div>
                                            <input type="hidden" name="update1">
                                            <input type="hidden" name="id" value="<?php echo $id ?>">

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
    <script src="ajax/js/student-mark-update.js" type="text/javascript"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>

    <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>


    <!-- App js -->


</body>

</html>