<?php
include '../class/include.php';
include './auth.php';
$course_id = $_GET['course'];
$center_id = $_GET['center'];
$year = $_GET['year'];
$batch = $_GET['batch'];
$COURSE = new Course($course_id);
$CENTER = new Centers($center_id);

$HELPER = new Helper(NULL);
$STUDENT = new Student(NULL);
$students = $STUDENT->getStudentsByCourseAndCenterWithoutDropOut($course_id, $center_id, $year, $batch);
?>
<!doctype html>

<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Student Password List | Course: <?= $COURSE->courseid .' - '.$COURSE->cname  ?> | Center: <?= $CENTER->centercode .' - '. $CENTER->center_name ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="#" name="description" />
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
    <link href='https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
    <link href='https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'>

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
                                <h4 class="mb-0">Student Password List | Course: <?= $COURSE->courseid .' - '.$COURSE->cname  ?> | Center: <?= $CENTER->centercode .' - '. $CENTER->center_name  ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Student Password List</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div>

                                <div class="table-responsive mb-4">
                                    <table id="table1" class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                        <thead>
                                            <tr class="bg-transparent">

                                                <th>No</th>
                                                   <th>Student NIC No</th>
                                                 <th>Student Name</th>
                                                <th>MIS NO</th>
                                               
                                             
                                                <th>Password</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($students as $key => $student) {
                                                $key++;
                                            ?>
                                              
                                                <tr>
                                                    <td><?= $key ?></td>
                                                    <td><?= $student['nic'] ?></td>
                                                    <td><?= $student['fname'] . ' ' . $student['lname'] ?></td>
                                                   <td>
                                                               <?= '<span style="font-size: 12px;"><b><u>MIS NO - </u></b></span><br>' . $student['id'] ?>
                                                       </td>                                                   
                                                    <td><?= '<span style="font-size: 12px;"><b><u>Password </u></b></span><br>' . $student['password'] ?></td>
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
    <!-- <script src="assets/js/pages/ecommerce-datatables.init.js"></script> -->

    <!-- App js -->
    <script src="assets/js/pages/form-advanced.init.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

    <script>
        $(document).ready(function() {
            var empDataTable = $('#table1').DataTable({
                dom: 'Blfrtip',
                buttons: [{
                    extend: 'pdfHtml5',
                    exportOptions: {
                        // columns: [0, 1] // Column index which needs to export
                    },
                    customize: function(doc) {
                        doc.content[1].table.widths = ['5%', '20%', '38%', '20%', '17%'];
                        doc.styles.tableHeader.margin = [5, 5, 5, 5];
                        doc.styles.tableBodyOdd.margin =
                            doc.styles.tableBodyEven.margin = [5, 20, 5, 20];
                    }
                }]

            });

        });
    </script>

</body>

</html>