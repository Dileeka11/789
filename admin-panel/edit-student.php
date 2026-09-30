<?php
include '../class/include.php';
include './auth.php';

$id = '';
$id = $_GET['id'];

$STUDENT = new Student($id);

$APPLICATIONS = new Applications($STUDENT->application_id);
 
 $USER_ID = new User($_SESSION['id']);

?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Edit Student | Sri Lanka Youth Services</title>

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
    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
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
                                <h4 class="mb-0">Edit Student - <?= $STUDENT->id ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="manage-students-by-course.php?id=<?= $STUDENT->course_id ?>">Students</a></li>
                                        <li class="breadcrumb-item active">Edit Student</li>
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
                                            <label for="example-url-input" class="col-md-2 col-form-label">NIC Number</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="nic" name="nic" placeholder="Enter NIC Number" value="<?php echo $STUDENT->nic ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">First Name</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="fname" name="fname" placeholder="Enter First Name" value="<?php echo $STUDENT->fname ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Last Name</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="lname" name="lname" placeholder="Enter Last Name" value="<?php echo $STUDENT->lname ?>">
                                            </div>
                                        </div>
                                         
                                           <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Address</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="address" name="address" placeholder="Enter the address" value="<?php echo $APPLICATIONS->address ?>">
                                            </div>
                                        </div>
                                          <?php 
                                          
                                          if($USER_ID->type == 1){ 
                                          ?>
                                         <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Course Name </label>
                                            <div class="col-md-10">
                                                 <select class="form-control select2"   data-live-search="">
                                                    <option value="">-- Select the course name -- </option>
                                                   
                                                 <?php
                                                   $COURSE = new Course(NULL);
                                                    foreach ($COURSE->all() as $key => $course) {
                                                      if( $STUDENT->course_id == $course['courseid']  )  {
                                                    ?>
                                                          <option value="<?php echo $course['courseid'] ?> " selected=""> <?php  echo $course['courseid'] . ' - '. $course['cname']   ?></option>
                                                    
                                                    <?php 
                                                    }else {?>
                                                     <option value="<?php echo $course['courseid'] ?> " > <?php  echo $course['courseid'] . ' - '. $course['cname']   ?></option>
                                                     <?php } } ?>
                                                </select>
                                                 
                                            </div>
                                        </div>
                                        <?php }else {?>
                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Course Name </label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text"  placeholder="Enter Last Name" readonly=""   value="<?php 
                                                 $COURSE = new Course($STUDENT->course_id);
                                                echo $COURSE->courseid.' - '.$COURSE->cname ?>">
                                            </div>
                                        </div>
                                        <?php } ?>
                                        
                                        
                                        
                                         <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Center Name </label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text"   placeholder="Enter Last Name" readonly="" value="<?php 
                                                  $CENTER = new Centers($STUDENT->centercode);
                                                echo $CENTER->center_name ?>">
                                            </div>
                                        </div>
                                        
                                         <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Year</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text"   placeholder="Enter Last Name" readonly="" value="<?php echo $STUDENT->year ?>">
                                            </div>
                                        </div>
                                        
                                         <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Batch</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text"   placeholder="Enter Last Name" readonly="" value="<?php echo $STUDENT->batch ?>">
                                            </div>
                                        </div>
                                        
                                         <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Mobile Number</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text"   placeholder="Enter mobile number" id="mobile_number" name="mobile_number" value="<?php echo $APPLICATIONS->mobile_number ?>">
                                            </div>
                                        </div>
                                         <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Whatsapp Number</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text"   placeholder="Enter whatsapp number" id="whatsapp_number" name="whatsapp_number" value="<?php echo $APPLICATIONS->whatsapp_number ?>">
                                            </div>
                                        </div>
                                         <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Email</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text"   placeholder="Enter email address" id="email" name="email"  value="<?php echo $APPLICATIONS->email ?>">
                                            </div>
                                        </div>
                                          <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Gn Division</label>
                                            <div class="col-md-10">
                                                <select class="form-control select2" name="gn_id" id="gn_id" data-live-search="">
                                                    <option value="">-- Select the Gn Division -- </option>
                                                    <?php
                                                    $GNDIVISION = new Gndivision(NULL);
                                                    foreach ($GNDIVISION->GetGnByDsdivision($APPLICATIONS->divisional_id) as $gn_division) {
                                                    ?>
                                                        <option value="<?php echo $gn_division['id'] ?>" <?= $gn_division['id'] == $APPLICATIONS->gn_id ? 'selected' : '' ?>><?php echo   $gn_division['name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-12" style="display: flex; justify-content: flex-end;margin-top: 15px;">
                                                <button class="btn btn-primary " type="submit" id="update">Update</button>
                                            </div>
                                            <input type="hidden" name="update">
                                            <input type="hidden" name="id" value="<?php echo $id ?>"> 
                                            <input type="hidden" name="application_id" value="<?php echo $STUDENT->application_id ?>">

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
    <script src="assets/libs/select2/js/select2.min.js"></script>

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
    <script src="ajax/js/student.js" type="text/javascript"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>

    <script src="assets/js/pages/form-advanced.init.js"></script>
    <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>


    <!-- App js -->


</body>

</html>