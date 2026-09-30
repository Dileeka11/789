<?php
include '../class/include.php';
include './auth.php';
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Exam Period | Youth Service LTD </title>
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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
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
                                        <li class="breadcrumb-item active">Exam Period</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <?php
                    if ($_SESSION['type'] == 1) {
                    ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Add Exam Period</h4>
                                        <form id="form-data">
                                            <div class="mb-3 row">
                                                <label for="example-search-input" class="col-md-2 col-form-label">Year</label>
                                                <div class="col-md-10">
                                                    <select class="form-control select2" name="year" id="year">
                                                        <option value="">-- Select Year -- </option>
                                                        <?php
                                                        $current_year = date('Y');
                                                        $current_year = $current_year;
                                                        for ($i = 0; $i < 20; $i++) {
                                                            $year = $current_year - $i;
                                                        ?>
                                                            <option value="<?= $year ?>"> <?= $year ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-search-input" class="col-md-2 col-form-label">Batch</label>
                                                <div class="col-md-10">
                                                    <select class="form-control select2" name="batch" id="batch">
                                                        <option value="">-- Select Batch -- </option>
                                                        <?php
                                                        $DEFULT_DATA = new DefaultData();
                                                        foreach ($DEFULT_DATA->CourseBatch() as $key => $batch) {
                                                        ?>
                                                            <option value="<?= $key ?>"><?= $batch ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label"> Batch Start Date</label>
                                                <div class="col-md-10">
                                                    <input class="form-control datepicker" type="text" id="batch_start_date" name="batch_start_date" placeholder="Enter  Batch Start Date">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label"> Batch end Date</label>
                                                <div class="col-md-10">
                                                    <input class="form-control  " type="text" id="batch_end_date" name="batch_end_date" placeholder="Enter  Batch End Date">
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
                    <?php
                    }
                    ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title"><?= $_SESSION['type'] == 1 ? 'Manage ' : '' ?>Exam Period</h4>


                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>

                                                <th>Year</th>
                                                <th>Batch</th>
                                                <th>Batch Duration</th>
                                                <th>Certificate Issued Date</th>
                                                <th>All Printable Certificates</th>
                                                <th>Printed Certificates</th>
                                                <th >Available </th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            $EXAMPERIOD = new ExamPeriod(NULL);
                                            foreach ($EXAMPERIOD->all() as $key => $period) {
                                                $key++;
                                                $EXAM_STUDENTS = new ExamStudent(null);
                                                $passed_students = $EXAM_STUDENTS->getPassedStudentsCountByYearAndBatchNewOne($period['year'], $period['batch']);
                                                $available_qr = ($period['certificate_count'] - $period['printed_count']);
                                            ?>
                                                <tr>
                                                    <td><?= $key ?></td>
                                                    <td><?= $period['year'] ?></td>
                                                    <td><?= $period['batch'] ?></td>
                                                    <td><?= $period['batch_start_date'] . ' - ' . $period['batch_end_date'] ?></td>
                                                    <td><?= $period['certificate_issued_date']    ?></td>
                                                    <td><?= count($passed_students);    ?></td>
                                                    <td><?= $period['printed_count'];    ?></td> 
<td><?= count($passed_students) - $period['printed_count']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($_SESSION['type'] == 1) {
                                                        ?>
                                                            <a href="edit-exam-period.php?id=<?= $period['id'] ?>">
                                                                <div class="badge bg-pill bg-soft-primary font-size-14" type="button"><i class="fas fa-pencil-alt p-1"></i></div>
                                                            </a>
                                                            |
                                                            <a href="manage-actions-table.php?id=<?= $period['id'] ?>">
                                                                <div class="badge bg-pill bg-soft-warning font-size-14 action" data-id="<?php echo $id ?>" type="button"><i class="fa fa-toggle-on  p-1"></i></div>
                                                            </a>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <a href="manage-instructor-courses.php?id=<?= $period['id'] ?>">
                                                                <div class="badge bg-pill bg-soft-success font-size-14" type="button"><i class="fas fa-eye p-1"></i></div>
                                                            </a>
                                                        <?php
                                                        }
                                                        ?>
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
    <script src="ajax/js/exam-period.js" type="text/javascript"></script>
    <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>
    <!-- init js -->
    <script src="assets/js/pages/form-advanced.init.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <script>
        $(document).ready(function() {
            $(".datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
            });
        });
    </script>
</body>

</html>