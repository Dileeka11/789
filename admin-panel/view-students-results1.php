<?php
include '../class/include.php';
include './auth.php';

$id = '';
$id = $_GET['id'];
$EXAM_STUDENT = new ExamStudent($id);
$EXAM = new SheduleExam($EXAM_STUDENT->exam_id);
$STUDENT = new Student($EXAM_STUDENT->student_id);
$course = Course::getCourseByCourseID($STUDENT->course_id);

$COURSE_TRADE = new CourseTrade($course['tradecode']);
$student_questions = ExamStudentQuestion::getStudentQuestions($EXAM_STUDENT->student_id, $EXAM_STUDENT->exam_id);
?>
<!doctype html>

<html lang="en">

<head>

    <meta charset="utf-8" />
    <title> View MCQ Paper</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
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
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="assets/libs/jquery/jquery-2.2.4.min.js"></script>
    <style>
        .student-exam-details-section table {
            width: 100%;
        }

        .student-exam-details-section table th,
        .student-exam-details-section table td {
            padding: 10px;
        }

        .student-exam-details-section table th {
            width: 15%;
            text-align: left;
        }
        .form-check-label p {
            margin: 0 10px;
        }
        .form-check-label {
            display: flex;
        }
        .form-check {
            display: flex;
        }
        
        .form-check-label.label-color-green p span {
            color: green !important;
        }
        .form-check-label.label-color-red p span {
            color: red !important;
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
                                <h4 class="mb-0">View Student Answers </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                        <li class="breadcrumb-item"><a href="view-exam-students.php?id=<?= $EXAM->id ?>">Exam Students</a></li>
                                        <li class="breadcrumb-item active"> View Student Results </li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="student-exam-details-section">
                                        <table>
                                            <tr>
                                                <th>Course ID:</th>
                                                <td id="course-id"><?= $course['courseid'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Course Name:</th>
                                                <td id="course-name"><?= $course['cname'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Course Trade:</th>
                                                <td id="course-trade"><?= $COURSE_TRADE->trade_name ?></td>
                                            </tr>
                                            <tr>
                                                <th>Course Level:</th>
                                                <td id="course-level"><?= $course['level'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Year:</th>
                                                <td id="exam-year"><?= $STUDENT->year ?></td>
                                            </tr>
                                            <tr>
                                                <th>Name:</th>
                                                <td id="student-name"><?= $STUDENT->fname . ' ' . $STUDENT->lname ?></td>
                                            </tr>
                                            <tr>
                                                <th>Student No:</th>
                                                <td id="student-no"><?= $STUDENT->id ?></span></td>
                                            </tr>
                                            <tr>
                                                <th>Student NIC No:</th>
                                                <td id="student-no"><?= $STUDENT->nic ?></span></td>
                                            </tr>
                                            <tr>
                                                <th>Exam Date:</th>
                                                <td><?= $EXAM->start_date ?></td>
                                            </tr>

                                            <?php
                                            if ($EXAM->type == 3) {
                                            ?>
                                                <tr>
                                                    <th>MCQ Marks:</th>
                                                    <td><?= $EXAM_STUDENT->mcq_marks ?> (<?= $EXAM_STUDENT->mcq_grade ?>)</td>
                                                </tr>
                                                <tr>
                                                    <th>Theory Marks:</th>
                                                    <td><?= $EXAM_STUDENT->essay_marks ?> (<?= $EXAM_STUDENT->essay_grade ?>)</td>
                                                </tr>
                                            <?php
                                            } elseif ($EXAM->type == 2) {
                                            ?>
                                                <tr>
                                                    <th>Theory Marks:</th>
                                                    <td><?= $EXAM_STUDENT->essay_marks ?> (<?= $EXAM_STUDENT->essay_grade ?>)</td>
                                                </tr>
                                            <?php
                                            } elseif ($EXAM->type == 1) {
                                            ?>
                                                <tr>
                                                    <th>MCQ Marks:</th>
                                                    <td><?= $EXAM_STUDENT->mcq_marks ?> (<?= $EXAM_STUDENT->mcq_grade ?>)</td>
                                                </tr>
                                            <?php
                                            }
                                            if ($EXAM->is_had_practical == 1) {
                                            ?>
                                                <tr>
                                                    <th>Practical Marks:</th>
                                                    <td><?= $EXAM_STUDENT->practical_marks ?> (<?= $EXAM_STUDENT->practical_grade ?>)</td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                            <tr>
                                                <th>Final Marks:</th>
                                                <td><?= $EXAM_STUDENT->full_marks ?></td>
                                            </tr>
                                            <tr>
                                                <th>Final Grade:</th>
                                                <td><?= $EXAM_STUDENT->grade ?></td>
                                            </tr>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="card">

                                <?php
                                $QUESTION = new Question(NULL);
                                foreach ($student_questions as $key => $question) {
                                    $QUESTION = new Question($question['question_id']);
                                    $key++;
                                ?>
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">
                                            <span style="display: flex;"> <?= $key . '. ' . $QUESTION->question ?> <?php echo $QUESTION->id ?> </span>
                                            <?php
                                            if ($QUESTION->image_name != '') {
                                            ?>
                                                <img src="../nc_assets/uploads/questions/<?= $QUESTION->image_name ?>" style="width:50%; margin: 20px 0;" alt="question_image" />
                                            <?php
                                            }
                                            ?>
                                        </h4>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div>
                                                    <div class="form-check mb-3">
                                                        <input type="radio" value="" <?= ($QUESTION->correct_answer == 1 || $question['answer'] == 1)  ? 'checked' : '' ?> disabled>
                                                        <label class="form-check-label <?= ($question['answer'] == 1 && $question['is_correct'] == 1) ? 'label-color-green' : ($question['answer'] == 1 ? 'label-color-red' : ($QUESTION->correct_answer == 1 ? 'label-color-green' : '')) ?>" <?= ($question['answer'] == 1 && $question['is_correct'] == 1) ? 'style="color:green"' : ($question['answer'] == 1 ? 'style="color:red"' : ($QUESTION->correct_answer == 1 ? 'style="color:green"' : '')) ?>>
                                                            <?= $QUESTION->answer_1 ?>
                                                            <?php
                                                            if ($question['answer'] == null && $QUESTION->correct_answer == 1) {
                                                            ?>
                                                                <span style="color:blue">Not Answered</span>
                                                            <?php
                                                            }
                                                            ?>
                                                        </label>
                                                        <?php
                                                        if ($QUESTION->image_answer_1 != '') {
                                                        ?>
                                                            <img src="../nc_assets/uploads/questions/options/<?= $QUESTION->image_answer_1 ?>" style="width:50%; margin: 20px 0;" alt="question__option_image" />
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="form-check mb-3">
                                                        <input type="radio" value="" <?= ($QUESTION->correct_answer == 2 || $question['answer'] == 2) ? 'checked' : '' ?> disabled>
                                                        <label class="form-check-label <?= ($question['answer'] == 2 && $question['is_correct'] == 1) ? 'label-color-green' : ($question['answer'] == 2 ? 'label-color-red' : ($QUESTION->correct_answer == 2 ? 'label-color-green' : '')) ?>" <?= ($question['answer'] == 2 && $question['is_correct'] == 1) ? 'style="color:green"' : ($question['answer'] == 2 ? 'style="color:red"' : ($QUESTION->correct_answer == 2 ? 'style="color:green"' : '')) ?>>
                                                            <?= $QUESTION->answer_2 ?>
                                                            <?php
                                                            if ($question['answer'] == null && $QUESTION->correct_answer == 2) {
                                                            ?>
                                                                <span style="color:blue">Not Answered</span>
                                                            <?php
                                                            }
                                                            ?>
                                                        </label>
                                                        <?php
                                                        if ($QUESTION->image_answer_2 != '') {
                                                        ?>
                                                            <img src="../nc_assets/uploads/questions/options/<?= $QUESTION->image_answer_2 ?>" style="width:50%; margin: 20px 0;" alt="question__option_image" />
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="form-check mb-3">
                                                        <input type="radio" value="" <?= ($QUESTION->correct_answer == 3 || $question['answer'] == 3) ? 'checked' : '' ?> disabled>
                                                        <label class="form-check-label <?= ($question['answer'] == 3 && $question['is_correct'] == 1) ? 'label-color-green' : ($question['answer'] == 3 ? 'label-color-red"' : ($QUESTION->correct_answer == 3 ? 'label-color-green' : '')) ?>" <?= ($question['answer'] == 3 && $question['is_correct'] == 1) ? 'style="color:green"' : ($question['answer'] == 3 ? 'style="color:red"' : ($QUESTION->correct_answer == 3 ? 'style="color:green"' : '')) ?>>
                                                            <?= $QUESTION->answer_3 ?>
                                                            <?php
                                                            if ($question['answer'] == null && $QUESTION->correct_answer == 3) {
                                                            ?>
                                                                <span style="color:blue">Not Answered</span>
                                                            <?php
                                                            }
                                                            ?>
                                                        </label>
                                                        <?php
                                                        if ($QUESTION->image_answer_3 != '') {
                                                        ?>
                                                            <img src="../nc_assets/uploads/questions/options/<?= $QUESTION->image_answer_3 ?>" style="width:50%; margin: 20px 0;" alt="question__option_image" />
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="form-check mb-3">
                                                        <input type="radio" value="" <?= ($QUESTION->correct_answer == 4 || $question['answer'] == 4) ? 'checked' : '' ?> disabled>
                                                        <label class="form-check-label <?= ($question['answer'] == 4 && $question['is_correct'] == 1) ? 'label-color-green' : ($question['answer'] == 4 ? 'label-color-red' : ($QUESTION->correct_answer == 4 ? 'label-color-green' : '')) ?>" <?= ($question['answer'] == 4 && $question['is_correct'] == 1) ? 'style="color:green"' : ($question['answer'] == 4 ? 'style="color:red"' : ($QUESTION->correct_answer == 4 ? 'style="color:green"' : '')) ?>>
                                                            <?= $QUESTION->answer_4 ?>
                                                            <?php
                                                            if ($question['answer'] == null && $QUESTION->correct_answer == 4) {
                                                            ?>
                                                                <span style="color:blue">Not Answered</span>
                                                            <?php
                                                            }
                                                            ?>
                                                        </label>
                                                        <?php
                                                        if ($QUESTION->image_answer_4 != '') {
                                                        ?>
                                                            <img src="../nc_assets/uploads/questions/options/<?= $QUESTION->image_answer_4 ?>" style="width:50%; margin: 20px 0;" alt="question__option_image" />
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                <?php } ?>
                                
                                
                                    <div class="row">
                                        <div class="col-12" style="display: flex; justify-content: flex-end;margin: 15px 0;right:15px">
                                            <button class="btn btn-primary " type="button" id="update-mcq-marks" exam_stu_id="<?= $EXAM_STUDENT->id ?>" exam_id="<?= $EXAM->id ?>" stu_id="<?= $STUDENT->id ?>">Update Marks</button>
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
    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {

            $('.date').datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: "today"
            })
            $('#departure-date').datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: +1

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
    <script src="ajax/js/student-mcq-marks.js" type="text/javascript"></script>
    <!-- App js -->


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