<?php
include '../class/include.php';
include './auth.php';
?>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title> Pending Course Requests | Sri Lanka Youth </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content=" e" name="description" />
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
                                    <h4 class="mb-0">All Pending Course Requests  </h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                            <li class="breadcrumb-item active"> All Pending Course Request</li>
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
                                                    <th>Center Name</th>
                                                    <th>Course Type</th>
                                                    <th>Course Name</th>

                                                    <th>Re. Date</th>
                                                    <th>Year</th>
                                                    <th>Course Fee</th>
                                                    <th>Teaching Dates</th> 


                                                    <th style="width: 120px;">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $COURSE_REQUEST = new CourseRequest(NULL);
                                                foreach ($COURSE_REQUEST->getCourseRequestByStatus(0) as $key => $course_request) {
                                                    $key++;
                                                    $COURSE = new Course($course_request['course_id']);
                                                    $CENTER = new Centers($course_request['center_id']);
                                                    ?>
                                                    <tr id="div71" class="">
                                                        <td><?php echo $key ?></td>
                                                        <td><?php echo $CENTER->center_name ?></td>
                                                        <?php
                                                        if ($COURSE->fullpart == 1) {
                                                            ?>
                                                            <td>Full Time 
                                                                <?php
                                                                if ($COURSE->nvqnon == 1) {
                                                                    ?>
                                                                    <span class="text-danger"> -   NVQ </span>
                                                                <?php } else {
                                                                    ?>
                                                                    <span class="text-danger"> -  NON NVQ </span>

                                                                    <?php
                                                                }
                                                                ?></td>

                                                        <?php } else if ($COURSE->fullpart == 2) { ?>
                                                            <td>Part Time 
                                                                <?php
                                                                if ($COURSE->nvqnon == 1) {
                                                                    ?>
                                                                    <span class="text-danger"> -   NVQ </span>
                                                                <?php } else {
                                                                    ?>
                                                                    <span class="text-danger"> -  NON NVQ </span>

                                                                    <?php
                                                                }
                                                                ?></td>
                                                        <?php } else { ?>
                                                            <td>Short Time </td>
                                                        <?php } ?>
                                                        <td><?php echo $COURSE->cname . ' / Level - ' . $COURSE->level ?></td>

                                                        <td><?php echo $course_request['request_date'] ?></td>
                                                        <td><?php echo $course_request['year'] . ' / Batch - 0' . $course_request['batch'] ?></td>
                                                        <td><?php echo number_format($course_request['course_fee'], 0, 2) ?></td>

                                                        <td><?php echo $course_request['teaching_days'] . ' - <span class="text-danger"> (Min - ' . $course_request['num_students'] . ')</span>' ?></td>




                                                        <td>
                                                            <div class="badge bg-pill bg-soft-success    font-size-14 approved_course" type="button" data-id="<?php echo $course_request['id'] ?>"><i class=" bx bx-check-circle   p-1"></i></div>
                                                            | 
                                                            <a href="#"  class=""> <div class="badge bg-pill bg-soft-danger font-size-14 open-modal" request-id="<?php echo $course_request['id'] ?>"  data-toggle="modal" data-target="#exampleModalCenter<?php echo $course_request['id'] ?>" title="Hold results">
                                                                    <i class=" bx bx-x-circle   p-1"></i>
                                                                </div> 
                                                            </a>


                                                        </td>
                                                    </tr>

                                                


                                            <?php } ?>
                                            </tbody>
                                        </table>
<?php 
 foreach ($COURSE_REQUEST->getCourseRequestByStatus(0) as $key => $course_request) {
      $CENTER = new Centers($course_request['center_id']);
     ?>

<div class="modal fade" id="exampleModalCenter<?php echo $course_request['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Enter the Reason for Reject Course Request.! </h5>
                                                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h6 class="text-success"><b><u>Center Name: <?php echo $CENTER->center_name ?> |  Course Name : <?php echo $COURSE->cname . ' / Level - ' . $COURSE->level ?></u></b></h6>
                                                                
                                                                    <div class="mb-3 row mt-3">
                                                                        <div class="col-md-12">
                                                                            <input class="form-control description" required="" type="text" placeholder="Enter course reject reason" name="description"  >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12" style="display: flex; justify-content: flex-end;margin-top: 15px;">
                                                                        <button class="btn btn-danger reject_course" type="submit"  >Reject</button>
                                                                        <input type="hidden" name="option" value="rejected">
                                                                        <input type="hidden" name="id" id="request-id" value="<?php echo $course_request['id'] ?>">
                                                                    </div>
                                                                
                                                            </div>

                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->

                                                </div>
                                                <?php } ?>
                                    </div>
                                </div> <!-- end col -->
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- END layout-wrapper -->

        </div>
        <!-- JAVASCRIPT -->
        <!-- JAVASCRIPT -->
        <!--<script src="assets/libs/jquery/jquery.min.js"></script>-->
        <!--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>-->
        <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>-->


        <!--<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>-->
        <!--<script src="assets/libs/metismenu/metisMenu.min.js"></script>-->
        <!--<script src="assets/libs/simplebar/simplebar.min.js"></script>-->
        <!--<script src="assets/libs/node-waves/waves.min.js"></script>-->
        <!--<script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>-->
        <!--<script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>-->
        <!--<script src="assets/libs/select2/js/select2.min.js"></script>-->
        <!-- Required datatable js -->
        <!--<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>-->
        <!--<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>-->

        <!-- Responsive examples -->
        <!--<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>-->
        <!--<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>-->
        <!--<script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>-->
        <!-- init js -->
        <!--<script src="assets/js/pages/ecommerce-datatables.init.js"></script>-->
        <!--<script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>-->
        <!--<script src="ajax/js/course-requests.js" type="text/javascript"></script>-->
        <!--<script src="ajax/js/schedule-exam.js" type="text/javascript"></script>-->
        <!--<script src="delete/js/schedule-exam.js" type="text/javascript"></script>-->
        <!-- App js -->

        <!-- pl  JAVASCRIPT -->
        <!--<script src="assets/libs/node-waves/waves.min.js"></script>-->
        <!--<script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>-->
        <!--<script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>-->
        <!--<script src="assets/libs/select2/js/select2.min.js"></script>-->
        <!-- Required datatable js -->
        <!--<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>-->
        <!--<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>-->


        <!--<script src="assets/libs/select2/js/select2.min.js"></script>-->
        <!--<script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>-->
        <!--<script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>-->
        <!--<script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>-->
        <!--<script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>-->
        <!--<script src="assets/libs/@chenfengyuan/datepicker/datepicker.min.js"></script>-->

        <!--<script src="assets/libs/metismenu/metisMenu.min.js"></script>-->

        <!-- init js -->
        <!--<script src="assets/js/pages/form-advanced.init.js"></script>-->
        <!-- App js -->
        <!--<script src="assets/js/app.js"></script>-->
        
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <!--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

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
        <script src="ajax/js/course-requests.js" type="text/javascript"></script>
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
<script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <!-- init js -->
        <script src="assets/js/pages/form-advanced.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>

</html>