<?php
include '../class/include.php';
include './auth.php';

$currentYear = date("Y");

date_default_timezone_set("Asia/Colombo");
$currentDateTime = date("Y-m-d H:i:s");
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
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

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
                                        <li class="breadcrumb-item active">League Type</li>
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

                                    <h4 class="card-title">Add League Fund By Type</h4>
                                    <form id="form-data">

                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label"> Current Year
                                            </label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="url" id="year" name="year"
                                                    placeholder="Enter username" value="<?php echo $currentYear ?>"
                                                    readonly="">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Fund
                                                Type</label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="fund_type" id="fund_type">
                                                    <option value="">-- Select Fund Type --</option>
                                                    <?php

                                                    $FUND_TYPES = new FundTypes(NULL);
 
                                                    foreach ($FUND_TYPES->all() as $fund_type) {
                                                        ?>
                                                        <option value="<?php echo $fund_type['id']; ?>">
                                                            <?php echo $fund_type['type']; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div> 

                                         <div class="mb-3 row text-danger">
                                            <label for="example-url-input" class="col-md-2 col-form-label"> Available Funds
                                            </label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="url" id="available_fund" name="available_fund" readonly="">
                                            </div>
                                        </div>

                                     <div class="mb-3 row">
    <label for="example-search-input" class="col-md-2 col-form-label">League Type</label>
    <div class="col-md-10">
        <select class="form-control" name="league_type" id="league_type">
            <option value="">-- Select League Type --</option>
            <?php
          
            $LEAGUE_TYPES = new LeagueTypes(NULL);   
            foreach ($LEAGUE_TYPES->all() as $league_type) { 
                    ?>
                    <option value="<?php echo $league_type['id']; ?>">
                        <?php echo $league_type['name']; ?>
                    </option>
                    <?php
                 
            }
            ?>
        </select>
    </div>
</div>



                                        <div class="mb-3 row">
                                            <label for="example-url-input"
                                                class="col-md-2 col-form-label">Amount</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="amount" name="amount"
                                                    placeholder="Enter amount ">
                                                <small id="amount-message" class="form-text"></small>
                                                <!-- Message appears here -->
                                            </div>
                                        </div>


                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Date & time
                                            </label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="datetime" name="datetime"
                                                    value="<?php echo $currentDateTime ?>" readonly="">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12"
                                                style="display: flex; justify-content: flex-end;margin-top: 15px;">
                                                <button class="btn btn-primary " type="submit"
                                                    id="create">Create</button>

                                            </div>
                                            <input type="hidden" name="create">

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

                                    <h4 class="card-title">Manage Funds</h4>

                                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th> 
                                                <th>Fund Type</th>
                                                 <th>League  Type</th>
                                                <th>Amount</th> 
                                                <th>Date & Time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $LEAGUE_FUND_AMOUNT = new LeagueFundAmount(NULL);
                                            foreach ($LEAGUE_FUND_AMOUNT->getByYear($currentYear) as $key => $league_fund_fund) {
                                                $FUND_TYPE = new FundTypes($league_fund_fund['fund_type']);
                                                $LEAGUE_TYPES = new LeagueTypes($league_fund_fund['league_type']);  
                                                $key++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $key; ?></td>
                                                    
                                                    <td><?php echo $FUND_TYPE->type; ?></td>
                                                     <td><?php echo $LEAGUE_TYPES->name; ?></td>
                                                     
                                                    <td><?php echo number_format($league_fund_fund['amount'], 2); ?></td> 
                                                    <td><?php echo $league_fund_fund['datetime']; ?></td>
                                                    <td>
                                                        <a href="#" class="">
                                                            <div class="badge bg-pill bg-soft-primary font-size-14  "
                                                                title="Edit">
                                                                <i class=" bx bx-pencil   p-1"></i>
                                                            </div>
                                                        </a>
                                                        |
                                                        <a href="your-payment-history-page-url" class="text-decoration-none"
                                                            title="View Payment History">
                                                            <div class="badge bg-pill bg-soft-warning font-size-14">
                                                                <i class="bx bx-time p-1"></i>
                                                            </div>
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
    <script src="ajax/js/league-fund-amount.js" type="text/javascript"></script>

    <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>

</body>

</html>