<?php
include '../class/include.php';
include './auth.php';

$USERS = new User($_SESSION['id']);
$DEFUL_DATA = new DefaultData();

$year  = isset($_GET['year']) ? $_GET['year'] : '';
$batch = isset($_GET['batch']) ? $_GET['batch'] : '';

$EXAM_STUDENT = new ExamStudent(NULL);
$rows = $EXAM_STUDENT->getCenterCertificatePrintSummary($year, $batch);

// Group the center rows by province
$provinces = array();
$grand = array('pass' => 0, 'printed' => 0, 'centers' => 0);
foreach ($rows as $row) {
    $key = $row['province_name'];
    if (!isset($provinces[$key])) {
        $provinces[$key] = array('centers' => array(), 'pass' => 0, 'printed' => 0);
    }
    $provinces[$key]['centers'][] = $row;
    $provinces[$key]['pass']    += intval($row['pass_count']);
    $provinces[$key]['printed'] += intval($row['printed_count']);

    $grand['pass']    += intval($row['pass_count']);
    $grand['printed'] += intval($row['printed_count']);
    $grand['centers']++;
}
$grand['available'] = max(0, $grand['pass'] - $grand['printed']);
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title> Certificate Print Report | SL Youth </title>
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
        .province-row td {
            background: #eef1fd;
            font-weight: 600;
            color: #343a40;
            border-left: 4px solid #5b73e8;
        }

        .subtotal-row td {
            background: #f8f9fa;
            font-weight: 600;
        }

        .grand-row td {
            background: #343a40;
            color: #fff;
            font-weight: 700;
        }

        .summary-card .num {
            font-size: 26px;
            font-weight: 700;
        }

        .progress-sm {
            height: 6px;
        }

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

            .province-row td, .subtotal-row td, .grand-row td {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
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
                                <h4 class="mb-0">Center Wise Certificate Print Report</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                        <li class="breadcrumb-item active">Certificate Print Report</li>
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
                                            <label class="form-label">Exam Year</label>
                                            <select class="form-select form-control" name="year">
                                                <option value="">- All Years -</option>
                                                <?php foreach ($DEFUL_DATA->CourseYear() as $key => $course_year) { ?>
                                                    <option value="<?php echo $key ?>" <?php echo ((string) $year === (string) $key) ? 'selected' : '' ?>><?php echo $course_year ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Exam Batch</label>
                                            <select class="form-select form-control" name="batch">
                                                <option value="">- All Batches -</option>
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

                    <!-- Summary cards -->
                    <div class="row">
                        <div class="col-md-3 col-6">
                            <div class="card summary-card">
                                <div class="card-body">
                                    <div class="text-muted">Centers</div>
                                    <div class="num"><?php echo $grand['centers']; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="card summary-card">
                                <div class="card-body">
                                    <div class="text-muted">Exam Pass Count</div>
                                    <div class="num text-primary"><?php echo $grand['pass']; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="card summary-card">
                                <div class="card-body">
                                    <div class="text-muted">Certificates Printed</div>
                                    <div class="num text-success"><?php echo $grand['printed']; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="card summary-card">
                                <div class="card-body">
                                    <div class="text-muted">Available To Print</div>
                                    <div class="num text-danger"><?php echo $grand['available']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Report table -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <p class="text-muted mb-3">
                                        Year: <strong><?php echo $year !== '' ? htmlspecialchars($year) : 'All'; ?></strong>
                                        &nbsp;|&nbsp; Batch: <strong><?php echo $batch !== '' ? htmlspecialchars($batch) : 'All'; ?></strong>
                                        &nbsp;|&nbsp; Generated: <strong><?php echo date('Y-m-d h:i A'); ?></strong>
                                    </p>

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-centered mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 60px;">No</th>
                                                    <th>Center</th>
                                                    <th class="text-center" style="width: 150px;">Exam Pass Count</th>
                                                    <th class="text-center" style="width: 150px;">Printed Count</th>
                                                    <th class="text-center" style="width: 150px;">Available Count</th>
                                                    <th class="text-center" style="width: 160px;">Printed %</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (count($provinces) == 0): ?>
                                                    <tr>
                                                        <td colspan="6" class="text-center text-muted">No passed students found for the selected period.</td>
                                                    </tr>
                                                <?php endif; ?>

                                                <?php foreach ($provinces as $province_name => $province):
                                                    $p_available = max(0, $province['pass'] - $province['printed']);
                                                    $p_percent = $province['pass'] > 0 ? round(($province['printed'] / $province['pass']) * 100) : 0;
                                                ?>
                                                    <tr class="province-row">
                                                        <td colspan="6"><i class="bx bx-map"></i> <?php echo htmlspecialchars($province_name); ?></td>
                                                    </tr>

                                                    <?php $no = 0; foreach ($province['centers'] as $row):
                                                        $no++;
                                                        $pass = intval($row['pass_count']);
                                                        $printed = intval($row['printed_count']);
                                                        $available = max(0, $pass - $printed);
                                                        $percent = $pass > 0 ? round(($printed / $pass) * 100) : 0;
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $no; ?></td>
                                                            <td><?php echo $row['centercode'] . ' - ' . htmlspecialchars($row['center_name']); ?></td>
                                                            <td class="text-center text-primary fw-bold"><?php echo $pass; ?></td>
                                                            <td class="text-center text-success"><?php echo $printed; ?></td>
                                                            <td class="text-center <?php echo $available > 0 ? 'text-danger fw-bold' : 'text-muted'; ?>"><?php echo $available; ?></td>
                                                            <td class="text-center">
                                                                <?php echo $percent; ?>%
                                                                <div class="progress progress-sm mt-1">
                                                                    <div class="progress-bar bg-success" style="width: <?php echo $percent; ?>%"></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>

                                                    <tr class="subtotal-row">
                                                        <td colspan="2" class="text-end"><?php echo htmlspecialchars($province_name); ?> Total</td>
                                                        <td class="text-center"><?php echo $province['pass']; ?></td>
                                                        <td class="text-center text-success"><?php echo $province['printed']; ?></td>
                                                        <td class="text-center text-danger"><?php echo $p_available; ?></td>
                                                        <td class="text-center"><?php echo $p_percent; ?>%</td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <?php if (count($provinces) > 0): ?>
                                                <tfoot>
                                                    <tr class="grand-row">
                                                        <td colspan="2" class="text-end">Grand Total</td>
                                                        <td class="text-center"><?php echo $grand['pass']; ?></td>
                                                        <td class="text-center"><?php echo $grand['printed']; ?></td>
                                                        <td class="text-center"><?php echo $grand['available']; ?></td>
                                                        <td class="text-center"><?php echo $grand['pass'] > 0 ? round(($grand['printed'] / $grand['pass']) * 100) : 0; ?>%</td>
                                                    </tr>
                                                </tfoot>
                                            <?php endif; ?>
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
