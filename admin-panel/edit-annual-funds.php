<?php
include '../class/include.php';
include './auth.php';

$currentYear = date("Y");

date_default_timezone_set("Asia/Colombo");  
$currentDateTime = date("Y-m-d H:i:s");  


$id = '';
$id = $_GET['id'];

$ANNUAL_FUNDS = new AnnualFund($id);
?>
 
<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Manage Accounts | Sl Youth </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="#" name="description" />
        <meta content=" " name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- DataTables -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        
        <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
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
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Dashboard</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                            <li class="breadcrumb-item active">User Type</li>
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

                                        <h4 class="card-title">Add Anual Fund By Type</h4>
                                        <form id="form-data">
                                            
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label"> Current Year  </label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="url" id="year" name="year" placeholder="Enter username" value="<?php echo $ANNUAL_FUNDS->year ?>" readonly="">
                                                </div>
                                            </div>
                                            
                                         <div class="mb-3 row">
    <label for="example-search-input" class="col-md-2 col-form-label">Fund Type</label>
    <div class="col-md-10">
        <select class="form-control" name="type" id="type">
            <option value="">-- Select Fund Type --</option>
            <?php
            $FUND_TYPE = new FundTypes(NULL);
           
            
            foreach ($FUND_TYPE->all() as $fund_type) {
                 if($fund_type['id'] == $ANNUAL_FUNDS->type ){
                    ?>
                    <option value="<?php echo $fund_type['id']; ?>" selected=""><?php echo $fund_type['type']; ?></option>
                    <?php
                 
            }else{
                ?>
                                    <option value="<?php echo $fund_type['id']; ?>" ><?php echo $fund_type['type']; ?></option>

                <?
            }
            }
            ?>
        </select>
    </div>
</div>



                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Amount</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" id="amount" name="amount" placeholder="Enter amount " value="<?php echo $ANNUAL_FUNDS->amount ?>">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Date & time </label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" id="datetime" name="datetime" value="<?php echo $ANNUAL_FUNDS->datetime ?>"  readonly="">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12" style="display: flex; justify-content: flex-end;margin-top: 15px;">
                                                    <button class="btn btn-primary " type="submit" >Update</button>

                                                </div>
                                                <input type="hidden" name="update">

                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div> 
                        </div> 
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
    <script src="assets/libs/select2/js/select2.min.js"></script>

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
         ///////////////////
        <script src="ajax/js/annual-fund.js" type="text/javascript"></script>
         
        <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>
        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>

</html>