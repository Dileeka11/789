<?php
include '../class/include.php';
include './auth.php';

$id = $_GET['id'] ?? NULL;
$COURSE = new Course($id);

$USER = new User($_SESSION['id']);

// Current timestamp as unix time
date_default_timezone_set('Asia/Colombo');
$nowTimestamp = time();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Practical Papers | Sri Lanka Youth Services</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="plugin/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/preloader.css" rel="stylesheet" type="text/css" />
</head>

<body class="someBlock">

    <div id="layout-wrapper">

        <?php include './top-header.php'; ?>
        <?php include './navigation.php'; ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <!-- Page Title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">Practical Papers</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                                        <li class="breadcrumb-item active">Practical Papers</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                 

                    <!-- Table Card -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Available Practical Papers</h4>

                                    <table class="table table-centered datatable dt-responsive nowrap table-card-list"
                                        style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                        <thead>
                                            <tr class="bg-transparent">
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Course</th>
                                                <th>Year</th>
                                                <th>Batch</th> 
                                                <th>Available Until</th>
                                                <th>Paper</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $CENTER_COURSES   = new CenterCourses(NULL);
                                            $PRACTICAL_PAPERS = new PracticalPapers(NULL);

                                            $rowNumber = 0;

                                            foreach ($CENTER_COURSES->getCoursesByCenters($USER->center_id) as $centerCourse) {
                                                foreach ($PRACTICAL_PAPERS->getAvailablePapersByCourse($centerCourse['course_id']) as $paper) {

                                                    // ── strtotime handles all common formats automatically ──
                                                    // "2026-06-13 17:27"    -> works
                                                    // "2026-06-13 17:27:00" -> works
                                                    $scheduledTimestamp = strtotime(trim($paper['datetime_fp']));

                                                    // Skip completely if date is invalid
                                                    if (!$scheduledTimestamp) continue;

                                                    // Deadline = scheduled + 86400 seconds (24 hours)
                                                    $deadlineTimestamp = $scheduledTimestamp + 86400;

                                                    // ── Show only if inside the valid window ───────────────
                                                    if ($nowTimestamp < $scheduledTimestamp) continue; // not started yet
                                                    if ($nowTimestamp >= $deadlineTimestamp)  continue; // expired after 1 day

                                                    $rowNumber++;
                                                    ?>
                                                    <tr id="div<?php echo $paper['id'] ?>">
                                                        <td><?php echo $rowNumber ?></td>
                                                        <td><?php echo htmlspecialchars($paper['title']) ?></td>
                                                        <td><?php echo htmlspecialchars($paper['course_id']) ?></td>
                                                        <td><?php echo htmlspecialchars($paper['year']) ?></td>
                                                        <td><?php echo htmlspecialchars($paper['batch']) ?></td>
                                                     
                                                        <td>
                                                            <span class="badge bg-soft-warning text-warning font-size-12">
                                                                <i class="fas fa-clock me-1"></i>
                                                                <?php echo date('Y-m-d H:i', $deadlineTimestamp) ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <a href="../nc_assets/uploads/practical-papers/<?php echo $paper['pdf_doc'] ?>"
                                                                target="_blank" class="btn btn-sm btn-outline-danger">
                                                                <i class="fas fa-file-pdf"></i> View Paper
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }

                                            if ($rowNumber === 0) { ?>
                                                <tr>
                                                    <td colspan="8" class="text-center text-muted py-5">
                                                        <i class="fas fa-folder-open fa-2x mb-2 d-block"></i>
                                                        No practical papers are available at this time.<br>
                                                        <small>Papers will appear here during their scheduled time window.</small>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="rightbar-overlay"></div>

    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="assets/js/pages/ecommerce-datatables.init.js"></script>
    <script src="assets/js/jquery.preloader.min.js"></script>
    <script src="assets/js/app.js"></script>

</body>
</html>
