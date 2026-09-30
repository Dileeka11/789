<?php
include '../class/include.php';
include './auth.php';

$USER = new User($_SESSION['id']);
$id = $_GET['id'];
$EXAM = new SheduleExam($id);
$COURSE = new Course($EXAM->course_id);

?>
<!doctype html>

<html lang="en">

<head>

    <meta charset="utf-8" />
    <title> Exam Students</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="#" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- plugin css -->
    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet" type="text/css">
    <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/libs/@chenfengyuan/datepicker/datepicker.min.css">
    <link href="plugin/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/preloader.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <!-- Bootstrap CSS -->
 
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="assets/libs/jquery/jquery-2.2.4.min.js"></script>
    <style>
        .datepicker-container {
            z-index: 99999 !important;
        }

        .m-l-3 {
            margin-left: 10px;
        }

        .edit_certificate_no {
            cursor: pointer;
        }
    </style>
</head>


<body class="someBlock">

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
                                <h4 class="mb-0">" <?php echo $COURSE->courseid  . ' - ' . $COURSE->cname ?> " - Download Final Results by Center</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                        <li class="breadcrumb-item active"><a href="schedule-exam.php">Schedule Exam </a></li>
                                        <li class="breadcrumb-item active"> Exam Students</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php if (isset($_GET['error'])): ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">You cannot print any more certificates. The maximum limit has been reached.</div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3   row">
                                <div class="col-md-3">


                                </div>

                                <div class="col-md-9" style="text-align: right;">
                                     
                                  
                                    <button class="btn btn-warning" id="btn-report-3" type="submit">Center PDF</button>    
                                    <input type="hidden" name="id" value="<?= $id ?>">

                                </div>

                            </div>

                            <div class="card">
                                <div class="card-body">

                                    <div class="col-md-12">
                                        <form id="report-form" class="mb-3" action="final-results-by-center.php" method="get">
                                            <div class="row">
                                                
                                                <input type="hidden" name="center" id="center" value="<?php echo $USER->center_id ?>"> 

                                                <div class="mb-3 col-md-6 row">
                                                    <label for="example-search-input" class="col-md-3 col-form-label">Year</label>
                                                    <div class="col-md-9">
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
                                                <div class="mb-3 col-md-6 row">
                                                    <label for="example-search-input" class="col-md-3 col-form-label">Batch</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control select2" name="batch" id="batch">
                                                            <option value="">-- Select Batch -- </option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="" name="id" value="<?php echo $id ?>">
                                            </div>
                                            <input type="hidden" name="issue_date" id="issue-date" value="">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Manage Exam Students</h4>
                                    <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                        <thead>
                                            <tr class="bg-transparent">

                                                <th> Id</th>
                                                <th>Student Id</th>
                                                 <th> Name </th>
                                               
                                                <?php
                                                if ($EXAM->type == 1 || $EXAM->type == 3) {
                                                ?>
                                                    <th>MCQ Test</th>
                                                <?php
                                                }
                                                if ($EXAM->type == 2 || $EXAM->type == 3) {
                                                ?>
                                                    <th>Theory Test</th>
                                                <?php
                                                }
                                                if ($EXAM->is_had_practical == 1) {
                                                ?>
                                                    <th>Practical Test</th>
                                                <?php
                                                }
                                                ?>
                                                <th>Full Marks</th>
                                                <th>Certificate No</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $STUDENTS = new Student(NULL);
                                            foreach ($STUDENTS->getStudentsByCourseAndCenterWithoutDropOut($COURSE->courseid,$USER->center_id,$EXAM->year,$EXAM->batch ) as $key => $student) {
                                                $STU = new Student($student['id']);
                                                $CENTER = new Centers($STU->centercode); 
                                                $key++;
                                               $is_student_exist = ExamStudent::getStudentDetails($student['id']);

                                            ?>
                                                <tr id="div<?php echo $student['id'] ?>">
                                                    <td><?= $key ?></td>
                                                     <td><?= $STU->id . '</br>' . substr($STU->year, -2) . ' / ' . $STU->batch ?></td>

                                                    <td><?= $STU->fname . ' ' . $STU->lname   ?>
                                                    <a href="edit-student.php?id=<?= $STU->id ?>" title="Edit Student" target="_blank" >
                                                            <div class="badge bg-pill bg-soft-primary font-size-14" type="button"><i class="fas fa-pencil-alt  p-1"></i></div>
                                                        </a>
                                                    </td>
                                                   
                                                   
                                                        <td>
                                                            <div id="mcq_marks_section_<?= $student['id'] ?>">
                                                                <span class="mcq_marks_span" id="mcq_marks_span_<?= $student['id'] ?>">
                                                                    
                                                                  <?php echo isset($is_student_exist['mcq_marks']) ? $is_student_exist['mcq_marks'] : '0'; ?>
                                                                    
                                                                    </span>
                                                            </div>
                                                        </td>
                                                   
                                                        
                                                   
                                                        <td>
                                                            <div id="practical_marks_section_<?= $student['id'] ?>">
                                                                <span class="practical_marks_span" id="practical_marks_span_<?= $student['id'] ?>">
                                                                  <?php echo isset($is_student_exist['practical_marks']) ? $is_student_exist['practical_marks'] : '0'; ?>
                                                                    </span>
                                                              </div> 
                                                        </td>
                                                     <td>
                                                           <?php echo isset($is_student_exist['grade']) ? $is_student_exist['grade'] : '0'; ?>
                                                      </td>
                                                    <!--<td><?= $is_student_exist['full_marks'] ? ($is_student_exist['full_marks'] . ' - ' . $is_student_exist['grade']) : 0 ?></td>-->
                                                    <td>
                                                        <div id="certificate_no_section_<?= $STU->id ?>">
                                                            <span class="certificate_no_span" id="certificate_no_span_<?= $STU->id ?>"><?= $STU->certificate_no ?? '-' ?><span class="badge bg-pill bg-soft-primary font-size-14 edit_certificate_no m-l-3 <?= $STU->certificate_no == null ? 'hidden' : '' ?>" student_id="<?= $STU->id ?>"><i class="fas fa-pencil-alt  p-1"></i></span></span>
                                                        </div>
                                                        
                                                    </td>
                                                   <td>
                                                       
                                                       <a href="student-mcq-and-practical-mark.php?id=<?php echo $student['id']  ?>&exam-id=<?php echo $id ?>" title="Enter Marks here">
                                                                <div class="badge bg-pill bg-soft-success font-size-14" type="button"><i class=" bx bx-paste  p-1"></i></div>
                                                            </a>
                                                   </td>
                                                </tr>
                                            <?php
                                                // }
                                            } ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="myExtraLargeModalLabel">
                        Enter Issue Date
                    </h5>
                    <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" class="issue_date" value="" style="width: 100%;" />
                        </div>
                        <div class="col-md-12 mt-3">
                            <button class="btn btn-primary" id="save-submit-btn" data-id="<?php echo $id ?>" type="submit"> Save</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
    <!-- END layout-wrapper -->


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {

            $('.date').datepicker({
                dateFormat: 'dd/mm/YYYY',
                minDate: "today"
            })
            $('#departure-date').datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: +1

            })
            $('.issue_date').datepicker({
                format: 'dd/mm/YYYY',

            })
        });
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.time').timepicker({});
        });
    </script>
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

    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <!-- init js -->
    <script src="assets/js/pages/ecommerce-datatables.init.js"></script>
    <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>
    <script src="ajax/js/exam-students.js" type="text/javascript"></script>
    <script src="ajax/js/schedule-exam.js" type="text/javascript"></script>
    <!-- App js -->


    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="assets/libs/select2/js/select2.min.js"></script>
    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>


    <script src="assets/libs/select2/js/select2.min.js"></script>
    <script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
    <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="assets/libs/@chenfengyuan/datepicker/datepicker.min.js"></script>

    <!-- init js -->
    <script src="assets/js/pages/form-advanced.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

</body>

</html>