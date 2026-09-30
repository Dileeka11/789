<?php
include '../class/include.php';
include './auth.php';

$id = $_GET['id'];
$COURSE = new Course($id);
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Create Theory Paper | Sri Lanka Youth Services</title>

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
                                <h4 class="mb-0">Theory Paper Questions</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                                        <li class="breadcrumb-item active">Manage Theory Paper</li>
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

                                    <h4 class="card-title">Theory Paper</h4>
                                    <form id="form-data">
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Exam Paper Title</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="title" name="title" placeholder="Enter the Exam paper title">
                                            </div>
                                        </div>
                                        <?php
                                        if ($COURSE->english_lang == 1) {
                                        ?>
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">PDF Document (English)</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="file" id="essay_paper" name="essay_paper">
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        if ($COURSE->sinhala_lang == 1) {
                                        ?>
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">PDF Document (Sinhala)</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="file" id="essay_paper_sinhala" name="essay_paper_sinhala">
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        if ($COURSE->tamil_lang == 1) {
                                        ?>
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">PDF Document (Tamil)</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="file" id="essay_paper_tamil" name="essay_paper_tamil">
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-12" style="display: flex; justify-content: flex-end;margin-top: 15px;">
                                                <button class="btn btn-primary " type="submit" id="create">Create</button>

                                            </div>
                                            <input type="hidden" name="create">
                                            <input type="hidden" name="course_id" value="<?php echo $id ?>">

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

                                    <h4 class="card-title">Manage Theory Paper</h4>


                                    <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                        <thead>
                                            <tr class="bg-transparent">

                                                <th>Id</th>
                                                <th>Title</th>
                                                <?php
                                                if ($COURSE->english_lang == 1) {
                                                ?>

                                                    <th>English Paper</th>
                                                <?php
                                                }
                                                if ($COURSE->sinhala_lang == 1) {
                                                ?>

                                                    <th>Sinhala Paper</th>
                                                <?php
                                                }
                                                if ($COURSE->tamil_lang == 1) {
                                                ?>

                                                    <th>Tamil Paper</th>
                                                <?php
                                                }
                                                ?>
                                                <th style="width: 120px;" class="">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $WRITTING_PAPERS = new WrittingPapers(NULL);
                                            foreach ($WRITTING_PAPERS->getPapersByCourse($id) as $key => $question) {
                                                $key++;
                                            ?>
                                                <tr id="div<?php echo $question['id'] ?>">
                                                    <td><?php echo $key ?></td>
                                                    <td><?php echo $question['title'] ?></td>
                                                    <?php
                                                    if ($COURSE->english_lang == 1) {
                                                    ?>
                                                        <td><a href="../nc_assets/uploads/essay-papers/<?php echo $question['pdf_doc'] ?>" target="_blank"> Click View</a></td>
                                                    <?php
                                                    }
                                                    if ($COURSE->sinhala_lang == 1) {
                                                    ?>
                                                        <td><a href="../nc_assets/uploads/essay-papers/<?php echo $question['pdf_doc_sinhala'] ?>" target="_blank"> Click View</a></td>
                                                    <?php
                                                    }
                                                    if ($COURSE->tamil_lang == 1) {
                                                    ?>
                                                        <td><a href="../nc_assets/uploads/essay-papers/<?php echo $question['pdf_doc_tamil'] ?>" target="_blank"> Click View</a></td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <td class="">
                                                        <a href="edit-esay-paper.php?id=<?php echo $question['id'] ?>" class="hidden">
                                                            <div class="badge bg-pill bg-soft-primary    font-size-14" type="button"><i class="fas fa-pencil-alt  p-1"></i></div>
                                                        </a>
                                                        <div class="badge bg-pill bg-soft-danger font-size-14 delete-essay-paper" data-id="<?php echo $question['id'] ?>"><i class="fas fa-trash  p-1"></i></div>

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
    <script src="ajax/js/writting-paper.js" type="text/javascript"></script>

    <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <!-- ckeditor -->
    <script src="delete/js/written-paper.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.2.2/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '#question'
        });
    </script>


</body>

</html>