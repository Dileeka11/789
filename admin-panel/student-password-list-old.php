<?php
include '../class/include.php';
include './auth.php';
$course_id = $_GET['course'];
$center_id = $_GET['center'];
$year = $_GET['year'];
$batch = $_GET['batch'];
$COURSE = new Course($course_id);
$CENTER = new Centers($center_id);

$HELPER = new Helper(NULL);
$STUDENT = new Student(NULL);
$students = $STUDENT->getStudentsByCourseAndCenter($course_id, $center_id, $year, $batch);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Student Password List</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <div id="PDFcontent">
        <h3 style="text-align: center;text-decoration:underline; font-size:20px; font-weight:600">Student Password List</h3>
        <table style="text-align: left;">
            <tr>
                <th style="width: 30%;">Course</th>
                <th style="width: 5%;">:</th>
                <td><?= $COURSE->courseid . ' - ' . $COURSE->cname ?></td>
            </tr>
            <tr>
                <th>Center</th>
                <th>:</th>
                <td><?= $CENTER->centercode . ' - ' . $CENTER->center_name ?></td>
            </tr>
            <tr>
                <th>Year</th>
                <th>:</th>
                <td><?= $year ?></td>
            </tr>
            <tr>
                <th>Batch</th>
                <th>:</th>
                <td><?= $batch ?></td>
            </tr>
        </table>
        <table class="mainTable" style="text-align: left; width:100%" border="1">
            <tr>
                <th style="width: 7%; padding:5px; height:20px">No.</th>
                <th style="width: 7%; padding:5px; height:20px">Student ID</th>
                <td style="width: 40%; padding:5px; height:20px">Student Name</td>
                <td style="width: 30%; padding:5px; height:20px">Student NIC No</td>
                <td style="width: 16%; padding:5px; height:20px">Password</td>
            </tr>
            <?php
            if (count($students) > 0) {
                foreach ($students as $key => $student) {
                    $key++;
                    // $password = $HELPER->decryptData($student['password']);
            ?>
                    <tr>
                        <td><?= $key ?></td>
                        <td><?= $student['id'] ?></td>
                        <td><?= $student['fname'] . ' ' . $student['lname'] ?></td>
                        <td><?= $student['nic'] ?></td>
                        <td><?= $student['password'] ?></td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="5">No data found</td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>

    <!-- <div id="ignoreContent">

        <p>Only for display and not in pdf</p>

    </div> -->

    <button id="gpdf" style="margin-top: 10px;">Generate PDF</button>

    <script>
        var pdfdoc = new jsPDF({
            format: 'a4', // or specify custom dimensions [width, height]
        });

        var specialElementHandlers = {


            '#ignoreContent': function(element, renderer) {

                return true;

            }

        };



        $(document).ready(function() {

            $("#gpdf").click(function() {

                var pdfContent = $('#PDFcontent').html();

                // Add your HTML content with styles here
                pdfContent += '<style>' +
                    'table { width: 100%; border-collapse: collapse; }' +
                    'th, td { border: 1px solid #fff; padding: 5px; text-align: left; }' +
                    '</style>';

                // var pageHeight = pdfdoc.internal.pageSize.getHeight();
                // var y = 10; // Initial Y position
                // var pageBreakThreshold = pageHeight - 20; // Adjust as needed

                pdfdoc.fromHTML(pdfContent, 10, 10, {
                    'width': 110,
                    'elementHandlers': specialElementHandlers,
                    'autoPageBreak': true,
                    'margin': {
                        top: 20
                    }
                });

                pdfdoc.save('First.pdf');

            });
        });
    </script>


</body>

</html>