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
                                <h4 class="mb-0">Enter Student Practical  Marks : - " <?php echo $STUDENT->id . " -  ". $STUDENT->fname." ".$STUDENT->lname ?> " </h4>

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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    
                                     <?php
                                        $EXAM_PERIOD = new ExamPeriod(null);
                                        $RES = $EXAM_PERIOD->getExamPeriodByYearAndBatch($STUDENT->year,$STUDENT->batch);
                                       
                                        if($RES[8] == 0){
                                        ?>
                                        <div class="alert alert-danger" role="alert">
                                      <?php echo $STUDENT->year.' - Batch 0'.$STUDENT->batch ?>       සිසුන්ගේ ප්‍රයෝගික ලකුණු ඇතුලත් කිරිමට ලබා දුන් කාලය අවසන් වී ඇති බව කරුණාවෙන් සලසලකන්න .!               
                        </div>
                                        
                                        <?php }else{ ?>
                                        <!--<p  style="color:red" >පද්ධතිය තාව කාලිකව නවතා ඇත.. වැඩි විස්තර සදහා විභාග අංශය අමතන්න..</p>-->
                                    <form id="form-data" >
                                        <div class=" row">
                                            <div class="col-md-2 ">
                                            </div>
                                            <div class="col-md-10">
                                                <!-- <p class="text-danger"> Please enter the correct marks. If any student absent enter the mark " 0 "</p> -->

                                            </div>
                                        </div>
                                         <p style="color:red"> නම නිවැරදි විය යුතු ආකාරය  උදාහරණ සහිතව: K. G. Gamage Dilshan<br>


(අභ්‍යාස ලාබියාගේ අත්සන් ලේඛණය පරීක්ෂා කර බලා නම් වල වැරදි ඇත්නම් එය නිවැරදි කිරීමට කටයුතු කරන්න. 
)<br>
සහතික පතට මෙම නම ඇතුලත් වන බැවින් නම් වලට අදාල කිසිදු වගකිමක්  විභාග අංශය මගින් භාරගනු නොලැබේ. සහතික පත් ප්‍රමදයට  හේතුවද මෙය වේ.  යම් හෙතුවක් මත නව සහතික පතක් නිකුත් කිරිමට සිදු වුව හොත් එයට Rs. 600 ක මුදලක් අයතනය විසින් ගෙවිමට සිදුවන බව තරයේ අවදාරණය කරමි. 
</p>

                                         <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-12 col-form-label"> Student Name</label>
                                                <div class="col-md-11">
                                                    <input class="form-control" type="text" id="nic" name="nic" placeholder="Enter NIC Number" value="<?php echo $STUDENT->fname .' '.$STUDENT->lname  ?>" readonly="">
                                                </div>
                                                <div class="col-md-1">
                                                    <a href="edit-student-profile.php?id=<?php echo $STUDENT->id ?>" target="_blank">
                                                    <div class="btn btn-primary " type="submit"  >Edit </div>
                                                </a>
                                                </div>
                                            </div>
                                        <?php 
                                         
                                       if($is_student_exist['practical_marks'] !=0){
                                        ?>
                                        
                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-12  col-form-label">Enter Student Practical Test Mark <span class="text-danger"> | * Please enter marks out of 100 if final test include practical test. If it's not, please leave it empty (not as 0)</span> </label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="text" id="practical_mark" name="practical_mark" placeholder="Enter Practical Test Mark" min="0" disabled=""  value="<?= isset($is_student_exist) ? ($is_student_exist['practical_grade']!=''?$is_student_exist['practical_marks']:'') : '' ?>">
                                            
                                                
                                            </div>
                                        </div>
                                        <?php }else{ ?>
                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-12  col-form-label">Enter Student Practical Test Mark <span class="text-danger"> | * Please enter marks out of 100 if final test include practical test. If it's not, please leave it empty (not as 0)</span> </label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="text" id="practical_mark" name="practical_mark" placeholder="Enter Practical Test Mark" min="0" value="<?= isset($is_student_exist) ? ($is_student_exist['practical_grade']!=''?$is_student_exist['practical_marks']:'') : '' ?>">
                                            
                                                
                                            </div>
                                        </div>
                                        <?php } ?>
                                        
                                        
                                          <?php 
                                         
                                        if($is_student_exist['practical_marks'] !=0){
                                        ?>
                                        
                                       
                                        <?php }else {?>

 <div class="row">
                                            <div class="col-12" style="display: flex; justify-content: flex-end;margin-top: 15px;">
                                                <button class="btn btn-primary " type="submit" id="update1">Update</button>

                                            </div>
                                            <input type="hidden" name="update1">
                                            <input type="hidden" name="id" value="<?php echo $id ?>">

                                        </div>
                                        <?php } ?>

                                    </form>
<?php } ?>
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