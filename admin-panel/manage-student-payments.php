<?php
include '../class/include.php';
include './auth.php';

$id = '';
$id = base64_decode($_GET['id']);
 

$STUDENT = new Student($id);
$COURSE = new Course($STUDENT->course_id);
$COURSE_REQUEST = new CourseRequest($STUDENT->request_course_id);

$STUDENT_PAYMENT = new StudentPayment(NULL);

date_default_timezone_set('Asia/Colombo');
$createdAt = date('Y-m-d H:i:s');
?>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title> Manage Student Payments - Sri Lanka Youth </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content=" " name="author" />
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

                                            <div class="mb-3 row">
                                                <label for="example-search-input" class="col-md-2 col-form-label">Student MIS No</label>
                                                <div class="col-md-10">
                                                    <input class="form-control  " type="text" value="<?php echo $STUDENT->id ?>"  readonly="">

                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="example-search-input" class="col-md-2 col-form-label">Student NIC No</label>
                                                <div class="col-md-10">
                                                    <input class="form-control  " type="text" value="<?php echo $STUDENT->nic ?>"  readonly="">

                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="example-search-input" class="col-md-2 col-form-label">Student Full Name</label>
                                                <div class="col-md-10">
                                                    <input class="form-control  " type="text" value="<?php echo $STUDENT->fname . ' ' . $STUDENT->lname ?>"  readonly="">

                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-search-input" class="col-md-2 col-form-label">Course Name</label>
                                                <div class="col-md-10">
                                                    <input class="form-control  " type="text" value="<?php echo $COURSE->cname ?>"  readonly="">

                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-search-input" class="col-md-2 col-form-label">Year & Batch</label>
                                                <div class="col-md-10">
                                                    <input class="form-control  " type="text" value="<?php echo $STUDENT->year . ' - Batch 0' . $STUDENT->batch ?>"  readonly="">

                                                </div>
                                            </div> 

                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label text-danger">Course Fee</label>
                                                <div class="col-md-10">
                                                    <input class="form-control  " type="text"   value="<?php echo number_format($COURSE_REQUEST->course_fee, 2) ?>" readonly="">
                                                    <input class="form-control  " type="hidden" id="course_fee" name="course_fee" value="<?php echo $COURSE_REQUEST->course_fee ?>" readonly="">
                                                </div>
                                            </div>                                        

                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label text-warning">Paid Amount</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text"  placeholder="All Paid amount" readonly="" value="<?php echo number_format($STUDENT_PAYMENT->getPayedAmountByStudent($id), 2) ?>">
                                                    <input class="form-control" type="hidden" id="paid_amount" name="paid_amount" placeholder="All Paid amount" readonly="" value="<?php echo $STUDENT_PAYMENT->getPayedAmountByStudent($id) ?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label text-danger">Payble Amount</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" id="name" name="name" placeholder="Enter Branch Name" readonly="" value="<?php echo number_format($COURSE_REQUEST->course_fee - $STUDENT_PAYMENT->getPayedAmountByStudent($id), 2) ?>">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Payment Date and Time</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" id="date" name="date" placeholder="Enter Branch Name" value="<?php echo $createdAt ?>" readonly="">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Course Payment</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" id="amount" name="amount" placeholder="Enter course payment amount">
                                                </div>
                                            </div>
 
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Registration Amount</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" id="reg_amount" name="reg_amount" placeholder="Enter registration amount">
                                                </div>
                                            </div>
                                            
                                           
                                            
                                            <div class="row">
                                                <div class="col-12" style="display: flex; justify-content: flex-end;margin-top: 15px;">
                                                    <button class="btn btn-primary " type="submit" id="payment">Payment</button>
                                                </div>
                                                <input type="hidden" name="payment_now">
                                                <input type="hidden" name="student_id" value="<?php echo $id ?>">

                                            </div>
                                        </form>

                                    </div>
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
                                                            <th>Payment Amount</th> 
                                                            <th>Payment Date</th>  
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $STUDENT_PAYMENT = new StudentPayment(NULL);
                                                        foreach ($STUDENT_PAYMENT->getStudentPayment($id) as $key => $student_payment) {
                                                            $key++;
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $key ?></td>                                                                         
                                                                    <td>Rs: <?php echo number_format($student_payment['payment_amount'], 2);
                                                                        if($student_payment['reg_amount'] != 0){
                                                                          echo  ' - Registration Amount : ' . number_format($student_payment['reg_amount'],2);
                                                                        }else{
                                                                            
                                                                        }
                                                                        ?>
                                                                </td>
                                                                <td><?php echo $student_payment['payment_date'] ?></td>

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
//////////////////////////////////////
<script src="ajax/js/student.js" type="text/javascript"></script>

<!-- init js -->
<script src="assets/js/pages/form-advanced.init.js"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>

</body>

</html>