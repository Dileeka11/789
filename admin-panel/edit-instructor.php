<?php
include '../class/include.php';
include './auth.php';

$id = '';
$id = $_GET['id'];
$USER = new User($id);
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Instructor | Youth Service LTD </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
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
                                        <li class="breadcrumb-item"><a href="create-instructors.php">Instructors</a></li>
                                        <li class="breadcrumb-item active">Edit</li>
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

                                    <h4 class="card-title">Edit Instructor</h4>
                                    <form id="form-data">
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Full Name</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="name" name="name" placeholder="Enter full name" value="<?php echo $USER->name ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">User Name</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="url" id="username" name="username" placeholder="Enter username" value="<?php echo $USER->username ?>">
                                            </div>
                                        </div>


                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Email</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="email" name="email" placeholder="Enter Email address" value="<?php echo $USER->email ?>">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Phone</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="phone" name="phone" placeholder="Enter the Phone number" value="<?php echo $USER->phone ?>">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Center</label>
                                            <div class="col-md-10">
                                                <select class="form-select mb-3 " id="center_id" name="center_id" autocomplete="off" required="">
                                                    <option selected="" value=""> -- Select Center -- </option>
                                                    <?php
                                                    $CENTER = new Centers(NULL);
                                                    foreach ($CENTER->all() as $center) {
                                                        if ($center['centercode'] == $USER->center_id) {
                                                    ?>
                                                            <option selected="" value="<?php echo $center['centercode'] ?>"> <?php echo $center['center_name'] ?> </option>

                                                        <?php } else { ?>
                                                            <option value="<?php echo $center['centercode'] ?>"> <?php echo $center['center_name'] ?> </option>
                                                    <?php
                                                        }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Course/(s)</label>
                                            <div class="col-md-10">
                                                <select class="form-control select2" name="courses[]" id="courses" multiple="multiple">
                                                    <option value="">-- Select Courses -- </option>
                                                    <?php
                                                    $COURSES = new Course(NULL);
                                                    foreach ($COURSES->all() as $course) {
                                                        $INSTRUCTOR_COURSES = new InstructorCourses(null);
                                                        $courses = $INSTRUCTOR_COURSES->getInstructorCourses($USER->id);
                                                        $selected = '';
                                                        foreach (unserialize($courses['courses']) as $course_id) {
                                                            if ($course_id == $course['courseid']) {
                                                                $selected = 'selected';
                                                                break;
                                                            }
                                                        }


                                                    ?>
                                                        <option value="<?= $course['courseid'] ?>" <?= $selected ?>><?= $course['courseid'] . ' - ' . $course['cname'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">If Paper Instructor</label>
                                            <div class="col-md-10">
                                                <select class="form-select mb-3 " id="paper_instructor" name="paper_instructor" autocomplete="off" required="">
                                                    <option selected="" value=""> -- Select Status -- </option>
                                                    <?php
                                                    if ($USER->isActive == 1) {
                                                    ?>
                                                        <option value="1" selected=""> Paper Instructor </option>
                                                        <option value="0">Not Paper Instructor </option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="1"> Paper Instructor </option>
                                                        <option value="0" selected="">Not Paper Instructor </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-12" style="display: flex; justify-content: flex-end;margin-top: 15px;">
                                                <button class="btn btn-primary " type="submit" id="update">Update</button>

                                            </div>
                                            <input type="hidden" name="update">
                                            <input type="hidden" name="id" value='<?php echo $id ?>'>

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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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


    <script src="assets/libs/select2/js/select2.min.js"></script>

    <!-- init js -->

    <script src="assets/js/pages/form-advanced.init.js"></script>
    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <!-- Datatable init js -->
    <script src="assets/js/pages/datatables.init.js"></script>
    <script src="ajax/js/instructor.js" type="text/javascript"></script>
    <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>

</body>

</html>