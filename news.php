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
        <title>News - </title>

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
        <div class="breadcrumb-area shadow dark text-center bg-fixed text-light" style="background-image: url(assets/img/banner/12.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>News</h1>
                        <ul class="breadcrumb">
                            <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                            <li class="active">News</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <!-- Start Blog
        ============================================= -->
        <div class="blog-area full-blog left-sidebar full-blog default-padding">
            <div class="container">
                <div class="row">
                    <div class="blog-items">
                        <div class="blog-content col-md-8">
                            <!-- Single Item -->
                            <?php
                            $NEWS = new News(NULL);
                            foreach ($NEWS->all() as $news) {
                                $date = $news['date'];

                                $day = date('d', strtotime($date));
                                $year = date('Y', strtotime($date));

                                $month = date('F', strtotime($date));
                                ?>
                                <div class="single-item">
                                    <div class="item">
                                        <div class="thumb">
                                            <a href="news-view.php?id=<?php echo $news['id'] ?>"><img src="upload/news/<?php echo $news['image_name'] ?>" alt="Thumb"></a>
                                            <div class="date">
                                                <h4><span><?php echo $day ?></span><?php echo$month . ' , ' . $year ?></h4>
                                            </div>
                                        </div>
                                        <div class="info">
                                            <h3>
                                                <a href="news-view.php?id=<?php echo $news['id'] ?>"> <?php echo $news['title'] ?></a>
                                            </h3>
                                            <p>
                                                <?php echo $news['short_description'] ?>
                                            </p>
                                            <a href="news-view.php?id=<?php echo $news['id'] ?>">Read More <i class="fas fa-angle-double-right"></i></a>
                                            <div class="meta">
                                                 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <!-- Single Item -->

                            <!-- Pagination -->
                            <div class="row">
                                <div class="col-md-12 pagi-area">
                                    <nav aria-label="navigation">
                                        <ul class="pagination">
                                            <li><a href="#">Previous</a></li>
                                            <li class="active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">Next</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <!-- Start Sidebar -->
                        <div class="sidebar col-md-4">
                            <aside>

                                <!-- Start Sidebar Item -->
                                <div class="sidebar-item search">
                                    <div class="title">
                                        <h4>Search</h4>
                                    </div>
                                    <div class="sidebar-info">
                                        <form>
                                            <input type="text" class="form-control">
                                            <input type="submit" value="search">
                                        </form>
                                    </div>
                                </div>
                                <!-- End Sidebar Item -->

                                <!-- Start Sidebar Item -->
                                <div class="sidebar-item category">
                                    <div class="title">
                                        <h4>Category</h4>
                                    </div>
                                    <div class="sidebar-info">
                                        <ul>
                                            <li>
                                                <a href="#">Java Programming <span>23</span></a>
                                            </li>
                                            <li>
                                                <a href="#">Social Science <span>0</span></a>
                                            </li>
                                            <li>
                                                <a href="#">Business Management <span>12</span></a>
                                            </li>
                                            <li>
                                                <a href="#">Online Learning <span>17</span></a>
                                            </li>
                                            <li>
                                                <a href="#">Course Management <span>0</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Sidebar Item -->

                                <!-- Start Sidebar Item -->
                                <div class="sidebar-item recent-post">
                                    <div class="title">
                                        <h4>Recent Posts</h4>
                                    </div>

                                    <div class="item">
                                        <div class="content">
                                            <div class="thumb">
                                                <a href="#">
                                                    <img src="assets/img/courses/g1.jpg" alt="Thumb">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <h4>
                                                    <a href="#">Profession paython learing</a>
                                                </h4>
                                                <div class="meta">
                                                    <i class="fas fa-user"></i> By <a href="#">Drup Paul</a> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="content">
                                            <div class="thumb">
                                                <a href="#">
                                                    <img src="assets/img/courses/g2.jpg" alt="Thumb">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <h4>
                                                    <a href="#">Social Science & Humanities</a>
                                                </h4>
                                                <div class="meta">
                                                    <i class="fas fa-user"></i> By <a href="#">Drup Paul</a> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="content">
                                            <div class="thumb">
                                                <a href="#">
                                                    <img src="assets/img/courses/g3.jpg" alt="Thumb">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <h4>
                                                    <a href="#">Actualized Leadership Network Seminar</a>
                                                </h4>
                                                <div class="meta">
                                                    <i class="fas fa-user"></i> By <a href="#">Drup Paul</a> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Sidebar Item -->

                                <!-- Start Sidebar Item -->
                                <div class="sidebar-item archives">
                                    <div class="title">
                                        <h4>Archives</h4>
                                    </div>
                                    <div class="sidebar-info">
                                        <ul>
                                            <li><a href="#">Aug 2018</a></li>
                                            <li><a href="#">Sept 2018</a></li>
                                            <li><a href="#">Nov 2018</a></li>
                                            <li><a href="#">Dec 2018</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Sidebar Item -->

                                <!-- Start Sidebar Item -->
                                <div class="sidebar-item gallery">
                                    <div class="title">
                                        <h4>Gallery</h4>
                                    </div>
                                    <div class="sidebar-info">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <img src="assets/img/blog/thumb-1.jpg" alt="thumb">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="assets/img/blog/thumb-2.jpg" alt="thumb">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="assets/img/blog/thumb-3.jpg" alt="thumb">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="assets/img/blog/thumb-4.jpg" alt="thumb">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="assets/img/blog/thumb-5.jpg" alt="thumb">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="assets/img/blog/thumb-6.jpg" alt="thumb">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Sidebar Item -->

                                <!-- Start Sidebar Item -->
                                <div class="sidebar-item social-sidebar">
                                    <div class="title">
                                        <h4>follow us</h4>
                                    </div>
                                    <div class="sidebar-info">
                                        <ul>
                                            <li class="facebook">
                                                <a href="#">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li class="twitter">
                                                <a href="#">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="pinterest">
                                                <a href="#">
                                                    <i class="fab fa-pinterest"></i>
                                                </a>
                                            </li>
                                            <li class="g-plus">
                                                <a href="#">
                                                    <i class="fab fa-google-plus-g"></i>
                                                </a>
                                            </li>
                                            <li class="linkedin">
                                                <a href="#">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Sidebar Item -->

                                <!-- Start Sidebar Item -->
                                <div class="sidebar-item tags">
                                    <div class="title">
                                        <h4>tags</h4>
                                    </div>
                                    <div class="sidebar-info">
                                        <ul>
                                            <li><a href="#">Fashion</a>
                                            </li>
                                            <li><a href="#">Education</a>
                                            </li>
                                            <li><a href="#">nation</a>
                                            </li>
                                            <li><a href="#">study</a>
                                            </li>
                                            <li><a href="#">health</a>
                                            </li>
                                            <li><a href="#">food</a>
                                            </li>
                                            <li><a href="#">travel</a>
                                            </li>
                                            <li><a href="#">science</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Sidebar Item -->

                            </aside>
                        </div>
                        <!-- End Start Sidebar -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Blog -->

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