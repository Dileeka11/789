<?php
include '../class/include.php'; 
?>
<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Division Position | Youth Service LTD </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="#" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- DataTables -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
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
 


           



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="">
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Manage Survey Team </h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Positions </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <di 

                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">

                                            <h4 class="card-title">Manage Survey Team </h4>


                                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Districts</th>
                                                        <th>GN Count - <?php
                                                        $GN = new Gndivision(NULL);
                                                        echo count($GN->all());
                                                        ?></th>
                                                        <th>Application Count - <?php $SU = new SurveyTeam(NULL);
                                                        echo 2 * count($SU->all())
                                                        ?></th>
                                                        <th>Action</th>

                                                    </tr>
                                                </thead>


                                                <tbody>
                                                    <?php
                                                    $DISTRICT = new Districts(NULL);
                                                    foreach ($DISTRICT->all() as $key => $district) {
                                                    $key++;
                                                    ?>
                                                    <tr>
                                                        <td> <?php echo $key ?></td>
                                                        <td> <?php echo $district['name'] ?></td>
                                                        <td>
                                                            <?php
                                                            $GN_DIVISION = new Gndivision(NULL);
                                                            $res = $GN_DIVISION->getGnByDistrict($district['id']); 
                                                            echo $res;
                                                            
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $SURVEY_TEAM = new SurveyTeam(NULL); 
                                                            $res2 = $SURVEY_TEAM->getApplicaionByDistrict($district['id']); 
                                                            echo $res2;
                                                            ?>
                                                            
                                                        </td>
                                                        <td>
                                                            <a href="manage-survey-team_ds.php?id=<?php echo $district['id'] ?>" title="View Ds List">
                                                                <div class="badge bg-pill bg-soft-success font-size-14" type="button"><i class=" bx bx-detail  p-1"></i></div>
                                                            </a>

                                                        </td>
                                                    </tr>
                                                    <?php
                                                    }
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
        <!-- Buttons examples -->
        <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="assets/libs/jszip/jszip.min.js"></script>
        <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

        <!-- Responsive examples -->
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <!-- Datatable init js -->
        <script src="assets/js/pages/datatables.init.js"></script> 
        <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>
        <!-- App js -->
        <script src="assets/js/app.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script>
            $(function () {
                $("#start_date").datepicker();
            });
        </script>
        ///////////////////////////////////////
        <script src="ajax/js/positions.js" type="text/javascript"></script>
        <script src="ajax/js/position-by-division.js" type="text/javascript"></script>

        <script>
            $("document").ready(function () {

                $("#position").change(function () {
                    var position = $(this).val();

                    //director training
                    if (position == '4') {
                        $('#name').val('Rashitha Delpola');
                        $('#email').val('emailaddress@gmail.com');
                        $('#phone_number').val('000 000 0000');
                    } else if (position == '5') {
                        //director admin
                        $('#name').val('director admin');
                        $('#email').val('emailaddress@gmail.com');
                        $('#phone_number').val('000 000 0000');
                    } else if (position == '6') {
                        //director finance
                        $('#name').val('Director Finance');
                        $('#email').val('emailaddress@gmail.com');
                        $('#phone_number').val('000 000 0000');
                    } else if (position == '7') {
                        //director development
                        $('#name').val('Director Development');
                        $('#email').val('emailaddress@gmail.com');
                        $('#phone_number').val('000 000 0000');
                    } else if (position == '8') {
                        //chairman
                        $('#name').val('Pasindhu Gunarathna');
                        $('#email').val('emailaddress@gmail.com');
                        $('#phone_number').val('000 000 0000');
                    }
                });
            });
        </script>

    </body>

</html>