<?php
include '../class/include.php';
include './auth.php';

$id ='';
$id = $_GET['id'];

$DIVISION = new Divisions($id);
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
                                    <h4 class="mb-0">Positions  - " <?php echo $DIVISION->name ?> "</h4>
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
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Add User with Positions </h4>
                                        <form id="form-data">
                                            
                                            <div class="mb-3 row">
                                                <label for="example-search-input" class="col-md-2 col-form-label">Position</label>
                                                <div class="col-md-10">
                                                    <select class="form-control" name="position" id="position">
                                                        <option value="">-- Select Position -- </option>
                                                        <?php
                                                        $POSITIONS = new Positions(NULL);
                                                        foreach ($POSITIONS->all() as $positions) {
                                                            ?>
                                                            <option value="<?php echo $positions['id'] ?>"><?php echo $positions['name'] ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Full Name</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" id="name" name="name" placeholder="Enter full name">
                                                </div>
                                            </div>
                                            

                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Email</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" id="email" name="email" placeholder="Enter Email address">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Phone Number</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" id="phone_number" name="phone_number" placeholder="Enter the Phone number">
                                                </div>
                                            </div>
 
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Duration Start Date</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" id="start_date" name="start_date" placeholder="Enter the duration start date">
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-12" style="display: flex; justify-content: flex-end;margin-top: 15px;">
                                                    <button class="btn btn-primary " type="submit" id="create_position">Create</button>

                                                </div>
                                                <input type="hidden" name="create_position">
                                                <input type="hidden" name="division_id" value="<?php echo $id ?>">

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

                                        <h4 class="card-title">Manage Division Positions</h4>


                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Position</th>
                                                    <th>Email</th>
                                                    <th>Phone Number</th>
                                                     <th>Duration</th>
                                                    <th>Status</th>
                                                    <th>Options</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php
                                                $DIVISION_POSITIONS = new DivisionPositions(NULL);
                                                foreach ($DIVISION_POSITIONS->getPositionByDivisionByStatus($id) as $key=>$division_position) {
                                                    $POSITIONS  = new Positions($division_position['position_id']);
                                                    $key++;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $key ?></td>
                                                        <td><?php echo  $division_position['name'] ?></td>
                                                        <td><?php echo $POSITIONS->name ?></td>
                                                        <td><?php echo $division_position['email'] ?></td>
                                                        <td><?php echo $division_position['phone_number'] ?></td>
                                                        <td><?php echo $division_position['start_date'].' - ' .$division_position['end_time'] ?></td>
                                                        <?php if ($division_position['status'] == 0) { ?>
                                                            <td><span class="badge rounded-pill bg-success float-end">Active</span> </td>
                                                        <?php } else { ?>
                                                            <td><span class="badge rounded-pill bg-danger float-end">InActive</span> </td>

                                                        <?php } ?>
                                                        <td>
                                                            <a href="edit-division-positions.php?id=<?php echo $division_position['id'] ?>">
                                                                <div class="badge bg-pill bg-soft-success font-size-14" type="button"><i class="fas fa-pencil-alt p-1"></i></div>
                                                            </a>  
                                                            <?php
                                                            if ($division_position['status'] == 0){
                                                            ?>
                                                            |
                                                            <a href="#">
                                                                <div data-id="<?php echo $division_position['id'] ?>" class="badge hold_position bg-pill bg-soft-danger font-size-14" type="button"><i class=" bx bx-user-x  p-1"></i></div>
                                                            </a> 
                                                            <?php }?>
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
  $( function() {
    $( "#start_date" ).datepicker();
  } );
  </script>
        ///////////////////////////////////////
        <script src="ajax/js/positions.js" type="text/javascript"></script>
        <script src="ajax/js/position-by-division.js" type="text/javascript"></script>

            <script>
            $("document").ready(function () {

                $("#position").change(function () {
                    var position = $(this).val();
                    
                    //director training
                    if(position == '4'){
                        $('#name').val('Rashitha Delpola');
                        $('#email').val('emailaddress@gmail.com');
                        $('#phone_number').val('000 000 0000');
                    }else if(position == '5'){
                        //director admin
                        $('#name').val('director admin');
                        $('#email').val('emailaddress@gmail.com');
                        $('#phone_number').val('000 000 0000');
                    }else if(position == '6'){
                        //director finance
                        $('#name').val('Director Finance');
                        $('#email').val('emailaddress@gmail.com');
                        $('#phone_number').val('000 000 0000');
                    }else if(position == '7'){
                        //director development
                        $('#name').val('Director Development');
                        $('#email').val('emailaddress@gmail.com');
                        $('#phone_number').val('000 000 0000');
                    }else if(position == '8'){
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