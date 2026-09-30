<?php
include '../class/include.php';
include './auth.php';
?>
<!doctype html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <title>Create Users | Sri Lanka Youth Services</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="NYSC" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- DataTables -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/preloader.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <link href="plugin/sweetalert/sweetalert.css" id="app-style" rel="stylesheet" type="text/css" />

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
                                    <h4 class="mb-0">Users</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                                            <li class="breadcrumb-item active">Manage Users</li>
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

                                        <h4 class="card-title">Add User</h4>
                                        <form id="form-data">
                                            <div class="mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Full Name</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" id="name" name="name" placeholder="Enter full name">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">User Name</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="url" id="username" name="username" placeholder="Enter username">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="example-search-input" class="col-md-2 col-form-label">User Type</label>
                                                <div class="col-md-10">
                                                    <select class="form-control" name="type" id="type">
                                                        <option value="">-- Select User type -- </option>
                                                        <?php
                                                        $USER_TYPE = new UserType(NULL);
                                                        foreach ($USER_TYPE->all() as $user_type) {
                                                            ?>
                                                            <option value="<?php echo $user_type['id'] ?>"><?php echo $user_type['name'] ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3 row hidden" id="fedaration_name_section">
                                                <label for="example-search-input" class="col-md-2 col-form-label">Fedaration Name</label>
                                                <div class="col-md-10">
                                                    <select class="form-control" name="fedaration_name" id="fedaration_name">
                                                        <option value="">-- Select Fedaration -- </option>
                                                        <?php
                                                        $FEDARATION = new Fedaration(NULL);
                                                        foreach ($FEDARATION->all() as $fedaration) {
                                                            ?>
                                                            <option value="<?php echo $fedaration['id'] ?>"><?php echo $fedaration['name'] ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Email</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" id="email" name="email">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Phone</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" id="phone" name="phone">
                                                </div>
                                            </div>


                                            <div class="mb-3 row">
                                                <label for="example-url-input" class="col-md-2 col-form-label">Password</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="password" id="password" name="password">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12" style="display: flex; justify-content: flex-end;margin-top: 15px;">
                                                    <button class="btn btn-primary " type="submit" id="create">Create</button>

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

                                        <h4 class="card-title">Manage Users</h4>


                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Type</th>
                                                    <th>Email</th>
                                                    <th>Username</th>
                                                    <th>Options</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php
                                                $USER = new user(NULL);
                                                foreach ($USER->all() as $user) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $user['name'] ?></td>
                                                        <?php
                                                        $USER_TYPE = new UserType($user['type'])
                                                        ?>
                                                        <td><?php echo $USER_TYPE->name ?></td>
                                                        <td><?php echo $user['email'] ?></td>
                                                        <td><?php echo $user['username'] ?></td>
                                                        <td>
                                                            <a href="edit-user.php?id=<?php echo $user['id'] ?>">
                                                                <div class="badge bg-pill bg-soft-success font-size-14" type="button"><i class="fas fa-pencil-alt p-1"></i></div>
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
                <!-- End Page-content -->


                <?php include './footer.php'; ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->



        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script type="text/javascript" src="assets/libs/jquery/jquery-2.2.4.min.js"></script>
        <script src="ajax/js/user.js" type="text/javascript"></script>

        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
        <script src="plugin/sweetalert/sweetalert.min.js"></script>

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
        <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>
        <!-- Datatable init js -->
        <script src="assets/js/pages/datatables.init.js"></script>


        <!-- App js -->
        <script src="assets/js/app.js"></script>


    </body>

</html>