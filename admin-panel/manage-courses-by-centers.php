<?php
include '../class/include.php';
include './auth.php';
?>
<!doctype html>

<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Manage Courses | Sl Youth </title>
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

    </head>


    <body>

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
                                    <h4 class="mb-0">Manage Course</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Manage Course</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div>


                                    <div class="table-responsive mb-4">
                                        <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                            <thead>
                                                <tr class="bg-transparent">

                                                    <th>Id</th>
                                                    <th>Course Trade</th>
                                                    <th>Course Name </th>
                                                    <th>Course ID</th>
                                                    <th>Course Type</th>
                                                    <th style="width: 120px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                 <?php
                                                $CENTER_COURSE = new CenterCourses(NULL);
                                                foreach ($CENTER_COURSE->getCoursesByCenters($_SESSION['center_id']) as $key => $center_courses) {
                                                    $COURSE = new Course($center_courses['course_id']);
$COURSE_TRADE = new CourseTrade($COURSE->tradecode);
                                                    $key++;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $key ?></td>
                                                        <td><?php echo $COURSE_TRADE->trade_name ?></td>
                                                        <td><?php echo $COURSE->cname ?></td>
                                                        <td><?php echo $COURSE->courseid ?></td>
                                                        <td>
                                                            <?php
                                                            if ($COURSE->fullpart == 1) {
                                                                echo '<span class="text-warning"> Full Time </span>';
                                                            } else if ($COURSE->fullpart == 2) {
                                                                echo '<span class="text-info">  Part Time </span>';
                                                            } else {
                                                                echo '<span class="text-info">  Short Time </span>';
                                                            }
                                                            ?>
                                                        </td>

                                                        <td>
                                                            <a href="manage-students-by-center-course.php?id=<?php echo $center_courses['course_id'] ?>" title="Manage Students By Course">
                                                                <div class="badge bg-pill bg-soft-warning font-size-14" type="button"><i class="fas fa-users  p-1"></i></div>
                                                            </a> 
                                                            <!--|-->
                                                            <!--<a href="dropout-course-students-centers.php?id=<?php echo $center_courses['course_id'] ?>&year=<?php echo $COURSE->year ?>&batch=<?php echo $COURSE->batch ?>" > -->
                                                            <!--    <div class="badge bg-pill bg-soft-danger   font-size-14" type="button" title="Manage Dropout Students Reports"><i class="bx bx-user-x   p-1"></i></div>-->
                                                            <!--</a>                                                                                                                 -->
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                    </div> <!-- container-fluid -->
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

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>

</html>