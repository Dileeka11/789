<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use Sabberworm\CSS\CSSList\Document;

include '../class/include.php';
include './auth.php';

$EXAMSTUDENT = new ExamStudent(null);
$CENTER = new Centers(null);
$COURSE = new Course(null);
$STUDENT = new Student(null);
$APPLICATIONS = new Applications(null);

$exam_passed_students_count = $EXAMSTUDENT->getPassedStudentsCount();
$centers_count = count($CENTER->all());
$courses_count = count($COURSE->all());
$students_count = count($STUDENT->all());
$application_count = count($APPLICATIONS->all());
 
/////
$application_count_this_year = $APPLICATIONS->getApplicationsByCenterThisYear();
$student_count_this_year = count($STUDENT->getStudentThisYear());
 $student_count_nvq_this_year = count($STUDENT->getStudentByStudentNvqThisYear());
 $student_count_non_nvq_this_year = count($STUDENT->getStudentByStudentNonNvqThisYear());
 

$USER = new User($_SESSION['id']);

if(!empty($USER->center_id)){
    //get application in center vise
$all_center_application_count_this_year = $APPLICATIONS->getallApplicationsByCenter($USER->center_id);
$all_center_student_count_this_year = count($STUDENT->getAllStudentscenters($USER->center_id));
$all_center_student_count_nvq_this_year = count($STUDENT->getAllStudentByStudentNvqThisYear($USER->center_id));
$all_center_student_count_non_nvq_this_year = count($STUDENT->getAllStudentByStudentNonNvqThisYear($USER->center_id));

}


date_default_timezone_set('Asia/Colombo'); ;

$currentYear = date("Y"); // Get the current year
 
if ($_SESSION['type'] == 14) {
    header("Location: manage-exam-period.php");
    exit();
}
 
?>
 
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard | Sl Youth Sri Lanka </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="plugin/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="assets/css/preloader.css" rel="stylesheet" type="text/css" />
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script> <!-- Load Data Labels Plugin -->
    <style>
        .modal-dialog {
            pointer-events: none !important;
        }
    </style>

</head>

