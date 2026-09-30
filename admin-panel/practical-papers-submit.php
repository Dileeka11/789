<?php
include '../class/include.php';
include './auth.php';

$id = $_GET['id'] ?? NULL;
$COURSE = new Course($id);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Create Practical Paper | Sri Lanka Youth Services</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- CSS -->
    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="plugin/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/preloader.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body class="someBlock">

    <div id="layout-wrapper">

        <?php include './top-header.php'; ?>
        <?php include './navigation.php'; ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">Practical Paper Questions</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                                        <li class="breadcrumb-item active">Manage Practical Paper</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Create Form Card -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Practical Paper</h4>
                                    <form id="form-data" method="POST" enctype="multipart/form-data">

                                        <!-- Course -->
                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-form-label">Select Exam Course</label>
                                            <div class="col-md-10">
                                                <select class="form-control select2" name="course_id" id="course_id">
                                                    <option value="">-- Select the Course --</option>
                                                    <?php
                                                    $COURSE_LIST = new Course(NULL);
                                                    foreach ($COURSE_LIST->all() as $course) { ?>
                                                        <option value="<?php echo $course['courseid'] ?>">
                                                            <?php echo $course['courseid'] . ' - ' . $course['cname'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Year -->
                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-form-label">Year</label>
                                            <div class="col-md-10">
                                                <select class="form-control select2" name="year" id="year">
                                                    <option value="">-- Select Year --</option>
                                                    <?php
                                                    $current_year = date('Y');
                                                    for ($i = 0; $i < 20; $i++) {
                                                        $year = $current_year - $i; ?>
                                                        <option value="<?= $year ?>"><?= $year ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Batch -->
                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-form-label">Batch</label>
                                            <div class="col-md-10">
                                                <select class="form-control select2" name="batch" id="batch">
                                                    <option value="">-- Select Batch --</option>
                                                    <?php
                                                    $DEFULT_DATA = new DefaultData();
                                                    foreach ($DEFULT_DATA->CourseBatch() as $key => $batch) { ?>
                                                        <option value="<?= $key ?>"><?= $batch ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Paper Title -->
                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-form-label">Paper Title</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="title" name="title"
                                                    placeholder="Enter the Exam paper title">
                                            </div>
                                        </div>

                                        <!-- Date & Time -->
                                        <div class="mb-3 row">
                                            <label for="datetime_fp" class="col-md-2 col-form-label">Date &amp; Time</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="datetime_fp" id="datetime_fp"
                                                    placeholder="Select date &amp; time..." readonly>
                                            </div>
                                        </div>

                                        <!-- PDF Upload -->
                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-form-label">Upload PDF</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="file" id="pdf_doc" name="pdf_doc"
                                                    accept="application/pdf">
                                            </div>
                                        </div>

                                        <!-- Active / Inactive -->
                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-form-label">Active / Inactive</label>
                                            <div class="col-md-10">
                                                <div class="form-check mt-2">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="activeCheck" name="active" value="1">
                                                    <label class="form-check-label" for="activeCheck">Active</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="row">
                                            <div class="col-12" style="display: flex; justify-content: flex-end; margin-top: 15px;">
                                                <button class="btn btn-primary" type="submit" id="create">Create</button>
                                            </div>
                                            <input type="hidden" name="create">
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Create Form Card -->

                    <!-- Table Card -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Manage Practical Papers</h4>

                                    <table class="table table-centered datatable dt-responsive nowrap table-card-list"
                                        style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                        <thead>
                                            <tr class="bg-transparent">
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Course</th>
                                                <th>Year</th>
                                                <th>Batch</th>
                                                <th>Date &amp; Time</th>
                                                <th>Paper</th>
                                                <th>Status</th>
                                                <th style="width: 120px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $WRITTING_PAPERS = new PracticalPapers(NULL);
                                            foreach ($WRITTING_PAPERS->all($id) as $key => $question) {
                                                $key++;
                                                $isActive = isset($question['active']) ? $question['active'] : 1;
                                            ?>
                                                <tr id="div<?php echo $question['id'] ?>">
                                                    <td><?php echo $key ?></td>
                                                    <td><?php echo htmlspecialchars($question['title']) ?></td>
                                                    <td><?php echo htmlspecialchars($question['course_id']) ?></td>
                                                    <td><?php echo htmlspecialchars($question['year']) ?></td>
                                                    <td><?php echo htmlspecialchars($question['batch']) ?></td>
                                                    <td><?php echo htmlspecialchars($question['datetime_fp']) ?></td>
                                                    <td>
                                                        <a href="../nc_assets/uploads/practical-papers/<?php echo $question['pdf_doc'] ?>"
                                                            target="_blank">
                                                            <i class="fas fa-file-pdf text-danger"></i> View
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <span class="badge toggle-active <?php echo $isActive == 1 ? 'bg-success' : 'bg-danger'; ?>"
                                                            data-id="<?php echo $question['id']; ?>"
                                                            data-status="<?php echo $isActive; ?>"
                                                            style="cursor:pointer; font-size:13px; padding:6px 12px; color:#fff;">
                                                            <?php echo $isActive == 1 ? 'Active' : 'Inactive'; ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="edit-practical-paper.php?id=<?php echo $question['id'] ?>">
                                                            <div class="badge bg-pill bg-soft-primary font-size-14"
                                                                title="Edit" style="cursor:pointer;">
                                                                <i class="fas fa-pencil-alt p-1"></i>
                                                            </div>
                                                        </a>
                                                        &nbsp;
                                                        <div class="badge bg-pill bg-soft-danger font-size-14 delete-practical-paper"
                                                            data-id="<?php echo $question['id'] ?>"
                                                            title="Delete" style="cursor:pointer;">
                                                            <i class="fas fa-trash p-1"></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Table Card -->

                </div>
            </div>
        </div>

    </div>
    <!-- END layout-wrapper -->

    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT — load jQuery first, then plugins, then app scripts -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="assets/libs/select2/js/select2.min.js"></script>
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="plugin/sweetalert/sweetalert.min.js"></script>
    <script src="assets/js/pages/ecommerce-datatables.init.js"></script>
    <script src="assets/js/jquery.preloader.min.js"></script>
    <script src="ajax/js/practical-paper.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        // Flatpickr init
        flatpickr("#datetime_fp", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            defaultDate: new Date(),
            time_24hr: true,
            minuteIncrement: 1
        });

        $(document).ready(function () {

            // ── INIT SELECT2 ─────────────────────────────────────────
            $('.select2').select2({
                placeholder: "-- Select --",
                allowClear: true
            });

            // ── DELETE ───────────────────────────────────────────────
         $(document).on('click', '.delete-practical-paper', function () {

    var id = $(this).data('id');

    swal({
        title: "Are you sure?",
        text: "This record will be permanently deleted!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {

        $.ajax({
            url: 'ajax/php/practical-paper-ajax.php',
            type: "POST",
            data: {
                delete_id: id
            },
            dataType: "json",
            success: function (json) {

                if (json.status) {

                    $('#div' + id).remove();

                    swal("Deleted!", "Record deleted successfully.", "success");

                } else {
                    swal("Error!", "Delete failed.", "error");
                }
            },
            error: function (xhr) {
                console.log(xhr.responseText);
                swal("Error!", "AJAX request failed.", "error");
            }
        });

    });

});

            // ── TOGGLE ACTIVE / INACTIVE ─────────────────────────────
            $(document).on('click', '.toggle-active', function () {
                var $el       = $(this);
                var id        = $el.data('id');
                var status    = $el.data('status');
                var newStatus = (status == 1) ? 0 : 1;

                $.ajax({
                    url: 'ajax/php/practical-paper-ajax.php',
                    type: 'POST',
                    data: { toggle_id: id, active: newStatus },
                    success: function (res) {
                        res = $.trim(res);
                        if (res === 'success') {
                            $el.data('status', newStatus);
                            if (newStatus == 1) {
                                $el.removeClass('bg-danger').addClass('bg-success').text('Active');
                            } else {
                                $el.removeClass('bg-success').addClass('bg-danger').text('Inactive');
                            }
                        } else {
                            swal("Error!", "Status update failed.", "error");
                        }
                    },
                    error: function () {
                        swal("Error!", "AJAX request failed.", "error");
                    }
                });
            });

        });
    </script>

</body>
</html>