<?php
include '../class/include.php';
include './auth.php';
date_default_timezone_set('Asia/Colombo'); ;

$currentYear = date("Y"); // Get the current year
 

?>
<!doctype html>

<html lang="en">

<head>

    <meta charset="utf-8" />
    <title> Shedule Exam</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="#" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- DataTables -->
  
    <!-- plugin css -->
    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet" type="text/css">
    <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/libs/@chenfengyuan/datepicker/datepicker.min.css">
    <link href="plugin/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/preloader.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="assets/libs/jquery/jquery-2.2.4.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script> <!-- Load Data Labels Plugin -->

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
                        
                   
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
             
            
            <div class="col-md-6">
                                                    <label class="col-md-12 col-form-label"> Select end year  *</label>
                                                    <select class="form-select form-control mb-3" id="start_year" name="start_year" required>
                                                <option selected value="">-- Select Start Year --</option>
                                                <?php
                                                for ($year = 2023; $year <= $currentYear; $year++) {
                                                    echo "<option value='$year'>$year</option>";
                                                }
                                                ?>
                                            </select>
                                                </div>
                                                
                                <div class="col-md-6">
                                                    <label class="col-md-12 col-form-label"> Select end year  *</label>
                                                   <select class="form-select form-control mb-3" id="end_year" name="end_year" required>
                                                <option selected value="">-- Select End Year --</option>
                                                <?php
                                                for ($year = 2023; $year <= $currentYear; $year++) {
                                                    echo "<option value='$year' " . ($year == $currentYear ? "selected" : "") . ">$year</option>";
                                                }
                                                ?>
                                            </select>
                                                </div>
                                                
                                                
 
        </div>
        
                                
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    
        
                                <canvas id="applicationsChart"></canvas>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- END layout-wrapper -->


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {

            $('.date').datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: "today"
            })
            $('#departure-date').datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: +1

            })
        });
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.time').timepicker({});
        });
    </script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="assets/libs/select2/js/select2.min.js"></script>
    <!-- Required datatable js -->
  
    <!-- Responsive examples -->
     <!-- init js -->
    <script src="assets/js/pages/ecommerce-datatables.init.js"></script>
    <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script> 
   
     <!-- App js -->

    <!-- pl  JAVASCRIPT -->
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
  

     <script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
    <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="assets/libs/@chenfengyuan/datepicker/datepicker.min.js"></script>

    <!-- init js -->
 
    <!-- App js -->
    <script src="assets/js/app.js"></script>
    
<script>
    $(document).ready(function () {
        const ctx = document.getElementById('applicationsChart').getContext('2d');

        let applicationsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [
                    {
                        label: "Applications",
                        data: [],
                        backgroundColor: "rgba(54, 162, 235, 0.7)",
                        barThickness: 50 // Reduced bar width
                    },
                    {
                        label: "Total Students",
                        data: [],
                        backgroundColor: "rgba(255, 159, 64, 0.7)",
                        barThickness: 50
                    },
                    {
                        label: "Pass Students",
                        data: [],
                        backgroundColor: "rgba(75, 192, 192, 0.7)",
                        barThickness: 50
                    },
                    {
                        label: "Fail Students",
                        data: [],
                        backgroundColor: "rgba(255, 99, 132, 0.7)",
                        barThickness: 50
                    },
                    {
                        label: "Absent Students",
                        data: [],
                        backgroundColor: "rgba(153, 102, 255, 0.7)",
                        barThickness: 50
                    }
                ]
            },
            options: {
                responsive: true,
                scales: { 
                    y: { beginAtZero: true } 
                }
            }
        });

        function fetchData(startYear, endYear) {
            if (!startYear || !endYear) {
                alert("Please select both Start Year and End Year.");
                return;
            }

            $.ajax({
                url: 'ajax/php/chart.php',
                type: 'POST',
                data: { start_year: startYear, end_year: endYear },
                dataType: 'json',
                success: function (data) {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    let years = Object.keys(data);
                    let applications = [];
                    let totalStudents = [];
                    let passStudents = [];
                    let failStudents = [];
                    let absentStudents = [];

                    years.forEach(year => {
                        applications.push(data[year].applications || 0);
                        totalStudents.push(data[year].students || 0);
                        passStudents.push(data[year].pass_students || 0);
                        failStudents.push(data[year].fail_students || 0);
                        absentStudents.push(data[year].absent_students || 0);
                    });

                    applicationsChart.data.labels = years;
                    applicationsChart.data.datasets[0].data = applications;
                    applicationsChart.data.datasets[1].data = totalStudents;
                    applicationsChart.data.datasets[2].data = passStudents;
                    applicationsChart.data.datasets[3].data = failStudents;
                    applicationsChart.data.datasets[4].data = absentStudents;
                    applicationsChart.update();
                },
                error: function () {
                    alert('Error fetching data');
                }
            });
        }

        // Set default values
        let defaultStartYear = $('#start_year').val() || 2023;
        let defaultEndYear = $('#end_year').val() || new Date().getFullYear();

        // Fetch data with defaults
        fetchData(defaultStartYear, defaultEndYear);

        // Update chart when year selection changes
        $('#start_year, #end_year').change(function () {
            let startYear = $('#start_year').val();
            let endYear = $('#end_year').val();

            if (!startYear || !endYear) {
                alert("Please select both Start Year and End Year.");
                return;
            }

            if (parseInt(startYear) > parseInt(endYear)) {
                alert("Start year must be before or equal to End year.");
                return;
            }

            fetchData(startYear, endYear);
        });
    });
</script>



</body>

</html>