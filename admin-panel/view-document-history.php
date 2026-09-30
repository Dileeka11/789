<?php

use Sabberworm\CSS\CSSList\Document;

include '../class/include.php';
include './auth.php';

$id = $_GET['id'];
$USER = new User($_SESSION['id']);
$DOCUMENT = new Documents($id);


?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>View Letter History | Sri Lanka Youth Services</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="#" name="description" />
    <meta content="#" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="plugin/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="assets/css/preloader.css" rel="stylesheet" type="text/css" />
    <style>
        .sa-input-error {
            display: none !important;
        }

        .sweet-alert textarea {
            resize: vertical;
            width: 100%;
            margin-bottom: 10px;
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
                                <h4 class="mb-0">View Document History - <?= $DOCUMENT->title ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="manage-documents.php">Documents</a></li>
                                        <li class="breadcrumb-item active">View Document History</li>
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



                                    <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                        <thead>
                                            <tr class="bg-transparent">

                                                <th>Id</th>
                                                <th>Division / Position</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                                <th>Date</th>
                                                <th>Minit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $DOC_STATUS = new DocumentStatus(null);
                                            $document_status = $DOC_STATUS->getDocumentStatusByDocumentId($id);
                                            $count = 0;
                                            foreach ($document_status as $key => $status) {
                                                $DIVISION = new Divisions($status['sender_division_id']);
                                                $POSITION = new Positions($status['sender_position_id']);
                                                $status1 = '';
                                                if ($status['status'] == 0) {
                                                    $count++;
                                                    if($count > 1) {
                                                        break;
                                                    }
                                                    $status1 = 'Created';
                                                } elseif ($status['status'] == 1) {
                                                    $status1 = 'Approved';
                                                } elseif ($status['status'] == 2) {
                                                    $status1 = 'Returned';
                                                } elseif ($status['status'] == 3) {
                                                    $status1 = 'Re Sent';
                                                } elseif ($status['status'] == 6) {
                                                    $status1 = 'Accepted';
                                                }
                                                $USER = new User($status['sender_user_id']);
                                                $key++
                                            ?>
                                                <tr>
                                                    <td><?= $key ?></td>

                                                    <td>
                                                        <?= $DIVISION->name . ' / ' . $POSITION->name ?>
                                                    </td>
                                                    <td><?= $USER->name ?></td>
                                                    <td><?= $status1 ?></td>
                                                    <td><?= $DOCUMENT->submit_date ?></td>
                                                    <td><?= $status['reason'] ?></td>
                                                </tr>
                                            <?php }
                                            ?>
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
    <div class="modal fade" id="reApplyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Letter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-data">
                        <div class="row">
                            <input type="file" name="file" id="file" />
                            <input type="hidden" name="document_name" id="document_name" />
                        </div>
                        <div class="row mt-3">
                            <label><b>Enter Minit</b></label>
                            <textarea name="minit" id="minit" rows="5"></textarea>
                        </div>
                        <input type="hidden" name="upload_image">
                        <input type="hidden" id="doc_id">
                        <button type="button" class="btn btn-primary mt-3" id="re-apply-document">Submit</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


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
    <script src="ajax/js/send-message.js" type="text/javascript"></script>
    <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <!-- ckeditor -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.2.2/tinymce.min.js"></script>
    <script src="ajax/js/submit-document.js" type="text/javascript"></script>
    <script>
        tinymce.init({
            selector: '.question'
        });
    </script>


</body>

</html>