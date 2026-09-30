<?php
include '../class/include.php';
?>
<!doctype html>

<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title> Search Student Result  </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="#" name="description" />
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
           tr, td{
                padding:8px;
            }
        </style>

    </head>


    <body class="someBlock">

        <!-- <body data-layout="horizontal" data-topbar="colored"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">
            <div class="">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"> Search Student Details </h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                            <li class="breadcrumb-item active">  Search Student Details</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--<div class="row">-->
                        <!--    <div class="col-12">-->
                        <!--        <div class="card">-->
                        <!--            <div class="card-body">-->
                                        <!--<form id="form-data">-->
                                                      
                                        <!--         <div class="row mt-3">-->
                                        <!--            <label class="form-label mt-1 col-md-3" for="username" style="font-size: 18px;">Enter Your Mis Number.</label>-->
                                        <!--            <div class="col-md-3">-->
                                        <!--                <input type="text" class="form-control" id="student_id" placeholder="Please Enter Your NIC or Mis Number." name="student_id" style="margin-bottom:20px;">-->
                                        <!--            </div>-->
                                        <!--             <div class="col-md-3" hidden>-->
                                        <!--                <input type="text" class="form-control" id="certificate" placeholder="Please Enter certificate Number." name="certificate" style="margin-bottom:20px;">-->
                                        <!--            </div>-->
                                        <!--            <div class="col-md-3 " style="display: flex;">-->
                                        <!--                <button class="btn btn-primary w-sm waves-effect waves-light me-1" type="button" id="show-results" style="height: 40px;">Show Results</button>-->
                                        <!--                <button class="btn btn-warning w-sm waves-effect waves-light" type="button" id="reset" style="height: 40px;">Reset</button>-->
                                        <!--            </div>-->
                                        <!--        </div>-->
                                                 
                                        <!--</form>-->

                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div> <!-- end col -->-->
                        <!--</div>-->
                        <div class="row"> 
                            <div class="col-12">
                               
                                <h4 class="card-title">Manage Exam</h4>
                                <div class="row">
                                    
                                     <div class="card">
                                    <div class="card-body">
                                        
                                    <div class="  mt-5">
                                        <div class="col-lg-1"></div>
                                        <div class="col-lg-10">
                                            <div class="result-section ">
                                                <table>
                                                    <tr>
                                                        <th>Student ID:</th>
                                                        <td id="student-no"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Name:</th>
                                                        <td id="student-name"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Course ID:</th>
                                                        <td id="course-id"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Course Name:</th>
                                                        <td id="course-name"></td>
                                                    </tr>
                                                      <tr hidden>
                                                        <th>Center Name:</th>
                                                        <td id="center-name"></td>
                                                    </tr>
                                                    <tr hidden>
                                                        <th>Exam Participant:</th>
                                                        <td id="is_exam" class="text-danger"></td>
                                                    </tr>  
                                                    <tr hidden>
                                                        <th>Register Year & Batch:</th>
                                                        <td id="year-batch"></td>
                                                    </tr>
                                                     <tr hidden>
                                                        <th> Exam Year & Batch: </th>
                                                        <td id="exam_participant_year_batch"></td>
                                                    </tr>
                                                    <tr class="practical-mark-section" hidden>
                                                        <th>Practical Mark:</th>
                                                        <td id="practical-mark"></td>
                                                    </tr>
                                                    <tr class="theory-mark-section" hidden>
                                                        <th>Theory Mark:</th>
                                                        <td id="theory-grade"></td>
                                                    </tr>
                                                    <tr class="mcq-mark-section" hidden>
                                                        <th>MCQ Mark:</th>
                                                        <td id="mcq-grade"></td>
                                                    </tr>
                                                    <tr hidden>
                                                        <th>Avarage:</th>
                                                        <td id="avarage"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Final Grade:</th>
                                                        <td id="grade"></td>
                                                    </tr>
                                                     <tr hidden>
                                                        <th>  Certificate No:</th>
                                                        <td id="certificate_no"></td>
                                                    </tr>
                                                </table>
                                                <p class="text-center mt-3 mb-0">Please note that this online result is provisional and should not be used as an official confirmation or a certification.</p>
                                                <p class="text-center mt-1">Copyright @ <?= date('Y') ?> - National Youth Services Council - Sri Lanka</p>
                                            </div>
                                        </div>

                                </div> <!-- end col -->
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
        
        <script src="ajax/js/results.js" type="text/javascript"></script>
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