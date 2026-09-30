<!DOCTYPE html>
<?php
include './class/include.php';
 
 

?>
<html lang="en">


    <head>
        <!-- ========== Meta Tags ========== -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">

        <!-- ========== Page Title ========== -->
        <title>NYSC.lk - Courses </title>

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

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2647948117551772"
     crossorigin="anonymous"></script>

        <!-- ========== Google Fonts ========== -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800" rel="stylesheet">

    </head>

    <body>

        <!-- Preloader Start -->
        <div class="se-pre-con"></div>
        <!-- Preloader Ends -->

        <!-- Start Header Top 
        ============================================= -->
        <?php include './header.php'; ?>
        <!-- End Header -->

        <!-- Start Breadcrumb 
        ============================================= -->
        <div class="breadcrumb-area shadow dark text-center bg-fixed text-light" style="background-image: url(assets/img/banner/17.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Event</h1>
                        <ul class="breadcrumb">
                            <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                            <li><a href="#">Page</a></li>
                            <li class="active">Event</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <!-- Start Event
        ============================================= -->
        <section id="event" class="event-area bg-gray single-view default-padding">
            <div class="container">
                <div class="row">
                    <div class="event-items">
  
                       
                        <div class="more-btn col-md-12 text-center">
    <a href="#" id="viewAllCoursesBtn" data-offset="10" class="btn btn-dark border btn-md">View All Courses</a>
</div>


                    </div>
                </div>
            </div>
        </section>
        <!-- End Event -->

        <!-- Start Footer 
        ============================================= -->
        <?php include './footer.php';?>
        <!-- End Footer -->

        <!-- jQuery Frameworks
        ============================================= -->
        <script src="assets/js/jquery-1.12.4.min.js"></script>
       
       <script>
$(document).ready(function () {
       $.ajax({
        url: 'load_courses.php',
        type: 'GET',
        data: { offset: 10 },
        success: function (response) {
           if ($.trim(response) === '') {
                    $btn.hide(); // No more results
                } else {
                    $('.event-items .more-btn').before(response); // Insert before "View All" button
                    $btn.data('offset', offset + 10); // Load next batch on next click
                }
            $('#viewAllCoursesBtn').data('offset', 10); // Set next offset
        },
        error: function () {
            alert('Failed to load initial events.');
        }
    });
    
    $('#viewAllCoursesBtn').click(function (e) {
        e.preventDefault();

        let $btn = $(this);
        let offset = parseInt($btn.data('offset'));

        $.ajax({
            url: 'load_courses.php',
            type: 'GET',
            data: { offset: offset },
            success: function (response) {
                if ($.trim(response) === '') {
                    $btn.hide(); // No more results
                } else {
                    $('.event-items .more-btn').before(response); // Insert before "View All" button
                    $btn.data('offset', offset + 10); // Load next batch on next click
                }
            },
            error: function () {
                alert('Failed to load more courses.');
            }
        });
    });
});
</script>

       


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
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2647948117551772"
     crossorigin="anonymous"></script>


    </body>

</html>