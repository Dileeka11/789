<?php
$US = new User($_SESSION['id']);

?>

<div class="vertical-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="index.php" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" width="70%">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-dark.png" alt="" width="70%">
            </span>
        </a>
        <a href="index.php" class="logo logo-light">
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
                    <li class="menu-title">User Management</li>
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

                <?php
                }
                ?>
                <li class="menu-title">Navigation</li>
                <li>
                    <a href="index.php">
                        <i class="bx bx-home "></i>
                        <span>Dashboard </span>
                    </a>
                </li>

                <?php
                if ($_SESSION['type'] == 1 || $_SESSION['type'] == 4) {
                ?>
                    <li class="menu-title">MIS Management Panel</li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="   bx bx-book  "></i>
                            <span>Courses</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="manage-course-trade.php">Manage Course Trade</a></li>
                            <li><a href="create-courses.php">Create Courses</a></li>
                            <li><a href="manage-courses.php">Manage Courses</a></li>
                            <!--<li><a href="manage-courses-by-centers.php">Drop Out By Course</a></li>-->
                          
                        </ul>
                    </li>

                    <li>

                        <a href="javascript: void(0);" class="has-arrow waves-effect">

                            <i class="  bx bx-bar-chart-square "></i>

                            <span>Request Courses
                                <?php
                                $COURSE_RE = new CourseRequest(NULL);
                                $coun_course = count($COURSE_RE->getCourseRequestByStatus(0));
                                if ($coun_course != 0) {
                                ?>
                                    <span class="badge rounded-pill bg-info "><?php echo $coun_course ?></span></span>
                        <?php } ?>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="all-pending-course-requests.php">- Pending Requests </a></li>
                            <li><a href="all-approved-course-request.php">- Approvel Requests</a></li>
                            <li><a href="all-course-requests.php">- All Requests</a></li>
                            <li><a href="all-close-course-requests.php">- Close Requests</a></li>
                            <li><a href="all-reject-course-requests.php">- Reject Requests</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class=" bx bx-notepad "></i>
                            <span>Divisions</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="manage-positions.php">Manage Positions</a></li>
                            <li><a href="manage-divisions.php">Manage Divisions</a></li>

                        </ul>
                    </li>


                    <li>
                        <a href="manage-send-messages.php">
                            <i class=" bx bx-message-alt-dots "></i>
                            <span>Send Messages </span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class=" bx bx-clinic"></i>
                            <span>Centers</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="create-center.php">Create Center </a></li>
                            <li><a href="manage-centers-with-students.php">Manage Centers </a></li>
                        </ul>
                    </li>


                    <li>
                        <a href="create-instructors.php">
                            <i class='bx bx-group'></i>
                            <span>Instructors </span>
                        </a>
                    </li>
                    <li>
                        <a href="create-non-nvq-instructors.php">
                            <i class='bx bx-user-pin'></i>
                            <span>Non NVQ Instructor Details </span>
                        </a>
                    </li>
<?php
                }
                 if ($_SESSION['type'] == 4) {
                
                ?>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="  bx bx-spreadsheet  "></i>
                            <span>Reports</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="admin-center-student-reports.php">Student Details</a></li>
                             <li><a href="final-course-request-count-report.php">Registered Students</a></li>
                            <li><a href="all-dropout-students-report.php">Dropout Student Details</a></li>
                            <li><a href="final-application-report.php">All Courses Application Report</a></li>
                            <li><a href="center-student-payment.php">Payment Report</a></li>
                            
                            <li><a href="center-exam-report.php">Center Exam Report</a></li>
                           <li><a href="course-request-report.php">Course Request Report</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                          <i class="bx bx-bar-chart"></i>
                            <span>Chart Reports</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="chart-level-vise.php">Course Level Vise</a></li>
                             <li><a href="chart-center-vise.php">All Students Center Vise</a></li>
                             
                           
                        </ul>
                    </li>
                    
                    
                <?php
                }
                if ($_SESSION['type'] == 1 || $_SESSION['type'] == 9) {
                ?>
                                    <li class="menu-title">Exam Management Panel</li>

                      <li>
                        <a href="manage-slider.php">
                            <i class='bx bx-image'></i>
                            <span>Slider </span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="  bx bx-book-bookmark  "></i>
                            <span>Manage Exam </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="create-exam-period.php"> Exam Periods </a></li>
                            <li><a href="manage-exam-papers.php"> Exam Papers </a></li> 
                            <li><a href="practical-papers-submit.php"> Practical Papers </a></li> 
                            <li><a href="theory-papers-submit.php"> Theory Papers </a></li> 

                            

                        </ul>
                    </li>
                    
                        <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="  bx bx-book-bookmark  "></i>
                            <span>Online Exam </span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false"> 
                            <li><a href="schedule-exam-by-year.php">Shedule Exam</a></li>
                            <li><a href="manage-schedule-exam-by-year.php?id=non-nvq"> Non Nvq </a></li>
                            <li><a href="manage-schedule-exam-by-year.php?id=short_time"> Short Time </a></li> 
                             <li><a href="manage-schedule-exam-by-year.php?id=language"> Languages Exam </a></li> 
                              <li><a href="manage-schedule-exam-by-year.php?id=agriculture"> Agriculture Exam </a></li>
                            <li><a href="center-live-exam-report.php"> Live Exam Report </a></li>

                        </ul>
                    </li>
                    

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class=" bx bx-user-circle"></i>
                            <span>Students</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="create-students.php">Add Students</a></li>
                            <li><a href="manage-students.php">Manage All Students</a></li>
                               <li><a href="search-student-result.php"> Search Student</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="manage-centers-with-students.php">
                            <i class='bx bx-clinic'></i>
                            <span>Centers </span>
                        </a>
                    </li>
                
                    
                     <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="   bx bx-book  "></i>
                            <span>Manage Courses</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="manage-courses.php">All Courses</a></li>
                            <li><a href="manage-nvq-courses.php">NVQ Courses</a></li>
                            <li><a href="manage-non-nvq-courses.php">NON NVQ Courses</a></li>
                            <li><a href="manage-languages-courses.php">Language Courses</a></li>
                            <li><a href="create-non-nvq-instructors.php">Non NVQ Instructor Details</a></li>
                        </ul>
                    </li>
                    
                    

                    <li>
                        <a href="create-instructors.php">
                            <i class='bx bx-group'></i>
                            <span>Instructors </span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="  bx bx-spreadsheet  "></i>
                            <span>Reports</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="center-exam-report.php">Center Exam Report</a></li>
                            <li><a href="check-exam-final-mark-report.php">Check Exam Final Mark</a></li>
                              
                        </ul>
                    </li>
                <?php 
                 }if ($_SESSION['type'] == 1 || $_SESSION['type'] == 12) {
                ?>
                 <li class="menu-title">Accounts</li> 
                    
                    <li>
                        <a href="create-annual-funds.php">
                            <i class="bx bx bx-wallet  "></i>
                            <span>Annual Fund</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="   bx bx-credit-card  "></i>
                            <span>Manage League</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="manage-league.php"> League Type </a></li>
                             <li><a href="create-league-funds.php">Add League Amount  </a></li>  
                           
                        </ul>
                    </li> 
                    
                     <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="   bx bx-credit-card  "></i>
                            <span>Manage Payments</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="payment-funds.php"> Payments </a></li>
                             <li><a href="manage-non-nvq-courses.php">Current Year Payments  </a></li> 
                            <li><a href="manage-nvq-courses.php">History Annual Payments  </a></li>
                           
                        </ul>
                    </li> 
                <?php

                }
                if ($_SESSION['type'] == 3) {
                ?>
                    <li>
                        <a href="manage-students-by-center.php">
                            <i class=" bx bx-user-circle e "></i>
                            <span>Students </span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="  bx bx-bookmark-minus "></i>
                            <span>Course Requests</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="create-new-course-request.php"> - Create Requests </a></li>
                            <li><a href="center-approved-course-requests.php"> - Approvel Courses</a></li>
                            <li><a href="all-course-requests-by-centers.php">- All Requests</a></li>
                            <li><a href="center-close-course-requests.php">- Close Requests</a></li>
                            <li><a href="center-reject-course-requests.php">- Reject Requests</a></li>
                        </ul>

                    </li>
                    
                    
                    <li>
                        <a href="manage-courses-by-centers.php">
                            <i class=" bx bx-book  "></i>
                            <span>Manage Courses </span>
                        </a>
                    </li>
                      <li>
                        <a href="manage-courses.php">
                            <i class=" bx bx-book  "></i>
                            <span>  Courses Syllabus </span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="center-schedule-exam-by-year.php">
                            <i class='bx bx-image'></i>
                            <span>Short Time Exam</span>
                        </a>
                    </li>
                    
                    
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="  bx bx-spreadsheet  "></i>
                            <span>Reports</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="center-student-reports.php">Student Details</a></li>
                            <li><a href="center-final-course-request-count-report.php">Course student count</a></li>
                           <li><a href="center-exam-attendance-report.php">Theory Attendance Sheet</a></li>
                            <li><a href="center-practical-mark-sheet.php">Practical Attendance & Mark Sheet</a></li>
                            <li><a href="center-dropout-student-report.php">Drop Out Student </a></li>
                            <li><a href="center-student-practical-mark-report.php">Practical Mark Report </a></li>
                            <?php
                                $ACTION_PANEL = new ActionPanel(3);
                                if($ACTION_PANEL->status == 1){
                                ?>
                            <li><a href="center-final-exam-report.php">Exam Mark Report </a></li>
                         <?php } ?>
                            
                        </ul>
                    </li>
  
                <?php }
                if ($_SESSION['type'] == 6 || $_SESSION['type'] == 1) { ?>

   

                    <li class="menu-title">Directors Management Panel</li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="  bx bx-spreadsheet  "></i>
                            <span>Reports</span>
                        </a>
                       <ul class="sub-menu" aria-expanded="false">
                            <!--<li><a href="final-summary-report.php">Final Summary </a></li>-->
                            <li><a href="admin-center-student-reports.php">Students Details</a></li>
                            
                            <li><a href="center-course-report.php">Center Course Details</a></li>

                            <!--<li><a href="#">Students By Course </a></li>-->
                            
                            
                            <li><a href="all-dropout-students-report.php">Drop Out Students </a></li>
                            <!--<li><a href="#">Course Income </a></li>-->
                            <!--<li><a href="#">Payment History </a></li>-->
                            <!--<li><a href="final-exam-report.php">Final Exam Report</a></li>-->
                            <li><a href="final-application-report.php"> Application Report</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="manage-centers.php">
                            <i class='bx bx-clinic'></i>
                            <span>Centers </span>
                        </a>
                    </li>
                     
                    <li>
                        <a href="manage-courses-by-centers.php">
                            <i class=" bx bx-book  "></i>
                            <span>Manage Courses </span>
                        </a>
                    </li>

                <?php
                }
                if ($_SESSION['type'] == 5 || $_SESSION['type'] == 1 || $_SESSION['type'] == 6 ) {

                ?>
                    <li class="menu-title">Division Management Panel</li>
                    <?php
                            if ($USER->position == 1 || $USER->position == 2) {
                            ?>
                    <li>
                        <a href="manage-division-positions.php?id=<?php echo $US->division ?>">
                            <i class="bx bx-notepad "></i>
                            <span>Manage Division </span>
                        </a>
                    </li>
<?php } ?>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class=" bx bx-building "></i>
                            <span>Documentation</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="submit-document.php">Send Document</a></li>
                            <li><a href="manage-documents.php">Manage Documents</a></li>
                            
                                <li><a href="manage-document-copies.php">Manage Document Copies</a></li>
                            
                        </ul>
                    </li>


                <?php
                }
                ?>

                <?php

                if ($_SESSION['type'] == 7 && $_SESSION['isActive'] == 1) {
                ?>
                    <li>
                        <a href="create-exam-period.php">
                            <i class="bx bx-bookmark-plus "></i>
                            <span>Exam Period</span>
                        </a>
                    </li>
                <?php
                }
                ?>
                
                 <?php

                if ($_SESSION['type'] == 7 ) {
                ?>
                    <li>
                        <a href="manage-instructor-courses-students.php">
                            <i class="bx bx-bookmark-plus "></i>
                            <span>Manage Students </span>
                        </a>
                    </li>
                <?php
                }if ($_SESSION['type'] == 3 ) {
                ?>
                 
                
                <li>
                        <a href="search-student-result.php">
                            <i class='bx bx-group'></i>
                            <span>Search Student </span>
                        </a>
                    </li>
                    <?php } ?>
                    
                    
                     <li>
                        <a href="center-practical-papers-downloard.php">
                            <i class='bx bx-group'></i>
                            <span> Practicle Paper Downloard   </span>
                        </a>
                    </li>
                    
                      
                     <li>
                        <a href="center-theory-papers-downloard.php">
                            <i class='bx bx-group'></i>
                            <span> Theory Paper Downloard   </span>
                        </a>
                    </li>
                    
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>