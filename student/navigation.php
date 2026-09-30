<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" width="70%">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo.png" alt=""  width="70%">
            </span>
        </a>

        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" width="70%">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-light.png" alt="" width="70%">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <?php
                if ($_SESSION['type'] == 1) {
                    ?>
                    <li class="menu-title">Essentials</li>
                    <li>
                        <a href="create-users.php ">
                            <i class="bx bx bx-user-plus  "></i>
                            <span>Manage Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="manage-user-type.php">
                            <i class="bx  bx-user"></i>
                            <span>Manage User Type</span>
                        </a>
                    </li>
                    <li>
                        <a href="manage-fedarations.php">
                            <i class="bx bx-sitemap"></i>
                            <span>Manage Fedarations</span>
                        </a>
                    </li>
                    <li>
                        <a href="manage-document-type.php">
                            <i class="bx bx-layer "></i>
                            <span>Manage Document Type</span>
                        </a>
                    </li>
                    <?php
                }
                ?>
                <li class="menu-title">Navigation</li>
                <li>
                    <a href="index.php"  >
                        <i class="bx bx-home "></i>
                        <span>Dashboard </span>
                    </a> 
                </li> 
                <?php
                if ($_SESSION['type'] == 2) {
                    ?>
                <li>
                    <a href="manage-document-type-applications.php"  >
                        <i class="bx bx-clipboard  "></i>
                        <span>Applications</span>
                    </a> 
                </li> 
                <?php 
                } elseif ($_SESSION['type'] == 3) {
                    ?>
                <li>
                    <a href="all-applications.php"  >
                        <i class="bx bx-clipboard  "></i>
                        <span>Applications</span>
                    </a> 
                </li> 
                <?php 
                }
                ?>
<!--                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-book"></i>
                        <span>About Us</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">About NYSC</a></li> 
                    </ul>
                </li>-->
                <!--                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bx-chart "></i>
                                        <span>Centeres</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="manage-district.php">Districts</a></li>
                                        <li><a href="manage-center.php">Manage Center</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bx-chart "></i>
                                        <span>Courses Types</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="manage-course-type.php">Manage Courses Type </a></li>
                
                                    </ul>
                                </li>
                
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bx-chart "></i>
                                        <span>Courses</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="mobile_numbere-courses.php">Create Courses </a></li>
                                        <li><a href="manage-course.php">Manage Courses </a></li>
                
                                    </ul>
                                </li>
                
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bx-news"></i>
                                        <span>News</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="mobile_numbere-news.php">Add News</a></li>
                                        <li><a href="manage-news.php">Manage News</a></li>
                                    </ul>
                                </li>
                
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bx-calendar "></i>
                                        <span>Event</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="mobile_numbere-event.php">Add Event</a></li>
                                        <li><a href="manage-event.php">Manage Event</a></li> 
                                    </ul>
                                </li>
                
                
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class=" bx bx-sitemap "></i>
                                        <span>Devision</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="mobile_numbere-devision.php">Add Devision</a></li>
                                        <li><a href="manage-devision.php">Manage Devision</a></li> 
                                    </ul>
                                </li>
                
                                <li>
                                    <a href="mobile_numbere-photo-album.php" >
                                        <i class="bx bx-images"></i>
                                        <span>Photo Album</span>
                                    </a>
                
                                </li>
                
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bx-crosshair "></i>
                                        <span>Youth Club</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="#">Discover</a></li>
                                        <li><a href="#">Youth Office</a></li> 
                                    </ul>
                                </li>
                
                                <li>
                                    <a href="mobile_numbere-testimonial.php" >
                                        <i class="bx bx-images"></i>
                                        <span>Testimonial</span>
                                    </a>
                                </li>-->

                <!--                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bx-crosshair "></i>
                                        <span>Youth Club</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="mobile_numbere-news.php">Discover</a></li>
                                        <li><a href="manage-news.php">Nearest Youth Office</a></li>
                                        <li><a href="manage-news.php">Benefit</a></li>
                                        <li><a href="manage-news.php">Youth Club News</a></li>
                                    </ul>
                                </li> -->

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>