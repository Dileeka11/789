<?php
include '../class/include.php';
include './auth.php';
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Create Courses | Sri Lanka Youth</title>
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
                                        <li class="breadcrumb-item active">Create Courses</li>
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

                                    <h4 class="card-title">Add Courses</h4>
                                    <form id="form-data">
                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Select Course Trade</label>
                                            <div class="col-md-10">
                                                <select class="form-control select2" name="tradecode" id="coursetrade">
                                                    <option value="">-- Select Course Trade -- </option>
                                                    <?php
                                                    $COURSE_TRADE = new CourseTrade(NULL);
                                                    foreach ($COURSE_TRADE->all() as $course_trade) {
                                                    ?>
                                                        <option value="<?php echo $course_trade['id'] ?>"> <?php echo $course_trade['trade_name'] . ' - Trade Code : ' . $course_trade['trade_code'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Course Name</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" placeholder="Enter course name" name="cname" id="cname">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Course ID </label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="courseid" name="courseid" placeholder="Course id">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Select Course Level</label>
                                            <div class="col-md-10">
                                                <select class="form-control select2" name="level" id="level">
                                                    <option value="">-- Select Course Level -- </option>
                                                    <?php
                                                    $DEFUL_DATA = new DefaultData();
                                                    foreach ($DEFUL_DATA->CourseLevel() as $key => $level) {
                                                    ?>
                                                        <option value="<?php echo $key ?>"><?php echo $level ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Select Course Type</label>
                                            <div class="col-md-10">
                                                <select class="form-control select2" name="fullpart" id="fullpart">
                                                    <option value="">-- Select Course Type -- </option>
                                                    <?php
                                                    foreach ($DEFUL_DATA->CourseType() as $key => $type) {
                                                    ?>
                                                        <option value="<?php echo $key ?>"><?php echo $type ?></option>
                                                    <?php } ?>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Select Course Duration</label>
                                            <div class="col-md-10">
                                                <select class="form-control select2" name="durationm" id="durationm">
                                                    <option value="">-- Select Course Duration -- </option>
                                                    <?php
                                                    foreach ($DEFUL_DATA->CourseDuration() as $key => $duration) {
                                                    ?>
                                                        <option value="<?php echo $key ?>"><?php echo $duration ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Select NVQ level</label>
                                            <div class="col-md-10">
                                                <select class="form-control select2" name="nvqnon" id="nvqnon">
                                                    <option value="">-- Select Course NVQ level -- </option>
                                                    <?php
                                                    foreach ($DEFUL_DATA->nvqLevel() as $key => $nvq_level) {
                                                    ?>
                                                        <option value="<?php echo $key ?>"><?php echo $nvq_level ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>



                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Select Language</label>
                                            <div class="col-md-3 mt-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="formCheck1" name="sinhala_lang" value="1">
                                                    <label class="form-check-label" for="formCheck1">
                                                        Sinhala Language
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mt-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="english_lang" value="1" id="formCheck2">
                                                    <label class="form-check-label" for="formCheck2">
                                                        English Language
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mt-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="tamil_lang" value="1" id="formCheck3">
                                                    <label class="form-check-label" for="formCheck3">
                                                        Tamil Language
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Exam Paper Qu Count</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="number" step="5" min="0" id="qu_count" name="qu_count" placeholder="Exam Paper Qu Count" value="">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <h4>Course Modules</h4>
                                            <div class="module-section">

                                                <div class="mb-3 row">
                                                    <label for="example-url-input" class="col-md-2 col-form-label">Module 1 </label>
                                                    <label for="example-url-input" class="col-md-1 col-form-label">Module</label>
                                                    <div class="col-md-4 mt-2">
                                                        <div class="form-check">
                                                            <input class="form-control" type="text" placeholder="Enter module name" name="module_name_1" id="module-name-1" value="">
                                                        </div>
                                                    </div>
                                                    <label for="example-url-input" class="col-md-1 col-form-label">Code</label>
                                                    <div class="col-md-4 mt-2">
                                                        <div class="form-check">
                                                            <input class="form-control" type="text" placeholder="Enter module code" name="module_code_1" id="module-code-1" value="">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-12" style="display: flex; justify-content: flex-start;margin-top: 15px;">
                                                <input type="hidden" id="row-count" name="row_count" value="1" />
                                                <button class="btn btn-success " type="button" id="add-row">Add Row</button>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12" style="display: flex; justify-content: flex-end;margin-top: 15px;">
                                                <button class="btn btn-primary " type="submit" id="create">Create</button>

                                            </div>
                                            <input type="hidden" name="create">
                                            <input type="hidden" name="id" value="<?php $id ?>">

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
    <script src="assets/libs/select2/js/select2.min.js"></script>

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
    <script src="ajax/js/course.js" type="text/javascript"></script>
    <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>
    <!-- App js -->
    <script src="assets/js/pages/form-advanced.init.js"></script>
    <script src="assets/js/app.js"></script>

</body>

</html>