<?php
include '../class/include.php';
include './auth.php';

$id = '';
$id = base64_decode($_GET['id']);
$APPLICATION = New Applications($id);
?>
<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>View Application - Sri Lanka Youth </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- DataTables -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Dashboard</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                            <li class="breadcrumb-item active">View Application</li>
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

                                        <h4 class="card-title">Add User</h4>
                                        <form id="form-data">
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Full Name</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" id="name" name="name" placeholder="Enter full name" value="<?php echo $APPLICATION->full_name ?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">NIC Number</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="url" id="username" name="username" value="<?php echo $APPLICATION->nic?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Address </label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="url" id="username" name="username" value="<?php echo $APPLICATION->address?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">District</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="url" id="username" name="username" value="<?php 
                                                    $DISTRICT = new Districts($APPLICATION->district_id);
                                                    echo $DISTRICT->name ?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Division Name</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="url" id="username" name="username" value="<?php 
                                                    $DSDIVISION = new Dsdivision($APPLICATION->divisional_id);
                                                    echo $DSDIVISION->name ?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Gn Name</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="url" id="username" name="username" value="<?php
                                                    $GNDIVISION = new Gndivision($APPLICATION->gn_id);
                                                    echo $GNDIVISION->name ?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Education Level</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="url" id="username" name="username" value="<?php echo $APPLICATION->education_level?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Email Address</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="url" id="username" name="username" value="<?php echo $APPLICATION->email?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Mobile Number</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="url" id="username" name="username" value="<?php echo $APPLICATION->mobile_number?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Gender</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="url" id="username" name="username" value="<?php echo $APPLICATION->gender?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Birth Date</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="url" id="username" name="username" value="<?php echo $APPLICATION->birth_date?>">
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3 row hidden" id="center_name_section" >
                                                <label for="example-search-input" class="col-md-2 col-form-label"> Center Name</label>
                                                <div class="col-md-10">
                                                    <select class="form-control" name="center_id" id="center_id">
                                                        <option value="0">-- Select Center Name -- </option>
                                                        <?php
                                                        $CENTERS = new Centers(NULL);
                                                        foreach ($CENTERS->all() as $centers) {
                                                            ?>
                                                            <option value="<?php echo $centers['centercode'] ?>"><?php echo $centers['center_name'] ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
 
 
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>


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
        <!-- Buttons examples -->
        <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="assets/libs/jszip/jszip.min.js"></script>
        <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

        <!-- Responsive examples -->
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <!-- Datatable init js -->
        <script src="assets/js/pages/datatables.init.js"></script>
        <script src="ajax/js/user.js" type="text/javascript"></script>
        <script src="delete/js/schedule-exam.js" type="text/javascript"></script>
        <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>
        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>

</html>