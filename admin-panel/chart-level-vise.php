<?php
include '../class/include.php';
include './auth.php';

$USERS = new User($_SESSION['id']);
date_default_timezone_set('Asia/Colombo'); ;

$currentYear = date("Y"); // Get the current year

?>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title> Chart Leval Vise  | Sl Youth Sri Lanka</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- DataTables -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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
       <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script type="text/javascript" src="assets/libs/jquery/jquery-2.2.4.min.js"></script>
        <style>
            .assign-student-section .select2 {
                width: 100% !important;
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
                                    <h4 class="mb-0">Students Performance Report by Center Vise </h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                            <li class="breadcrumb-item active"> Students Performance Report by Center Vise</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                       
  
                                              <div class="card-body">
                                             
                                            <div class="row mb-4">
            
                                                 <div class="col-md-3">
                                                    <label class="col-md-12 col-form-label">  Start Year  *</label>
                                                    <select class="form-select form-control mb-3" id="start_year" name="start_year" required>
                                                <option selected value="">--  Start Year --</option>
                                                <?php
                                                for ($year = 2023; $year <= $currentYear; $year++) {
                                                    echo "<option value='$year'>$year</option>";
                                                }
                                                ?>
                                            </select>
                                                </div>
                                                
                                            <div class="col-md-3">
                                                    <label class="col-md-12 col-form-label"> End Year  *</label>
                                                   <select class="form-select form-control mb-3" id="end_year" name="end_year" required>
                                                <option selected value="">--  End Year --</option>
                                                <?php
                                                for ($year = 2023; $year <= $currentYear; $year++) {
                                                    echo "<option value='$year' " . ($year == $currentYear ? "selected" : "") . ">$year</option>";
                                                }
                                                ?>
                                            </select>
                                            </div>
                                                
                                            <div class="col-md-3">
                                                    <label class="col-md-12 col-form-label"> Batch  *</label>
                                                   <select class="form-select form-control mb-3" id="chart_batch" name="chart_batch" required>
                                                <option selected value="">-- All Batches --</option>
                                                <?php
                                                $DEFULT_DATA = new DefaultData();
                                                foreach($DEFULT_DATA->CourseBatch() as $key=>$batch){
                                                     echo "<option value='$key'>$batch</option>";
                                                }
                                                ?>
                                            </select>
                                            </div>    
                                            <div class="col-md-3">
                                                    <label class="col-md-12 col-form-label"> Course Type  *</label>
                                                   <select class="form-select form-control mb-3" id="course_type" name="course_type" required>
                                               <option   value="">-- All Course Types --</option>
<?php
$DEFULT_DATA = new DefaultData();
foreach($DEFULT_DATA->nvqLevel() as $key => $nvqlevel){
     
 
    echo "<option value='$key'  >$nvqlevel</option>";
}
                                                ?>
                                            </select>
                                            </div>    
                                         </div>
                                            
                                        </div> 


                                </div>
                            </div> <!-- end col -->
                        </div>

                        <div class="row" style="margin-top: 30px;">

                            <div class="col-lg-12">
 
                                    <div class="card">
                                        
                                     <div class="card-body" style="position: relative;">
     
                                            <div id="loader" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                                    <img src="https://i.gifer.com/VAyR.gif" alt="Loading..." width="80" height="80">
                                                  </div>

    
                                                <canvas id="applicationsChart"></canvas>
                                    </div>
 
                                </div>

                            </div>

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

        <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

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

        <!-- Responsive examples -->
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <!-- init js -->
        <script src="assets/js/pages/ecommerce-datatables.init.js"></script>
        <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>
        <!-- App js -->

        <!-- pl  JAVASCRIPT -->
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
        <script src="assets/libs/select2/js/select2.min.js"></script>
        <!-- Required datatable js -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>


        <script src="assets/libs/select2/js/select2.min.js"></script>
        <script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
        <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="assets/libs/@chenfengyuan/datepicker/datepicker.min.js"></script>
      
         <script src="ajax/js/report.js" type="text/javascript"></script>
        <script src="ajax/js/course.js" type="text/javascript"></script>
        <!-- init js -->
        <script src="assets/js/pages/form-advanced.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
    $(document).ready(function () {
        const ctx = document.getElementById('applicationsChart').getContext('2d');

        let applicationsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [
                    { label: "Applications", data: [], backgroundColor: "rgba(54, 162, 235, 0.7)", barThickness: 40, borderRadius: 3 },
                    { label: "Total Students", data: [], backgroundColor: "rgba(255, 159, 64, 0.7)", barThickness: 40, borderRadius: 3 },
                    { label: "Pass Students", data: [], backgroundColor: "rgba(75, 192, 192, 0.7)", barThickness: 40, borderRadius: 3 },
                    { label: "Fail Students", data: [], backgroundColor: "rgba(255, 99, 132, 0.7)", barThickness: 40, borderRadius: 3 },
                    { label: "Drop out Students", data: [], backgroundColor: "rgba(153, 102, 255, 0.7)", barThickness: 40, borderRadius: 3 }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                },
                plugins: {
                    title: {
                        display: true,  
                        text: 'NonNvq Students Performance Report',  
                        font: { size: 18 },
                        padding: { top: 10, bottom: 20 },
                        color: '#333'
                    },
                    datalabels: {
                        display: true,
                        color: '#000',
                        font: { weight: 'bold', size: 10 },
                        formatter: (value) => value,
                        anchor: 'end',
                        align: 'start',
                        offset: 5
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

       function fetchData(startYear, endYear, course_type = '', chart_batch = '') {
    if (!startYear || !endYear) {
        alert("Please select both Start Year and End Year.");
        return;
    }

    // Show loader before fetching data
    $("#loader").show();

    $.ajax({
        url: 'ajax/php/chart.php',
        type: 'POST',
        data: { start_year: startYear, end_year: endYear, course_type: course_type, chart_batch: chart_batch },
        dataType: 'json',
        success: function (data) {
            if (data.error) {
                alert(data.error);
                return;
            }

            let years = Object.keys(data);
            let applications = [], totalStudents = [], passStudents = [], failStudents = [], drop_out_students = [];

            years.forEach(year => {
                applications.push(data[year].applications || 0);
                totalStudents.push(data[year].students || 0);
                passStudents.push(data[year].pass_students || 0);
                failStudents.push(data[year].fail_students || 0);
                drop_out_students.push(data[year].drop_out_students || 0);
            });

            applicationsChart.data.labels = years;
            applicationsChart.data.datasets[0].data = applications;
            applicationsChart.data.datasets[1].data = totalStudents;
            applicationsChart.data.datasets[2].data = passStudents;
            applicationsChart.data.datasets[3].data = failStudents;
            applicationsChart.data.datasets[4].data = drop_out_students;
            applicationsChart.update();
        },
        error: function () {
            alert('Error fetching data');
        },
        complete: function () {
            // Hide loader after fetching data
            $("#loader").hide();
        }
    });
}


        let defaultStartYear = $('#start_year').val() ? $('#start_year').val() : 2023;
        let defaultEndYear = $('#end_year').val() ? $('#end_year').val() : new Date().getFullYear();
        fetchData(defaultStartYear, defaultEndYear);

     $('#start_year, #end_year, #course_type, #chart_batch').change(function () {
    let startYear = $('#start_year').val();
    let endYear = $('#end_year').val();
    let course_type = $('#course_type').val() || ''; 
    let chart_batch = $('#chart_batch').val() || '';

    if (!startYear || !endYear) {
        alert("Please select both Start Year and End Year.");
        return;
    }

    if (parseInt(startYear) > parseInt(endYear)) {
        alert("Start year must be before or equal to End year.");
        return;
    }

     
    fetchData(startYear, endYear, course_type, chart_batch);
});

    });
</script>


        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>

</html>