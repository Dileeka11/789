<?php
include '../class/include.php';
include './auth.php';
$id = $_GET['id'];
$center1 = '';
$year1 = '';
$batch1 = '';
if (isset($_GET['center'])) {
    $center1 = $_GET['center'];
}
if (isset($_GET['year'])) {
    $year1 = $_GET['year'];
}
if (isset($_GET['batch'])) {
    $batch1 = $_GET['batch'];
}
$course = Course::getCourseByCourseID($id);

$STUDENT = new Student(NULL);
$students = $STUDENT->getFilteredStudents($id, $center1, $year1, $batch1);
?>
<!doctype html>

<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Manage Students | <?= $course['cname'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="#" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">


    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="plugin/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
     
    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>


<body>

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
                                <h4 class="mb-0">Manage Students - <?= $course['cname'] . ' (' . $course['courseid'] . ')' ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Manage Students</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div>
                                <form id="form-data" class="mb-3" action="manage-students-by-course.php" method="get">
                                    <div class="row">
                                        <div class="mb-3 col-md-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Center</label>
                                            <div class="col-md-10">
                                                <select class="form-control select2" name="center" id="center" data-live-search="">
                                                    <option value="">-- Select the Center -- </option>
                                                    <?php
                                                    $CENTER = new Centers(NULL);
                                                    foreach ($CENTER->all() as $center) {
                                                    ?>
                                                        <option value="<?php echo $center['centercode'] ?>" <?= $center['centercode'] == $center1 ? 'selected' : '' ?>><?php echo $center['centercode'] . ' - ' . $center['center_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3 col-md-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Year</label>
                                            <div class="col-md-10">
                                                <select class="form-control select2" name="year" id="year">
                                                    <option value="">-- Select Year -- </option>
                                                    <?php
                                                    $current_year = date('Y');
                                                    $current_year = $current_year + 2;
                                                    for ($i = 0; $i < 20; $i++) {
                                                        $year = $current_year - $i;
                                                    ?>
                                                        <option value="<?= $year ?>" <?= $year == $year1 ? 'selected' : '' ?>> <?= $year ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Batch</label>
                                            <div class="col-md-10">
                                                <select class="form-control select2" name="batch" id="batch">
                                                    <option value="">-- Select Batch -- </option>
                                                    <option value="1" <?= $batch1 == 1 ? 'selected' : '' ?>>1</option>
                                                    <option value="2" <?= $batch1 == 2 ? 'selected' : '' ?>>2</option>
                                                     <option value="3" <?= $batch1 == 3 ? 'selected' : '' ?>>1</option>
                                                    <option value="4" <?= $batch1 == 4 ? 'selected' : '' ?>>2</option>
                                                        
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-3 row">
                                            <div class="col-12" style="display: flex;">
                                                <input type="hidden" name="id" value="<?= $id ?>">
                                                <button class="btn btn-primary " type="submit">Filter</button>
                                                <a class="btn btn-secondary ms-3" href="manage-students-by-course.php?id=<?= $id ?>">Clear</a>
                                                <?php
                                                if ($center1 != '' && $year1 != '' && $batch1 != '') {
                                                ?>
                                                    <a class="btn btn-success ms-3" href="student-password-list.php?course=<?= $id ?>&center=<?= $center1 ?>&year=<?= $year1 ?>&batch=<?= $batch1 ?>">Password PDF</a>
                                                <?php
                                                }
                                                ?>
                                            </div>

                                        </div>
                                    </div>
                                </form>

                                <div class="table-responsive mb-4">
                                    <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                        <thead>
                                            <tr class="bg-transparent">

                                                <th>No</th>
                                                <th>Student Id</th>
                                                <th>Nic</th>
                                                <th>Name</th>
                                                <th>Center</th>
                                                <th>Year</th>
                                                <th>Batch</th>
                                                <th style="width: 120px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($students as $key => $student) {
                                                $CENTER = new Centers($student['centercode']);
                                                
                                                $key++;
                                            ?>
                                                <tr>
                                                    <td><?= $key ?></td>
                                                    <td><?= $student['id'] ?></td>
                                                    <td><?= $student['nic'] ?></td>
                                                    <td><?= $student['fname'] . ' ' . $student['lname'] ?></td>
                                                    <td><?= $CENTER->center_name ?></td>
                                                    <td><?= $student['year'] ?></td>
                                                    <td><?= $student['batch'] ?></td>


                                                    <td>
                                                        <a href="view-student.php?id=<?php echo $student['id'] ?>" title="View Student">
                                                            <div class="badge bg-pill bg-soft-info font-size-14" type="button"><i class="fas fa-eye  p-1"></i></div>
                                                        </a> | 
                                                        <a href="edit-student.php?id=<?php echo $student['id'] ?>" title="Edit Student">
                                                            <div class="badge bg-pill bg-soft-warning font-size-14" type="button"><i class="fas fa-edit  p-1"></i></div>
                                                        </a>
                                                         |
                                                         <a href="admin-enter-practicall-mark.php?id=<?php echo $student['id'] ?>" title="Enter Practical Mark">
                                                                <div class="badge bg-pill bg-soft-success font-size-14" type="button"><i class="fas fa-book  p-1"></i></div>
                                                            </a>
                                                            |
                                                         <div class="badge bg-pill bg-soft-danger    font-size-14 drop_to_students" data-id="<?php echo $student['id'] ?>" type="button" title="Drop Students"><i class=" bx bx-user-x    p-1"></i></div>
                                                         
                                                        <!--<a href="student-mark.php?id=<?php echo $student['id'] ?>" title="Update Test Marks">-->
                                                        <!--    <div class="badge bg-pill bg-soft-success font-size-14" type="button"><i class="fas fa-book  p-1"></i></div>-->
                                                        <!--</a>-->

                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Minible.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="https://themesbrand.com/" target="_blank" class="text-reset">Themesbrand</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="assets/libs/select2/js/select2.min.js"></script>
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
    <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <!-- App js -->
    <script src="assets/js/pages/form-advanced.init.js"></script>
    <script src="assets/js/app.js"></script>
    
    <script src="ajax/js/student.js" type="text/javascript"></script>


</body>

</html>