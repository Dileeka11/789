<?php
include '../class/include.php';
$id = '';
$STUDENT = null;
$exam_student = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $STUDENT = new Student($id);
    $exam_student = ExamStudent::getLatestStudentExam($id);
    $COURSE = new Course($STUDENT->course_id);
    $CENTER = new Centers($STUDENT->centercode);
}


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Student Profile - nyscexam.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/logo.png">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Custom Css -->
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css" />
    <style>
        .profile-img {
            width: 150px;
            height: 150px;
            border: 3px solid #ddd;
            border-radius: 50%;
            object-fit: cover;
        }
        .logo-img {
            width: 50%;
            margin: 0 auto;
            display: block;
            transition: transform 0.5s ease-in-out;
        }
        .text-center {
            text-align: center;
        }
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.6); /* Reduced opacity */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            display: none;
        }
        .preloader .spinner-border {
            width: 3rem;
            height: 3rem;
        }
        .slide-logo {
            transform: translateY(-50px) translateX(200px); /* Adjust based on desired position */
        }
        .search-container {
            text-align: right; /* Align to the right */
        }
        .search-container form {
            display: inline-flex;
            align-items: center;
            width: 100%;
            max-width: 400px; /* Adjust width if needed */
            margin: 0;
        }
        .search-container .form-control {
            margin-right: 10px;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Preloader -->
    <div class="preloader" id="preloader">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <!-- Begin page -->
    <div class="container my-5">
        <!-- Profile Card -->
        <div class="card mx-auto" style="max-width: 900px;">
            <div class="card-body">
                <div class="text-center mb-4">
                    <a href="#" class="d-block auth-logo">
                        <img id="logo" src="assets/images/logo-dark.png" alt="Logo" class="logo-img">
                    </a>
                    <h3 class="font-weight-bold  " style="margin-top:20px;">Verification Student Profile</h3>
                </div>

                <!--<div class="search-container mb-4">-->
                <!--    <form method="GET" action="" onsubmit="showPreloaderAndSlideLogo()">-->
                <!--        <input type="text" name="id" class="form-control" placeholder="Enter Student ID" required value="<?= htmlspecialchars($id) ?>">-->
                <!--        <button class="btn btn-primary" type="submit">Search</button>-->
                <!--    </form>-->
                <!--</div>-->

                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="assets/images/user_default.jpg" alt="Profile Picture" class="profile-img mb-3">
                    </div>
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tbody>
                                 <tr>
                                    <th>MIS NO:</th>
                                    <td><?= htmlspecialchars($STUDENT->id) ?></td>
                                </tr>
                                <tr>
                                    <th>Name:</th>
                                    <td><?= htmlspecialchars($STUDENT->fname . ' ' . $STUDENT->lname) ?></td>
                                </tr>
                                <tr>
                                    <th>NIC No:</th>
                                    <td><?= htmlspecialchars($STUDENT->nic) ?></td>
                                </tr>
                                <tr>
                                    <th>Center:</th>
                                    <td><?= htmlspecialchars($CENTER->center_name) ?></td>
                                </tr>
                                <tr>
                                    <th>Course:</th>
                                    <td><?= htmlspecialchars($COURSE->cname) ?></td>
                                </tr>
                                <tr>
                                    <th>Year:</th>
                                    <td><?= htmlspecialchars($STUDENT->year) ?></td>
                                </tr>
                                <tr>
                                    <th>Batch:</th>
                                    <td><?= htmlspecialchars($STUDENT->batch) ?></td>
                                </tr>
                                <tr>
                                    <th>Grade:</th>
                                    <td><?= htmlspecialchars($exam_student['grade'] ?? '-') ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
            
            
            <div class="card mx-auto" style="max-width: 900px;">
            <div class="card-body">
                    <div class="container mt-5">
        <h3 class="text-center">Course  Modules</h3>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
              
                <tr>
                    <th>No.</th>
                    <th>Module Code</th>
                    <th>Module Name</th>
                </tr>
               
            </thead>
            <tbody>
                  <?php
                $CourseModule = new CourseModule(null);
                foreach($CourseModule->getModulesByCourse($STUDENT->course_id) as $key=>$course_module){
                    $key++;
                ?>
                <tr>
                    <td><?php echo $key ?>.</td>
                    <td><?php echo $course_module['code'] ?></td>
                    <td><?php echo $course_module['name'] ?></td>
                </tr>
                  <?php } ?>
            </tbody>
        </table>
    </div>
                    
                </div>

                <div class="text-center mt-4">
                    <p class="mb-0 text-danger"><b>Please note that this is a valid student profile.</b></p>
                    <p class="text-muted mt-1">Copyright @ <?= date('Y') ?> - National Youth Services Council - Sri Lanka</p>
                </div>
            </div>
        </div>
    </div>
    <!-- End page -->

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <script>
        function showPreloaderAndSlideLogo() {
            document.getElementById('preloader').style.display = 'flex';
            document.getElementById('logo').classList.add('slide-logo');
        }
    </script>
</body>

</html>
