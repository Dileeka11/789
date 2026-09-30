<?php
include '../class/include.php';
include './auth.php';

$USERS = new User($_SESSION['id']);
?>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title> Course Requests </title>
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
                                    <h4 class="mb-0">Submit Course Request  </h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                            <li class="breadcrumb-item active"> Submit Course Request</li>
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

                                            <div class="mb-3 row hidden">
                                                <label for="example-search-input" class="col-md-2 col-form-label ">Select Course Type</label>
                                                <div class="col-md-10">
                                                    <select class="form-control " name="type" id="type">
                                                       
                                                        <option value="1">Full Time</option>
                                                        <option value="2">Part Time</option>
                                                        <option value="3">Short Time</option>

                                                    </select>
                                                </div>
                                            </div>


                                            <div class="mb-3 row">
                                                <label for="example-search-input" class="col-md-2 col-form-label">Select Course Name</label>
                                                <div class="col-md-10">
                                                    <select class="form-control select2" name="course_id" id="course-bar">
                                                         <option value="" selected="">-- Select Course Name -- </option>
                                                         
                                                        <?php
                                                        $CENTER_COURSE = new CenterCourses(NULL);
                                                        foreach ($CENTER_COURSE->getCenterCoursesWithDetails($USERS->center_id) as $key => $courses) {
                                                            $COURSE = new Course($courses['courseid']);

                                                            if ($COURSE->fullpart == 1) {
                                                                $type = 'Full Time';
                                                            } else if ($COURSE->fullpart == 2) {
                                                                $type = 'Part Time';
                                                            } else {
                                                                $type = 'Short Time';
                                                            }
                                                            ?>
                                                            <option value="<?php echo $COURSE->courseid ?>"><?php echo $COURSE->courseid . ' - ' .$COURSE->cname . ' | Level - ' . $COURSE->level . ' | ' . $type ?></option>
                                                        <?php } ?>

                                                    </select>
                                                </div>
                                            </div>



                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Select Course Year</label>
                                                <div class="col-md-10">
                                                    <select class="form-control " name="year" id="year">
                                                        <option value="">-- Select Year --</option>
                                                        <?php
                                                        for ($x = 2024; $x <= 2030; $x++) {
                                                            ?>
                                                            <option value="<?php echo $x ?>"> <?php echo $x ?> </option>
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                            </div>


                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label"> Select Course Batch</label>
                                                <div class="col-md-10">
                                                    <select class="form-control " name="batch" id="batch">
                                                        <option value="">-- Select batch --</option>
                                                        <?php
                                                        for ($y = 1; $y <= 6; $y++) {
                                                            ?>
                                                            <option value="<?php echo $y ?>" >Batch 0<?php echo $y ?> </option>
                                                        <?php } ?> 
                                                    </select>

                                                </div>
                                            </div>


                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Nu. of Min Students</label>
                                                <div class="col-md-10">
                                                    <select class="form-control " name="num_students" id="num_students">
                                                        <option value="" >-- Select Minimum Students --</option>
                                                        <option value="5"> 5 </option>
                                                        <option value="10"> 10 </option>
                                                        <option value="15"> 15 </option>
                                                        <option value="20"> 20 </option>
                                                        <option value="30"> 30 </option>
                                                        <option value="40"> 40 </option>
                                                        <option value="50"> 50 </option>
                                                        <option value="60"> 60 </option>
                                                        <option value="70"> 70 </option>
                                                        <option value="80"> 80 </option>
                                                    </select>

                                                </div>
                                            </div>


                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Teaching Dates</label>
                                                <div class="col-md-10">
                                                    <select class="form-control " name="teaching_days" id="teaching_days">
                                                        <option value="">-- Select Teaching Dates   --</option>
                                                        <option value="Monday to Friday"> Monday to Friday </option>
                                                        <option value="Monday to Friday Evening"> Monday to Friday Evening </option>
                                                        <option value="One day per week"> One day per week</option>
                                                        <option value="Two days per week"> Two days per week</option>
                                                        <option value="Saturday"> Saturday </option>
                                                        <option value="Saturday Evening"> Saturday Evening </option>
                                                        <option value="Sunday"> Sunday </option>
                                                        <option value="Sunday Evening "> Sunday Evening </option>
                                                        <option value="Saturday and Sunday"> Saturday and Sunday  </option>
                                                        <option value="Saturday and Sunday Evening"> Saturday and Sunday Evening </option>
                                                    </select>

                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Course Fee</label>
                                                <div class="col-md-10">
                                                    <input class="form-control  " type="number" id="course_fee" name="course_fee" placeholder="Enter course fee">
                                                </div>
                                            </div>                                           


                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">DG Approval </label>
                                                <div class="col-md-10">
                                                    <select class="form-control " name="dg_approvel" id="dg_approvel">
                                                        <option value="">-- Select Approval  -- </option>
                                                        <option value="1"> Yes </option>
                                                        <option value="2"> No </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12" style="display: flex; justify-content: flex-end;margin-top: 15px;">
                                                    <button class="btn btn-primary " type="submit" id="create">Create</button>
                                                </div>
                                                <input type="hidden" name="create">
                                                <input type="hidden" name="center_id" value="<?php echo $USERS->center_id ?>">

                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Manage Pending Course Request</h4>


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
                                                foreach ($COURSE_REQUEST->getCourseRequestByCenterIdWithStatus($USERS->center_id, 0) as $key => $course_request) {
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
                                                        <td><?php echo  $course_request['course_id'] . ' - ' .$COURSE->cname . ' / Level - ' . $COURSE->level ?></td>
                                                        <td><?php echo $course_request['request_date'] ?></td>
                                                        <td><?php echo $course_request['year'] . ' / Batch - ' . $course_request['batch'] ?></td>
                                                        <td><?php echo number_format($course_request['course_fee'], 0, 2) ?></td>
                                                        <td><?php echo $course_request['teaching_days'] . ' - <span class="text-danger"> (Min - ' . $course_request['num_students'] . ')</span>' ?></td>



                                                        <td>
                                                            <a href="edit-new-course-request.php?id=<?php echo $course_request['id'] ?>">
                                                                <div class="badge bg-pill bg-soft-primary    font-size-14" type="button"><i class="fas fa-pencil-alt  p-1"></i></div>
                                                            </a>
                                                            | 
                                                            <div class="badge bg-pill bg-soft-danger font-size-14 released-result course-request"   data-id="<?php echo $course_request['id'] ?>" title="Delete">
                                                                <i class="fas fa-trash  p-1"></i>
                                                            </div>

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
        
        <script src="ajax/js/course-requests.js" type="text/javascript"></script>
        <script src="delete/js/course-request.js" type="text/javascript"></script>

        <!-- init js -->
        <script src="assets/js/pages/form-advanced.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>

</html>