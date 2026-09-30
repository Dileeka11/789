<!doctype html>
<?php
include '../class/include.php';
include './auth.php';
?>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Form Advanced Plugins | Minible - Admin & Dashboard Template</title>
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
        <link href="plugin/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href=assets/css/preloader.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

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
                                    <h4 class="mb-0">Advanced Plugins</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                            <li class="breadcrumb-item active">Advanced Plugins</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Add Questions</h4>
                                        <form id="form-data">
                                            <div class="mb-3 row">
                                                <label for="example-search-input" class="col-md-2 col-form-label">Select Correct Answer</label>
                                                <div class="col-md-10">
                                                    <select class="form-control select2" name="correct_answer" id="correct_answer">
                                                        <option value="">-- Select the Course -- </option>
                                                        <?php
                                                        $COURSE = new Course(NULL);
                                                        foreach ($COURSE->all() as $course) {
                                                            ?>
                                                            <option value="1"><?php echo $course['courseid'] . ' - ' . $course['cname'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Course Trade</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text"  value="<?php echo $COURSE->coursetrade ?>" readonly="">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Course Name</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text"  value="<?php echo $COURSE->cname ?>" readonly="">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Course Id</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text"  value="<?php echo $COURSE->courseid ?>" readonly="">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Add Question</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" id="question" name="question" placeholder="Enter your question">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Answer 1 </label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" id="answer_1" name="answer_1" placeholder="Enter your first answer">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Answer 2 </label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" id="answer_2" name="answer_2" placeholder="Enter your second answer">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Answer 3 </label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" id="answer_3" name="answer_3" placeholder="Enter your Third answer">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Answer 4 </label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" id="answer_4" name="answer_4" placeholder="Enter your forth answer">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-search-input" class="col-md-2 col-form-label">Select Correct Answer</label>
                                                <div class="col-md-10">
                                                    <select class="form-control" name="correct_answer" id="correct_answer">
                                                        <option value="">-- Select the correct answer -- </option>
                                                        <option value="1">Answer 1</option>
                                                        <option value="2">Answer 2</option>
                                                        <option value="3">Answer 3</option>
                                                        <option value="4">Answer 4</option>
                                                    </select>
                                                </div>
                                            </div>



                                            <div class="row">
                                                <div class="col-12" style="display: flex; justify-content: flex-end;margin-top: 15px;">
                                                    <button class="btn btn-primary " type="submit" id="create">Create</button>

                                                </div>
                                                <input type="hidden" name="create">
                                                <input type="hidden" name="course" value="<?php echo $id ?>"> 

                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Manage Questions</h4>


                                        <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                            <thead>
                                                <tr class="bg-transparent">

                                                    <th>  Id</th>
                                                    <th>Question</th>
                                                    <th>Answer 1</th>
                                                    <th>Answer 2</th>
                                                    <th>Answer 3</th>
                                                    <th>Answer 4</th>
                                                    <th>Correct Answer </th> 
                                                    <th style="width: 120px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $QUESTION = new Question(NULL);
                                                foreach ($QUESTION->all() as $key => $question) {
                                                    $key++;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $key ?></td>
                                                        <td><?php echo $question['question'] ?></td>
                                                        <td><?php echo $question['answer_1'] ?></td>
                                                        <td><?php echo $question['answer_2'] ?></td>
                                                        <td><?php echo $question['answer_3'] ?></td>
                                                        <td><?php echo $question['answer_4'] ?></td>
                                                        <td><?php
                                                            if ($question['correct_answer'] == 1) {
                                                                echo 'Answer 1';
                                                            } else if ($question['correct_answer'] == 2) {
                                                                echo 'Answer 2';
                                                            } else if ($question['correct_answer'] == 3) {
                                                                echo 'Answer 3';
                                                            } else {
                                                                echo 'Answer 4';
                                                            }
                                                            ?></td>

                                                        <td>
                                                            <a href="create-questions.php?id=<?php echo $question['id'] ?>">
                                                                <div class="badge bg-pill bg-soft-primary    font-size-14" type="button"><i class="fas fa-pencil-alt  p-1"></i></div>
                                                            </a>

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
        <!-- END layout-wrapper -->


        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
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

        <!-- init js -->
        <script src="assets/js/pages/ecommerce-datatables.init.js"></script>
        <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>
        <!-- App js -->

        <!-- pl        <!-- JAVASCRIPT --> 
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
