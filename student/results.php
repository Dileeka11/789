<?php
include "../class/include.php"
?>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Student Result - nyscexam.com </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/logo.png">

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="plugin/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="assets/css/timeTo.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/preloader.css" rel="stylesheet" type="text/css" />
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2647948117551772"
     crossorigin="anonymous"></script>
</head>

<style>
    .card-custom {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-header-custom {
        background-color: #f8f9fa;
        text-align: center;
        font-size: 1.25rem;
        font-weight: bold;
    }

    .card-body-custom {
        text-align: center;
        padding: 2rem;
    }
</style>
<style>

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8); /* Dark overlay to disable background interaction */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .modal-overlay.visible {
            opacity: 1;
            visibility: visible;
        }

        /* Modal Content */
        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            max-width: 400px;
            width: 100%;
            position: relative;
        }

        .modal-content h2 {
            margin-bottom: 20px;
        }

        .modal-content p {
            margin-bottom: 30px;
        }

        .modal-content .btn {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            background-color: #ff0000;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
        }

        .modal-content .btn i {
            margin-right: 8px;
        }

        .modal-content .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
        }

    </style>
<body class="someBlock">
    <!-- <body data-layout="horizontal" data-topbar="colored"> -->
    <!-- Begin page -->
    <div>
  <!--<div id="subscribeModal" class="modal-overlay">-->
  <!--      <div class="modal-content">-->
  <!--          <button class="close-btn" onclick="closeModal()">&#10006;</button>-->
  <!--          <h2>Subscribe to our main YouTube channel now</h2>-->
  <!--          <p>Don't miss out on our latest updates and videos. Subscribe today!</p>-->
  <!--          <a href="https://www.youtube.com/channel/UCMZiv_zU8VqfN0XBpmAPOQA?sub_confirmation=1" target="_blank" class="btn btn-danger">-->
  <!--              <i class="fab fa-youtube"></i> Subscribe Now-->
  <!--          </a>-->
  <!--      </div>-->
  <!--  </div>-->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content" style="margin-left: 0px;">


            <div class="page-content">
                <div class="container-fluid">
                    <!-- end page title -->
                    <?php

                    $ACTION_PANEL = new ActionPanel(3);
                    if ($ACTION_PANEL->status == 1) {
                    ?>


                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-lg-1"></div>
                                            <div class="col-lg-10">
                                                <div class="text-center">
                                                    <a href="" class="mb-3 d-block auth-logo">
                                                        <img src="assets/images/logo-dark.png" alt="" class="logo logo-dark" style="width: 100%; margin:auto">
                                                    </a>
                                                </div>
                                                <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title text-success" id="myExtraLargeModalLabel">
                                                                    <center> වෘත්තීය පුහුණුවත් අපි “ Smart” කළෙමු ! </cente>
                                                                        </h5>
                                                                        <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close">
                                                                        </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-10">

                                                                        <u>
                                                                            <b>
                                                                                <p> කෙටිම කාලයකින්‍ විභාග ප්‍රතිඵල නිකුත් කළෙමු.</p>
                                                                            </b>

                                                                        </u>

                                                                        <p> 21 වන සියවසේ කුසලතාවන් සහ විභවතාවන් ග්‍රහණය කරගත හැකිවන අයුරින් තරුණ ප්‍රජාවගේ සහජ දක්ෂතාවන් හා කුසලතා වැඩි දියුණු කිරීමට සුදුසු ඉගැනුම් හා ඉගැන්වීම් පරිසරයක් නිර්මාණය කර වර්තමානයේ ප්‍රබල වෙනසක් සිදුකිරීම ජාතික අවශ්‍යතාවයක්ව පවතී.
                                                                        </p>

                                                                        <p>
                                                                            මෙරට සංවර්ධන න්‍යාය පත්‍රය මෙහෙයවනු ලබන තරුණ ප්‍රජාව අනාගතයට සරිලන බලසතු ශ්‍රී ලාංකීය තරුණයෙක් බවට පත් කිරීම ජාතික තරුණ සේවා සභාවේ ආයතනික දැක්ම වේ.
                                                                        </p>
                                                                        <p>

                                                                            වෙනස් වන ලෝකය සමඟ ජාතික තරුණ සේවා සභාව ද උපාය උපක්‍රමිකව වෙනස්වීම් කළමනාකරණය කර 2023 වර්ෂයේ සිට වෘත්තීය පුහුණු මධ්‍යස්ථාන ආශ්‍රිත විභාග පැවැත්වීමේ ක්‍රියාවලිය Digitalize කරමින් Online මඟින් විභාග පවත්වා ජාතික හා ජාත්‍යන්තර පිළිගැනීමක් ලැබෙන පරිදි ඉලෙක්ට්‍රොනික් පහසුකම් සහිත වටිනා සහතික පතක් ඔබ සුරතට ලබාදීමට අප ක්‍රියා කල බව සතුටින් ඔබට දන්වා සිටිමි.
                                                                            ඔබගේ අනාගත අධ්‍යාපනික හා වෘත්තීය දිවිය සර්වප්‍රකාරයෙන් සාර්ථක වේවායි ප්‍රාර්ථනා කරමි.

                                                                        </p>



                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <img src="assets/images/chirman.jpg" alt="" class="logo logo-dark" style="width: 100%; margin:auto;border-radius:6px">
                                                                        <p>
                                                                            පසිදු ගුණරත්න<br>
                                                                            සභාපති/ තරුණ සේවා අධ්‍යක්ෂ ජනරාල් <br>
                                                                            ජාතික තරුණ සේවා සභාව

                                                                        </p>
                                                                        <center> <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Click here to Close</button></center>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->


                                                <h3 class="text-center">Exam Results</h3>
                                                <div>
                                                    <!-- <form action="#"> -->

                                                    <div class="row mt-3">
                                                        <label class="form-label mt-1 col-md-3" for="username" style="font-size: 18px;">Enter Your MIS No.</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" id="student_id" placeholder="Please Enter Your MIS Number." name="student_id" style="margin-bottom:20px;">
                                                        </div>
                                                        <label class="form-label mt-1 col-md-12 text-center" for="username" style="font-size: 18px;">Or</label>
                                                        <label class="form-label mt-1 col-md-3" for="username" style="font-size: 18px;">Enter Your NIC No.</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" id="nic_no" placeholder="Please Enter Your NIC Number." name="nic_no" style="margin-bottom:20px;">
                                                        </div>
                                                        <div class="col-md-12 text-center">
                                                            <button class="btn btn-primary w-sm waves-effect waves-light me-1" type="button" id="show-results" style="height: 40px;">Show Results</button>
                                                            <button class="btn btn-warning w-sm waves-effect waves-light" type="button" id="reset" style="height: 40px;">Reset</button>
                                                        </div>
                                                    </div>




                                                    <!-- </form> -->

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-lg-1"></div>
                                            <div class="col-lg-10">
                                                <div class="result-section hidden">

                                                </div>
                                                <div class="">
                                                    <p class="text-center mt-3 mb-0">Please note that this online result is provisional and should not be used as an official confirmation or a certification.</p>
                                                    <p class="text-center mt-1">Copyright @ <?= date('Y') ?> - National Youth Services Council - Sri Lanka</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> <!-- end col-->
                        </div>

                    <?php } else { ?>

                        <div class="container mt-5">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="card card-custom">

                                        <div class="card-header card-header-custom  ">
                                            <a href="" class="m-10 d-block auth-logo">
                                                <img src="assets/images/logo-dark.png" alt="" class="logo logo-dark" style="width: 100%; margin:auto">
                                            </a>
                                        </div>
                                        <div class="card-body card-body-custom">
                                            <p class="card-text" style="line-height: 30px;">
                                            <h4 class="text-center;" style="margin-bottom: 20px;font-weight: 600;line-height: 35px;"> මේ ජාතික තරුණ සේවා සභාවේ විභාග හා ඇගයීම් අංශයයි ..</h4>
                                           

                                            ඔබගේ විභාගයට අදාල ප්‍රතිපල මෙතෙක් නිකුත් කිරිම සිදු නොකරන ඇති අතර එය නිකුත් වූ විගස ඔබගේ මධ්‍යස්ථානය මගින් ඔබට එය දැනුවත් කිරිම සිදු කරනු ලබයි. ඉන්පසු ඔබට ඔබගේ ප්‍රතිපල ලබා ගැනිමට හැකියාව ලැබේ..
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>





                </div> <!-- container-fluid -->
            </div>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="assets/js/jquery.time-to.min.js" type="text/javascript"></script>
    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/libs/jszip/jszip.min.js"></script>
    <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="plugin/sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <script src="assets/js/jquery.preloader.min.js" type="text/javascript"></script>
    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="ajax/js/results.js" type="text/javascript"></script>

    <!-- Datatable init js -->
    <script src="assets/js/pages/datatables.init.js"></script>
  
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2647948117551772"
     crossorigin="anonymous"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>

    // <script>
    //     $(window).on('load', function() {
    //         $('.bs-example-modal-xl').modal('show');

    //     });
    // </script>

<script>
        document.addEventListener("DOMContentLoaded", function() {
            // Show the modal always
            document.getElementById('subscribeModal').classList.add('visible');
        });

        function closeModal() {
            document.getElementById('subscribeModal').classList.remove('visible');
        }
    </script>

</body>

</html>