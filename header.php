<style>
    .button-container {
        display: none; /* Hide by default */
    }

    @media (max-width: 768px) {
        .button-container {
            display: block; /* Show only on screens smaller than 768px */
        }
    }
</style>

<div style="background-color:red; padding:5px; color:white;" class="hidden d-none d-md-block">
    <center>Under maintenance and development this website @2024 - Exam & Assessment Division - National Youth Service Council.</center>
</div>


<!-- Login Section (Visible Only on Mobile) -->
<div class="container">
    <div class="button-container text-right col-12 col-md-2 d-block d-md-none">
        <a href="https://exam.nyscexam.com/" class="animated-button animated-border-butto">Student Login</a>
    </div>
</div>

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2647948117551772"
     crossorigin="anonymous"></script>



<div class="top-bar-area address-one-lines bg-dark text-light">
    <div class="container">
        <div class="row">
            <div class="col-md-8 address-info">
                <div class="info box">
                    <ul>
                        <li>
                            Have any question?  011 222 3333 
                        </li>
                        <li>
                            <i class="fas fa-envelope-open"></i>
                            exam.assessment@gmail.com
                        </li>
                        <li>
                            <i class="fas fa-clock"></i>
                            Mon - Fri <span>8:30 - 16:15</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="user-login text-right col-md-2">
                <a href="https://exam.nyscexam.com/">Student Login</a>
            </div>
            <div class="user-login text-right col-md-2">
                <a href="admin-panel">Center Login</a>
            </div>
        </div>
    </div>
</div>



<!-- End Header Top -->
<header id="home">

    <!-- Start Navigation -->
    <div class="wrap-sticky" style="height: 91px;">
        <nav class="navbar navbar-default attr-border navbar-sticky bootsnav on no-full">

            <!-- Start Top Search -->
            <div class="container">
                <div class="row">
                    <div class="top-search">
                        <div class="input-group">
                            <form action="#">
                                <input type="text" name="text" class="form-control" placeholder="Search">
                                <button type="submit">
                                    <i class="fas fa-search"></i>
                                </button>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Top Search -->

           
                <div class="col-md-3">
                    <!-- Start Header Navigation -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                            <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="/">
                            <img src="assets/img/logo.png" class="logo" alt="Logo">
                        </a>
                    </div>
                    <!-- End Header Navigation -->
                </div>
                <div class="col-md-9">
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <ul class="nav navbar-nav navbar-right" data-in="#" data-out="#">
                            <li>
                                <a class="smooth-menu" href="index.php">Home</a>
                            </li>
                            <li>
                                <a class="smooth-menu" href="#">About Us</a>
                            </li>
                            <li>
                                <a class="smooth-menu" href="#">Staff</a>
                            </li> 
                            <li>
                                <a class="smooth-menu" href="#">News</a>
                            </li>
                            <li>
                                <a class="smooth-menu" href="#">Gallery</a>
                            </li>
                            <li>
                                <a class="smooth-menu" href="#">Contact Us</a>
                            </li>
                             <?php
                                $ACTION_PANEL = new ActionPanel(3);
                                if($ACTION_PANEL->status == 1){
                                ?>
                            <li>
                               
                                <span class="release-now-animation"><center>Released</center></span>
                               
                                <a class="smooth-menu" href="student/results.php" style="color:red;padding-top:9px;"> Exam Results</a>
                            </li>
                             <?php } ?>
                            <!--  <li>-->
                            <!--    <a class="smooth-menu" href="./admin-panel/center-search-student-result.php">Search Student  </a>-->
                            <!--</li>-->
                            <!--<li>-->
                            <!--    <a class="smooth-menu" href="student/profile.php"  style="color:red">  Verification</a>-->
                            <!--</li>-->
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </div>

        </nav>
    </div>
    <!-- End Navigation -->

</header>

<!-- Add this CSS in your style section or external stylesheet -->
<style>
   .button-container {
        text-align: center; /* Center the button */
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .animated-button {   
       
  
        display: inline-block;
        padding: 12px 30px;
        font-size: 18px;
        font-weight: bold;
        color: white;
        background-color: #FF6666;
        border-radius: 5px;
        text-decoration: none;
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
    }

    
  
    .release-now-animation {
        display: inline-block;
        position: relative;
        animation: upDown 1s infinite alternate ease-in-out;
        margin-left: 25px;
        border-radius: 4px;
        color: white;
        font-weight: 600;
        font-size: 12px;
        padding: 0px 10px 0px 10px;
        background-color: red;
    }

    .release-now-animation::after {
        content: "";
        position: absolute;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 5px solid red;
    }

    @keyframes upDown {
        0% {
            transform: translateY(0);
        }
        100% {
            transform: translateY(-5px);
        }
    }
</style>
