<?php
include '../class/include.php';
include './auth.php';

$USERS = new User($_SESSION['id']);
?>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title> Final Summary Report student by course  | Sl Youth Sri Lanka</title>
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
                                    <h4 class="mb-0"> Drop Out Student Report </h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                            <li class="breadcrumb-item active"> Final Summary Report Drop Out  Student Course Vise</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                       <form id="report-form" class="mb-3 text-danger" action="final-results-by-center-student-drop-out.php" method="get">

                                            <div class="mb-3 row">


                                                <div class="col-md-2">
                                                    <label class="col-md-12 col-form-label"> Select Center  *</label>
                                                    <select class="form-select form-control mb-3 select2 drop_out_student"  id="center" name="center" autocomplete="off" required="">
                                                        <option selected="" value="">  -  Select your center - </option>  


                                                        <?php
                                                        $CENTER = new Centers(NULL);
                                                        foreach ($CENTER->all() as $key => $center) {
                                                            ?>
                                                            <option value="<?php echo $center['centercode'] ?>"><?php echo $center['center_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="col-md-12 col-form-label"> Select course Year  *</label>
                                                    <select class="form-select form-control mb-3 drop_out_student "  id="course_year" name="course_year" autocomplete="off" required="">
                                                        <option selected="" value="">  - Course Year  - </option>  

                                                        <?php
                                                        $DEFUL_DATA = new DefaultData();
                                                        foreach ($DEFUL_DATA->CourseYear() as $key => $course_year) {
                                                            ?>
                                                            <option value="<?php echo $key ?>"><?php echo $course_year ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="col-md-2">
                                                    <label class="col-md-12 col-form-label"> Select course Batch  *</label>
                                                    <select class="form-select mb-3 drop_out_student"  id="course_batch" name="course_batch" autocomplete="off" required="">
                                                        <option selected="" value="">    - Course Batch -   </option>  

                                                        <?php
                                                        foreach ($DEFUL_DATA->CourseBatch() as $key => $course_batch) {
                                                            ?>
                                                            <option value="<?php echo $key ?>"><?php echo $course_batch ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>


                                                <div class="col-md-5">
                                                    <label class="col-md-12 col-form-label ">  Select Your Course Name *</label>
                                                    <select id="course" name="course" required="" class="form-select select2 drop_out_student" autocomplete="off">
                                                        <option  value="">-- Select Your Course Name -- </option>

                                                    </select>
                                                </div>

                                                <div class="col-md-1">
                                                    <label class="col-md-12 col-form-label ">      </label>
                                                    <button type="button" class="btn btn-primary waves-effect waves-light" id="btn-report-drop-out"  title="Print Report"style="margin-top: 20px;"> <i class=" bx bx-printer "></i></button>
                                                    <input type="hidden" name="row_height" value="20">

                                                </div>

                                            </div>



                                        </form>
                                    </div>


                                </div>
                            </div> <!-- end col -->
                        </div>

                        <div class="row" style="margin-top: 30px;">

                            <div class="col-lg-12">

                                <div>





                                    <div class="table-responsive mb-4">

                                        <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">

                                            <thead>

                                                <tr class="bg-transparent">



                                                    <th>No</th>
                                                    <th>Mis No</th>
                                                    <th>NIC</th>
                                                    <th>Full Name </th>
                                                    <th>Drop Out Date </th> 



                                                </tr>

                                            </thead>

                                            <tbody id="course_table">



                                               

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
        <script src="assets/libs/jquery/jquery.min.js"></script>

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
         <script src="ajax/js/get-center-course.js" type="text/javascript"></script>
        <script src="ajax/js/report.js" type="text/javascript"></script>
        <script src="ajax/js/course.js" type="text/javascript"></script>
        <!-- init js -->
        <script src="assets/js/pages/form-advanced.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>

</html>