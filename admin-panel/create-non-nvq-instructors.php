<?php
include '../class/include.php';
include './auth.php';
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Non NVQ Course - Instructor Details | National Youth Service Council </title>
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

        .inline-edit-input {
            min-width: 130px;
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
                                <h4 class="mb-0">Non NVQ Course - Instructor Details</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Course &amp; Instructor Details</li>
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

                                    <h4 class="card-title">Add Course &amp; Instructor</h4>
                                    <form id="form-data">
                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-form-label">Training Center</label>
                                            <div class="col-md-10">
                                                <select class="form-control select2" name="centercode" id="centercode">
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
                                            <label class="col-md-2 col-form-label">Course Name (Non NVQ)</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="course_name" name="course_name" placeholder="Enter course name">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-form-label">Instructor Name</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="instructor_name" name="instructor_name" placeholder="Enter instructor name">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-form-label">Instructor Tel. No</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="instructor_tel" name="instructor_tel" placeholder="Enter telephone number">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-form-label">Service Details / Category</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="service_details" name="service_details" placeholder="Enter service details / category">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-form-label">Start Date</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="date" id="start_date" name="start_date">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-form-label">End Date</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="date" id="end_date" name="end_date">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-form-label">Status</label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="status" id="status">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12" style="display: flex; justify-content: flex-end;margin-top: 15px;">
                                                <button class="btn btn-primary " type="submit" id="create">Save</button>
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

                                    <h4 class="card-title">Manage Course &amp; Instructor Details</h4>


                                    <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="non-nvq-table">
                                        <thead>
                                            <tr>
                                                <th>Centre</th>
                                                <th>Course (Non NVQ)</th>
                                                <th>Instructor Name</th>
                                                <th>Instructor Tel. No</th>
                                                <th>Service Details</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Active / Inactive</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $NON_NVQ = new NonNvqInstructor(NULL);
                                            foreach ($NON_NVQ->all() as $row) {
                                                $CENTER = new Centers($row['centercode']);
                                            ?>
                                                <tr id="row-<?= $row['id'] ?>">
                                                    <td><?= $row['centercode'] . ' - ' . $CENTER->center_name ?></td>
                                                    <td><?= htmlspecialchars($row['course_name']) ?></td>
                                                    <td><?= htmlspecialchars($row['instructor_name']) ?></td>
                                                    <td><?= htmlspecialchars($row['instructor_tel']) ?></td>
                                                    <td><?= htmlspecialchars($row['service_details']) ?></td>
                                                    <td><?= $row['start_date'] ?></td>
                                                    <td>
                                                        <input type="date" class="form-control inline-edit-input update-end-date" data-id="<?= $row['id'] ?>" value="<?= $row['end_date'] ?>">
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-<?= $row['status'] == 1 ? 'success' : 'secondary' ?>" id="status-badge-<?= $row['id'] ?>">
                                                            <?= $row['status'] == 1 ? 'Active' : 'Inactive' ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="badge bg-pill bg-soft-<?= $row['status'] == 1 ? 'danger' : 'success' ?> font-size-14 update-status" data-id="<?= $row['id'] ?>" status="<?= $row['status'] == 1 ? 0 : 1 ?>" type="button" title="<?= $row['status'] == 1 ? 'Set Inactive' : 'Set Active' ?>"><i class="bx bx-<?= $row['status'] == 1 ? 'x' : 'check' ?> p-1"></i></div>
                                                        |
                                                        <div class="badge bg-pill bg-soft-danger font-size-14 delete-non-nvq" data-id="<?= $row['id'] ?>" type="button" title="Delete"><i class="bx bx-trash p-1"></i></div>
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
    <script src="ajax/js/non-nvq-instructor.js" type="text/javascript"></script>
    <script src="delete/js/non-nvq-instructor.js" type="text/javascript"></script>
    <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>
    <!-- init js -->
    <script src="assets/js/pages/form-advanced.init.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <script>
        $(document).ready(function() {
            $('#non-nvq-table').DataTable({
                dom: 'Blfrtip',
                buttons: [{
                    extend: 'excel'
                }]
            });
            $('.select2').select2();
        });
    </script>


</body>

</html>
