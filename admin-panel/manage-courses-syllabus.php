<?php
include '../class/include.php';
include './auth.php';

$id = '';
$id = $_GET['id'];

$COURSE = new Course($id);

?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Manage Course Syllabus | Youth Service LTD </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
<!-- plugin css -->
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
                <link href="assets/css/preloader.css" rel="stylesheet" type="text/css" />
        <style>
            .assign-student-section .select2 {
                width: 100% !important;
            }
        </style>

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
                                        <li class="breadcrumb-item active">Manage Syllabus</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    
                         <?php

               
                if ($_SESSION['type'] == 1) {
?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Attach Syllabus - "<?php echo $COURSE->courseid ." - ".$COURSE->cname?>"</h4>
                                   <form id="form-data">
                                       
                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-form-label">  Title </label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" id="title" name="title" placeholder="Enter syllabus title">
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-form-label">Attach Course Syllabus </label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="file" id="syllabus" name="syllabus" >
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12" style="display: flex; justify-content: flex-end;margin-top: 15px;">
                                                <button class="btn btn-primary " type="submit"  id="create">Create</button>
                                                <input type="hidden" name="create">
                                                <input type="hidden" name="course_id" value="<?php echo $id ?>">

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
<?php } ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Manage Divisions </h4>

                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>#id</th>
                                                <th> Title </th>
                                                <th>Syllabus URL</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>


                                      <tbody>
    <?php
    $COURSESYLLABUS = new CourseSyllabus(NULL);
    $syllabusList = $COURSESYLLABUS->getByCourseId($id);

    if (!empty($syllabusList)) {
        foreach ($syllabusList as $key => $syllabus) {
            $key++;
    ?>
            <tr id="div<?php echo $syllabus['id'] ?>">
                <td><?php echo $key ?></td>
                <td><?php echo $syllabus['title'] ?></td>
                <td>
                    <a href="../nc_assets/uploads/syllabus/<?php echo $syllabus['syllabus']; ?>" target="_blank">
                      Downloard Syllabus Click This  
                    </a>
                </td>
                
                         <?php

               
                if ($_SESSION['type'] == 1) {
?>
                <td>
                    <div data-id="<?php echo $syllabus['id']; ?>" class="course_syllabus">
                        <div class="badge bg-pill bg-soft-danger font-size-14">
                            <i class="fas fa-trash p-1"></i>
                        </div>
                    </div>
                </td>
                <?php } ?>
                
            </tr>
    <?php
        }
    } else {
    ?>
        <tr>
            <td colspan="4" class="text-center">No syllabus in this course.</td>
        </tr>
    <?php
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
    


           <script src="assets/libs/jquery/jquery.min.js"></script>
           <script src="ajax/js/course-syllabus.js" type="text/javascript"></script>
           <script src="delete/js/course-syllabus.js" type="text/javascript"></script>


        <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>


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
         <script src="assets/libs/@chenfengyuan/datepicker/datepicker.min.js"></script>

        <!-- init js -->
        <script src="assets/js/pages/form-advanced.init.js"></script>
              <script src="assets/libs/jquery/jquery.min.js"></script>
        <!-- App js -->
        <script src="assets/js/app.js"></script>
    

</body>

</html>