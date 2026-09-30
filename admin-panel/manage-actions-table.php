<?php
include '../class/include.php';

include './auth.php';

$id = '';
$id = $_GET['id'];
$EXAM_PERIOD = new ExamPeriod($id);
?>

<html lang="en">



<head>



    <meta charset="utf-8" />

    <title>Manage Action Panel </title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta content="" name="description" />

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
    <link href="plugin/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />

    <!-- App Css-->

    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />



</head>





<body>



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

                                <h4 class="mb-0">Manage Action Panel | Year- <?php echo $EXAM_PERIOD->year. ' | Batch- '. $EXAM_PERIOD->batch ?></h4>



                                <div class="page-title-right">

                                    <ol class="breadcrumb m-0">

                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>

                                        <li class="breadcrumb-item active">Manage Centers</li>

                                    </ol>

                                </div>



                            </div>

                        </div>

                    </div>

                    <!-- end page title -->

<div class="row">
                          

                    <div class="row">

                        <div class="col-lg-12">

                            <div>





                                <div class="table-responsive mb-4">

                                    <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">

                                        <thead>

                                            <tr class="bg-transparent">



                                                <th>Id</th>

                                                <th> Action Name </th>

                                                <th> Action Status </th>


                                                <th style="width: 120px;">Action</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php
                                            $ACTION_PANEL = new ActionPanel(NULL);
                                            foreach ($ACTION_PANEL->getWithoutExam() as $key => $action_panel) {
                                                $key++;
                                            ?>
                                                <tr>

                                                    <td><?= $key ?></td>

                                                    <td> <?= $action_panel['action_name'] ?> </td>

                                                    <td>
                                                        
                                                        <?php
                                                        if($action_panel['status_name'] == 'name_edit'){
                                                              if ($EXAM_PERIOD->name_edit_status == 1  ) {
                                                                  ?>
                                                                    <p class="text-success"> Active </p>
                                                                    <?php
                                                              }else{
                                                                  ?>
                                                                   <p class="text-danger"> In Active </p>
                                                                  <?php
                                                              }
                                                        }
                                                        
                                                         if($action_panel['status_name'] == 'practical_mark'){
                                                              if ($EXAM_PERIOD->practical_mark_status == 1  ) {
                                                                  ?>
                                                                    <p class="text-success"> Active </p>
                                                                    <?php
                                                              }else{
                                                                  ?>
                                                                   <p class="text-danger"> In Active </p>
                                                                  <?php
                                                              }
                                                        }
                                                        
                                                        ?> 
                                                    </td>



                                                    <td>


                                                        <div class="badge bg-pill bg-soft-warning font-size-14 action" data-id="<?php echo $action_panel['id']?>" exam_id="<?php echo $id ?>" type="button"><i class="fa fa-toggle-on  p-1"></i></div>

                                                    </td>

                                                </tr>
                                            <?php } ?>


                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- end row -->



                </div> <!-- container-fluid -->

            </div>

            <!-- End Page-content -->






        </div>

        <!-- end main content-->



    </div>

    <!-- END layout-wrapper -->





    <!-- Right bar overlay-->

    <div class="rightbar-overlay"></div>



    <!-- JAVASCRIPT -->

    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="ajax/js/action-panel.js"></script>


    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/libs/metismenu/metisMenu.min.js"></script>

    <script src="assets/libs/simplebar/simplebar.min.js"></script>

    <script src="assets/libs/node-waves/waves.min.js"></script>

    <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>

    <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>

    <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>


    <!-- Required datatable js -->

    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>

    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>



    <!-- Responsive examples -->

    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>

    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>



    <!-- init js -->

    <script src="assets/js/pages/ecommerce-datatables.init.js"></script>



    <!-- App js -->

    <script src="assets/js/app.js"></script>



</body>



</html>