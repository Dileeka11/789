<?php
include './class/include.php';
?>
<html lang="en">

    <head>


        <meta charset="utf-8" />
        <title>Instructor | Youth Service LTD </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="admin-panel/assets/images/favicon.ico">

        <!-- DataTables -->
        <link href="admin-panel/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="admin-panel/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <link href="admin-panel/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="admin-panel/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="admin-panel/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="admin-panel/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="admin-panel/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <link href="admin-panel/plugin/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
        <link href="admin-panel/assets/css/preloader.css" rel="stylesheet" type="text/css" />


    </head>

    <body class="authentication-bg someBlock">
        <div class="account-pages  "  >
            <div class="container">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <div class="text-center">
                            <a href="#" class="mb-2 d-block auth-logo">
                                <img src="student/assets/images/logo-dark.png" alt=""  width="100%" class="logo logo-dark">
                                <img src="student/assets/images/logo-light.png" alt=""  width="100%" class="logo logo-light">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>

                </div>
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-8 col-lg-8 col-xl-8">
                        <div class="card">

                            <div class="card-body p-4"> 

                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Instructor Registration Form</h5>
                                    <p class="text-muted">Fill your Personal Details and submit now.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form id="form-data">

                                        <div class="mb-3">
                                            <label class="form-label" for="useremail"> Name with Intials <span class="text-danger"> ( Ex: K.G. Saman Kumara Hewage ) *</span></label>
                                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter your name with initials ">        
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="username">Mobile Number <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control phone_number" id="mobile_number" name="mobile_number"placeholder="Enter your mobile number">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="username">Email Address  <span class="text-danger">*</span> </label>
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter your emaill address">
                                                </div>
                                            </div>
                                            <!--<div class="col-md-6">-->
                                            <!--    <div class="mb-3">-->
                                            <!--        <label class="form-label" for="userpassword">Select your course Type <span class="text-danger">*</span></label>-->
                                            <!--        <select class="form-control select2 change_details" id="course_type"  >-->
                                            <!--            <option value=""> -- Select your course type -- </option>-->
                                            <!--             
                                            <!--        </select>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <!--<div class="col-md-6">-->
                                            <!--    <div class="mb-3">-->
                                            <!--        <label class="form-label" for="userpassword">Select your course duration <span class="text-danger">*</span></label>-->
                                            <!--        <select class="form-control select2 change_details" id="duration"  >-->
                                            <!--            <option value=""> -- Select your course duration -- </option>-->
                                            <!--            
                                            <!--        </select>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="userpassword">Please Select your Courses <span class="text-danger">*</span></label>
                                                    <select class="form-control select2" name="courses[]" id="course-bar"  multiple="multiple">
                                                        <option value=""> -- Select your Course -- </option>
<?php
                                            $COURSE = new Course(NULL);
                                            foreach ($COURSE->all() as $key => $course) {
                                                
                                                     if ($course['fullpart'] == 1) {
                                                            $type= '<span class="text-warning"> Full Time </span>';
                                                        } else if($course['fullpart'] == 2) {
                                                            $type= '<span class="text-info">  Part Time </span>';
                                                        }else{
                                                            $type= '<span class="text-info">  Short Time </span>';
                                                        }
                                                        
                                                         if ($course['level'] == 0) {
                                                            $Level= '<span class="text-warning"> Non Nvq </span>';
                                                        } else if($course['level'] == 3) {
                                                            $Level= '<span class="text-info"> Level 3 </span>';
                                                        }else{
                                                            $Level= '<span class="text-info">  Level 4 </span>';
                                                        }
                                                        
                                                        
                                                ?>
                                                <option value="<?php echo $course['courseid'] ?>"> <?php echo $course['courseid']. ' - ' .$course['cname']. ' / '.$Level. ' / '.$type    ?></option>
                                                <?php }?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="userpassword">Select your Center <span class="text-danger">*</span></label>
                                                    <select class="form-control select2" id="center_id" name="center_id">
                                                        <option value=""> -- Select your Center -- </option>
                                                        <?php
                                                        $CENTER = new Centers(NULL);
                                                        foreach ($CENTER->all() as $center) {
                                                            ?>
                                                            <option value="<?php echo $center['centercode'] ?>"> <?php echo $center['center_name'] ?> </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <div class="mb-3">
                                                    <label class="form-label" for="username">Password <span class="text-danger">* Pleasee remember your enter password.</span></label>
                                                    <input type="password" class="form-control phone_number" id="password" name="password"   placeholder="Enter your Password">
                                                </div>
                                            </div>
                                        </div>





                                        <div class="mt-3 text-end">
                                            <button class="btn btn-primary w-sm waves-effect waves-light" type="submit" id="instructor">Register Now</button>

                                            <input type="hidden" name="create_instructor">
                                        </div>


                                    </form>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>

        <!-- JAVASCRIPT -->
        <script src="admin-panel/assets/libs/jquery/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="admin-panel/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="admin-panel/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="admin-panel/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="admin-panel/assets/libs/node-waves/waves.min.js"></script>
        <script src="admin-panel/assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="admin-panel/assets/libs/jquery.counterup/jquery.counterup.min.js"></script>

        <script src="admin-panel/assets/libs/select2/js/select2.min.js"></script>
        <!-- Required datatable js -->
        <script src="admin-panel/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="admin-panel/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="admin-panel/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="admin-panel/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="admin-panel/assets/libs/jszip/jszip.min.js"></script>
        <script src="admin-panel/assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="admin-panel/assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="admin-panel/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="admin-panel/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="admin-panel/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

        <!-- Responsive examples -->
        <script src="admin-panel/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="admin-panel/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <script src="admin-panel/plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <!-- Datatable init js -->
        <script src="admin-panel/assets/js/pages/datatables.init.js"></script>
       
        <script src="ajax/js/applications.js" type="text/javascript"></script>
        <script src="ajax/js/get-course.js" type="text/javascript"></script>


        <script src="admin-panel/assets/js/jquery.preloader.min.js" type="text/javascript"></script>
        <!-- init js -->
        <script src="admin-panel/assets/js/pages/form-advanced.init.js"></script>
        <!-- App js -->
        <script src="admin-panel/assets/js/app.js"></script>


    </body>
</html>
