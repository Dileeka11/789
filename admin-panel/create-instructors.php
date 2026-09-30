<?php
include '../class/include.php';
include './auth.php';
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Instructor | National Youth Service Council </title>
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
    <style>
        .assign-student-section .select2 {
            width: 100% !important;
        }

        .dt-button {
            padding: 10px 20px 10px 20px;
            margin-bottom: 20px;
            color: white;
            background-color: #28a745;
            border-radius: 5px;
        }
    </style>
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
                                        <li class="breadcrumb-item active">Instructor</li>
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

                                    <h4 class="card-title">Add Instructor</h4>
                                    <form id="form-data">
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Full Name</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="name" name="name" placeholder="Enter full name">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">User Name</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="url" id="username" name="username" placeholder="Enter username">
                                            </div>
                                        </div>




                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Email</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="email" name="email" placeholder="Enter Email address">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Phone</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="phone" name="phone" placeholder="Enter the Phone number">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Course(s)</label>
                                            <div class="col-md-10">
                                                <select class="form-control select2" name="courses[]" id="courses" multiple="multiple">
                                                    <option value="">-- Select Courses -- </option>
                                                    <?php
                                                    $COURSES = new Course(NULL);
                                                    foreach ($COURSES->all() as $course) {
                                                    ?>
                                                        <option value="<?= $course['courseid'] ?>"><?= $course['courseid'] . ' - ' . $course['cname'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Center</label>
                                            <div class="col-md-10">
                                                <select class="form-control select2" name="center" id="center">
                                                    <option value="">-- Select Center -- </option>
                                                    <?php
                                                    $CENTER = new Centers(NULL);
                                                    foreach ($CENTER->all() as $center) {
                                                    ?>
                                                        <option value="<?= $center['centercode'] ?>"><?= $center['centercode'] . ' - ' . $center['center_name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Password</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="password" id="password" name="password" placeholder="Enter password">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12" style="display: flex; justify-content: flex-end;margin-top: 15px;">
                                                <button class="btn btn-primary " type="submit" id="create">Create</button>

                                            </div>
                                            <input type="hidden" name="create">

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Manage Instructors</h4>


                                    <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="students-table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Center</th>
                                                <th>Courses</th>
                                                <th>Mobile Number</th>
                                                <th>Status</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            $USER = new user(NULL);

                                            foreach ($USER->getInstructors() as $user) {
                                                $INSTRUCTOR_COURSES = new InstructorCourses(null);
                                                $course_list = '';
                                                $courses = $INSTRUCTOR_COURSES->getInstructorCourses($user['id']);
                                                foreach (unserialize($courses['courses']) as $course_id) {
                                                    $COURSE = new Course($course_id);
                                                    if ($course_list == '') {
                                                        $course_list = $COURSE->courseid . ' - ' . $COURSE->cname;
                                                    } else {
                                                        $course_list .= ', ' . $COURSE->courseid . ' - ' . $COURSE->cname;
                                                    }
                                                }

                                            ?>
                                                <tr>
                                                    <td><?= $user['name'] ?></td>
                                                    <td><?= $user['email'] ?></td>
                                                    <td><?php
                                                        $CENTER = new Centers($user['center_id']);
                                                        echo $CENTER->center_name;
                                                        ?></td>
                                                    <td><?= $course_list ?></td>
                                                    <td><?= $user['phone'] ?></td>
                                                    <td><?= $user['isActive'] == 1 ? "Active" : "Blocked" ?></td>
                                                    <td>
                                                        <a href="edit-instructor.php?id=<?php echo $user['id'] ?>">
                                                            <div class="badge bg-pill bg-soft-info font-size-14" type="button"><i class="fas fa-pencil-alt p-1"></i></div>
                                                        </a> |
                                                        <div class="badge bg-pill bg-soft-<?= $user['isActive'] == 1 ? "danger" : "success" ?> font-size-14 update-instructor-status " data-id="<?= $user['id'] ?>" status="<?= $user['isActive'] == 1 ? 0 : 1 ?>" type="button" title="<?= $user['isActive'] == 1 ? "Block" : "Unblock" ?> Instructor "><i class=" bx bx-<?= $user['isActive'] == 1 ? "x" : "check" ?>  p-1"></i></div> |
                                                        <a href="update-password.php?id=<?php echo $user['id'] ?>">
                                                            <div class="badge bg-pill bg-soft-warning font-size-14" type="button"><i class=" bx bx-lock  p-1"></i></div>
                                                        </a>
                                                        |
                                                        <?php
                                                        if ($user['isActive'] == 1) {
                                                        ?>
                                                            <a href="manage-exam-period.php?id=<?php echo $user['id'] ?>">
                                                                <div class="badge bg-pill bg-soft-primary font-size-14" type="button" title="View Papers"><i class=" bx bx-award  p-1"></i></div>
                                                            </a>
                                                            |
                                                        <?php
                                                        }
                                                        ?>
                                                        <div class="badge bg-pill bg-soft-danger font-size-14 instructor " data-id="<?php echo $user['id'] ?>" type="button" title="Delete "><i class=" bx bx-trash  p-1"></i></div>

                                                    </td>
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
    ///////////////////
    <script src="ajax/js/instructor.js" type="text/javascript"></script>
    <script src="delete/js/instructor.js" type="text/javascript"></script>
    <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>
    <!-- init js -->
    <script src="assets/js/pages/form-advanced.init.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>



    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

    <script>
        $(document).ready(function() {
            // $('#students-table').DataTable({
            //     dom: 'Bfrtip',
            //     buttons: [
            //         'copy', 'csv', 'excel', 'pdf', 'print'
            //     ]
            // });
            var empDataTable = $('#students-table').DataTable({
                dom: 'Blfrtip',
                buttons: [{
                    extend: 'excel',
                    exportOptions: {
                        // columns: [0, 1] // Column index which needs to export
                    }
                }]

            });
        });
    </script>


</body>

</html>