<?php
include '../class/include.php';
include './auth.php';

$id = '';
$id = $_GET['id'];

$STUDENT = new Student($id);
?>
<!doctype html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <title>Exam Result | Sri Lanka Youth Services</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
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
                                    <h4 class="mb-0">Exam Result</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Manage Exam Result</li>
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

                                        <h4 class="card-title">Add Exam Result</h4>
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
                                                <label for="example-url-input" class="col-md-2 col-form-label">First Name</label>
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
                                                <label for="example-url-input" class="col-md-2 col-form-label">Course Id</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="url" id="username" name="username" placeholder="Enter username" value="<?php echo $STUDENT->course_id ?>" readonly="">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Course name</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="url" id="username" name="username" placeholder="Enter username" value="<?php echo $STUDENT->course_name ?>" readonly="">
                                                </div>
                                            </div>
                                            <div class=" row">
                                                <div class="col-md-2 ">
                                                </div>
                                                <div class="col-md-10">
                                                    <p class="text-danger"> Please Enter the correct Marks. if any student absun enter the mark " 0 "</p>

                                                </div>
                                            </div>
                                            <?php
                                            if ($STUDENT->practical_mark == 0) {
                                                ?>
                                                <div class="mb-3 row">
                                                    <label for="example-url-input" class="col-md-2 col-form-label">Practical Exam Mark</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="number"  id="practical_mark" name="practical_mark" placeholder="Enter Practical Exam Mark" min="0"  >
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                <div class="mb-3 row">
                                                    <label for="example-url-input" class="col-md-2 col-form-label">Practical Exam Mark</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="number"  id="practical_mark" name="practical_mark" placeholder="Enter Practical Exam Mark" min="0" readonly="" value="<?php echo $STUDENT->practical_mark ?>">
                                                    </div>
                                                </div>
                                            <?php } ?>


                                            <?php
                                            if ($STUDENT->mcq_mark == 0) {
                                                ?>
                                                <div class="mb-3 row">
                                                    <label for="example-url-input" class="col-md-2 col-form-label">MCQ Paper Result</label>
                                                    <div class="col-md-9">
                                                        <input class="form-control" type="number" min="0" id="mcq_mark" name="mcq_mark" placeholder="MCQ Paper Marks" >
                                                    </div>
                                                    <div class="col-md-1">
                                                        <a href="edit-user.php?id=1">
                                                            <div class="badge bg-pill bg-soft-success font-size-20" type="button"><i class="fas fa-file"></i></div>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                <div class="mb-3 row">
                                                    <label for="example-url-input" class="col-md-2 col-form-label">MCQ Paper Result</label>
                                                    <div class="col-md-9">
                                                        <input class="form-control" type="number" min="0"  placeholder="MCQ Paper Marks" readonly="" value="<?php echo $STUDENT->mcq_mark ?>">
                                                    </div>
                                                    <div class="col-md-1">
                                                        <a href="edit-user.php?id=1">
                                                            <div class="badge bg-pill bg-soft-success font-size-20" type="button"><i class="fas fa-file"></i></div>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php } ?>


                                            <?php
                                            if ($STUDENT->writing_paper_mark == 0) {
                                                ?>

                                                <div class="mb-3 row">
                                                    <label for="example-url-input" class="col-md-2 col-form-label">Writting Paper Mark</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="number" min="0" id="writing_paper_mark" name="writing_paper_mark"  placeholder="Enter the writting paper Mark">
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                <div class="mb-3 row">
                                                    <label for="example-url-input" class="col-md-2 col-form-label">Writting Paper Mark</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="number" min="0" id="writing_paper_mark" name="writing_paper_mark"  placeholder="Enter the writting paper Mark" readonly="" value="<?php echo $STUDENT->writing_paper_mark ?>">
                                                    </div>
                                                </div>
                                            <?php } ?>

                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Total Marks</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="number" min="0"  readonly="">
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