<body class="someBlock">
    <!-- <body data-layout="horizontal" data-topbar="colored"> -->
    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php
        include './top-header.php';
        ?>
        <!-- ========== Left Sidebar Start ========== -->
        <?php include './navigation.php'; ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <?php
            if ($_SESSION['type'] == 1  ||  $_SESSION['type'] == 9) {
            ?>
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Dashboard   </h4>

                                    <div class="page-title-right  ">
                                         <b> STUDENT LIVE COUNT - <span id="student_live_count" style="color:red;"> <?php echo $student_live_count ?> </span></b>

                                             
                                             
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="total-revenue-chart"></div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?= number_format($application_count, 0, 2) ?></span></h4>
                                            <p class="text-muted mb-0">Total Applications</p>
                                        </div>
                                        <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i>2.65%</span> since last week
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="orders-chart"> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?= number_format($students_count, 0, 2) ?></span></h4>
                                            <p class="text-muted mb-0">Total Students</p>
                                        </div>
                                        <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="mdi mdi-arrow-down-bold me-1"></i>0.82%</span> since last week
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="customers-chart"> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup"> <?= $centers_count ?></span></h4>
                                            <p class="text-muted mb-0">Our Centers</p>
                                        </div>
                                        <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="mdi mdi-arrow-down-bold me-1"></i>6.24%</span> since last week
                                        </p>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">

                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="growth-chart"></div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1">+ <span data-plugin="counterup"><?= $courses_count ?></span></h4>
                                            <p class="text-muted mb-0">On On goin Course </p>
                                        </div>
                                        <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i>10.51%</span> since last week
                                        </p>
                                    </div>
                                </div>
                            </div> <!-- end col-->



                            <div class="row">
                                <div class="col-xl-8">
                                    <div class="card">
                                        
                                     <div class="card-body" style="position: relative;">
     
                                            <div id="loader" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                                    <img src="https://i.gifer.com/VAyR.gif" alt="Loading..." width="80" height="80">
                                                  </div>

    
                                                <canvas id="applicationsChart"></canvas>
                                    </div>


                                    </div> <!-- end card-->
                                </div> <!-- end col-->

                                <div class="col-xl-4 ">
                                    <div class="card">
                                         <div class="card-body">
                                             
                                            <div class="row mb-4">
            
                                                 <div class="col-md-6">
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
                                                
                                            <div class="col-md-6">
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
                                                
                                            <div class="col-md-6">
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
                                            <div class="col-md-6">
                                                    <label class="col-md-12 col-form-label"> Course Type  *</label>
                                                   <select class="form-select form-control mb-3" id="course_type" name="course_type" required>
                                               <option   value="">-- All Course Types --</option>
<?php
$DEFULT_DATA = new DefaultData();
foreach($DEFULT_DATA->nvqLevel() as $key => $nvqlevel){
     
    $selected = ($key == 2) ? 'selected' : '';
    echo "<option value='$key' $selected>$nvqlevel</option>";
}
                                                ?>
                                            </select>
                                            </div>    
                                         </div>
                                            
                                        </div> 
                                    </div>
                                     
                                      <div class="card bg-primary">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-sm-8">
                                                    <p class="text-white font-size-18">Click Button to update Student Passwords <i class="mdi mdi-arrow-right"></i></p>
                                                    <div class="mt-4">
                                                        <button class="btn btn-success " type="button" id="update-password">Update Now</button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="mt-4 mt-sm-0">
                                                        <img src="assets/images/setup-analytics-amico.svg" class="img-fluid" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end card-body-->
                                    </div>

                                   
                                </div>  
                            </div>

                        </div>
                    </div>
                </div>
                <!--Centers -->
            <?php
            } else 
                if ($_SESSION['type'] == 4 || $_SESSION['type'] == 6  || $_SESSION['type'] == 13) {
            ?>
                <div class="page-content">
                    <div class="container-fluid">
                         
                       
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="total-revenue-chart"></div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1">+<span data-plugin="counterup"><?= number_format($application_count_this_year, 0, 2) ?></span></h4>
                                            <p class="text-muted mb-0">Total Applications </p>
                                        </div>
                                        <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i>
                                        <?php 
                                            $year = date("Y/m/d");
                                            echo $year; 
                                        ?>
                                        </span>  since this year
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                
                                <div class="card">
                                    <div class="card-body">
                                        <h4> Select Year for Student Performance</h4>
                                        <div class="float-end mt-2">
                                            <div id="orders-chart"> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1">+<span data-plugin="counterup">
                                                <?= number_format($student_count_this_year, 0, 2) ?>
                                                </span></h4>
                                            <p class="text-muted mb-0">Total Students</p>
                                        </div>
                                        <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="mdi mdi-arrow-down-bold me-1"></i> 
                                        <?php 
                                            $year = date("Y/m/d");
                                            echo $year; 
                                        ?></span> since this year
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="customers-chart"> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1">+<span data-plugin="counterup">    <?= number_format($student_count_nvq_this_year, 0, 2) ?> </span></h4>
                                            <p class="text-muted mb-0"> Nvq Student</p>
                                        </div>
                                        <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="mdi mdi-arrow-down-bold me-1"></i> 
                                        <?php 
                                            $year = date("Y/m/d");
                                            echo $year; 
                                        ?></span> since this year
                                        </p>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">

                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="growth-chart"></div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1">+ <span data-plugin="counterup">     <?= number_format($student_count_non_nvq_this_year, 0, 2) ?> </span></h4>
                                            <p class="text-muted mb-0">Non Nvq Students</p>
                                        </div>
                                        <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i> <?php 
                                            $year = date("Y/m/d");
                                            echo $year; 
                                        ?></span> since this year
                                        </p>
                                    </div>
                                </div>
                            </div> <!-- end col-->
 
                                    

                            <div class="row">
                                <div class="col-xl-12">
                                        
                                    <div class="table-responsive mb-4">

                                        <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">

                                            <thead>

                                                <tr class="bg-transparent">



                                                    <th>No</th>

                                                    <th>Center Name</th>

                                                    <th>Appications</th> 

                                                    <th> Students </th>
 

                                                    <th>Nvq</th>

                                                    <th>Non Nvq</th>

                                                   
                                                    <th>Full Time</th> 
                                                    
                                                    <th>Part Time</th>

                                                    
 
                                                    <th>Short Time</th>

                                                </tr>

                                            </thead>

                                            <tbody>



                                                <?php
                                                $CENTER = new Centers(NULL);
                                                $STUDENT_NEW =  New Student(NULL);
                                                foreach ($CENTER->all() as $key => $centers) {

                                                    $key++;
                                                    ?>
                                                <tr>

                                                    <td><?php echo $key ?></td>

                                                    <td><?php echo $centers['center_name'] ?></td>

                                                    <td><?php echo $count_applications = $APPLICATIONS->getApplicationsByCenter($centers['centercode']);?></td>

                                                    <td><?php echo count($STUDENT_NEW->getApplicationsByCenterStudent($centers['centercode']));?></td>
 
                                                     <td><?php echo count($STUDENT_NEW->getStudentByCenterStudentNvq($centers['centercode']));?></td>


                                                    <td><?php echo count($STUDENT_NEW->getStudentByCenterStudentNonNvq($centers['centercode']));?></td>
                                                    
                                                     
                                                     <td><?php echo count($STUDENT_NEW->getStudentByCenterStudentCourseType($centers['centercode'],1));?></td>
                                                     
                                                     <td><?php echo count($STUDENT_NEW->getStudentByCenterStudentCourseType($centers['centercode'],2));?></td>
                                                     
                                                     <td><?php echo count($STUDENT_NEW->getStudentByCenterStudentCourseType($centers['centercode'],3));?></td>
                                                     
                                                      
                                                </tr>
<?php
}
?>


                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>
                            
                                </div> <!-- end col-->

                                  
                                </div> <!-- end Col -->
                            </div>

                        </div>
                    </div>
                </div>
            <?php
            } else
                if ($_SESSION['type'] == 4) {
            ?>
                <!--Analysis Programmer Dashboard -->
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Dashboard</h4>

                                    <div class="page-title-right hidden">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item active">All Files</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="total-revenue-chart"></div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?= number_format($students_count, 0, 2) ?></span></h4>
                                            <p class="text-muted mb-0">Total Students</p>
                                        </div>
                                        <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i>2.65%</span> since last week
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="orders-chart"> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?= number_format($exam_passed_students_count['count'], 0, 2) ?></span></h4>
                                            <p class="text-muted mb-0">Total Exam Pass Students</p>
                                        </div>
                                        <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="mdi mdi-arrow-down-bold me-1"></i>0.82%</span> since last week
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="customers-chart"> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup"> <?= $centers_count ?></span></h4>
                                            <p class="text-muted mb-0">Our Centers</p>
                                        </div>
                                        <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="mdi mdi-arrow-down-bold me-1"></i>6.24%</span> since last week
                                        </p>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">

                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="growth-chart"></div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1">+ <span data-plugin="counterup"><?= $courses_count ?></span></h4>
                                            <p class="text-muted mb-0">Our Courses</p>
                                        </div>
                                        <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i>10.51%</span> since last week
                                        </p>
                                    </div>
                                </div>
                            </div> <!-- end col-->



                            <div class="row">
                                <div class="col-xl-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="float-end">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle text-reset" href="#" id="dropdownMenuButton5" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="fw-semibold">Sort By:</span> <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton5">
                                                        <a class="dropdown-item" href="#">Monthly</a>
                                                        <a class="dropdown-item" href="#">Yearly</a>
                                                        <a class="dropdown-item" href="#">Weekly</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4 class="card-title mb-4">Sales Analytics</h4>

                                            <div class="mt-1">
                                                <ul class="list-inline main-chart mb-0">
                                                    <li class="list-inline-item chart-border-left me-0 border-0">
                                                        <h3 class="text-primary">$<span data-plugin="counterup">2,371</span><span class="text-muted d-inline-block font-size-15 ms-3">Income</span></h3>
                                                    </li>
                                                    <li class="list-inline-item chart-border-left me-0">
                                                        <h3><span data-plugin="counterup">258</span><span class="text-muted d-inline-block font-size-15 ms-3">Sales</span>
                                                        </h3>
                                                    </li>
                                                    <li class="list-inline-item chart-border-left me-0">
                                                        <h3><span data-plugin="counterup">3.6</span>%<span class="text-muted d-inline-block font-size-15 ms-3">Conversation Ratio</span></h3>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="mt-3" style="position: relative;">
                                                <div id="sales-analytics-chart" class="apex-charts" dir="ltr" style="min-height: 354px;">
                                                    <div id="apexchartsdh5eyvr1" class="apexcharts-canvas apexchartsdh5eyvr1 apexcharts-theme-light" style="width: 773px; height: 339px;"><svg id="SvgjsSvg1395" width="773" height="339" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg apexcharts-zoomable hovering-zoom" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                                                            <foreignObject x="0" y="0" width="773" height="339">
                                                                <div class="apexcharts-legend apexcharts-align-center position-bottom" xmlns="http://www.w3.org/1999/xhtml" style="inset: auto 0px 1px; position: absolute; max-height: 169.5px;">
                                                                    <div class="apexcharts-legend-series" style="margin: 2px 5px;" rel="1" seriesname="Desktops" data:collapsed="false"><span class="apexcharts-legend-marker" style="background: rgb(91, 115, 232) !important; color: rgb(91, 115, 232); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;" rel="1" data:collapsed="false"></span><span class="apexcharts-legend-text" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;" rel="1" i="0" data:default-text="Desktops" data:collapsed="false">Desktops</span></div>
                                                                    <div class="apexcharts-legend-series" style="margin: 2px 5px;" rel="2" seriesname="Laptops" data:collapsed="false"><span class="apexcharts-legend-marker" style="background: rgb(223, 226, 230) !important; color: rgb(223, 226, 230); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;" rel="2" data:collapsed="false"></span><span class="apexcharts-legend-text" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;" rel="2" i="1" data:default-text="Laptops" data:collapsed="false">Laptops</span></div>
                                                                    <div class="apexcharts-legend-series" style="margin: 2px 5px;" rel="3" seriesname="Tablets" data:collapsed="false"><span class="apexcharts-legend-marker" style="background: rgb(241, 180, 76) !important; color: rgb(241, 180, 76); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;" rel="3" data:collapsed="false"></span><span class="apexcharts-legend-text" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;" rel="3" i="2" data:default-text="Tablets" data:collapsed="false">Tablets</span></div>
                                                                </div>
                                                                <style type="text/css">
                                                                    .apexcharts-legend {
                                                                        display: flex;
                                                                        overflow: auto;
                                                                        padding: 0 10px;
                                                                    }

                                                                    .apexcharts-legend.position-bottom,
                                                                    .apexcharts-legend.position-top {
                                                                        flex-wrap: wrap
                                                                    }

                                                                    .apexcharts-legend.position-right,
                                                                    .apexcharts-legend.position-left {
                                                                        flex-direction: column;
                                                                        bottom: 0;
                                                                    }

                                                                    .apexcharts-legend.position-bottom.apexcharts-align-left,
                                                                    .apexcharts-legend.position-top.apexcharts-align-left,
                                                                    .apexcharts-legend.position-right,
                                                                    .apexcharts-legend.position-left {
                                                                        justify-content: flex-start;
                                                                    }

                                                                    .apexcharts-legend.position-bottom.apexcharts-align-center,
                                                                    .apexcharts-legend.position-top.apexcharts-align-center {
                                                                        justify-content: center;
                                                                    }

                                                                    .apexcharts-legend.position-bottom.apexcharts-align-right,
                                                                    .apexcharts-legend.position-top.apexcharts-align-right {
                                                                        justify-content: flex-end;
                                                                    }

                                                                    .apexcharts-legend-series {
                                                                        cursor: pointer;
                                                                        line-height: normal;
                                                                    }

                                                                    .apexcharts-legend.position-bottom .apexcharts-legend-series,
                                                                    .apexcharts-legend.position-top .apexcharts-legend-series {
                                                                        display: flex;
                                                                        align-items: center;
                                                                    }

                                                                    .apexcharts-legend-text {
                                                                        position: relative;
                                                                        font-size: 14px;
                                                                    }

                                                                    .apexcharts-legend-text *,
                                                                    .apexcharts-legend-marker * {
                                                                        pointer-events: none;
                                                                    }

                                                                    .apexcharts-legend-marker {
                                                                        position: relative;
                                                                        display: inline-block;
                                                                        cursor: pointer;
                                                                        margin-right: 3px;
                                                                        border-style: solid;
                                                                    }

                                                                    .apexcharts-legend.apexcharts-align-right .apexcharts-legend-series,
                                                                    .apexcharts-legend.apexcharts-align-left .apexcharts-legend-series {
                                                                        display: inline-block;
                                                                    }

                                                                    .apexcharts-legend-series.apexcharts-no-click {
                                                                        cursor: auto;
                                                                    }

                                                                    .apexcharts-legend .apexcharts-hidden-zero-series,
                                                                    .apexcharts-legend .apexcharts-hidden-null-series {
                                                                        display: none !important;
                                                                    }

                                                                    .apexcharts-inactive-legend {
                                                                        opacity: 0.45;
                                                                    }
                                                                </style>
                                                            </foreignObject>
                                                            <g id="SvgjsG1397" class="apexcharts-inner apexcharts-graphical" transform="translate(72.65771411845559, 30)">
                                                                <defs id="SvgjsDefs1396">
                                                                    <clipPath id="gridRectMaskdh5eyvr1">
                                                                        <rect id="SvgjsRect1418" width="720.4666719436646" height="263.6799995422363" x="-22.124386062120138" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                                    </clipPath>
                                                                    <clipPath id="gridRectMarkerMaskdh5eyvr1">
                                                                        <rect id="SvgjsRect1419" width="680.2178998194242" height="263.6799995422363" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                                    </clipPath>
                                                                </defs>
                                                                <line id="SvgjsLine1404" x1="471.07300908459854" y1="0" x2="471.07300908459854" y2="259.6799995422363" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="471.07300908459854" y="0" width="1" height="259.6799995422363" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line>
                                                                <g id="SvgjsG1445" class="apexcharts-xaxis" transform="translate(0, 0)">
                                                                    <g id="SvgjsG1446" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText1448" font-family="Helvetica, Arial, sans-serif" x="2.224400986248106" y="288.6799995422363" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1449">2003</tspan>
                                                                            <title>2003</title>
                                                                        </text><text id="SvgjsText1451" font-family="Helvetica, Arial, sans-serif" x="71.18083155993939" y="288.6799995422363" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1452">Feb '03</tspan>
                                                                            <title>Feb '03</title>
                                                                        </text><text id="SvgjsText1454" font-family="Helvetica, Arial, sans-serif" x="133.46405917488636" y="288.6799995422363" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1455">Mar '03</tspan>
                                                                            <title>Mar '03</title>
                                                                        </text><text id="SvgjsText1457" font-family="Helvetica, Arial, sans-serif" x="202.42048974857767" y="288.6799995422363" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1458">Apr '03</tspan>
                                                                            <title>Apr '03</title>
                                                                        </text><text id="SvgjsText1460" font-family="Helvetica, Arial, sans-serif" x="269.1525193360209" y="288.6799995422363" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1461">May '03</tspan>
                                                                            <title>May '03</title>
                                                                        </text><text id="SvgjsText1463" font-family="Helvetica, Arial, sans-serif" x="338.1089499097122" y="288.6799995422363" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1464">Jun '03</tspan>
                                                                            <title>Jun '03</title>
                                                                        </text><text id="SvgjsText1466" font-family="Helvetica, Arial, sans-serif" x="404.84097949715533" y="288.6799995422363" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1467">Jul '03</tspan>
                                                                            <title>Jul '03</title>
                                                                        </text><text id="SvgjsText1469" font-family="Helvetica, Arial, sans-serif" x="473.79741007084664" y="288.6799995422363" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1470">Aug '03</tspan>
                                                                            <title>Aug '03</title>
                                                                        </text><text id="SvgjsText1472" font-family="Helvetica, Arial, sans-serif" x="542.753840644538" y="288.6799995422363" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1473">Sep '03</tspan>
                                                                            <title>Sep '03</title>
                                                                        </text><text id="SvgjsText1475" font-family="Helvetica, Arial, sans-serif" x="609.4858702319812" y="288.6799995422363" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1476">Oct '03</tspan>
                                                                            <title>Oct '03</title>
                                                                        </text><text id="SvgjsText1478" font-family="Helvetica, Arial, sans-serif" x="678.4423008056724" y="288.6799995422363" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1479"></tspan>
                                                                            <title></title>
                                                                        </text></g>
                                                                    <line id="SvgjsLine1480" x1="-18.124386062120138" y1="260.6799995422363" x2="694.3422858815444" y2="260.6799995422363" stroke="#e0e0e0" stroke-dasharray="0" stroke-width="1"></line>
                                                                </g>
                                                                <g id="SvgjsG1495" class="apexcharts-grid">
                                                                    <g id="SvgjsG1496" class="apexcharts-gridlines-horizontal">
                                                                        <line id="SvgjsLine1508" x1="-18.124386062120138" y1="0" x2="694.3422858815444" y2="0" stroke="#f1f1f1" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                                        <line id="SvgjsLine1509" x1="-18.124386062120138" y1="64.91999988555908" x2="694.3422858815444" y2="64.91999988555908" stroke="#f1f1f1" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                                        <line id="SvgjsLine1510" x1="-18.124386062120138" y1="129.83999977111816" x2="694.3422858815444" y2="129.83999977111816" stroke="#f1f1f1" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                                        <line id="SvgjsLine1511" x1="-18.124386062120138" y1="194.75999965667722" x2="694.3422858815444" y2="194.75999965667722" stroke="#f1f1f1" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                                        <line id="SvgjsLine1512" x1="-18.124386062120138" y1="259.6799995422363" x2="694.3422858815444" y2="259.6799995422363" stroke="#f1f1f1" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                                    </g>
                                                                    <g id="SvgjsG1497" class="apexcharts-gridlines-vertical"></g>
                                                                    <line id="SvgjsLine1498" x1="2.224400986248106" y1="260.6799995422363" x2="2.224400986248106" y2="266.6799995422363" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                                    <line id="SvgjsLine1499" x1="71.18083155993939" y1="260.6799995422363" x2="71.18083155993939" y2="266.6799995422363" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                                    <line id="SvgjsLine1500" x1="133.46405917488636" y1="260.6799995422363" x2="133.46405917488636" y2="266.6799995422363" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                                    <line id="SvgjsLine1501" x1="202.42048974857767" y1="260.6799995422363" x2="202.42048974857767" y2="266.6799995422363" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                                    <line id="SvgjsLine1502" x1="269.1525193360209" y1="260.6799995422363" x2="269.1525193360209" y2="266.6799995422363" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                                    <line id="SvgjsLine1503" x1="338.1089499097122" y1="260.6799995422363" x2="338.1089499097122" y2="266.6799995422363" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                                    <line id="SvgjsLine1504" x1="404.84097949715533" y1="260.6799995422363" x2="404.84097949715533" y2="266.6799995422363" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                                    <line id="SvgjsLine1505" x1="473.79741007084664" y1="260.6799995422363" x2="473.79741007084664" y2="266.6799995422363" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                                    <line id="SvgjsLine1506" x1="542.753840644538" y1="260.6799995422363" x2="542.753840644538" y2="266.6799995422363" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                                    <line id="SvgjsLine1507" x1="609.4858702319812" y1="260.6799995422363" x2="609.4858702319812" y2="266.6799995422363" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                                    <line id="SvgjsLine1514" x1="0" y1="259.6799995422363" x2="676.2178998194242" y2="259.6799995422363" stroke="transparent" stroke-dasharray="0"></line>
                                                                    <line id="SvgjsLine1513" x1="0" y1="1" x2="0" y2="259.6799995422363" stroke="transparent" stroke-dasharray="0"></line>
                                                                </g>
                                                                <g id="SvgjsG1420" class="apexcharts-area-series apexcharts-plot-series">
                                                                    <g id="SvgjsG1421" class="apexcharts-series" seriesName="Laptops" data:longestSeries="true" rel="1" data:realIndex="1">
                                                                        <path id="SvgjsPath1424" d="M 0 259.6799995422363L 0 116.85599979400635C 24.13475070079195 116.85599979400635 44.82167987289934 81.14999985694885 68.95643057369129 81.14999985694885C 90.75556023892273 81.14999985694885 109.44052852340683 126.5939997768402 131.23965818863826 126.5939997768402C 155.3744088894302 126.5939997768402 176.06133806153758 42.1979999256134 200.19608876232954 42.1979999256134C 223.55229911793464 42.1979999256134 243.57190799416762 188.26799966812132 266.9281183497727 188.26799966812132C 291.0628690505647 188.26799966812132 311.7497982226721 120.1019997882843 335.884548923464 120.1019997882843C 359.24075927906915 120.1019997882843 379.2603681553021 191.51399966239927 402.61657851090723 191.51399966239927C 426.75132921169916 191.51399966239927 447.43825838380656 126.5939997768402 471.5730090845985 126.5939997768402C 495.7077597853904 126.5939997768402 516.3946889574978 77.9039998626709 540.5294396582898 77.9039998626709C 563.8856500138949 77.9039998626709 583.9052588901279 172.03799969673156 607.261469245733 172.03799969673156C 631.396219946525 172.03799969673156 652.0831491186323 120.1019997882843 676.2178998194242 120.1019997882843C 676.2178998194242 120.1019997882843 676.2178998194242 120.1019997882843 676.2178998194242 259.6799995422363M 676.2178998194242 120.1019997882843z" fill="rgba(223,226,230,0.25)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="1" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 0 259.6799995422363L 0 116.85599979400635C 24.13475070079195 116.85599979400635 44.82167987289934 81.14999985694885 68.95643057369129 81.14999985694885C 90.75556023892273 81.14999985694885 109.44052852340683 126.5939997768402 131.23965818863826 126.5939997768402C 155.3744088894302 126.5939997768402 176.06133806153758 42.1979999256134 200.19608876232954 42.1979999256134C 223.55229911793464 42.1979999256134 243.57190799416762 188.26799966812132 266.9281183497727 188.26799966812132C 291.0628690505647 188.26799966812132 311.7497982226721 120.1019997882843 335.884548923464 120.1019997882843C 359.24075927906915 120.1019997882843 379.2603681553021 191.51399966239927 402.61657851090723 191.51399966239927C 426.75132921169916 191.51399966239927 447.43825838380656 126.5939997768402 471.5730090845985 126.5939997768402C 495.7077597853904 126.5939997768402 516.3946889574978 77.9039998626709 540.5294396582898 77.9039998626709C 563.8856500138949 77.9039998626709 583.9052588901279 172.03799969673156 607.261469245733 172.03799969673156C 631.396219946525 172.03799969673156 652.0831491186323 120.1019997882843 676.2178998194242 120.1019997882843C 676.2178998194242 120.1019997882843 676.2178998194242 120.1019997882843 676.2178998194242 259.6799995422363M 676.2178998194242 120.1019997882843z" pathFrom="M -1 259.6799995422363L -1 259.6799995422363L 68.95643057369129 259.6799995422363L 131.23965818863826 259.6799995422363L 200.19608876232954 259.6799995422363L 266.9281183497727 259.6799995422363L 335.884548923464 259.6799995422363L 402.61657851090723 259.6799995422363L 471.5730090845985 259.6799995422363L 540.5294396582898 259.6799995422363L 607.261469245733 259.6799995422363L 676.2178998194242 259.6799995422363"></path>
                                                                        <path id="SvgjsPath1425" d="M 0 116.85599979400635C 24.13475070079195 116.85599979400635 44.82167987289934 81.14999985694885 68.95643057369129 81.14999985694885C 90.75556023892273 81.14999985694885 109.44052852340683 126.5939997768402 131.23965818863826 126.5939997768402C 155.3744088894302 126.5939997768402 176.06133806153758 42.1979999256134 200.19608876232954 42.1979999256134C 223.55229911793464 42.1979999256134 243.57190799416762 188.26799966812132 266.9281183497727 188.26799966812132C 291.0628690505647 188.26799966812132 311.7497982226721 120.1019997882843 335.884548923464 120.1019997882843C 359.24075927906915 120.1019997882843 379.2603681553021 191.51399966239927 402.61657851090723 191.51399966239927C 426.75132921169916 191.51399966239927 447.43825838380656 126.5939997768402 471.5730090845985 126.5939997768402C 495.7077597853904 126.5939997768402 516.3946889574978 77.9039998626709 540.5294396582898 77.9039998626709C 563.8856500138949 77.9039998626709 583.9052588901279 172.03799969673156 607.261469245733 172.03799969673156C 631.396219946525 172.03799969673156 652.0831491186323 120.1019997882843 676.2178998194242 120.1019997882843" fill="none" fill-opacity="1" stroke="#dfe2e6" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-area" index="1" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 0 116.85599979400635C 24.13475070079195 116.85599979400635 44.82167987289934 81.14999985694885 68.95643057369129 81.14999985694885C 90.75556023892273 81.14999985694885 109.44052852340683 126.5939997768402 131.23965818863826 126.5939997768402C 155.3744088894302 126.5939997768402 176.06133806153758 42.1979999256134 200.19608876232954 42.1979999256134C 223.55229911793464 42.1979999256134 243.57190799416762 188.26799966812132 266.9281183497727 188.26799966812132C 291.0628690505647 188.26799966812132 311.7497982226721 120.1019997882843 335.884548923464 120.1019997882843C 359.24075927906915 120.1019997882843 379.2603681553021 191.51399966239927 402.61657851090723 191.51399966239927C 426.75132921169916 191.51399966239927 447.43825838380656 126.5939997768402 471.5730090845985 126.5939997768402C 495.7077597853904 126.5939997768402 516.3946889574978 77.9039998626709 540.5294396582898 77.9039998626709C 563.8856500138949 77.9039998626709 583.9052588901279 172.03799969673156 607.261469245733 172.03799969673156C 631.396219946525 172.03799969673156 652.0831491186323 120.1019997882843 676.2178998194242 120.1019997882843" pathFrom="M -1 259.6799995422363L -1 259.6799995422363L 68.95643057369129 259.6799995422363L 131.23965818863826 259.6799995422363L 200.19608876232954 259.6799995422363L 266.9281183497727 259.6799995422363L 335.884548923464 259.6799995422363L 402.61657851090723 259.6799995422363L 471.5730090845985 259.6799995422363L 540.5294396582898 259.6799995422363L 607.261469245733 259.6799995422363L 676.2178998194242 259.6799995422363"></path>
                                                                        <g id="SvgjsG1422" class="apexcharts-series-markers-wrap" data:realIndex="1">
                                                                            <g class="apexcharts-series-markers">
                                                                                <circle id="SvgjsCircle1520" r="0" cx="471.5730090845985" cy="126.5939997768402" class="apexcharts-marker wz8piy6rp" stroke="#ffffff" fill="#5b73e8" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                                <g id="SvgjsG1426" class="apexcharts-bar-series apexcharts-plot-series">
                                                                    <g id="SvgjsG1427" class="apexcharts-series" rel="1" seriesName="Desktops" data:realIndex="0">
                                                                        <path id="SvgjsPath1429" d="M -9.342484142242046 259.6799995422363L -9.342484142242046 185.02199967384337L 9.342484142242046 185.02199967384337L 9.342484142242046 185.02199967384337L 9.342484142242046 259.6799995422363L 9.342484142242046 259.6799995422363z" fill="rgba(91,115,232,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M -9.342484142242046 259.6799995422363L -9.342484142242046 185.02199967384337L 9.342484142242046 185.02199967384337L 9.342484142242046 185.02199967384337L 9.342484142242046 259.6799995422363L 9.342484142242046 259.6799995422363z" pathFrom="M -9.342484142242046 259.6799995422363L -9.342484142242046 259.6799995422363L 9.342484142242046 259.6799995422363L 9.342484142242046 259.6799995422363L 9.342484142242046 259.6799995422363L -9.342484142242046 259.6799995422363" cy="185.02199967384337" cx="9.342484142242046" j="0" val="23" barHeight="74.65799986839295" barWidth="18.684968284484093"></path>
                                                                        <path id="SvgjsPath1430" d="M 59.61394643144925 259.6799995422363L 59.61394643144925 223.97399960517882L 78.29891471593334 223.97399960517882L 78.29891471593334 223.97399960517882L 78.29891471593334 259.6799995422363L 78.29891471593334 259.6799995422363z" fill="rgba(91,115,232,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 59.61394643144925 259.6799995422363L 59.61394643144925 223.97399960517882L 78.29891471593334 223.97399960517882L 78.29891471593334 223.97399960517882L 78.29891471593334 259.6799995422363L 78.29891471593334 259.6799995422363z" pathFrom="M 59.61394643144925 259.6799995422363L 59.61394643144925 259.6799995422363L 78.29891471593334 259.6799995422363L 78.29891471593334 259.6799995422363L 78.29891471593334 259.6799995422363L 59.61394643144925 259.6799995422363" cy="223.97399960517882" cx="78.29891471593334" j="1" val="11" barHeight="35.70599993705749" barWidth="18.684968284484093"></path>
                                                                        <path id="SvgjsPath1431" d="M 121.89717404639622 259.6799995422363L 121.89717404639622 188.26799966812132L 140.58214233088032 188.26799966812132L 140.58214233088032 188.26799966812132L 140.58214233088032 259.6799995422363L 140.58214233088032 259.6799995422363z" fill="rgba(91,115,232,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 121.89717404639622 259.6799995422363L 121.89717404639622 188.26799966812132L 140.58214233088032 188.26799966812132L 140.58214233088032 188.26799966812132L 140.58214233088032 259.6799995422363L 140.58214233088032 259.6799995422363z" pathFrom="M 121.89717404639622 259.6799995422363L 121.89717404639622 259.6799995422363L 140.58214233088032 259.6799995422363L 140.58214233088032 259.6799995422363L 140.58214233088032 259.6799995422363L 121.89717404639622 259.6799995422363" cy="188.26799966812132" cx="140.58214233088032" j="2" val="22" barHeight="71.41199987411498" barWidth="18.684968284484093"></path>
                                                                        <path id="SvgjsPath1432" d="M 190.85360462008748 259.6799995422363L 190.85360462008748 172.03799969673156L 209.53857290457157 172.03799969673156L 209.53857290457157 172.03799969673156L 209.53857290457157 259.6799995422363L 209.53857290457157 259.6799995422363z" fill="rgba(91,115,232,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 190.85360462008748 259.6799995422363L 190.85360462008748 172.03799969673156L 209.53857290457157 172.03799969673156L 209.53857290457157 172.03799969673156L 209.53857290457157 259.6799995422363L 209.53857290457157 259.6799995422363z" pathFrom="M 190.85360462008748 259.6799995422363L 190.85360462008748 259.6799995422363L 209.53857290457157 259.6799995422363L 209.53857290457157 259.6799995422363L 209.53857290457157 259.6799995422363L 190.85360462008748 259.6799995422363" cy="172.03799969673156" cx="209.53857290457157" j="3" val="27" barHeight="87.64199984550476" barWidth="18.684968284484093"></path>
                                                                        <path id="SvgjsPath1433" d="M 257.5856342075307 259.6799995422363L 257.5856342075307 217.48199961662291L 276.2706024920148 217.48199961662291L 276.2706024920148 217.48199961662291L 276.2706024920148 259.6799995422363L 276.2706024920148 259.6799995422363z" fill="rgba(91,115,232,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 257.5856342075307 259.6799995422363L 257.5856342075307 217.48199961662291L 276.2706024920148 217.48199961662291L 276.2706024920148 217.48199961662291L 276.2706024920148 259.6799995422363L 276.2706024920148 259.6799995422363z" pathFrom="M 257.5856342075307 259.6799995422363L 257.5856342075307 259.6799995422363L 276.2706024920148 259.6799995422363L 276.2706024920148 259.6799995422363L 276.2706024920148 259.6799995422363L 257.5856342075307 259.6799995422363" cy="217.48199961662291" cx="276.2706024920148" j="4" val="13" barHeight="42.1979999256134" barWidth="18.684968284484093"></path>
                                                                        <path id="SvgjsPath1434" d="M 326.542064781222 259.6799995422363L 326.542064781222 188.26799966812132L 345.2270330657061 188.26799966812132L 345.2270330657061 188.26799966812132L 345.2270330657061 259.6799995422363L 345.2270330657061 259.6799995422363z" fill="rgba(91,115,232,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 326.542064781222 259.6799995422363L 326.542064781222 188.26799966812132L 345.2270330657061 188.26799966812132L 345.2270330657061 188.26799966812132L 345.2270330657061 259.6799995422363L 345.2270330657061 259.6799995422363z" pathFrom="M 326.542064781222 259.6799995422363L 326.542064781222 259.6799995422363L 345.2270330657061 259.6799995422363L 345.2270330657061 259.6799995422363L 345.2270330657061 259.6799995422363L 326.542064781222 259.6799995422363" cy="188.26799966812132" cx="345.2270330657061" j="5" val="22" barHeight="71.41199987411498" barWidth="18.684968284484093"></path>
                                                                        <path id="SvgjsPath1435" d="M 393.2740943686652 259.6799995422363L 393.2740943686652 139.577999753952L 411.9590626531493 139.577999753952L 411.9590626531493 139.577999753952L 411.9590626531493 259.6799995422363L 411.9590626531493 259.6799995422363z" fill="rgba(91,115,232,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 393.2740943686652 259.6799995422363L 393.2740943686652 139.577999753952L 411.9590626531493 139.577999753952L 411.9590626531493 139.577999753952L 411.9590626531493 259.6799995422363L 411.9590626531493 259.6799995422363z" pathFrom="M 393.2740943686652 259.6799995422363L 393.2740943686652 259.6799995422363L 411.9590626531493 259.6799995422363L 411.9590626531493 259.6799995422363L 411.9590626531493 259.6799995422363L 393.2740943686652 259.6799995422363" cy="139.577999753952" cx="411.9590626531493" j="6" val="37" barHeight="120.1019997882843" barWidth="18.684968284484093"></path>
                                                                        <path id="SvgjsPath1436" d="M 462.23052494235645 259.6799995422363L 462.23052494235645 191.51399966239927L 480.91549322684057 191.51399966239927L 480.91549322684057 191.51399966239927L 480.91549322684057 259.6799995422363L 480.91549322684057 259.6799995422363z" fill="rgba(91,115,232,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 462.23052494235645 259.6799995422363L 462.23052494235645 191.51399966239927L 480.91549322684057 191.51399966239927L 480.91549322684057 191.51399966239927L 480.91549322684057 259.6799995422363L 480.91549322684057 259.6799995422363z" pathFrom="M 462.23052494235645 259.6799995422363L 462.23052494235645 259.6799995422363L 480.91549322684057 259.6799995422363L 480.91549322684057 259.6799995422363L 480.91549322684057 259.6799995422363L 462.23052494235645 259.6799995422363" cy="191.51399966239927" cx="480.91549322684057" j="7" val="21" barHeight="68.16599987983703" barWidth="18.684968284484093"></path>
                                                                        <path id="SvgjsPath1437" d="M 531.1869555160478 259.6799995422363L 531.1869555160478 116.85599979400635L 549.8719238005318 116.85599979400635L 549.8719238005318 116.85599979400635L 549.8719238005318 259.6799995422363L 549.8719238005318 259.6799995422363z" fill="rgba(91,115,232,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 531.1869555160478 259.6799995422363L 531.1869555160478 116.85599979400635L 549.8719238005318 116.85599979400635L 549.8719238005318 116.85599979400635L 549.8719238005318 259.6799995422363L 549.8719238005318 259.6799995422363z" pathFrom="M 531.1869555160478 259.6799995422363L 531.1869555160478 259.6799995422363L 549.8719238005318 259.6799995422363L 549.8719238005318 259.6799995422363L 549.8719238005318 259.6799995422363L 531.1869555160478 259.6799995422363" cy="116.85599979400635" cx="549.8719238005318" j="8" val="44" barHeight="142.82399974822997" barWidth="18.684968284484093"></path>
                                                                        <path id="SvgjsPath1438" d="M 597.918985103491 259.6799995422363L 597.918985103491 188.26799966812132L 616.603953387975 188.26799966812132L 616.603953387975 188.26799966812132L 616.603953387975 259.6799995422363L 616.603953387975 259.6799995422363z" fill="rgba(91,115,232,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 597.918985103491 259.6799995422363L 597.918985103491 188.26799966812132L 616.603953387975 188.26799966812132L 616.603953387975 188.26799966812132L 616.603953387975 259.6799995422363L 616.603953387975 259.6799995422363z" pathFrom="M 597.918985103491 259.6799995422363L 597.918985103491 259.6799995422363L 616.603953387975 259.6799995422363L 616.603953387975 259.6799995422363L 616.603953387975 259.6799995422363L 597.918985103491 259.6799995422363" cy="188.26799966812132" cx="616.603953387975" j="9" val="22" barHeight="71.41199987411498" barWidth="18.684968284484093"></path>
                                                                        <path id="SvgjsPath1439" d="M 666.8754156771822 259.6799995422363L 666.8754156771822 162.2999997138977L 685.5603839616663 162.2999997138977L 685.5603839616663 162.2999997138977L 685.5603839616663 259.6799995422363L 685.5603839616663 259.6799995422363z" fill="rgba(91,115,232,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 666.8754156771822 259.6799995422363L 666.8754156771822 162.2999997138977L 685.5603839616663 162.2999997138977L 685.5603839616663 162.2999997138977L 685.5603839616663 259.6799995422363L 685.5603839616663 259.6799995422363z" pathFrom="M 666.8754156771822 259.6799995422363L 666.8754156771822 259.6799995422363L 685.5603839616663 259.6799995422363L 685.5603839616663 259.6799995422363L 685.5603839616663 259.6799995422363L 666.8754156771822 259.6799995422363" cy="162.2999997138977" cx="685.5603839616663" j="10" val="30" barHeight="97.37999982833863" barWidth="18.684968284484093"></path>
                                                                    </g>
                                                                </g>
                                                                <g id="SvgjsG1440" class="apexcharts-line-series apexcharts-plot-series">
                                                                    <g id="SvgjsG1441" class="apexcharts-series" seriesName="Tablets" data:longestSeries="true" rel="1" data:realIndex="2">
                                                                        <path id="SvgjsPath1444" d="M 0 162.2999997138977C 24.13475070079195 162.2999997138977 44.82167987289934 178.52999968528746 68.95643057369129 178.52999968528746C 90.75556023892273 178.52999968528746 109.44052852340683 142.82399974822997 131.23965818863826 142.82399974822997C 155.3744088894302 142.82399974822997 176.06133806153758 162.2999997138977 200.19608876232954 162.2999997138977C 223.55229911793464 162.2999997138977 243.57190799416762 113.60999979972837 266.9281183497727 113.60999979972837C 291.0628690505647 113.60999979972837 311.7497982226721 146.06999974250795 335.884548923464 146.06999974250795C 359.24075927906915 146.06999974250795 379.2603681553021 51.93599990844726 402.61657851090723 51.93599990844726C 426.75132921169916 51.93599990844726 447.43825838380656 90.88799983978271 471.5730090845985 90.88799983978271C 495.7077597853904 90.88799983978271 516.3946889574978 68.16599987983702 540.5294396582898 68.16599987983702C 563.8856500138949 68.16599987983702 583.9052588901279 142.82399974822997 607.261469245733 142.82399974822997C 631.396219946525 142.82399974822997 652.0831491186323 133.0859997653961 676.2178998194242 133.0859997653961" fill="none" fill-opacity="1" stroke="rgba(241,180,76,1)" stroke-opacity="1" stroke-linecap="butt" stroke-width="4" stroke-dasharray="0" class="apexcharts-line" index="2" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 0 162.2999997138977C 24.13475070079195 162.2999997138977 44.82167987289934 178.52999968528746 68.95643057369129 178.52999968528746C 90.75556023892273 178.52999968528746 109.44052852340683 142.82399974822997 131.23965818863826 142.82399974822997C 155.3744088894302 142.82399974822997 176.06133806153758 162.2999997138977 200.19608876232954 162.2999997138977C 223.55229911793464 162.2999997138977 243.57190799416762 113.60999979972837 266.9281183497727 113.60999979972837C 291.0628690505647 113.60999979972837 311.7497982226721 146.06999974250795 335.884548923464 146.06999974250795C 359.24075927906915 146.06999974250795 379.2603681553021 51.93599990844726 402.61657851090723 51.93599990844726C 426.75132921169916 51.93599990844726 447.43825838380656 90.88799983978271 471.5730090845985 90.88799983978271C 495.7077597853904 90.88799983978271 516.3946889574978 68.16599987983702 540.5294396582898 68.16599987983702C 563.8856500138949 68.16599987983702 583.9052588901279 142.82399974822997 607.261469245733 142.82399974822997C 631.396219946525 142.82399974822997 652.0831491186323 133.0859997653961 676.2178998194242 133.0859997653961" pathFrom="M -1 259.6799995422363L -1 259.6799995422363L 68.95643057369129 259.6799995422363L 131.23965818863826 259.6799995422363L 200.19608876232954 259.6799995422363L 266.9281183497727 259.6799995422363L 335.884548923464 259.6799995422363L 402.61657851090723 259.6799995422363L 471.5730090845985 259.6799995422363L 540.5294396582898 259.6799995422363L 607.261469245733 259.6799995422363L 676.2178998194242 259.6799995422363"></path>
                                                                        <g id="SvgjsG1442" class="apexcharts-series-markers-wrap" data:realIndex="2">
                                                                            <g class="apexcharts-series-markers">
                                                                                <circle id="SvgjsCircle1521" r="0" cx="471.5730090845985" cy="90.88799983978271" class="apexcharts-marker wmqojcucm" stroke="#ffffff" fill="#f1b44c" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                    <g id="SvgjsG1423" class="apexcharts-datalabels" data:realIndex="1"></g>
                                                                    <g id="SvgjsG1428" class="apexcharts-datalabels" data:realIndex="0"></g>
                                                                    <g id="SvgjsG1443" class="apexcharts-datalabels" data:realIndex="2"></g>
                                                                </g>
                                                                <line id="SvgjsLine1515" x1="-18.124386062120138" y1="0" x2="694.3422858815444" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line>
                                                                <line id="SvgjsLine1516" x1="-18.124386062120138" y1="0" x2="694.3422858815444" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                                                                <g id="SvgjsG1517" class="apexcharts-yaxis-annotations"></g>
                                                                <g id="SvgjsG1518" class="apexcharts-xaxis-annotations"></g>
                                                                <g id="SvgjsG1519" class="apexcharts-point-annotations"></g>
                                                                <rect id="SvgjsRect1522" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-zoom-rect"></rect>
                                                                <rect id="SvgjsRect1523" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-selection-rect"></rect>
                                                            </g>
                                                            <rect id="SvgjsRect1403" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
                                                            <g id="SvgjsG1481" class="apexcharts-yaxis" rel="0" transform="translate(20.53332805633545, 0)">
                                                                <g id="SvgjsG1482" class="apexcharts-yaxis-texts-g"><text id="SvgjsText1483" font-family="Helvetica, Arial, sans-serif" x="20" y="31.4" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                        <tspan id="SvgjsTspan1484">80</tspan>
                                                                    </text><text id="SvgjsText1485" font-family="Helvetica, Arial, sans-serif" x="20" y="96.31999988555908" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                        <tspan id="SvgjsTspan1486">60</tspan>
                                                                    </text><text id="SvgjsText1487" font-family="Helvetica, Arial, sans-serif" x="20" y="161.23999977111816" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                        <tspan id="SvgjsTspan1488">40</tspan>
                                                                    </text><text id="SvgjsText1489" font-family="Helvetica, Arial, sans-serif" x="20" y="226.15999965667723" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                        <tspan id="SvgjsTspan1490">20</tspan>
                                                                    </text><text id="SvgjsText1491" font-family="Helvetica, Arial, sans-serif" x="20" y="291.0799995422363" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                        <tspan id="SvgjsTspan1492">0</tspan>
                                                                    </text></g>
                                                                <g id="SvgjsG1493" class="apexcharts-yaxis-title"><text id="SvgjsText1494" font-family="Helvetica, Arial, sans-serif" x="5.908332824707031" y="159.83999977111816" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="900" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-title-text " style="font-family: Helvetica, Arial, sans-serif;" transform="rotate(-90 -9.291667938232422 156.239990234375)">Points</text></g>
                                                            </g>
                                                            <g id="SvgjsG1398" class="apexcharts-annotations"></g>
                                                        </svg>
                                                        <div class="apexcharts-tooltip apexcharts-theme-light" style="left: 378.431px; top: 107.35px;">
                                                            <div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">31 Jul</div>
                                                            <div class="apexcharts-tooltip-series-group apexcharts-active" style="order: 1; display: flex;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(91, 115, 232);"></span>
                                                                <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                                    <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label">Desktops: </span><span class="apexcharts-tooltip-text-value">21 points</span></div>
                                                                    <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                                                </div>
                                                            </div>
                                                            <div class="apexcharts-tooltip-series-group apexcharts-active" style="order: 2; display: flex;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(223, 226, 230);"></span>
                                                                <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                                    <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label">Laptops: </span><span class="apexcharts-tooltip-text-value">41 points</span></div>
                                                                    <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                                                </div>
                                                            </div>
                                                            <div class="apexcharts-tooltip-series-group apexcharts-active" style="order: 3; display: flex;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(241, 180, 76);"></span>
                                                                <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                                    <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label">Tablets: </span><span class="apexcharts-tooltip-text-value">52 points</span></div>
                                                                    <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light" style="left: 513.706px; top: 291.68px;">
                                                            <div class="apexcharts-xaxistooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; min-width: 38.45px;">31 Jul</div>
                                                        </div>
                                                        <div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                                            <div class="apexcharts-yaxistooltip-text"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="resize-triggers">
                                                    <div class="expand-trigger">
                                                        <div style="width: 774px; height: 340px;"></div>
                                                    </div>
                                                    <div class="contract-trigger"></div>
                                                </div>
                                            </div>
                                        </div> <!-- end card-body-->
                                    </div> <!-- end card-->
                                </div> <!-- end col-->

                                <div class="col-xl-4">
                                    <div class="card bg-primary">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-sm-12">
                                                    <p class="text-white font-size-18">Click Button to Close or Open Request <i class="mdi mdi-arrow-right"></i></p>
                                                    <div class="row">
                                                        <div class="col-md-6">


                                                            <button class="btn btn-success course-request-open-close " data-id="1" type="button">Open Request</button>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button class="btn btn-danger course-request-open-close" data-id="0" type="button">Close Request</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div> <!-- end card-body-->
                                    </div> <!-- end card-->

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="float-end">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle text-reset" href="#" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="fw-semibold">Sort By:</span> <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                                        <a class="dropdown-item" href="#">Monthly</a>
                                                        <a class="dropdown-item" href="#">Yearly</a>
                                                        <a class="dropdown-item" href="#">Weekly</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title mb-4">Top Selling Products</h4>


                                            <div class="row align-items-center g-0 mt-3">
                                                <div class="col-sm-3">
                                                    <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-primary me-2"></i> Desktops </p>
                                                </div>

                                                <div class="col-sm-9">
                                                    <div class="progress mt-1" style="height: 6px;">
                                                        <div class="progress-bar progress-bar bg-primary" role="progressbar" style="width: 52%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->

                                            <div class="row align-items-center g-0 mt-3">
                                                <div class="col-sm-3">
                                                    <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-info me-2"></i> iPhones </p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="progress mt-1" style="height: 6px;">
                                                        <div class="progress-bar progress-bar bg-info" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="45">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->

                                            <div class="row align-items-center g-0 mt-3">
                                                <div class="col-sm-3">
                                                    <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-success me-2"></i> Android </p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="progress mt-1" style="height: 6px;">
                                                        <div class="progress-bar progress-bar bg-success" role="progressbar" style="width: 48%" aria-valuenow="48" aria-valuemin="0" aria-valuemax="48">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->

                                            <div class="row align-items-center g-0 mt-3">
                                                <div class="col-sm-3">
                                                    <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-warning me-2"></i> Tablets </p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="progress mt-1" style="height: 6px;">
                                                        <div class="progress-bar progress-bar bg-warning" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->

                                            <div class="row align-items-center g-0 mt-3">
                                                <div class="col-sm-3">
                                                    <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-purple me-2"></i> Cables </p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="progress mt-1" style="height: 6px;">
                                                        <div class="progress-bar progress-bar bg-purple" role="progressbar" style="width: 63%" aria-valuenow="63" aria-valuemin="0" aria-valuemax="63">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->

                                        </div> <!-- end card-body-->
                                    </div> <!-- end card-->
                                </div> <!-- end Col -->
                            </div>

                        </div>
                    </div>
                </div>
            <?php } else if ($_SESSION['type'] == 7) { ?>
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Dashboard</h4>

                                    <div class="page-title-right hidden">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item active">All Files</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="total-revenue-chart"></div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?= number_format($students_count, 0, 2) ?></span></h4>
                                            <p class="text-muted mb-0">Total Students</p>
                                        </div>
                                        <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i>2.65%</span> since last week
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="orders-chart"> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?= number_format($exam_passed_students_count['count'], 0, 2) ?></span></h4>
                                            <p class="text-muted mb-0">Total Exam Pass Students</p>
                                        </div>
                                        <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="mdi mdi-arrow-down-bold me-1"></i>0.82%</span> since last week
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="customers-chart"> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup"> <?= $centers_count ?></span></h4>
                                            <p class="text-muted mb-0">Our Centers</p>
                                        </div>
                                        <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="mdi mdi-arrow-down-bold me-1"></i>6.24%</span> since last week
                                        </p>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">

                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="growth-chart"></div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1">+ <span data-plugin="counterup"><?= $courses_count ?></span></h4>
                                            <p class="text-muted mb-0">Our Courses</p>
                                        </div>
                                        <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i>10.51%</span> since last week
                                        </p>
                                    </div>
                                </div>
                            </div> <!-- end col-->



                            <div class="row">
                                <div class="col-xl-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="float-end">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle text-reset" href="#" id="dropdownMenuButton5" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="fw-semibold">Sort By:</span> <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton5">
                                                        <a class="dropdown-item" href="#">Monthly</a>
                                                        <a class="dropdown-item" href="#">Yearly</a>
                                                        <a class="dropdown-item" href="#">Weekly</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4 class="card-title mb-4">Sales Analytics</h4>

                                            <div class="mt-1">
                                                <ul class="list-inline main-chart mb-0">
                                                    <li class="list-inline-item chart-border-left me-0 border-0">
                                                        <h3 class="text-primary">$<span data-plugin="counterup">2,371</span><span class="text-muted d-inline-block font-size-15 ms-3">Income</span></h3>
                                                    </li>
                                                    <li class="list-inline-item chart-border-left me-0">
                                                        <h3><span data-plugin="counterup">258</span><span class="text-muted d-inline-block font-size-15 ms-3">Sales</span>
                                                        </h3>
                                                    </li>
                                                    <li class="list-inline-item chart-border-left me-0">
                                                        <h3><span data-plugin="counterup">3.6</span>%<span class="text-muted d-inline-block font-size-15 ms-3">Conversation Ratio</span></h3>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="mt-3" style="position: relative;">
                                                <div id="sales-analytics-chart" class="apex-charts" dir="ltr" style="min-height: 354px;">
                                                    <div id="apexchartsdh5eyvr1" class="apexcharts-canvas apexchartsdh5eyvr1 apexcharts-theme-light" style="width: 773px; height: 339px;"><svg id="SvgjsSvg1395" width="773" height="339" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg apexcharts-zoomable hovering-zoom" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                                                            <foreignObject x="0" y="0" width="773" height="339">
                                                                <div class="apexcharts-legend apexcharts-align-center position-bottom" xmlns="http://www.w3.org/1999/xhtml" style="inset: auto 0px 1px; position: absolute; max-height: 169.5px;">
                                                                    <div class="apexcharts-legend-series" style="margin: 2px 5px;" rel="1" seriesname="Desktops" data:collapsed="false"><span class="apexcharts-legend-marker" style="background: rgb(91, 115, 232) !important; color: rgb(91, 115, 232); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;" rel="1" data:collapsed="false"></span><span class="apexcharts-legend-text" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;" rel="1" i="0" data:default-text="Desktops" data:collapsed="false">Desktops</span></div>
                                                                    <div class="apexcharts-legend-series" style="margin: 2px 5px;" rel="2" seriesname="Laptops" data:collapsed="false"><span class="apexcharts-legend-marker" style="background: rgb(223, 226, 230) !important; color: rgb(223, 226, 230); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;" rel="2" data:collapsed="false"></span><span class="apexcharts-legend-text" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;" rel="2" i="1" data:default-text="Laptops" data:collapsed="false">Laptops</span></div>
                                                                    <div class="apexcharts-legend-series" style="margin: 2px 5px;" rel="3" seriesname="Tablets" data:collapsed="false"><span class="apexcharts-legend-marker" style="background: rgb(241, 180, 76) !important; color: rgb(241, 180, 76); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;" rel="3" data:collapsed="false"></span><span class="apexcharts-legend-text" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;" rel="3" i="2" data:default-text="Tablets" data:collapsed="false">Tablets</span></div>
                                                                </div>
                                                                <style type="text/css">
                                                                    .apexcharts-legend {
                                                                        display: flex;
                                                                        overflow: auto;
                                                                        padding: 0 10px;
                                                                    }

                                                                    .apexcharts-legend.position-bottom,
                                                                    .apexcharts-legend.position-top {
                                                                        flex-wrap: wrap
                                                                    }

                                                                    .apexcharts-legend.position-right,
                                                                    .apexcharts-legend.position-left {
                                                                        flex-direction: column;
                                                                        bottom: 0;
                                                                    }

                                                                    .apexcharts-legend.position-bottom.apexcharts-align-left,
                                                                    .apexcharts-legend.position-top.apexcharts-align-left,
                                                                    .apexcharts-legend.position-right,
                                                                    .apexcharts-legend.position-left {
                                                                        justify-content: flex-start;
                                                                    }

                                                                    .apexcharts-legend.position-bottom.apexcharts-align-center,
                                                                    .apexcharts-legend.position-top.apexcharts-align-center {
                                                                        justify-content: center;
                                                                    }

                                                                    .apexcharts-legend.position-bottom.apexcharts-align-right,
                                                                    .apexcharts-legend.position-top.apexcharts-align-right {
                                                                        justify-content: flex-end;
                                                                    }

                                                                    .apexcharts-legend-series {
                                                                        cursor: pointer;
                                                                        line-height: normal;
                                                                    }

                                                                    .apexcharts-legend.position-bottom .apexcharts-legend-series,
                                                                    .apexcharts-legend.position-top .apexcharts-legend-series {
                                                                        display: flex;
                                                                        align-items: center;
                                                                    }

                                                                    .apexcharts-legend-text {
                                                                        position: relative;
                                                                        font-size: 14px;
                                                                    }

                                                                    .apexcharts-legend-text *,
                                                                    .apexcharts-legend-marker * {
                                                                        pointer-events: none;
                                                                    }

                                                                    .apexcharts-legend-marker {
                                                                        position: relative;
                                                                        display: inline-block;
                                                                        cursor: pointer;
                                                                        margin-right: 3px;
                                                                        border-style: solid;
                                                                    }

                                                                    .apexcharts-legend.apexcharts-align-right .apexcharts-legend-series,
                                                                    .apexcharts-legend.apexcharts-align-left .apexcharts-legend-series {
                                                                        display: inline-block;
                                                                    }

                                                                    .apexcharts-legend-series.apexcharts-no-click {
                                                                        cursor: auto;
                                                                    }

                                                                    .apexcharts-legend .apexcharts-hidden-zero-series,
                                                                    .apexcharts-legend .apexcharts-hidden-null-series {
                                                                        display: none !important;
                                                                    }

                                                                    .apexcharts-inactive-legend {
                                                                        opacity: 0.45;
                                                                    }
                                                                </style>
                                                            </foreignObject>
                                                            <g id="SvgjsG1397" class="apexcharts-inner apexcharts-graphical" transform="translate(72.65771411845559, 30)">
                                                                <defs id="SvgjsDefs1396">
                                                                    <clipPath id="gridRectMaskdh5eyvr1">
                                                                        <rect id="SvgjsRect1418" width="720.4666719436646" height="263.6799995422363" x="-22.124386062120138" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                                    </clipPath>
                                                                    <clipPath id="gridRectMarkerMaskdh5eyvr1">
                                                                        <rect id="SvgjsRect1419" width="680.2178998194242" height="263.6799995422363" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                                    </clipPath>
                                                                </defs>
                                                                <line id="SvgjsLine1404" x1="471.07300908459854" y1="0" x2="471.07300908459854" y2="259.6799995422363" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="471.07300908459854" y="0" width="1" height="259.6799995422363" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line>
                                                                <g id="SvgjsG1445" class="apexcharts-xaxis" transform="translate(0, 0)">
                                                                    <g id="SvgjsG1446" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText1448" font-family="Helvetica, Arial, sans-serif" x="2.224400986248106" y="288.6799995422363" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="600" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1449">2003</tspan>
                                                                            <title>2003</title>
                                                                        </text><text id="SvgjsText1451" font-family="Helvetica, Arial, sans-serif" x="71.18083155993939" y="288.6799995422363" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1452">Feb '03</tspan>
                                                                            <title>Feb '03</title>
                                                                        </text><text id="SvgjsText1454" font-family="Helvetica, Arial, sans-serif" x="133.46405917488636" y="288.6799995422363" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1455">Mar '03</tspan>
                                                                            <title>Mar '03</title>
                                                                        </text><text id="SvgjsText1457" font-family="Helvetica, Arial, sans-serif" x="202.42048974857767" y="288.6799995422363" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1458">Apr '03</tspan>
                                                                            <title>Apr '03</title>
                                                                        </text><text id="SvgjsText1460" font-family="Helvetica, Arial, sans-serif" x="269.1525193360209" y="288.6799995422363" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1461">May '03</tspan>
                                                                            <title>May '03</title>
                                                                        </text><text id="SvgjsText1463" font-family="Helvetica, Arial, sans-serif" x="338.1089499097122" y="288.6799995422363" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1464">Jun '03</tspan>
                                                                            <title>Jun '03</title>
                                                                        </text><text id="SvgjsText1466" font-family="Helvetica, Arial, sans-serif" x="404.84097949715533" y="288.6799995422363" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1467">Jul '03</tspan>
                                                                            <title>Jul '03</title>
                                                                        </text><text id="SvgjsText1469" font-family="Helvetica, Arial, sans-serif" x="473.79741007084664" y="288.6799995422363" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1470">Aug '03</tspan>
                                                                            <title>Aug '03</title>
                                                                        </text><text id="SvgjsText1472" font-family="Helvetica, Arial, sans-serif" x="542.753840644538" y="288.6799995422363" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1473">Sep '03</tspan>
                                                                            <title>Sep '03</title>
                                                                        </text><text id="SvgjsText1475" font-family="Helvetica, Arial, sans-serif" x="609.4858702319812" y="288.6799995422363" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1476">Oct '03</tspan>
                                                                            <title>Oct '03</title>
                                                                        </text><text id="SvgjsText1478" font-family="Helvetica, Arial, sans-serif" x="678.4423008056724" y="288.6799995422363" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                            <tspan id="SvgjsTspan1479"></tspan>
                                                                            <title></title>
                                                                        </text></g>
                                                                    <line id="SvgjsLine1480" x1="-18.124386062120138" y1="260.6799995422363" x2="694.3422858815444" y2="260.6799995422363" stroke="#e0e0e0" stroke-dasharray="0" stroke-width="1"></line>
                                                                </g>
                                                                <g id="SvgjsG1495" class="apexcharts-grid">
                                                                    <g id="SvgjsG1496" class="apexcharts-gridlines-horizontal">
                                                                        <line id="SvgjsLine1508" x1="-18.124386062120138" y1="0" x2="694.3422858815444" y2="0" stroke="#f1f1f1" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                                        <line id="SvgjsLine1509" x1="-18.124386062120138" y1="64.91999988555908" x2="694.3422858815444" y2="64.91999988555908" stroke="#f1f1f1" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                                        <line id="SvgjsLine1510" x1="-18.124386062120138" y1="129.83999977111816" x2="694.3422858815444" y2="129.83999977111816" stroke="#f1f1f1" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                                        <line id="SvgjsLine1511" x1="-18.124386062120138" y1="194.75999965667722" x2="694.3422858815444" y2="194.75999965667722" stroke="#f1f1f1" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                                        <line id="SvgjsLine1512" x1="-18.124386062120138" y1="259.6799995422363" x2="694.3422858815444" y2="259.6799995422363" stroke="#f1f1f1" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                                    </g>
                                                                    <g id="SvgjsG1497" class="apexcharts-gridlines-vertical"></g>
                                                                    <line id="SvgjsLine1498" x1="2.224400986248106" y1="260.6799995422363" x2="2.224400986248106" y2="266.6799995422363" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                                    <line id="SvgjsLine1499" x1="71.18083155993939" y1="260.6799995422363" x2="71.18083155993939" y2="266.6799995422363" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                                    <line id="SvgjsLine1500" x1="133.46405917488636" y1="260.6799995422363" x2="133.46405917488636" y2="266.6799995422363" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                                    <line id="SvgjsLine1501" x1="202.42048974857767" y1="260.6799995422363" x2="202.42048974857767" y2="266.6799995422363" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                                    <line id="SvgjsLine1502" x1="269.1525193360209" y1="260.6799995422363" x2="269.1525193360209" y2="266.6799995422363" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                                    <line id="SvgjsLine1503" x1="338.1089499097122" y1="260.6799995422363" x2="338.1089499097122" y2="266.6799995422363" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                                    <line id="SvgjsLine1504" x1="404.84097949715533" y1="260.6799995422363" x2="404.84097949715533" y2="266.6799995422363" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                                    <line id="SvgjsLine1505" x1="473.79741007084664" y1="260.6799995422363" x2="473.79741007084664" y2="266.6799995422363" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                                    <line id="SvgjsLine1506" x1="542.753840644538" y1="260.6799995422363" x2="542.753840644538" y2="266.6799995422363" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                                    <line id="SvgjsLine1507" x1="609.4858702319812" y1="260.6799995422363" x2="609.4858702319812" y2="266.6799995422363" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                                    <line id="SvgjsLine1514" x1="0" y1="259.6799995422363" x2="676.2178998194242" y2="259.6799995422363" stroke="transparent" stroke-dasharray="0"></line>
                                                                    <line id="SvgjsLine1513" x1="0" y1="1" x2="0" y2="259.6799995422363" stroke="transparent" stroke-dasharray="0"></line>
                                                                </g>
                                                                <g id="SvgjsG1420" class="apexcharts-area-series apexcharts-plot-series">
                                                                    <g id="SvgjsG1421" class="apexcharts-series" seriesName="Laptops" data:longestSeries="true" rel="1" data:realIndex="1">
                                                                        <path id="SvgjsPath1424" d="M 0 259.6799995422363L 0 116.85599979400635C 24.13475070079195 116.85599979400635 44.82167987289934 81.14999985694885 68.95643057369129 81.14999985694885C 90.75556023892273 81.14999985694885 109.44052852340683 126.5939997768402 131.23965818863826 126.5939997768402C 155.3744088894302 126.5939997768402 176.06133806153758 42.1979999256134 200.19608876232954 42.1979999256134C 223.55229911793464 42.1979999256134 243.57190799416762 188.26799966812132 266.9281183497727 188.26799966812132C 291.0628690505647 188.26799966812132 311.7497982226721 120.1019997882843 335.884548923464 120.1019997882843C 359.24075927906915 120.1019997882843 379.2603681553021 191.51399966239927 402.61657851090723 191.51399966239927C 426.75132921169916 191.51399966239927 447.43825838380656 126.5939997768402 471.5730090845985 126.5939997768402C 495.7077597853904 126.5939997768402 516.3946889574978 77.9039998626709 540.5294396582898 77.9039998626709C 563.8856500138949 77.9039998626709 583.9052588901279 172.03799969673156 607.261469245733 172.03799969673156C 631.396219946525 172.03799969673156 652.0831491186323 120.1019997882843 676.2178998194242 120.1019997882843C 676.2178998194242 120.1019997882843 676.2178998194242 120.1019997882843 676.2178998194242 259.6799995422363M 676.2178998194242 120.1019997882843z" fill="rgba(223,226,230,0.25)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="1" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 0 259.6799995422363L 0 116.85599979400635C 24.13475070079195 116.85599979400635 44.82167987289934 81.14999985694885 68.95643057369129 81.14999985694885C 90.75556023892273 81.14999985694885 109.44052852340683 126.5939997768402 131.23965818863826 126.5939997768402C 155.3744088894302 126.5939997768402 176.06133806153758 42.1979999256134 200.19608876232954 42.1979999256134C 223.55229911793464 42.1979999256134 243.57190799416762 188.26799966812132 266.9281183497727 188.26799966812132C 291.0628690505647 188.26799966812132 311.7497982226721 120.1019997882843 335.884548923464 120.1019997882843C 359.24075927906915 120.1019997882843 379.2603681553021 191.51399966239927 402.61657851090723 191.51399966239927C 426.75132921169916 191.51399966239927 447.43825838380656 126.5939997768402 471.5730090845985 126.5939997768402C 495.7077597853904 126.5939997768402 516.3946889574978 77.9039998626709 540.5294396582898 77.9039998626709C 563.8856500138949 77.9039998626709 583.9052588901279 172.03799969673156 607.261469245733 172.03799969673156C 631.396219946525 172.03799969673156 652.0831491186323 120.1019997882843 676.2178998194242 120.1019997882843C 676.2178998194242 120.1019997882843 676.2178998194242 120.1019997882843 676.2178998194242 259.6799995422363M 676.2178998194242 120.1019997882843z" pathFrom="M -1 259.6799995422363L -1 259.6799995422363L 68.95643057369129 259.6799995422363L 131.23965818863826 259.6799995422363L 200.19608876232954 259.6799995422363L 266.9281183497727 259.6799995422363L 335.884548923464 259.6799995422363L 402.61657851090723 259.6799995422363L 471.5730090845985 259.6799995422363L 540.5294396582898 259.6799995422363L 607.261469245733 259.6799995422363L 676.2178998194242 259.6799995422363"></path>
                                                                        <path id="SvgjsPath1425" d="M 0 116.85599979400635C 24.13475070079195 116.85599979400635 44.82167987289934 81.14999985694885 68.95643057369129 81.14999985694885C 90.75556023892273 81.14999985694885 109.44052852340683 126.5939997768402 131.23965818863826 126.5939997768402C 155.3744088894302 126.5939997768402 176.06133806153758 42.1979999256134 200.19608876232954 42.1979999256134C 223.55229911793464 42.1979999256134 243.57190799416762 188.26799966812132 266.9281183497727 188.26799966812132C 291.0628690505647 188.26799966812132 311.7497982226721 120.1019997882843 335.884548923464 120.1019997882843C 359.24075927906915 120.1019997882843 379.2603681553021 191.51399966239927 402.61657851090723 191.51399966239927C 426.75132921169916 191.51399966239927 447.43825838380656 126.5939997768402 471.5730090845985 126.5939997768402C 495.7077597853904 126.5939997768402 516.3946889574978 77.9039998626709 540.5294396582898 77.9039998626709C 563.8856500138949 77.9039998626709 583.9052588901279 172.03799969673156 607.261469245733 172.03799969673156C 631.396219946525 172.03799969673156 652.0831491186323 120.1019997882843 676.2178998194242 120.1019997882843" fill="none" fill-opacity="1" stroke="#dfe2e6" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-area" index="1" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 0 116.85599979400635C 24.13475070079195 116.85599979400635 44.82167987289934 81.14999985694885 68.95643057369129 81.14999985694885C 90.75556023892273 81.14999985694885 109.44052852340683 126.5939997768402 131.23965818863826 126.5939997768402C 155.3744088894302 126.5939997768402 176.06133806153758 42.1979999256134 200.19608876232954 42.1979999256134C 223.55229911793464 42.1979999256134 243.57190799416762 188.26799966812132 266.9281183497727 188.26799966812132C 291.0628690505647 188.26799966812132 311.7497982226721 120.1019997882843 335.884548923464 120.1019997882843C 359.24075927906915 120.1019997882843 379.2603681553021 191.51399966239927 402.61657851090723 191.51399966239927C 426.75132921169916 191.51399966239927 447.43825838380656 126.5939997768402 471.5730090845985 126.5939997768402C 495.7077597853904 126.5939997768402 516.3946889574978 77.9039998626709 540.5294396582898 77.9039998626709C 563.8856500138949 77.9039998626709 583.9052588901279 172.03799969673156 607.261469245733 172.03799969673156C 631.396219946525 172.03799969673156 652.0831491186323 120.1019997882843 676.2178998194242 120.1019997882843" pathFrom="M -1 259.6799995422363L -1 259.6799995422363L 68.95643057369129 259.6799995422363L 131.23965818863826 259.6799995422363L 200.19608876232954 259.6799995422363L 266.9281183497727 259.6799995422363L 335.884548923464 259.6799995422363L 402.61657851090723 259.6799995422363L 471.5730090845985 259.6799995422363L 540.5294396582898 259.6799995422363L 607.261469245733 259.6799995422363L 676.2178998194242 259.6799995422363"></path>
                                                                        <g id="SvgjsG1422" class="apexcharts-series-markers-wrap" data:realIndex="1">
                                                                            <g class="apexcharts-series-markers">
                                                                                <circle id="SvgjsCircle1520" r="0" cx="471.5730090845985" cy="126.5939997768402" class="apexcharts-marker wz8piy6rp" stroke="#ffffff" fill="#5b73e8" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                                <g id="SvgjsG1426" class="apexcharts-bar-series apexcharts-plot-series">
                                                                    <g id="SvgjsG1427" class="apexcharts-series" rel="1" seriesName="Desktops" data:realIndex="0">
                                                                        <path id="SvgjsPath1429" d="M -9.342484142242046 259.6799995422363L -9.342484142242046 185.02199967384337L 9.342484142242046 185.02199967384337L 9.342484142242046 185.02199967384337L 9.342484142242046 259.6799995422363L 9.342484142242046 259.6799995422363z" fill="rgba(91,115,232,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M -9.342484142242046 259.6799995422363L -9.342484142242046 185.02199967384337L 9.342484142242046 185.02199967384337L 9.342484142242046 185.02199967384337L 9.342484142242046 259.6799995422363L 9.342484142242046 259.6799995422363z" pathFrom="M -9.342484142242046 259.6799995422363L -9.342484142242046 259.6799995422363L 9.342484142242046 259.6799995422363L 9.342484142242046 259.6799995422363L 9.342484142242046 259.6799995422363L -9.342484142242046 259.6799995422363" cy="185.02199967384337" cx="9.342484142242046" j="0" val="23" barHeight="74.65799986839295" barWidth="18.684968284484093"></path>
                                                                        <path id="SvgjsPath1430" d="M 59.61394643144925 259.6799995422363L 59.61394643144925 223.97399960517882L 78.29891471593334 223.97399960517882L 78.29891471593334 223.97399960517882L 78.29891471593334 259.6799995422363L 78.29891471593334 259.6799995422363z" fill="rgba(91,115,232,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 59.61394643144925 259.6799995422363L 59.61394643144925 223.97399960517882L 78.29891471593334 223.97399960517882L 78.29891471593334 223.97399960517882L 78.29891471593334 259.6799995422363L 78.29891471593334 259.6799995422363z" pathFrom="M 59.61394643144925 259.6799995422363L 59.61394643144925 259.6799995422363L 78.29891471593334 259.6799995422363L 78.29891471593334 259.6799995422363L 78.29891471593334 259.6799995422363L 59.61394643144925 259.6799995422363" cy="223.97399960517882" cx="78.29891471593334" j="1" val="11" barHeight="35.70599993705749" barWidth="18.684968284484093"></path>
                                                                        <path id="SvgjsPath1431" d="M 121.89717404639622 259.6799995422363L 121.89717404639622 188.26799966812132L 140.58214233088032 188.26799966812132L 140.58214233088032 188.26799966812132L 140.58214233088032 259.6799995422363L 140.58214233088032 259.6799995422363z" fill="rgba(91,115,232,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 121.89717404639622 259.6799995422363L 121.89717404639622 188.26799966812132L 140.58214233088032 188.26799966812132L 140.58214233088032 188.26799966812132L 140.58214233088032 259.6799995422363L 140.58214233088032 259.6799995422363z" pathFrom="M 121.89717404639622 259.6799995422363L 121.89717404639622 259.6799995422363L 140.58214233088032 259.6799995422363L 140.58214233088032 259.6799995422363L 140.58214233088032 259.6799995422363L 121.89717404639622 259.6799995422363" cy="188.26799966812132" cx="140.58214233088032" j="2" val="22" barHeight="71.41199987411498" barWidth="18.684968284484093"></path>
                                                                        <path id="SvgjsPath1432" d="M 190.85360462008748 259.6799995422363L 190.85360462008748 172.03799969673156L 209.53857290457157 172.03799969673156L 209.53857290457157 172.03799969673156L 209.53857290457157 259.6799995422363L 209.53857290457157 259.6799995422363z" fill="rgba(91,115,232,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 190.85360462008748 259.6799995422363L 190.85360462008748 172.03799969673156L 209.53857290457157 172.03799969673156L 209.53857290457157 172.03799969673156L 209.53857290457157 259.6799995422363L 209.53857290457157 259.6799995422363z" pathFrom="M 190.85360462008748 259.6799995422363L 190.85360462008748 259.6799995422363L 209.53857290457157 259.6799995422363L 209.53857290457157 259.6799995422363L 209.53857290457157 259.6799995422363L 190.85360462008748 259.6799995422363" cy="172.03799969673156" cx="209.53857290457157" j="3" val="27" barHeight="87.64199984550476" barWidth="18.684968284484093"></path>
                                                                        <path id="SvgjsPath1433" d="M 257.5856342075307 259.6799995422363L 257.5856342075307 217.48199961662291L 276.2706024920148 217.48199961662291L 276.2706024920148 217.48199961662291L 276.2706024920148 259.6799995422363L 276.2706024920148 259.6799995422363z" fill="rgba(91,115,232,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 257.5856342075307 259.6799995422363L 257.5856342075307 217.48199961662291L 276.2706024920148 217.48199961662291L 276.2706024920148 217.48199961662291L 276.2706024920148 259.6799995422363L 276.2706024920148 259.6799995422363z" pathFrom="M 257.5856342075307 259.6799995422363L 257.5856342075307 259.6799995422363L 276.2706024920148 259.6799995422363L 276.2706024920148 259.6799995422363L 276.2706024920148 259.6799995422363L 257.5856342075307 259.6799995422363" cy="217.48199961662291" cx="276.2706024920148" j="4" val="13" barHeight="42.1979999256134" barWidth="18.684968284484093"></path>
                                                                        <path id="SvgjsPath1434" d="M 326.542064781222 259.6799995422363L 326.542064781222 188.26799966812132L 345.2270330657061 188.26799966812132L 345.2270330657061 188.26799966812132L 345.2270330657061 259.6799995422363L 345.2270330657061 259.6799995422363z" fill="rgba(91,115,232,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 326.542064781222 259.6799995422363L 326.542064781222 188.26799966812132L 345.2270330657061 188.26799966812132L 345.2270330657061 188.26799966812132L 345.2270330657061 259.6799995422363L 345.2270330657061 259.6799995422363z" pathFrom="M 326.542064781222 259.6799995422363L 326.542064781222 259.6799995422363L 345.2270330657061 259.6799995422363L 345.2270330657061 259.6799995422363L 345.2270330657061 259.6799995422363L 326.542064781222 259.6799995422363" cy="188.26799966812132" cx="345.2270330657061" j="5" val="22" barHeight="71.41199987411498" barWidth="18.684968284484093"></path>
                                                                        <path id="SvgjsPath1435" d="M 393.2740943686652 259.6799995422363L 393.2740943686652 139.577999753952L 411.9590626531493 139.577999753952L 411.9590626531493 139.577999753952L 411.9590626531493 259.6799995422363L 411.9590626531493 259.6799995422363z" fill="rgba(91,115,232,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 393.2740943686652 259.6799995422363L 393.2740943686652 139.577999753952L 411.9590626531493 139.577999753952L 411.9590626531493 139.577999753952L 411.9590626531493 259.6799995422363L 411.9590626531493 259.6799995422363z" pathFrom="M 393.2740943686652 259.6799995422363L 393.2740943686652 259.6799995422363L 411.9590626531493 259.6799995422363L 411.9590626531493 259.6799995422363L 411.9590626531493 259.6799995422363L 393.2740943686652 259.6799995422363" cy="139.577999753952" cx="411.9590626531493" j="6" val="37" barHeight="120.1019997882843" barWidth="18.684968284484093"></path>
                                                                        <path id="SvgjsPath1436" d="M 462.23052494235645 259.6799995422363L 462.23052494235645 191.51399966239927L 480.91549322684057 191.51399966239927L 480.91549322684057 191.51399966239927L 480.91549322684057 259.6799995422363L 480.91549322684057 259.6799995422363z" fill="rgba(91,115,232,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 462.23052494235645 259.6799995422363L 462.23052494235645 191.51399966239927L 480.91549322684057 191.51399966239927L 480.91549322684057 191.51399966239927L 480.91549322684057 259.6799995422363L 480.91549322684057 259.6799995422363z" pathFrom="M 462.23052494235645 259.6799995422363L 462.23052494235645 259.6799995422363L 480.91549322684057 259.6799995422363L 480.91549322684057 259.6799995422363L 480.91549322684057 259.6799995422363L 462.23052494235645 259.6799995422363" cy="191.51399966239927" cx="480.91549322684057" j="7" val="21" barHeight="68.16599987983703" barWidth="18.684968284484093"></path>
                                                                        <path id="SvgjsPath1437" d="M 531.1869555160478 259.6799995422363L 531.1869555160478 116.85599979400635L 549.8719238005318 116.85599979400635L 549.8719238005318 116.85599979400635L 549.8719238005318 259.6799995422363L 549.8719238005318 259.6799995422363z" fill="rgba(91,115,232,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 531.1869555160478 259.6799995422363L 531.1869555160478 116.85599979400635L 549.8719238005318 116.85599979400635L 549.8719238005318 116.85599979400635L 549.8719238005318 259.6799995422363L 549.8719238005318 259.6799995422363z" pathFrom="M 531.1869555160478 259.6799995422363L 531.1869555160478 259.6799995422363L 549.8719238005318 259.6799995422363L 549.8719238005318 259.6799995422363L 549.8719238005318 259.6799995422363L 531.1869555160478 259.6799995422363" cy="116.85599979400635" cx="549.8719238005318" j="8" val="44" barHeight="142.82399974822997" barWidth="18.684968284484093"></path>
                                                                        <path id="SvgjsPath1438" d="M 597.918985103491 259.6799995422363L 597.918985103491 188.26799966812132L 616.603953387975 188.26799966812132L 616.603953387975 188.26799966812132L 616.603953387975 259.6799995422363L 616.603953387975 259.6799995422363z" fill="rgba(91,115,232,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 597.918985103491 259.6799995422363L 597.918985103491 188.26799966812132L 616.603953387975 188.26799966812132L 616.603953387975 188.26799966812132L 616.603953387975 259.6799995422363L 616.603953387975 259.6799995422363z" pathFrom="M 597.918985103491 259.6799995422363L 597.918985103491 259.6799995422363L 616.603953387975 259.6799995422363L 616.603953387975 259.6799995422363L 616.603953387975 259.6799995422363L 597.918985103491 259.6799995422363" cy="188.26799966812132" cx="616.603953387975" j="9" val="22" barHeight="71.41199987411498" barWidth="18.684968284484093"></path>
                                                                        <path id="SvgjsPath1439" d="M 666.8754156771822 259.6799995422363L 666.8754156771822 162.2999997138977L 685.5603839616663 162.2999997138977L 685.5603839616663 162.2999997138977L 685.5603839616663 259.6799995422363L 685.5603839616663 259.6799995422363z" fill="rgba(91,115,232,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 666.8754156771822 259.6799995422363L 666.8754156771822 162.2999997138977L 685.5603839616663 162.2999997138977L 685.5603839616663 162.2999997138977L 685.5603839616663 259.6799995422363L 685.5603839616663 259.6799995422363z" pathFrom="M 666.8754156771822 259.6799995422363L 666.8754156771822 259.6799995422363L 685.5603839616663 259.6799995422363L 685.5603839616663 259.6799995422363L 685.5603839616663 259.6799995422363L 666.8754156771822 259.6799995422363" cy="162.2999997138977" cx="685.5603839616663" j="10" val="30" barHeight="97.37999982833863" barWidth="18.684968284484093"></path>
                                                                    </g>
                                                                </g>
                                                                <g id="SvgjsG1440" class="apexcharts-line-series apexcharts-plot-series">
                                                                    <g id="SvgjsG1441" class="apexcharts-series" seriesName="Tablets" data:longestSeries="true" rel="1" data:realIndex="2">
                                                                        <path id="SvgjsPath1444" d="M 0 162.2999997138977C 24.13475070079195 162.2999997138977 44.82167987289934 178.52999968528746 68.95643057369129 178.52999968528746C 90.75556023892273 178.52999968528746 109.44052852340683 142.82399974822997 131.23965818863826 142.82399974822997C 155.3744088894302 142.82399974822997 176.06133806153758 162.2999997138977 200.19608876232954 162.2999997138977C 223.55229911793464 162.2999997138977 243.57190799416762 113.60999979972837 266.9281183497727 113.60999979972837C 291.0628690505647 113.60999979972837 311.7497982226721 146.06999974250795 335.884548923464 146.06999974250795C 359.24075927906915 146.06999974250795 379.2603681553021 51.93599990844726 402.61657851090723 51.93599990844726C 426.75132921169916 51.93599990844726 447.43825838380656 90.88799983978271 471.5730090845985 90.88799983978271C 495.7077597853904 90.88799983978271 516.3946889574978 68.16599987983702 540.5294396582898 68.16599987983702C 563.8856500138949 68.16599987983702 583.9052588901279 142.82399974822997 607.261469245733 142.82399974822997C 631.396219946525 142.82399974822997 652.0831491186323 133.0859997653961 676.2178998194242 133.0859997653961" fill="none" fill-opacity="1" stroke="rgba(241,180,76,1)" stroke-opacity="1" stroke-linecap="butt" stroke-width="4" stroke-dasharray="0" class="apexcharts-line" index="2" clip-path="url(#gridRectMaskdh5eyvr1)" pathTo="M 0 162.2999997138977C 24.13475070079195 162.2999997138977 44.82167987289934 178.52999968528746 68.95643057369129 178.52999968528746C 90.75556023892273 178.52999968528746 109.44052852340683 142.82399974822997 131.23965818863826 142.82399974822997C 155.3744088894302 142.82399974822997 176.06133806153758 162.2999997138977 200.19608876232954 162.2999997138977C 223.55229911793464 162.2999997138977 243.57190799416762 113.60999979972837 266.9281183497727 113.60999979972837C 291.0628690505647 113.60999979972837 311.7497982226721 146.06999974250795 335.884548923464 146.06999974250795C 359.24075927906915 146.06999974250795 379.2603681553021 51.93599990844726 402.61657851090723 51.93599990844726C 426.75132921169916 51.93599990844726 447.43825838380656 90.88799983978271 471.5730090845985 90.88799983978271C 495.7077597853904 90.88799983978271 516.3946889574978 68.16599987983702 540.5294396582898 68.16599987983702C 563.8856500138949 68.16599987983702 583.9052588901279 142.82399974822997 607.261469245733 142.82399974822997C 631.396219946525 142.82399974822997 652.0831491186323 133.0859997653961 676.2178998194242 133.0859997653961" pathFrom="M -1 259.6799995422363L -1 259.6799995422363L 68.95643057369129 259.6799995422363L 131.23965818863826 259.6799995422363L 200.19608876232954 259.6799995422363L 266.9281183497727 259.6799995422363L 335.884548923464 259.6799995422363L 402.61657851090723 259.6799995422363L 471.5730090845985 259.6799995422363L 540.5294396582898 259.6799995422363L 607.261469245733 259.6799995422363L 676.2178998194242 259.6799995422363"></path>
                                                                        <g id="SvgjsG1442" class="apexcharts-series-markers-wrap" data:realIndex="2">
                                                                            <g class="apexcharts-series-markers">
                                                                                <circle id="SvgjsCircle1521" r="0" cx="471.5730090845985" cy="90.88799983978271" class="apexcharts-marker wmqojcucm" stroke="#ffffff" fill="#f1b44c" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                    <g id="SvgjsG1423" class="apexcharts-datalabels" data:realIndex="1"></g>
                                                                    <g id="SvgjsG1428" class="apexcharts-datalabels" data:realIndex="0"></g>
                                                                    <g id="SvgjsG1443" class="apexcharts-datalabels" data:realIndex="2"></g>
                                                                </g>
                                                                <line id="SvgjsLine1515" x1="-18.124386062120138" y1="0" x2="694.3422858815444" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line>
                                                                <line id="SvgjsLine1516" x1="-18.124386062120138" y1="0" x2="694.3422858815444" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                                                                <g id="SvgjsG1517" class="apexcharts-yaxis-annotations"></g>
                                                                <g id="SvgjsG1518" class="apexcharts-xaxis-annotations"></g>
                                                                <g id="SvgjsG1519" class="apexcharts-point-annotations"></g>
                                                                <rect id="SvgjsRect1522" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-zoom-rect"></rect>
                                                                <rect id="SvgjsRect1523" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-selection-rect"></rect>
                                                            </g>
                                                            <rect id="SvgjsRect1403" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
                                                            <g id="SvgjsG1481" class="apexcharts-yaxis" rel="0" transform="translate(20.53332805633545, 0)">
                                                                <g id="SvgjsG1482" class="apexcharts-yaxis-texts-g"><text id="SvgjsText1483" font-family="Helvetica, Arial, sans-serif" x="20" y="31.4" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                        <tspan id="SvgjsTspan1484">80</tspan>
                                                                    </text><text id="SvgjsText1485" font-family="Helvetica, Arial, sans-serif" x="20" y="96.31999988555908" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                        <tspan id="SvgjsTspan1486">60</tspan>
                                                                    </text><text id="SvgjsText1487" font-family="Helvetica, Arial, sans-serif" x="20" y="161.23999977111816" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                        <tspan id="SvgjsTspan1488">40</tspan>
                                                                    </text><text id="SvgjsText1489" font-family="Helvetica, Arial, sans-serif" x="20" y="226.15999965667723" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                        <tspan id="SvgjsTspan1490">20</tspan>
                                                                    </text><text id="SvgjsText1491" font-family="Helvetica, Arial, sans-serif" x="20" y="291.0799995422363" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                        <tspan id="SvgjsTspan1492">0</tspan>
                                                                    </text></g>
                                                                <g id="SvgjsG1493" class="apexcharts-yaxis-title"><text id="SvgjsText1494" font-family="Helvetica, Arial, sans-serif" x="5.908332824707031" y="159.83999977111816" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="900" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-title-text " style="font-family: Helvetica, Arial, sans-serif;" transform="rotate(-90 -9.291667938232422 156.239990234375)">Points</text></g>
                                                            </g>
                                                            <g id="SvgjsG1398" class="apexcharts-annotations"></g>
                                                        </svg>
                                                        <div class="apexcharts-tooltip apexcharts-theme-light" style="left: 378.431px; top: 107.35px;">
                                                            <div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">31 Jul</div>
                                                            <div class="apexcharts-tooltip-series-group apexcharts-active" style="order: 1; display: flex;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(91, 115, 232);"></span>
                                                                <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                                    <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label">Desktops: </span><span class="apexcharts-tooltip-text-value">21 points</span></div>
                                                                    <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                                                </div>
                                                            </div>
                                                            <div class="apexcharts-tooltip-series-group apexcharts-active" style="order: 2; display: flex;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(223, 226, 230);"></span>
                                                                <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                                    <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label">Laptops: </span><span class="apexcharts-tooltip-text-value">41 points</span></div>
                                                                    <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                                                </div>
                                                            </div>
                                                            <div class="apexcharts-tooltip-series-group apexcharts-active" style="order: 3; display: flex;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(241, 180, 76);"></span>
                                                                <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                                    <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label">Tablets: </span><span class="apexcharts-tooltip-text-value">52 points</span></div>
                                                                    <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light" style="left: 513.706px; top: 291.68px;">
                                                            <div class="apexcharts-xaxistooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; min-width: 38.45px;">31 Jul</div>
                                                        </div>
                                                        <div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                                            <div class="apexcharts-yaxistooltip-text"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="resize-triggers">
                                                    <div class="expand-trigger">
                                                        <div style="width: 774px; height: 340px;"></div>
                                                    </div>
                                                    <div class="contract-trigger"></div>
                                                </div>
                                            </div>
                                        </div> <!-- end card-body-->
                                    </div> <!-- end card-->
                                </div> <!-- end col-->

                                <div class="col-xl-4">
                                    <div class="card bg-primary">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-sm-8">
                                                    <p class="text-white font-size-18">Click Button to update Student Passwords <i class="mdi mdi-arrow-right"></i></p>
                                                    <div class="mt-4">
                                                        <button class="btn btn-success " type="button" id="update-password">Update Now</button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="mt-4 mt-sm-0">
                                                        <img src="assets/images/setup-analytics-amico.svg" class="img-fluid" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end card-body-->
                                    </div> <!-- end card-->

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="float-end">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle text-reset" href="#" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="fw-semibold">Sort By:</span> <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                                        <a class="dropdown-item" href="#">Monthly</a>
                                                        <a class="dropdown-item" href="#">Yearly</a>
                                                        <a class="dropdown-item" href="#">Weekly</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="card-title mb-4">Top Selling Products</h4>


                                            <div class="row align-items-center g-0 mt-3">
                                                <div class="col-sm-3">
                                                    <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-primary me-2"></i> Desktops </p>
                                                </div>

                                                <div class="col-sm-9">
                                                    <div class="progress mt-1" style="height: 6px;">
                                                        <div class="progress-bar progress-bar bg-primary" role="progressbar" style="width: 52%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->

                                            <div class="row align-items-center g-0 mt-3">
                                                <div class="col-sm-3">
                                                    <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-info me-2"></i> iPhones </p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="progress mt-1" style="height: 6px;">
                                                        <div class="progress-bar progress-bar bg-info" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="45">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->

                                            <div class="row align-items-center g-0 mt-3">
                                                <div class="col-sm-3">
                                                    <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-success me-2"></i> Android </p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="progress mt-1" style="height: 6px;">
                                                        <div class="progress-bar progress-bar bg-success" role="progressbar" style="width: 48%" aria-valuenow="48" aria-valuemin="0" aria-valuemax="48">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->

                                            <div class="row align-items-center g-0 mt-3">
                                                <div class="col-sm-3">
                                                    <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-warning me-2"></i> Tablets </p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="progress mt-1" style="height: 6px;">
                                                        <div class="progress-bar progress-bar bg-warning" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->

                                            <div class="row align-items-center g-0 mt-3">
                                                <div class="col-sm-3">
                                                    <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-purple me-2"></i> Cables </p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="progress mt-1" style="height: 6px;">
                                                        <div class="progress-bar progress-bar bg-purple" role="progressbar" style="width: 63%" aria-valuenow="63" aria-valuemin="0" aria-valuemax="63">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->

                                        </div> <!-- end card-body-->
                                    </div> <!-- end card-->
                                </div> <!-- end Col -->
                            </div>

                        </div>
                    </div>
                </div>
                
                 <?php
            } else 
                if ($_SESSION['type'] == 3) {
            ?>
            
              <!-- Center Dashboard  -->
              
                <div class="page-content">
                    <div class="container-fluid"> 
                        <div class="row">
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="total-revenue-chart"></div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1">+<span data-plugin="counterup"><?= number_format($all_center_application_count_this_year, 0, 2) ?></span></h4>
                                            <p class="text-muted mb-0">Total Applications</p>
                                        </div>
                                        <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i>
                                        <?php 
                                            $year = date("Y/m/d");
                                            echo $year; 
                                        ?>
                                        </span>  since this year
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="orders-chart"> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1">+<span data-plugin="counterup">
                                                <?= number_format($all_center_student_count_this_year, 0, 2) ?>
                                                </span></h4>
                                            <p class="text-muted mb-0">Total Students</p>
                                        </div>
                                        <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="mdi mdi-arrow-down-bold me-1"></i> 
                                        <?php 
                                            $year = date("Y/m/d");
                                            echo $year; 
                                        ?></span> since this year
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="customers-chart"> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1">+<span data-plugin="counterup">    <?= number_format($all_center_student_count_nvq_this_year, 0, 2) ?> </span></h4>
                                            <p class="text-muted mb-0"> Nvq Student</p>
                                        </div>
                                        <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="mdi mdi-arrow-down-bold me-1"></i> 
                                        <?php 
                                            $year = date("Y/m/d");
                                            echo $year; 
                                        ?></span> since this year
                                        </p>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">

                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="growth-chart"></div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1">+ <span data-plugin="counterup">     <?= number_format($all_center_student_count_non_nvq_this_year, 0, 2) ?> </span></h4>
                                            <p class="text-muted mb-0">Non Nvq Students</p>
                                        </div>
                                        <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i> <?php 
                                            $year = date("Y/m/d");
                                            echo $year; 
                                        ?></span> since this year
                                        </p>
                                    </div>
                                </div>
                            </div> <!-- end col-->
 
                                    

                            <div class="row">
                                <div class="col-xl-12">
                                        
                                    <div class="table-responsive mb-4">

                                        <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">

                                          

                                        </table>

                                    </div>

                                </div>

                            </div>
                            
                                
                            </div>

                        </div>
                    </div>
                </div>
                
                 <?php
            } else if ($_SESSION['type'] == 6) {
            ?>
                
                    <div class="container-fluid">
                     
                        <!-- end page title -->
                        <div class="row">
                             



                              

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

                        </div>
                     
                 
                 
                
                
            <?php
            }
            if ($_SESSION['type'] == 3) {
            ?>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">ප්‍රධාන කර්‍යාලයේ විශේෂ දැනුවත් කිරිම්..!</h5>
                                <button type="button" class="btn-close" id="closeButton" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php
                                $SEND_MESSAGE = new SendMessage(NULL);
                                foreach ($SEND_MESSAGE->all() as $send_message) {
                                ?>
                                    <?php echo $send_message['message'] ?>
                                <?php } ?>
                            </div>

                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->

                </div>
            <?php } ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->





    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $(window).on('load', function() {
                $('#exampleModalCenter').modal('show');

            });
            $('#closeButton').on('click', function() {
                $('#exampleModalCenter').modal('hide');
            });
        });
    </script>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    
        <script src="ajax/js/student-password.js" type="text/javascript"></script>


    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>

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
    <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <!-- Datatable init js -->
    <script src="assets/js/pages/datatables.init.js"></script>
    /////////////////////////
    <script src="ajax/js/applications.js" type="text/javascript"></script>
    <script src="ajax/js/dashboard.js" type="text/javascript"></script>
    
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
    <!--<script src="ajax/js/get-live-count.js" type="text/javascript"></script>-->

    <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <!-- ckeditor -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.2.2/tinymce.min.js"></script>
    <script src="ajax/js/submit-document.js" type="text/javascript"></script>
    
    
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

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2647948117551772"
     crossorigin="anonymous"></script>


</body>

</html>