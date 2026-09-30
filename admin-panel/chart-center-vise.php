<?php
include '../class/include.php';
include './auth.php';

$USERS = new User($_SESSION['id']);
?>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title> Chart Center Vise  | Sl Youth Sri Lanka</title>
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
                                       <form id="report-form" class="mb-3 text-danger" action="final-results-by-center-student-drop-out.php" method="get">

                                            <div class="mb-3 row">


                                                <div class="col-md-4">
                                                    <label class="col-md-12 col-form-label"> Select Center  *</label>
                                                    <select class="form-select form-control mb-3 select2  "  id="center" name="center" autocomplete="off" required="">
                                                        <option selected="" value="">  -  Select your center - </option>  


                                                        <?php
                                                        $CENTER = new Centers(NULL);
                                                        foreach ($CENTER->all() as $key => $center) {
                                                            ?>
                                                            <option value="<?php echo $center['centercode'] ?>"><?php echo $center['center_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="col-md-12 col-form-label"> Select course Year  *</label>
                                                    <select class="form-select form-control mb-3   "  id="year" name="year" autocomplete="off" required="">
                                                        <option selected="" value="">  - Course Year  - </option>  

                                                        <?php
                                                        $DEFUL_DATA = new DefaultData();
                                                        foreach ($DEFUL_DATA->CourseYear() as $key => $course_year) {
                                                            ?>
                                                            <option value="<?php echo $key ?>"><?php echo $course_year ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="col-md-12 col-form-label"> Select course Batch  *</label>
                                                    <select class="form-select mb-3 "  id="batch" name="batch" autocomplete="off" required="">
                                                        <option selected="" value="">    - Course Batch -   </option>  

                                                        <?php
                                                        foreach ($DEFUL_DATA->CourseBatch() as $key => $course_batch) {
                                                            ?>
                                                            <option value="<?php echo $key ?>"><?php echo $course_batch ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div 
                                            </div>
                                        </form>
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
            labels: [], // Centers will be set dynamically
            datasets: [
                { label: "Applications", data: [], backgroundColor: "rgba(54, 162, 235, 0.7)", borderRadius: 3 },
                { label: "Total Students", data: [], backgroundColor: "rgba(255, 159, 64, 0.7)", borderRadius: 3 },
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: { display: true, text: 'Centers' },
                    ticks: { autoSkip: false, maxRotation: 45, minRotation: 20 },
                    barPercentage: 0.5,  // Adjusted for better visibility
                    categoryPercentage: 0.5 // Adjusted spacing
                },
                y: { beginAtZero: true }
            }, 
            plugins: {
                title: {
                    display: true,  
                    text: 'Students Performance Report by Center Vise',  
                    font: { size: 18 },
                    padding: { top: 10, bottom: 20 },
                    color: '#333'
                }
            }
        }
    });

    function fetchData(center = '', year = '', batch = '') {
        $("#loader").show(); // Show loader

        $.ajax({
            url: 'ajax/php/chart-center-vise.php',
            type: 'POST',
            data: { center: center, year: year, batch: batch },
            dataType: 'json',
            success: function (data) {
                if (data.error) {
                    alert(data.error);
                    return;
                }

                let centers = [];
                let applications = [];
                let students = [];

                data.forEach(center => {
                    centers.push(center.name);
                    applications.push(center.applications || 0);
                    students.push(center.students || 0);
                });

                applicationsChart.data.labels = centers;
                applicationsChart.data.datasets[0].data = applications;
                applicationsChart.data.datasets[1].data = students;
                applicationsChart.update();
            },
            error: function () {
                alert('Error fetching data');
            },
            complete: function () {
                $("#loader").hide(); // Hide loader
            }
        });
    }

    fetchData(); // Load all centers initially

    $('#center, #year, #batch').change(function () {
        let center = $('#center').val() || ''; 
        let year = $('#year').val() || '';
        let batch = $('#batch').val() || '';
        fetchData(center, year, batch);
    });
  });
</script>


        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>

</html>