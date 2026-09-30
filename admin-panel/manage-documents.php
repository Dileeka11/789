<?php

use Sabberworm\CSS\CSSList\Document;

include '../class/include.php';
include './auth.php';


$USER = new User($_SESSION['id']);


?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Manage Documents | Sri Lanka Youth Services</title>

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
                                <h4 class="mb-0">Manage Documents</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Manage Documents</li>
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

                                                <th> Id</th>
                                                <th>Letter Type</th>
                                                <th>Title </th>
                                                <th>Submited Division </th>
                                                <th>Current Division / Position </th>
                                                <th>Copies </th>
                                                <th>Submit Date </th>
                                                <th style="width: 120px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $DOC = new Documents(null);
                                            $sent_documents_ids = $DOC->getSentDocumentsIds($USER->division, $USER->position);
                                            $DOCUMENT_STATUS = new DocumentStatus(NULL);
                                            $related_documents_ids = $DOCUMENT_STATUS->getLatestDocumentStatusByDivision($USER->division, $USER->position);
                                            $mergedArray = array_merge($sent_documents_ids, $related_documents_ids);

                                            $unique_documents_ids = [];

                                            foreach ($mergedArray as $item) {
                                                if (!isset($uniqueArray[$item])) {
                                                    $unique_documents_ids[$item] = $item;
                                                }
                                            }

                                            // Convert the associative array back to indexed array
                                            $unique_documents_ids = array_values($unique_documents_ids);
                                            rsort($unique_documents_ids);

                                            foreach ($unique_documents_ids as $key => $document_id) {
                                                $DOCUMENT = new Documents($document_id);
                                                $SENDER_DIVISION = new Divisions($DOCUMENT->sender_division_id);
                                                $CURRENT_DIVISION = new Divisions($DOCUMENT->receiver_division_id);
                                                $CURRENT_POSITION = new Positions($DOCUMENT->current_position);
                                                $DOCUMENT_COPY  = new DocumentCopies(null);
                                                $document_copies = $DOCUMENT_COPY->getCopiesByDocumentId($DOCUMENT->id);
                                                $OTHER_DOCUMENT_DIVISION  = new OtherDocumentDivision(null);
                                                $other_divisions = $OTHER_DOCUMENT_DIVISION->getOtherDivisionsByDocumentId($DOCUMENT->id);

                                                $OTHER_DOCUMENT_DIVISION  = new OtherDocumentDivision(null);
                                                $get_current_user = $OTHER_DOCUMENT_DIVISION->getCurrentUserByDivision($DOCUMENT->id, $USER->division, $USER->position);

                                                $copy_list = '';
                                                $other_division_list = '';
                                                if (count($document_copies) > 0) {
                                                    foreach ($document_copies as $key1 => $document_copy) {
                                                        $COPY_DIVISION = new Divisions($document_copy['division_id']);
                                                        if ($key1 == 0) {
                                                            $copy_list = $COPY_DIVISION->name;
                                                        } else {
                                                            $copy_list .= "<br />" . $COPY_DIVISION->name;
                                                        }
                                                    }
                                                }
                                                if ($DOCUMENT->type == 2 || $DOCUMENT->type == 3) {
                                                    if (count($other_divisions) > 0) {
                                                        foreach ($other_divisions as $key2 => $division) {
                                                            $OTHER_DIVISION = new Divisions($division['division_id']);
                                                            $OTHER_DIVISION_POSITION = new Positions($division['current_position_id']);
                                                            if ($key2 == 0) {
                                                                $other_division_list = $OTHER_DIVISION->name . ' / ' . $OTHER_DIVISION_POSITION->name;
                                                            } else {
                                                                $other_division_list .= "<br />" . $OTHER_DIVISION->name . ' / ' . $OTHER_DIVISION_POSITION->name;
                                                            }
                                                        }
                                                    }
                                                }
                                                $key++
                                            ?>
                                                <tr>
                                                    <td><?= $key ?></td>
                                                    <td>
                                                        <?= $DOCUMENT->type == 1 ? 'Division Through' : ($DOCUMENT->type == 2 ? 'Other Division' : 'Division Through and Other Division') ?>
                                                    </td>

                                                    <td>
                                                        <?= $DOCUMENT->title ?>
                                                    </td>
                                                    <td><?= $SENDER_DIVISION->name ?></td>
                                                    <td>
                                                        <?php
                                                        if ($DOCUMENT->type == 1 || $DOCUMENT->type == 3) {
                                                            echo $CURRENT_DIVISION->name . ' / ' . $CURRENT_POSITION->name;
                                                        }
                                                        if ($DOCUMENT->type == 3) {
                                                            echo "<br />" .  $other_division_list;
                                                        } elseif ($DOCUMENT->type == 2) {
                                                            echo $other_division_list;
                                                        }
                                                        ?>
                                                    </td>

                                                    <td><?= $copy_list ?? '-' ?></td>
                                                    <td><?= $DOCUMENT->submit_date ?></td>
                                                    <td>
                                                        <a href="../upload/files/<?= $DOCUMENT->document; ?>" attributes-list download target="_blank" title="Download Letter">
                                                            <div class="badge bg-pill bg-soft-warning font-size-14" type="button"><i class="fas fa-download  p-1"></i></div>
                                                        </a> |
                                                        <a href="view-document.php?id=<?= $DOCUMENT->id; ?>" title="View Document History">
                                                            <div class="badge bg-pill bg-soft-info font-size-14" type="button"><i class="fas fa-eye  p-1"></i></div>
                                                        </a> |
                                                        <?php
                                                        if (($DOCUMENT->receiver_division_id == $USER->division && $DOCUMENT->current_position == $USER->position) || isset($get_current_user)) {
                                                            if (($DOCUMENT->receiver_division_id == $USER->division && $DOCUMENT->current_position == $USER->position) && $DOCUMENT->current_status == 2) {
                                                        ?>
                                                                <a href="#" title="Re Apply Letter" class="open-modal" data-bs-toggle="modal" data-bs-target="#reApplyModal" data-id="<?= $DOCUMENT->id; ?>">
                                                                    <div class="badge bg-pill bg-soft-success font-size-14" data-id="<?= $DOCUMENT->id; ?>"><i class="fas fa-share p-1"></i></div>
                                                                </a> |
                                                                <?php
                                                            } else {
                                                                if (!(($DOCUMENT->receiver_division_id == $USER->division) && ($DOCUMENT->current_position == $USER->position) && ($DOCUMENT->current_status == 6)) && !isset($get_current_user)) {
                                                                    if ($USER->position != 7) {
                                                                ?>
                                                                        <a href="#" title="Approve Letter">
                                                                            <div class="badge bg-pill bg-soft-success font-size-14 approve-document" data-id="<?= $DOCUMENT->id; ?>"><i class="fas fa-share p-1"></i></div>
                                                                        </a> |
                                                                    <?php
                                                                    }
                                                                }
                                                                if ((isset($get_current_user) && $get_current_user['current_status'] != 6)) {
                                                                    if ($USER->position != 7) {
                                                                    ?>
                                                                        <a href="#" title="Approve Letter">
                                                                            <div class="badge bg-pill bg-soft-success font-size-14 approve-document" data-id="<?= $DOCUMENT->id; ?>"><i class="fas fa-share p-1"></i></div>
                                                                        </a> |
                                                                    <?php
                                                                    }
                                                                }
                                                            }
                                                            if (!(($DOCUMENT->sender_division_id == $USER->division) && ($DOCUMENT->sender_position_id == $USER->position))) {
                                                                if (!(($DOCUMENT->receiver_division_id == $USER->division) && ($DOCUMENT->current_position == $USER->position) && ($DOCUMENT->current_status == 6))  && !isset($get_current_user)) {
                                                                    ?>
                                                                    <a href="#" title="Accept Letter">
                                                                        <div class="badge bg-pill bg-soft-primary font-size-14 accept-document" data-id="<?= $DOCUMENT->id; ?>"><i class="fas fa-check p-1"></i></div>
                                                                    </a> |
                                                                    <?php
                                                                    if ($DOCUMENT->sender_division_id == $USER->division) {
                                                                    ?>
                                                                        <a href="#" title="Return Letter">
                                                                            <div class="badge bg-pill bg-soft-danger font-size-14 return-document" data-id="<?= $DOCUMENT->id; ?>"><i class="fas fa-reply p-1"></i></div>
                                                                        </a> |
                                                                    <?php
                                                                    }
                                                                }
                                                                if ((isset($get_current_user) && $get_current_user['current_status'] != 6)) {
                                                                    ?>
                                                                    <a href="#" title="Accept Letter">
                                                                        <div class="badge bg-pill bg-soft-primary font-size-14 accept-document" data-id="<?= $DOCUMENT->id; ?>"><i class="fas fa-check p-1"></i></div>
                                                                    </a> |
                                                                    <?php
                                                                    if ($DOCUMENT->sender_division_id == $USER->division) {
                                                                    ?>
                                                                        <a href="#" title="Return Letter">
                                                                            <div class="badge bg-pill bg-soft-danger font-size-14 return-document" data-id="<?= $DOCUMENT->id; ?>"><i class="fas fa-reply p-1"></i></div>
                                                                        </a> |
                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        ?>

                                                        <a href="view-document-history.php?id=<?= $DOCUMENT->id; ?>" title="View Document History">
                                                            <div class="badge bg-pill bg-soft-info font-size-14" type="button"><i class="fas fa-history  p-1"></i></div>
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