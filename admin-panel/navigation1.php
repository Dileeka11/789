<div class="vertical-menu">



    <!-- LOGO -->

    <div class="navbar-brand-box">

        <a href="index.html" class="logo logo-dark">

            <span class="logo-sm">

                <img src="assets/images/logo-sm.png" alt="" width="70%">

            </span>

            <span class="logo-lg">

                <img src="assets/images/logo-dark.png" alt=""  width="70%">

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

                        <a href="exam-reports.php">

                            <i class=" bx bx-copy-alt "></i>

                            <span>Genarate Report</span>

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

                if ($_SESSION['type'] == 1 || $_SESSION['type'] == 2) {

                    ?>

                    <li>

                        <a href="manage-courses.php"  >

                            <i class=" bx bx-link-alt  "></i>

                            <span>Courses </span>

                        </a> 

                    </li> 

                    <li>

                        <a href="schedule-exam.php"  >

                            <i class=" bx bx-calendar  "></i>

                            <span>Shedule Exam </span>

                        </a> 

                    </li>  

                    <li>

                        <a href="javascript: void(0);" class="has-arrow waves-effect">

                            <i class=" bx bx-user-circle"></i>

                            <span>Students</span>

                        </a>

                        <ul class="sub-menu" aria-expanded="false">

                            <li><a href="create-students.php">Add Students</a></li>

                            <li><a href="manage-students.php">Manage Students</a></li>

                        </ul>

                    </li>

               

                    <?php

                }

                if ($_SESSION['type'] == 3) {

                    ?>





                    <li>

                        <a href="manage-students-by-center.php"  >

                            <i class=" bx bx-user-circle e "></i>

                            <span>Students </span>

                        </a> 

                    </li> 



                <?php } ?>



            </ul>

        </div>

        <!-- Sidebar -->

    </div>

</div>