<?php
include '../class/include.php';
include './auth.php';

date_default_timezone_set('Asia/Colombo');
$createdAt = date('Y-m-d H:i:s');

$USER = new User($_SESSION['id']);

 
?>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Submit Document | Sl Youth </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- plugin css -->
        <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet" type="text/css">
        <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/libs/@chenfengyuan/datepicker/datepicker.min.css">

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
                                                <li class="breadcrumb-item active">Submit Latter</li>
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
                                                    <label for="example-search-input" class="col-md-2 col-form-label">Select Latter Type</label>
                                                    <div class="col-md-10">
                                                        <select class="form-control  " name="type" id="type">
                                                            <option value="">-- Select Latter Type -- </option>

                                                            <option value="1"> Division Throught </option>
                                                            <option value="2"> Send Other Division</option>
                                                            <option value="3"> Division Throught and Other Divisions </option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">Latter Title  </label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="text" placeholder="Enter Latter Title" name="title" id="title">
                                                    </div>
                                                </div>



                                                <div class="mb-3 row  hidden " id="position_bar">
                                                    <label for="example-search-input" class="col-md-2 col-form-label">Select Divisions Position  </label>
                                                    <div class="col-md-10">
                                                        <select class="form-control " name="send_position" id="position">
                                                            <option value="">-- Select Divisions Position -- </option>
                                                            <?php
                                                            $DIVISION_POSITIONS = new DivisionPositions(NULL);
                                                            foreach ($DIVISION_POSITIONS->getPositionByDivision($USER->division) as $key => $division_position) {
                                                                $POSITIONS = new Positions($division_position['position_id']);
                                                                $key++;
                                                                ?>
                                                                <option value="<?php echo $POSITIONS->id; ?>"><?php echo $POSITIONS->name . ' - ( ' . $division_position['name'] . ' )'; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row hidden" id="send_divisions">
                                                    <label for="example-search-input" class="col-md-2 col-form-label">Select Send Divisions  </label>
                                                    <div class="col-md-10">
                                                        <select class="form-control  " name="send_division" id="send_division">
                                                            <option value="">-- Select Send Division -- </option>
                                                            <?php
                                                            $DIVISION = new Divisions(NULL);
                                                            foreach ($DIVISION->all() as $key => $division) {

                                                                if ($id == $division['id']) {
                                                                    ?>
                                                                <?php } else {
                                                                    ?>
                                                                    <option value="<?php echo $division['id']; ?>" ><?php echo $division['name']; ?></option>

                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row " >
                                                    <label for="example-search-input" class="col-md-2 col-form-label">Select  Copy Divisions</label>
                                                    <div class="col-md-10">
                                                        <select class="select2 form-control select2-multiple"  name="copy_divisions" multiple="multiple" data-placeholder="Choose ...">
                                                            <option value="">-- Select Copy Divisions -- </option>
                                                            <?php
                                                            foreach ($DIVISION->all() as $key => $division) {
                                                                $key++;
                                                                if ($id == $division['id']) {
                                                                    ?>
                                                                <?php } else {
                                                                    ?>
                                                                    <option value="<?php echo $division['id']; ?>" ><?php echo $division['name']; ?></option>


                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>

                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">Attach Document <span class="text-danger">(PDF Only)</span> </label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="file" placeholder="Enter course name" name="document" id="document">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">Submit Date and Time  </label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="text"  readonly="" name="submit_date" id="submit_date" value="<?php echo $createdAt ?>">
                                                    </div>
                                                </div>


                                                <div class="mb-3 row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">Add Your Minit</label>
                                                    <div class="col-md-10">
                                                        <textarea class="form-control question" id="minit" name="minit">  </textarea>

                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-12" style="display: flex; justify-content: flex-end;margin-top: 15px;">
                                                        <button class="btn btn-primary " type="submit" id="create">Submit</button>

                                                    </div>
                                                    <input type="hidden" name="create">
                                                    <input type="hidden" name="submit_division_id" value="<?php echo $USER->division ?>">
                                                    <input type="hidden" name="position_id" value="<?php echo $USER->position ?>">

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


        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->

        <!-- /Right-bar -->

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

        <!-- plugins -->
        <script src="assets/libs/select2/js/select2.min.js"></script>
        <script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
        <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="assets/libs/@chenfengyuan/datepicker/datepicker.min.js"></script>
        <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>

        <!-- init js -->
        <script src="assets/js/pages/form-advanced.init.js"></script>
        ////////////////////////////
        <script src="ajax/js/submit-document.js" type="text/javascript"></script>
        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>
</html>
