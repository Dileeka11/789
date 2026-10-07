<?php
include '../class/include.php';
include './auth.php';

date_default_timezone_set('Asia/Colombo');

$USERS = new User($_SESSION['id']);

$today = date('Y-m-d');
$now   = time();

// Find all exams scheduled for today, then keep only the ones that are
// currently LIVE (now is within [start_time, start_time + duration]).
$SCHEDULE_EXAM = new SheduleExam(NULL);
$EXAM_STUDENT  = new ExamStudent(NULL);

$today_exams = $SCHEDULE_EXAM->getExamsByDate($today);

$live_exams = array();
foreach ($today_exams as $exam) {
    // `time` may be stored in a few formats ("09:00", "09:00:00", "9:00 am").
    // strtotime() parses all of them reliably.
    $start = strtotime($exam['start_date'] . ' ' . $exam['time']);
    if ($start === false) {
        continue;
    }
    $end = $start + intval($exam['duration']); // duration is in seconds

    if ($now >= $start && $now <= $end) {
        $exam['__start'] = $start;
        $exam['__end']   = $end;
        $live_exams[] = $exam;
    }
}
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title> Live Exam Attendance Report | SL Youth </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Auto refresh every 30 seconds so the live numbers stay current -->
    <meta http-equiv="refresh" content="30">
    <meta content="#" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/preloader.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="assets/libs/jquery/jquery-2.2.4.min.js"></script>
    <style>
        .live-badge {
            display: inline-block;
            width: 10px;
            height: 10px;
            background: #34c38f;
            border-radius: 50%;
            margin-right: 6px;
            animation: live-pulse 1.2s infinite;
        }

        @keyframes live-pulse {
            0%   { box-shadow: 0 0 0 0 rgba(52, 195, 143, 0.6); }
            70%  { box-shadow: 0 0 0 8px rgba(52, 195, 143, 0); }
            100% { box-shadow: 0 0 0 0 rgba(52, 195, 143, 0); }
        }

        .exam-card-head {
            background: #f5f6f8;
            border-left: 4px solid #34c38f;
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

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"><span class="live-badge"></span> Live Exam Attendance Report</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                        <li class="breadcrumb-item active">Live Exam Attendance Report</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-info d-flex justify-content-between align-items-center" role="alert">
                                <span>
                                    <i class="bx bx-time-five"></i>
                                    Last updated: <strong><?php echo date('Y-m-d h:i:s A'); ?></strong>
                                    &nbsp;|&nbsp; Live exams right now: <strong><?php echo count($live_exams); ?></strong>
                                </span>
                                <span class="text-muted">Auto refresh every 30s</span>
                            </div>
                        </div>
                    </div>

                    <?php if (count($live_exams) == 0): ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body text-center text-muted">
                                        <i class="bx bx-calendar-x" style="font-size: 40px;"></i>
                                        <h5 class="mt-2">No exams are live right now.</h5>
                                        <p class="mb-0">This page lists each center with how many students should sit the exam and how many have attended, while an exam is running.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php foreach ($live_exams as $exam):
                        $COURSE = new Course($exam['course_id']);
                        $stats  = $EXAM_STUDENT->getLiveExamCenterStats($exam['id'], $exam['course_id'], $exam['year'], $exam['batch']);

                        $total_expected = 0;
                        $total_attended = 0;
                        foreach ($stats as $row) {
                            $total_expected += intval($row['expected_count']);
                            $total_attended += intval($row['attended_count']);
                        }
                    ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="exam-card-head p-3 mb-3 rounded">
                                            <h5 class="mb-1">
                                                <?php echo $COURSE->courseid . ' - ' . $COURSE->cname; ?>
                                            </h5>
                                            <div class="text-muted">
                                                Year: <strong><?php echo htmlspecialchars($exam['year']); ?></strong>
                                                &nbsp;|&nbsp; Batch: <strong><?php echo htmlspecialchars($exam['batch']); ?></strong>
                                                &nbsp;|&nbsp; Starts: <strong><?php echo date('h:i A', $exam['__start']); ?></strong>
                                                &nbsp;|&nbsp; Ends: <strong><?php echo date('h:i A', $exam['__end']); ?></strong>
                                                &nbsp;|&nbsp; Total Expected: <strong><?php echo $total_expected; ?></strong>
                                                &nbsp;|&nbsp; Total Attended: <strong class="text-success"><?php echo $total_attended; ?></strong>
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-centered mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th style="width: 60px;">No</th>
                                                        <th>Center</th>
                                                        <th class="text-center" style="width: 160px;">Should Sit (Expected)</th>
                                                        <th class="text-center" style="width: 160px;">Attended</th>
                                                        <th class="text-center" style="width: 160px;">Not Attended</th>
                                                        <th class="text-center" style="width: 120px;">Attendance %</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (count($stats) == 0): ?>
                                                        <tr>
                                                            <td colspan="6" class="text-center text-muted">No students found for this exam.</td>
                                                        </tr>
                                                    <?php else: ?>
                                                        <?php $no = 0; foreach ($stats as $row):
                                                            $no++;
                                                            $expected = intval($row['expected_count']);
                                                            $attended = intval($row['attended_count']);
                                                            $not_attended = $expected - $attended;
                                                            if ($not_attended < 0) {
                                                                $not_attended = 0;
                                                            }
                                                            $percent = $expected > 0 ? round(($attended / $expected) * 100) : 0;
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $no; ?></td>
                                                                <td><?php echo $row['centercode'] . ' - ' . htmlspecialchars($row['center_name']); ?></td>
                                                                <td class="text-center"><?php echo $expected; ?></td>
                                                                <td class="text-center text-success fw-bold"><?php echo $attended; ?></td>
                                                                <td class="text-center text-danger"><?php echo $not_attended; ?></td>
                                                                <td class="text-center"><?php echo $percent; ?>%</td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </tbody>
                                                <?php if (count($stats) > 0): ?>
                                                    <tfoot>
                                                        <tr class="table-light fw-bold">
                                                            <td colspan="2" class="text-end">Total</td>
                                                            <td class="text-center"><?php echo $total_expected; ?></td>
                                                            <td class="text-center text-success"><?php echo $total_attended; ?></td>
                                                            <td class="text-center text-danger"><?php echo ($total_expected - $total_attended) > 0 ? ($total_expected - $total_attended) : 0; ?></td>
                                                            <td class="text-center"><?php echo $total_expected > 0 ? round(($total_attended / $total_expected) * 100) : 0; ?>%</td>
                                                        </tr>
                                                    </tfoot>
                                                <?php endif; ?>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>

        </div>

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>

</body>

</html>
