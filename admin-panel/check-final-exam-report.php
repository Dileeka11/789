<?php
include '../class/include.php';
include './auth.php';

$USERS = new User($_SESSION['id']);
$DEFUL_DATA = new DefaultData();

$year  = isset($_GET['year']) ? $_GET['year'] : '';
$batch = isset($_GET['batch']) ? $_GET['batch'] : '';

$rows = array();
if ($year !== '' && $batch !== '') {
    $EXAM_STUDENT = new ExamStudent(NULL);
    $rows = $EXAM_STUDENT->getRepeatStudentsWithPassedMarks($year, $batch);
}

// Show '-' for components the exam doesn't have
function check_final_mark($value, $applicable)
{
    if (!$applicable || $value === null || $value === '') {
        return '<span class="text-muted">-</span>';
    }
    return htmlspecialchars($value);
}
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title> Check Final Exam | SL Youth </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="#" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="assets/css/preloader.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <style>
        @media print {
            .vertical-menu, #page-topbar, .footer, .no-print, .page-title-right {
                display: none !important;
            }

            .main-content {
                margin-left: 0 !important;
            }

            .page-content {
                padding: 0 !important;
            }
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

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">Check Final Exam</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                        <li class="breadcrumb-item active">Check Final Exam</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filter -->
                    <div class="row no-print">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="get" class="row g-2 align-items-end">
                                        <div class="col-md-3">
                                            <label class="form-label">Exam Year *</label>
                                            <select class="form-select form-control" name="year" required>
                                                <option value="">- Select Year -</option>
                                                <?php foreach ($DEFUL_DATA->CourseYear() as $key => $course_year) { ?>
                                                    <option value="<?php echo $key ?>" <?php echo ((string) $year === (string) $key) ? 'selected' : '' ?>><?php echo $course_year ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Exam Batch *</label>
                                            <select class="form-select form-control" name="batch" required>
                                                <option value="">- Select Batch -</option>
                                                <?php foreach ($DEFUL_DATA->CourseBatch() as $key => $course_batch) { ?>
                                                    <option value="<?php echo $key ?>" <?php echo ((string) $batch === (string) $key) ? 'selected' : '' ?>><?php echo $course_batch ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 text-md-end">
                                            <button type="submit" class="btn btn-primary"><i class="bx bx-filter-alt"></i> Filter</button>
                                            <button type="button" class="btn btn-success" onclick="window.print()"><i class="bx bx-printer"></i> Print</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Report table -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <p class="text-muted mb-1">
                                        Students whose Theory, MCQ and Practical marks are all passed but the final grade is <strong class="text-danger">Repeat</strong>.
                                    </p>
                                    <p class="text-muted mb-3">
                                        Year: <strong><?php echo $year !== '' ? htmlspecialchars($year) : '-'; ?></strong>
                                        &nbsp;|&nbsp; Batch: <strong><?php echo $batch !== '' ? htmlspecialchars($batch) : '-'; ?></strong>
                                        &nbsp;|&nbsp; Students: <strong><?php echo count($rows); ?></strong>
                                        &nbsp;|&nbsp; Generated: <strong><?php echo date('Y-m-d h:i A'); ?></strong>
                                    </p>

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-centered mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 60px;">No</th>
                                                    <th>Student ID</th>
                                                    <th>Student Name</th>
                                                    <th>Center</th>
                                                    <th>Course</th>
                                                    <th class="text-center">Practical Marks</th>
                                                    <th class="text-center">Theory Marks</th>
                                                    <th class="text-center">MCQ Marks</th>
                                                    <th class="text-center">Final Mark</th>
                                                    <th class="text-center">Final Grade</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if ($year === '' || $batch === ''): ?>
                                                    <tr>
                                                        <td colspan="10" class="text-center text-muted">Select a year and batch to load the report.</td>
                                                    </tr>
                                                <?php elseif (count($rows) == 0): ?>
                                                    <tr>
                                                        <td colspan="10" class="text-center text-muted">No mismatched students found for the selected period.</td>
                                                    </tr>
                                                <?php endif; ?>

                                                <?php $no = 0; foreach ($rows as $row):
                                                    $no++;
                                                    $has_practical = $row['is_had_practical'] == 1;
                                                    $has_theory = in_array($row['type'], array(2, 3));
                                                    $has_mcq = in_array($row['type'], array(1, 3));
                                                ?>
                                                    <tr>
                                                        <td><?php echo $no; ?></td>
                                                        <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['fname'] . ' ' . $row['lname']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['centercode']); ?></td>
                                                        <td><?php echo htmlspecialchars($row['course_name'] !== null ? $row['course_name'] : $row['course_id']); ?></td>
                                                        <td class="text-center"><?php echo check_final_mark($row['practical_marks'], $has_practical); ?></td>
                                                        <td class="text-center"><?php echo check_final_mark($row['essay_marks'], $has_theory); ?></td>
                                                        <td class="text-center"><?php echo check_final_mark($row['mcq_marks'], $has_mcq); ?></td>
                                                        <td class="text-center"><?php echo check_final_mark($row['full_marks'], true); ?></td>
                                                        <td class="text-center text-danger fw-bold"><?php echo htmlspecialchars($row['grade']); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
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
