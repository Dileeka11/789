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
    <title>Payment Funds | Sl Youth </title>
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
     <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
     
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

                                    <h4 class="card-title">Add Payment Funds </h4>
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
                                                <select class="form-control" name="type" id="type">
                                                    <option value="">-- Select Fund Type --</option>
                                                    <?php
                                                    $FUND_TYPES = new FundTypes(NULL);

                                                    // Fetch all fund types
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
                                        
                                        
                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">League
                                                Type </label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="league_type" id="league_type">
                                                    <option value="">-- Select League Type --</option>
                                                    <?php

                                                    $LEAGUE_TYPE = new LeagueTypes(NULL);
                                                    $league_types = $LEAGUE_TYPE->all();
                                                    foreach ($league_types as $key => $league_type) {
                                                        ?>
                                                        <option value="<?php echo $league_type['id']; ?>">
                                                            <?php echo $league_type['name']; ?></option>
                                                        <?php

                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-url-input"
                                                class="col-md-2 col-form-label text-danger">Availabel Fund </label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="available_fund" name="amount"
                                                    placeholder="Enter amount " readonly="">
                                            </div>
                                        </div>
                                        
 
                                        <div class="mb-3 row">
                                            <label for="example-url-input"
                                                class="col-md-2 col-form-label">Amount</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="amount" name="amount"
                                                    placeholder="Enter amount " >
                                                     <small id="amount-message" class="form-text"></small>
                                            </div>
                                        </div>
                                        
                                         <div class="mb-3 row">
                                            <label for="example-url-input"
                                                class="col-md-2 col-form-label">Description</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control"   id="description" name="description" > </textarea>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">Date & time
                                            </label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="datetime" name="datetime" >
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

                                    <h4 class="card-title">Curent Yeat Payment Funds</h4>

                                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Year</th>
                                                <th>Fund Type</th>
                                                <th>Leagure Type</th>
                                                <th> Amount</th>
                                                <th>Date & Time</th> 
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $PAYMENT_FUND = new PaymentFund(NULL);
                                            foreach ($PAYMENT_FUND->getAllByYear($currentYear) as $key => $payment_fund) {
                                                $FUND_TYPE = new FundTypes($payment_fund['fund_type']);
                                                $LEAGUE_TYPE = new LeagueTypes($payment_fund['league_type']);

                                                $key++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $key; ?></td>
                                                    <td><?php echo $payment_fund['year']; ?></td>
                                                    <td><?php echo $FUND_TYPE->type; ?></td>
                                                     <td><?php echo $LEAGUE_TYPE->name; ?></td>
                                                    <td><?php echo number_format($payment_fund['amount'], 2); ?></td>
                                                     
                                                    <td><?php echo $payment_fund['datetime']; ?></td>
                                                    
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
    <script src="ajax/js/payment-fund.js" type="text/javascript"></script>
    <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        
    <!-- App js -->
    <script src="assets/js/app.js"></script>
  <script>
  $(document).ready(function() {
      $("#datetime").datepicker({
          dateFormat: 'yy-mm-dd'
      }).datepicker("setDate", new Date()); // Set current date
  });
</script>



</body>

</html>