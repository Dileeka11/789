<?php
                                                      
include './class/include.php';

$REQUEST_OPEN_CLOSE = new RequestOpenClose(1);

if($REQUEST_OPEN_CLOSE->status != 1){
  redirect('close.php');  
}
                                                            
$request_id = $_GET['id'];
// $request_id = 10;
$COURSE_REQUEST = new CourseRequest($request_id);
$COURSE = new Course($COURSE_REQUEST->course_id);
$CENTER = new Centers($COURSE_REQUEST->center_id);
?>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Register | Sri Lanka Youth </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Register for courses designed specifically for youth in Sri Lanka. Our student course registration form simplifies the process, ensuring you can easily sign up for educational opportunities and skill development programs. Start your journey to success today " name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.png">

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
                                <h5 class="text-primary">Student Registration Form</h5>
                                <p class="text-muted">Fill your Personal Details and submit now.</p>
                            </div>
                            <div class="p-2 mt-4">
                                <form id="form-data">
                                    <h5><b>Course Details</b></h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="">Course Name</label>
                                                <input type="text" class="form-control" id="" name="" disabled value="<?= $COURSE->cname ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="">Center</label>
                                                <input type="text" class="form-control" id="" name="" disabled value="<?= $CENTER->center_name ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="">Year</label>
                                                <input type="text" class="form-control" disabled id="" name="" value="<?= $COURSE_REQUEST->year ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="">Batch </label>
                                                <input type="text" class="form-control" id="" name="" disabled value="<?= $COURSE_REQUEST->batch ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h5><b>Personal Details</b></h5>
                                    <hr>
                                    <div class="mb-3">
                                        <p>ඔබ ඇතුලත් කරන නාමය  සහතික පතෙහි ඒ ආකරයටම සදහන් වන බැවින් ලබා දි ඇති උදාහරණ නාමයට අනුකුලව ඇතුලත් කරන්න. යම් නාමයක් වැරදුනොත් එයට නැවත මුදල් ගේවා සහතිකයක් ලබා ගැනිමට සිදුවේ. </p>
                                        <label class="form-label" for="useremail"> Name with Initials <span class="text-danger"> ( Ex: K.G. Saman Kumara Hewage ) *</span></label>
                                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter your name with initials ">
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
                                                <input type="text" class="form-control" id="nic" name="nic" placeholder="Enter your national id number ">
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
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="userpassword">Select your Province <span class="text-danger">*</span></label>
                                                <select class="form-control" name="province_id" id="province_id">
                                                    <option> -- Select your Province -- </option>
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
                                                <label class="form-label" for="userpassword">Select your District <span class="text-danger">*</span></label>
                                                <select class="form-control" id="district_id" name="district_id">
                                                    <option> -- Select your District -- </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="userpassword">Select your Divisional Secture <span class="text-danger">*</span></label>
                                                <select class="form-control" id="divisional_id" name="divisional_id">
                                                    <option> -- Select your Division Secture -- </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="userpassword">Select your Gn </label>
                                                <select class="form-control" name="gn_id" id="gn_id">
                                                    <option> -- Select your Gn -- </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="userpassword">Select your Education Level <span class="text-danger">*</span></label>
                                                <select class="form-control" name="education_level" id="education_level">
                                                    <option> -- Select your Education Level -- </option>
                                                   <?php
                                                        $DEFUL_DATA = new DefaultData();
                                                        foreach ($DEFUL_DATA->Education() as $key=>$education){
                                                        ?>
                                                        <option value="<?php echo $key ?>"> <?php echo $education ?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="username">Email Address </label>
                                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your emaill address">
                                            </div>
                                        </div>
                                    </div>

                                    <!--                                        <div class="form-check">
                                                                                    <input type="checkbox" class="form-check-input" id="auth-terms-condition-check">
                                                                                    <label class="form-check-label" for="auth-terms-condition-check">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                                                                                </div>-->



                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary w-sm waves-effect waves-light" type="submit" id="create">Register</button>

                                        <input type="hidden" name="course_id" value="<?php echo $COURSE_REQUEST->course_id ?>">
                                        <input type="hidden" name="request_course_id" value="<?php echo $request_id ?>">
                                        <input type="hidden" name="center_id" value="<?php echo $COURSE_REQUEST->center_id ?>">
                                        <input type="hidden" name="gender" id="gen">
                                        <input type="hidden" name="birth_date" id="birth_date">
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

    <script src="ajax/js/applications.js" type="text/javascript"></script>
    <script src="ajax/js/get-district.js" type="text/javascript"></script>
    <script src="ajax/js/get-ds.js" type="text/javascript"></script>
    <script src="ajax/js/get-gn.js" type="text/javascript"></script>
    <!-- App js -->
    <script src="student/assets/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js">
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".phone_number").mask("9999999999");
            $(".date").mask("99/99/9999");

        });
    </script>
    <script>
        $(document).ready(function() {

            $("#nic").focusout(function() {
                //Clear Existing Details
                $("#error").html("");
                $("#gender").html("");
                $("#year").html("");
                $("#month").html("");
                $("#day").html("");
                var NICNo = $("#nic").val();
                var dayText = 0;
                var year = "";
                var month = "";
                var day = "";
                var gender = "";
                if (NICNo.length != 10 && NICNo.length != 12) {
                    swal({
                        title: "Error!",
                        text: "Invalid NIC Number Please Check again..",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else if (NICNo.length == 10 && !$.isNumeric(NICNo.substr(0, 9))) {
                    alert("Invalid NIC No.");
                    $("#nic").focus();

                } else {
                    // Year
                    if (NICNo.length == 10) {
                        year = "19" + NICNo.substr(0, 2);
                        dayText = parseInt(NICNo.substr(2, 3));
                    } else {
                        year = NICNo.substr(0, 4);
                        dayText = parseInt(NICNo.substr(4, 3));
                    }

                    // Gender
                    if (dayText > 500) {
                        gender = "Female";
                        dayText = dayText - 500;
                    } else {
                        gender = "Male";
                    }

                    // Day Digit Validation
                    if (dayText < 1 && dayText > 366) {
                        $("#error").html("Invalid NIC No.");
                    } else {

                        //Month
                        if (dayText > 335) {
                            day = dayText - 335;
                            month = "12";
                        } else if (dayText > 305) {
                            day = dayText - 305;
                            month = "11";
                        } else if (dayText > 274) {
                            day = dayText - 274;
                            month = "10";
                        } else if (dayText > 244) {
                            day = dayText - 244;
                            month = "9";
                        } else if (dayText > 213) {
                            day = dayText - 213;
                            month = "8";
                        } else if (dayText > 182) {
                            day = dayText - 182;
                            month = "7";
                        } else if (dayText > 152) {
                            day = dayText - 152;
                            month = "6";
                        } else if (dayText > 121) {
                            day = dayText - 121;
                            month = "5";
                        } else if (dayText > 91) {
                            day = dayText - 91;
                            month = "4";
                        } else if (dayText > 60) {
                            day = dayText - 60;
                            month = "3";
                        } else if (dayText < 32) {
                            month = "1";
                            day = dayText;
                        } else if (dayText > 31) {
                            day = dayText - 31;
                            month = "2";
                        }



                        $("#gen").val(gender);
                        $("#birth_date").val(year + '/' + month + '/' + day);
                    }
                }
            });
        });
    </script>

</body>

</html>