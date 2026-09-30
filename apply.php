<!DOCTYPE html>
<?php
include './class/include.php';
 
$encoded = $_GET['data'] ?? '';
$decoded = base64_decode($encoded);
parse_str(str_replace('%', '&', $decoded), $params);

$center = $params['center'] ?? 'false';
$course = $params['course'] ?? '0';

$finalUrl = "https://nysc.lk/";
if ($params['q'] == 'toapply') {
    $finalUrl .= "courses/apply/" . base64_encode("q=toapply%center=" . $center . "%course=" . $course);
} else {
    $finalUrl .= "centers/list/" . base64_encode("q=fromcourse%center=" . $center . "%course=" . $course);
}
?>
<html lang="en">


<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <!-- ========== Page Title ========== -->
    <title>NYSC EXAM </title>

    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

    <!-- ========== Start Stylesheet ========== -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/css/flaticon-set.css" rel="stylesheet" />
    <link href="assets/css/elegant-icons.css" rel="stylesheet" />
    <link href="assets/css/magnific-popup.css" rel="stylesheet" />
    <link href="assets/css/owl.carousel.min.css" rel="stylesheet" />
    <link href="assets/css/owl.theme.default.min.css" rel="stylesheet" />
    <link href="assets/css/animate.css" rel="stylesheet" />
    <link href="assets/css/bootsnav.css" rel="stylesheet" />
    <link href="style.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet" />
    <!-- ========== End Stylesheet ========== -->



    <!-- ========== Google Fonts ========== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800" rel="stylesheet">
    
    <style>
    .btn-primary {
        background-color: #0066cc;
        border-color: #005cbf;
        transition: 0.3s ease-in-out;
    }
    .btn-primary:hover {
        background-color: #004c99;
        border-color: #004080;
    }
</style>


</head>

<body>

    <!-- Preloader Start -->
    <div class="se-pre-con"></div>
    <!-- Preloader Ends -->

    <!-- Start Header Top 
        ============================================= -->
    <?php include './header.php'; ?>
    <!-- End Header -->

     

    <!-- Start Event
        ============================================= -->
   <section id="event" class="event-area bg-gray single-view default-padding">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h2 class="mb-4">Click here to Apply for the Course</h2>
                <a href="<?php echo $finalUrl; ?>" class="btn btn-primary btn-lg px-5 py-3 shadow-sm">
                    <i class="fas fa-paper-plane mr-2"></i> Continue to Apply
                </a>
            </div>
        </div>
    </div>
</section>

    <!-- End Event -->

    <!-- Start Footer 
        ============================================= -->
    <?php include './footer.php'; ?>
    <!-- End Footer -->

    <!-- jQuery Frameworks
        ============================================= -->
    <script src="assets/js/jquery-1.12.4.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/equal-height.min.js"></script>
    <script src="assets/js/jquery.appear.js"></script>
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/modernizr.custom.13711.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/count-to.js"></script>
    <script src="assets/js/loopcounter.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <script src="assets/js/bootsnav.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>