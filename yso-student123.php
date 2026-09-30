<?php
include './class/include.php';
?>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Register | Sri Lanka Youth </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content=" " name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="student/assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="student/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="student/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="admin-panel/plugin/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />

        <link href="student/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <link href="admin-panel/assets/css/preloader.css" rel="stylesheet" type="text/css" />
    </head>

    <body class="authentication-bg someBlock">
        <div class="account-pages my-5 ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <div class="text-center">
                            <a href="#" class="mb-2 d-block auth-logo">
                                <img src="student/assets/images/logo-dark.png" alt="" width="100%" class="logo logo-dark">
                                <img src="student/assets/images/logo-light.png" alt="" width="100%" class="logo logo-light">
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
                                    <h5 class="text-primary">Youth Registration Form</h5>
                                    <p class="text-muted">Fill Nominiee's Personal Details and submit now.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form id="form-data" autocomplete="off">


                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="userpassword"> Province <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="province_id" id="province_id">
                                                        <option> -- Province -- </option>
                                                        <?php
                                                        $PROVINCE = new Province(NULL);
                                                        foreach ($PROVINCE->all() as $province) {
                                                            ?>
                                                            <option value="<?php echo $province['id'] ?>"> <?php echo $province['name'] ?> </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="userpassword"> District <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="district_id" name="district_id">
                                                        <option> --  District -- </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="userpassword">Divisional Secretariat <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="divisional_id" name="divisional_id">
                                                        <option> --  Division Secretariat -- </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="userpassword">GN Division <span class="text-danger">*</span>  </label>
                                                    <select class="form-control" name="gn_id" id="gn_id">
                                                        <option> -- GN Division -- </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <h5><b> Nomination 01 </b></h5>

                                        <hr>


                                        <div class="mb-3">
                                            <label class="form-label" for="useremail"> Name with Initials <span class="text-danger"> ( Ex: K.G. Saman Kumara Hewage ) *</span></label>
                                            <input type="text" class="form-control" id="full_name_1" name="full_name_1" placeholder="Enter name with initials ">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="username">Address <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="username">National Id Number <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="nic" name="nic" placeholder="Enter national id number ">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="username">Mobile Number <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control phone_number" id="mobile_number" name="mobile_number" placeholder="Enter your mobile number">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="username"> Whatsapp Number </label>
                                                    <input type="text" class="form-control phone_number" id="whatsapp_number" name="whatsapp_number" placeholder="Enter your whatsapp number">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="username">Date Of Birth</label>
                                                    <input type="text" class="form-control" id="birth_date" name="birth_date"    placeholder="Date of birth ">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="username">Email Address </label>
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter your emaill address">
                                                </div>
                                            </div>
                                        </div>


                                        <hr>
                                        <h5><b> Nomination 02 </b></h5>
                                        <hr>
                                        <div class="mb-3">
                                            <label class="form-label" for="useremail"> Name with Initials <span class="text-danger"> ( Ex: K.G. Saman Kumara Hewage ) *</span></label>
                                            <input type="text" class="form-control" id="full_name_2" name="full_name_2" placeholder="Enter your name with initials ">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="username">Address <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="address" name="address_2" placeholder="Enter your address">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="username">National Id Number <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="nic_2" name="nic_2" placeholder="Enter your national id number ">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="username">Mobile Number <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control phone_number" id="mobile_number_2" name="mobile_number_2" placeholder="Enter your mobile number">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="username"> Whatsapp Number </label>
                                                    <input type="text" class="form-control phone_number" id="whatsapp_number" name="whatsapp_number_2" placeholder="Enter your whatsapp number">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="username">Date Of Birth</label>
                                                    <input type="text" class="form-control" id="birth_date" name="birth_date_2"    placeholder="Date of birth ">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="username">Email Address </label>
                                                    <input type="text" class="form-control" id="email" name="email_2" placeholder="Enter your emaill address">
                                                </div>
                                            </div>
                                        </div>
 



                                        <div class="mt-3 text-end">
                                            <button class="btn btn-primary w-sm waves-effect waves-light" type="submit" id="create" >Register</button>

                                            <input type="hidden" name="create">
                                        </div>


                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <p>© <script>
                                document.write(new Date().getFullYear())
                                </script> Development <i class="mdi mdi-heart text-danger"></i> by Sri Lanka Youth. </p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>

        <!-- JAVASCRIPT -->
        <script src="student/assets/libs/jquery/jquery.min.js"></script>
        <script src="student/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="student/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="student/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="student/assets/libs/node-waves/waves.min.js"></script>
        <script src="student/assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="student/assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
        <script src="admin-panel/assets/js/jquery.preloader.min.js" type="text/javascript"></script>
        <script src="admin-panel/assets/libs/sweetalert2/sweetalert2.min.js" type="text/javascript"></script>
        <script src="admin-panel/plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>

        <script src="ajax/js/youth-member.js" type="text/javascript"></script>
        <script src="ajax/js/get-district.js" type="text/javascript"></script>
        <script src="ajax/js/get-ds.js" type="text/javascript"></script>
        <script src="ajax/js/get-gn.js" type="text/javascript"></script>
        <!-- App js -->
        <script src="student/assets/js/app.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js">
        </script>
        
         

    </body>

</html>