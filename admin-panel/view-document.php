<?php

use Sabberworm\CSS\CSSList\Document;

include '../class/include.php';
include './auth.php';
$id = $_GET['id'];
$USER = new User($_SESSION['id']);
$DOCUMENT = new Documents($id);
$SENDER_DIVISION = new Divisions($DOCUMENT->sender_division_id);
$CURRENT_DIVISION = new Divisions($DOCUMENT->receiver_division_id);
$CURRENT_POSITION = new Positions($DOCUMENT->current_position);
$DOCUMENT_COPY  = new DocumentCopies(null);
$document_copies = $DOCUMENT_COPY->getCopiesByDocumentId($DOCUMENT->id);
$OTHER_DOCUMENT_DIVISION  = new OtherDocumentDivision(null);
$other_divisions = $OTHER_DOCUMENT_DIVISION->getOtherDivisionsByDocumentId($DOCUMENT->id);

$OTHER_DOCUMENT_DIVISION  = new OtherDocumentDivision(null);
$get_current_user = $OTHER_DOCUMENT_DIVISION->getCurrentUserByDivision($DOCUMENT->id, $USER->division, $USER->position);



?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>View Document | Sri Lanka Youth Services</title>

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
        .badge {
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
                                <h4 class="mb-0">View Document - <?= $DOCUMENT->title ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="manage-documents.php">Documents</a></li>
                                        <li class="breadcrumb-item active">View Document</li>
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
                                    <iframe src="../upload/files/<?= $DOCUMENT->document; ?>" allowfullscreen width="100%" height="600px"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                                    if ($count > 1) {
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
                                                $USER1 = new User($status['sender_user_id']);
                                                $key++
                                            ?>
                                                <tr>
                                                    <td><?= $key ?></td>

                                                    <td>
                                                        <?= $DIVISION->name . ' / ' . $POSITION->name ?>
                                                    </td>
                                                    <td><?= $USER1->name ?></td>
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
                    <?php
                    if ((($DOCUMENT->receiver_division_id == $USER->division && $DOCUMENT->current_position == $USER->position) || isset($get_current_user)) && ($DOCUMENT->current_status != 6)) {
                    ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form id="form-data">
                                            <?php
                                            if ($DOCUMENT->current_status != 6) {
                                            ?>
                                                <div class="col-md-12 row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">Add Your Minit here</label>
                                                     
                                                        <textarea class="form-control question" id="minit" name="minit"></textarea>

                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            if (($DOCUMENT->receiver_division_id == $USER->division && $DOCUMENT->current_position == $USER->position) && $DOCUMENT->current_status == 2) {
                                            ?>
                                                <div class="mb-3 row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">Attach Document <span class="text-danger">(PDF Only)</span> </label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="file" placeholder="Enter course name" name="file" id="file" required>
                                                        <input type="hidden" name="document_name" id="document_name" />
                                                    </div>
                                                    <input type="hidden" name="upload_image">
                                                </div>

                                                <div class="" style="display: flex; justify-content: flex-end;margin-top: 15px;">
                                                    <div title="Re Apply Letter" class="re-apply-document me-3" data-id="<?= $DOCUMENT->id; ?>">
                                                        <div class="badge bg-pill bg-soft-success font-size-14" data-id="<?= $DOCUMENT->id; ?>"><i class="fas fa-share p-1"></i>Re Apply</div>
                                                    </div>
                                                <?php
                                            } else {
                                                ?>
                                                    <div class="" style="display: flex; justify-content: flex-end;margin-top: 15px;margin-bottom: 20px;">
                                                        <?php
                                                        if (!(($DOCUMENT->receiver_division_id == $USER->division) && ($DOCUMENT->current_position == $USER->position) && ($DOCUMENT->current_status == 6)) && !isset($get_current_user)) {
                                                            if ($USER->position != 7) {
                                                        ?>
                                                                <div title="Approve Letter" class="me-3">
                                                                    <div class="badge bg-pill bg-soft-success font-size-14 approve-document" data-id="<?= $DOCUMENT->id; ?>"><i class="fas fa-share p-1"></i>Approve</div>
                                                                </div>
                                                            <?php
                                                            }
                                                        }
                                                        if ((isset($get_current_user) && $get_current_user['current_status'] != 6)) {
                                                            if ($USER->position != 7) {
                                                            ?>
                                                                <div title="Approve Letter" class="me-3">
                                                                    <div class="badge bg-pill bg-soft-success font-size-14 approve-document" data-id="<?= $DOCUMENT->id; ?>"><i class="fas fa-share p-1"></i>Approve</div>
                                                                </div>
                                                            <?php
                                                            }
                                                        }
                                                    }
                                                    if (!(($DOCUMENT->sender_division_id == $USER->division) && ($DOCUMENT->sender_position_id == $USER->position))) {
                                                        if (!(($DOCUMENT->receiver_division_id == $USER->division) && ($DOCUMENT->current_position == $USER->position) && ($DOCUMENT->current_status == 6))  && !isset($get_current_user)) {
                                                            ?>
                                                            <div title="Accept Letter" class="me-3">
                                                                <div class="badge bg-pill bg-soft-primary font-size-14 accept-document" data-id="<?= $DOCUMENT->id; ?>"><i class="fas fa-check p-1"></i>Accept</div>
                                                            </div>
                                                            <?php
                                                            if ($DOCUMENT->sender_division_id == $USER->division) {
                                                            ?>
                                                                <div title="Return Letter" class="me-3">
                                                                    <div class="badge bg-pill bg-soft-danger font-size-14 return-document" data-id="<?= $DOCUMENT->id; ?>"><i class="fas fa-reply p-1"></i>Return</div>
                                                                </div>
                                                            <?php
                                                            }
                                                        }
                                                        if ((isset($get_current_user) && $get_current_user['current_status'] != 6)) {
                                                            ?>
                                                            <div title="Accept Letter" class="me-3">
                                                                <div class="badge bg-pill bg-soft-primary font-size-14 accept-document" data-id="<?= $DOCUMENT->id; ?>"><i class="fas fa-check p-1"></i>Accept</div>
                                                            </div>
                                                            <?php
                                                            if ($DOCUMENT->sender_division_id == $USER->division) {
                                                            ?>
                                                                <div title="Return Letter" class="me-3">
                                                                    <div class="badge bg-pill bg-soft-danger font-size-14 return-document" data-id="<?= $DOCUMENT->id; ?>"><i class="fas fa-reply p-1"></i>Return</div>
                                                                </div>
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    </div>

                                        </form>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    <?php
                    }
                    ?>
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
    <script src="ajax/js/send-message.js" type="text/javascript"></script>
    <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <!-- ckeditor -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.2.2/tinymce.min.js"></script>
    <script src="ajax/js/view-document.js" type="text/javascript"></script>
    <script>
        tinymce.init({
            selector: '.question'
        });
    </script>


</body>

</html>