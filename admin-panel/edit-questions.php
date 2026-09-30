<?php
include '../class/include.php';
include './auth.php';

$id = $_GET['id'];
$QUESTION = new Question($id);
$COURSE = new Course($QUESTION->course);
$COURSETRADE = new CourseTrade($COURSE->tradecode);
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Edit Questions | Sri Lanka Youth Services</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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
                                <h4 class="mb-0">Edit Question</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="create-questions.php?id=<?= $COURSE->courseid ?>">Questions</a></li>
                                        <li class="breadcrumb-item active">Edit Questions</li>
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
                                    <form id="form-data">
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Course Trade</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" value="<?php echo $COURSETRADE->trade_name ?>" readonly="">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Course Name</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" value="<?php echo $COURSE->cname ?>" readonly="">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Course Id</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" value="<?php echo $COURSE->courseid ?>" readonly="">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Course Module</label>
                                            <div class="col-md-10">
                                                <select class="form-control select2" name="module" id="module">
                                                    <option value="">-- Select Modules -- </option>
                                                    <?php
                                                    $COURSEMODULE = new CourseModule(NULL);
                                                    foreach ($COURSEMODULE->getModulesByCourse($COURSE->courseid) as $module) {
                                                        $selected = '';
                                                        if ($module['id'] == $QUESTION->module_id) {
                                                            $selected = 'selected';
                                                        }
                                                    ?>
                                                        <option value="<?= $module['id'] ?>" <?= $selected ?>><?= $module['code'] . ' - ' . $module['name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Add Image for Question</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="file" name="image_name">
                                                <input class="form-control" type="hidden" name="oldQuestionImage" value="<?= $QUESTION->image_name ?>">
                                                <?php
                                                if ($QUESTION->image_name != '') {
                                                ?>
                                                    <img src="../nc_assets/uploads/questions/<?= $QUESTION->image_name ?>" alt="NYSC" style="width:30%; margin-top:10px" />
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Image Answer 1</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="file" name="image_answer_1">
                                                <input class="form-control" type="hidden" name="oldAnswerImage1" value="<?= $QUESTION->image_answer_1 ?>">
                                                <?php
                                                if ($QUESTION->image_answer_1 != '') {
                                                ?>
                                                    <img src="../nc_assets/uploads/questions/options/<?= $QUESTION->image_answer_1 ?>" alt="NYSC" style="width:30%; margin-top:10px" />
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Image Answer 2</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="file" name="image_answer_2">
                                                <input class="form-control" type="hidden" name="oldAnswerImage2" value="<?= $QUESTION->image_answer_2 ?>">
                                                <?php
                                                if ($QUESTION->image_answer_2 != '') {
                                                ?>
                                                    <img src="../nc_assets/uploads/questions/options/<?= $QUESTION->image_answer_2 ?>" alt="NYSC" style="width:30%; margin-top:10px" />
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Image Answer 3</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="file" name="image_answer_3">
                                                <input class="form-control" type="hidden" name="oldAnswerImage3" value="<?= $QUESTION->image_answer_3 ?>">
                                                <?php
                                                if ($QUESTION->image_answer_3 != '') {
                                                ?>
                                                    <img src="../nc_assets/uploads/questions/options/<?= $QUESTION->image_answer_3 ?>" alt="NYSC" style="width:30%; margin-top:10px" />
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Image Answer 4</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="file" name="image_answer_4">
                                                <input class="form-control" type="hidden" name="oldAnswerImage4" value="<?= $QUESTION->image_answer_4 ?>">
                                                <?php
                                                if ($QUESTION->image_answer_4 != '') {
                                                ?>
                                                    <img src="../nc_assets/uploads/questions/options/<?= $QUESTION->image_answer_4 ?>" alt="NYSC" style="width:30%; margin-top:10px" />
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <!-- Question -->
                                        <?php
                                        if ($COURSE->english_lang == 1) {
                                        ?>
                                            <!-- English Question -->
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Add Question (English)</label>
                                                <div class="col-md-10">
                                                    <textarea style="background: white;" class="form-control question" id="question" name="question"><?= $QUESTION->question ?></textarea>

                                                </div>
                                            </div>
                                        <?php
                                        }
                                        if ($COURSE->sinhala_lang == 1) {
                                        ?>
                                            <!-- Sinhala Question -->
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Add Question (Sinhala)</label>
                                                <div class="col-md-10">
                                                    <textarea style="background: white;" class="form-control question" id="question_sinhala" name="question_sinhala"><?= $QUESTION->question_sinhala ?></textarea>

                                                </div>
                                            </div>
                                        <?php
                                        }
                                        if ($COURSE->tamil_lang == 1) {
                                        ?>
                                            <!-- Tamil Question -->
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Add Question (Tamil)</label>
                                                <div class="col-md-10">
                                                    <textarea style="background: white;" class="form-control question" id="question_tamil" name="question_tamil"><?= $QUESTION->question_tamil ?> </textarea>

                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>

                                        <!-- Answer 1 -->
                                        <?php
                                        if ($COURSE->english_lang == 1) {
                                        ?>
                                            <!-- English -->
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Answer 1 (English)</label>
                                                <div class="col-md-10">
                                                    <textarea style="background: white;" class="form-control question" id="answer_1" name="answer_1"><?= $QUESTION->answer_1 ?></textarea>

                                                </div>
                                            </div>
                                        <?php
                                        }
                                        if ($COURSE->sinhala_lang == 1) {
                                        ?>
                                            <!-- Sinhala -->
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Answer 1 (Sinhala)</label>
                                                <div class="col-md-10">
                                                    <textarea style="background: white;" class="form-control question" id="answer_1_sinhala" name="answer_1_sinhala"><?= $QUESTION->answer_1_sinhala ?></textarea>

                                                </div>
                                            </div>
                                        <?php
                                        }
                                        if ($COURSE->tamil_lang == 1) {
                                        ?>
                                            <!-- Tamil -->
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Answer 1 (Tamil)</label>
                                                <div class="col-md-10">
                                                    <textarea style="background: white;" class="form-control question" id="answer_1_tamil" name="answer_1_tamil"><?= $QUESTION->answer_1_tamil ?></textarea>

                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>


                                        <!-- Answer 2 -->
                                        <?php
                                        if ($COURSE->english_lang == 1) {
                                        ?>
                                            <!-- English -->
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Answer 2 (English)</label>
                                                <div class="col-md-10">
                                                    <textarea style="background: white;" class="form-control question" id="answer_2" name="answer_2"><?= $QUESTION->answer_2 ?></textarea>

                                                </div>
                                            </div>
                                        <?php
                                        }
                                        if ($COURSE->sinhala_lang == 1) {
                                        ?>
                                            <!-- Sinhala -->
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Answer 2 (Sinhala)</label>
                                                <div class="col-md-10">
                                                    <textarea style="background: white;" class="form-control question" id="answer_2_sinhala" name="answer_2_sinhala"><?= $QUESTION->answer_2_sinhala ?></textarea>

                                                </div>
                                            </div>
                                        <?php
                                        }
                                        if ($COURSE->tamil_lang == 1) {
                                        ?>
                                            <!-- Tamil -->
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Answer 2 (Tamil)</label>
                                                <div class="col-md-10">
                                                    <textarea style="background: white;" class="form-control question" id="answer_2_tamil" name="answer_2_tamil"><?= $QUESTION->answer_2_tamil ?></textarea>

                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>

                                        <!-- Answer 3 -->
                                        <?php
                                        if ($COURSE->english_lang == 1) {
                                        ?>
                                            <!-- English -->
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Answer 3 (English)</label>
                                                <div class="col-md-10">
                                                    <textarea style="background: white;" class="form-control question" id="answer_3" name="answer_3"><?= $QUESTION->answer_3 ?></textarea>

                                                </div>
                                            </div>
                                        <?php
                                        }
                                        if ($COURSE->sinhala_lang == 1) {
                                        ?>
                                            <!-- Sinhala -->
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Answer 3 (Sinhala)</label>
                                                <div class="col-md-10">
                                                    <textarea style="background: white;" class="form-control question" id="answer_3_sinhala" name="answer_3_sinhala"><?= $QUESTION->answer_3_sinhala ?></textarea>

                                                </div>
                                            </div>
                                        <?php
                                        }
                                        if ($COURSE->tamil_lang == 1) {
                                        ?>
                                            <!-- Tamil -->
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Answer 3 (Tamil)</label>
                                                <div class="col-md-10">
                                                    <textarea style="background: white;" class="form-control question" id="answer_3_tamil" name="answer_3_tamil"><?= $QUESTION->answer_3_tamil ?></textarea>

                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>

                                        <!-- Answer 4 -->
                                        <?php
                                        if ($COURSE->english_lang == 1) {
                                        ?>
                                            <!-- English -->
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Answer 4 (English)</label>
                                                <div class="col-md-10">
                                                    <textarea style="background: white;" class="form-control question" id="answer_4" name="answer_4"><?= $QUESTION->answer_4 ?></textarea>

                                                </div>
                                            </div>
                                        <?php
                                        }
                                        if ($COURSE->sinhala_lang == 1) {
                                        ?>
                                            <!-- Sinhala -->
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Answer 4 (Sinhala)</label>
                                                <div class="col-md-10">
                                                    <textarea style="background: white;" class="form-control question" id="answer_4_sinhala" name="answer_4_sinhala"><?= $QUESTION->answer_4_sinhala ?></textarea>

                                                </div>
                                            </div>
                                        <?php
                                        }
                                        if ($COURSE->tamil_lang == 1) {
                                        ?>
                                            <!-- Tamil -->
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Answer 4 (Tamil)</label>
                                                <div class="col-md-10">
                                                    <textarea style="background: white;" class="form-control question" id="answer_4_tamil" name="answer_4_tamil"><?= $QUESTION->answer_4_tamil ?></textarea>

                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Select Correct Answer</label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="correct_answer" id="correct_answer">
                                                    <option value="">-- Select the correct answer -- </option>
                                                    <?php
                                                    if ($QUESTION->correct_answer == 1) {
                                                    ?>
                                                        <option value="1" selected="">Answer 1</option>
                                                        <option value="2">Answer 2</option>
                                                        <option value="3">Answer 3</option>
                                                        <option value="4">Answer 4</option>
                                                    <?php } else if ($QUESTION->correct_answer == 2) { ?>
                                                        <option value="1">Answer 1</option>
                                                        <option value="2" selected="">Answer 2</option>
                                                        <option value="3">Answer 3</option>
                                                        <option value="4">Answer 4</option>
                                                    <?php } else if ($QUESTION->correct_answer == 3) { ?>
                                                        <option value="1">Answer 1</option>
                                                        <option value="2">Answer 2</option>
                                                        <option value="3" selected="">Answer 3</option>
                                                        <option value="4">Answer 4</option>
                                                    <?php } else { ?>
                                                        <option value="1">Answer 1</option>
                                                        <option value="2">Answer 2</option>
                                                        <option value="3">Answer 3</option>
                                                        <option value="4" selected="">Answer 4</option>

                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12" style="display: flex; justify-content: flex-end;margin-top: 15px;">
                                                <button class="btn btn-primary " type="submit" id="update">Update</button>
                                            </div>
                                            <input type="hidden" name="update">
                                            <input type="hidden" name="id" value="<?php echo $id ?>">

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>


                </div>
            </div>
        </div>
        <!-- end main content-->

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
    <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>

    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- init js -->
    <script src="assets/js/pages/ecommerce-datatables.init.js"></script>
    <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>s
    <script src="ajax/js/question.js" type="text/javascript"></script>s
    <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>s
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.2.2/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '.question'
        });
    </script>
</body>

</html>