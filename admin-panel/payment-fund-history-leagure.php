<?php
include '../class/include.php';
include './auth.php';

$currentYear = date("Y");

date_default_timezone_set("Asia/Colombo");
$currentDateTime = date("Y-m-d H:i:s");

$id = '';
$id = $_GET['id'];


$FUND_TYPES = new FundTypes($id);

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
                                <h4 class="mb-0 text-danger "><?php echo $FUND_TYPES->type ?> -  " <?php echo $currentYear ?> "</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                        <li class="breadcrumb-item active">User Type</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Manage League Types - <span class="text-danger"> " <?php echo $currentYear ?> " </span></h4>

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>League Type Name</th>
                            
                            <th>Amount</th>
                            <th>Paid Amount</th>
                            <th>Avb Amount</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
$currentYear = date("Y");  

$LEAGUE_TYPE = new LeagueTypes(NULL);
$LEAGUE_FUND_AMOUNT = new LeagueFundAmount(NULL);
$PAYMENT_FUND = new PaymentFund(NULL);

$league_types = $LEAGUE_TYPE->all();

if (empty($league_types)) {
    echo "<tr><td colspan='4'>No league types found.</td></tr>";
} else {
    foreach ($league_types as $key => $league_type) {
        $key++;

        
        $amount_array = $LEAGUE_FUND_AMOUNT->getFundAmount($id,$league_type['id'], $currentYear) ?? [];
        $payment_amount_array = $PAYMENT_FUND->getFundAmount($id,$league_type['id'], $currentYear) ?? [];

        $amount_values = !empty($amount_array) ? array_column($amount_array, 'amount') : [];
        $total = !empty($amount_values) ? array_sum($amount_values) : 0;

        $payment_amount_values = !empty($payment_amount_array) ? array_column($payment_amount_array, 'amount') : [];
        $payment_total = !empty($payment_amount_values) ? array_sum($payment_amount_values) : 0;
?>
        <tr id="div<?php echo $league_type['id'] ?>">
            <td><?php echo $key; ?></td>
            <td><?php echo htmlspecialchars($league_type['name']); ?></td>
            <td><?php echo number_format((float) $total, 2); ?></td>
           
            <td><?php echo number_format((float) $payment_total, 2); ?></td>
             <td><?php echo number_format((float) $total -$payment_total, 2); ?></td>
        </tr>
<?php
    }
}
?>

                    </tbody>
                </table>
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