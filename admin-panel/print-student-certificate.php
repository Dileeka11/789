<?php


// Include autoloader 
require_once 'plugin/dompdf/autoload.inc.php';
include '../class/include.php';
include('./plugin/phpqrcode/qrlib.php');

// Reference the Dompdf namespace Student No
use Dompdf\Dompdf;

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$serverName = $_SERVER['SERVER_NAME'];
$port = $_SERVER['SERVER_PORT'];
$portSuffix = ($protocol === 'http' && $port != 80) || ($protocol === 'https' && $port != 443) ? ':' . $port : '';
$basePath = dirname($_SERVER['PHP_SELF']);
$baseUrl = "$protocol://$serverName$portSuffix$basePath";
$domain = $_SERVER['SERVER_NAME'];

$student_id = $_GET['id'];
$exam_id = $_GET['exam_id'];

$STUDENT = new Student($student_id);
$EXAM = new SheduleExam($exam_id);
$CENTER = new Centers($STUDENT->centercode);
$COURSE = new Course($EXAM->course_id);

$PROVINCE = new Province($CENTER->province);


$EXAM_PERIOD = new ExamPeriod(null);
$exam_period = $EXAM_PERIOD->getExamPeriodByYearAndBatch($EXAM->year, $EXAM->batch);

$batch_start_date = $exam_period['batch_start_date'];
$batch_end_date = $exam_period['batch_end_date'];

$printed_count = $exam_period['printed_count'];
if ($printed_count >= $exam_period['certificate_count']) {
    $error_message = "exceed";
    header("Location: view-exam-students.php?id=" . $exam_id . "&error=" . $error_message);
    exit;
}
// update certificate printed count
$EXAM_PERIOD1 = new ExamPeriod($exam_period['id']);
$EXAM_PERIOD1->printed_count = $printed_count + 1;
$EXAM_PERIOD1->updateCertificatePrintedCount();

// Parse the start date
$start = DateTime::createFromFormat('Y-m-d', $batch_start_date);
$end = DateTime::createFromFormat('Y-m-d', $batch_end_date);
$period = $start->format('d.m.Y') . ' to ' . $end->format('d.m.Y');

$fileurl = "$baseUrl/qr/certificates";
$fileurl1 = "$baseUrl/assets/images/signatures/";
$html = '';



$url = "$domain/student/profile.php?id=" . $STUDENT->id;
QRcode::png($url, "qr/certificates/qr-$STUDENT->id.png", QR_ECLEVEL_L, 6);


if($EXAM->exam_category != 'short_time'){
 
    
$html .= '<div style="size: A4 portrait;width:100%; font-size:15px; font-family: Calibri, sans-serif;">';
$html .= '<div style="margin: auto; width: fit-content; padding: 30px 0 30px 30px;">';
$html .= '<table style="width:100%;margin-top:20px">';
$html .= '<tr>';
$html .= '<td style="width:100%; height:100px;"></td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width:100%; text-align:left; font-weight:400; padding:120px 0px 10px 0px;">This is to certify that</td>';
$html .= '</tr>';

 

// Updated HTML
$html .= '<tr>';
$html .= '<td style="width:100%; font-size:18px; padding:5px 0px; font-weight:700; text-align:left;">'   .  $STUDENT->fname.' '. $STUDENT->lname  . '</td>';
$html .= '</tr>';


$html .= '<tr><td style="height:30px"></td></tr>';
$html .= '<tr>';

$html .= '<td style="width:100%; font-weight:400; text-align:left; padding:5px 0px;">Was awarded the Professional Qualification of</td>';
 
$html .= '</tr>';


$html .= '<tr>';
$html .= '<td style="width:100%; font-size:18px; padding:5px 0px; font-weight:700; text-align:left;">' 
    . $COURSE->cname
    . '</td>';

$html .= '</tr>';

// $html .= '<tr>';
// $html .= '<td style="width:100%; font-size:18px; padding:5px 0px; font-weight:700; text-align:left;"></td>';
// $html .= '</tr>';
$html .= '<tr><td style="height:30px"></td></tr>';
$html .= '<tr>';
$html .= '<td style="width:100%; font-weight:400; text-align:left; padding:5px 0px;">Conducted by the National Youth Services Training Centre</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width:100%; font-size:18px; padding:5px 0px; font-weight:700; text-align:left;">' . $CENTER->center_name . '</td>';
$html .= '</tr>';
$html .= '<tr><td style="height:30px"></td></tr>';
$html .= '<tr>';
$html .= '<td style="width:100%; font-weight:400; text-align:left; padding:5px 0px;">During the period</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width:100%; font-size:15px; padding:5px 0px; font-weight:600; text-align:left;">From: ' . $period . '</td>';
$html .= '</tr>';
$html .= '<tr><td style="height:40px"></td></tr>';
$html .= '<tr>';
$html .= '<td style="width:100%; font-size:18px font-weight:400; text-align:left; "> Date of Issue - ' . $exam_period['certificate_issued_date'] . '</td>';
$html .= '</tr>';
// $html .= '<tr>';

// $html .= '<td style="width:100%; text-align:left; "><img src="' . $fileurl . '/qr-' . $STUDENT->id . '.png" style="margin-left:-5px;  width:60px" alt="qr" /></td>';
// $html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width:100%; font-size:16px; font-weight:400; text-align:left; ">Student No - '.$STUDENT->id.' </td>';
// $html .= '<td style="width:100%; font-size:12px; font-weight:400; text-align:left; padding:0px 0px;">(Student Verification)</td>';
$html .= '</tr>';
$html .= '<tr><td style="height:220px"></td></tr>';
$html .= '</table>';
$html .= '<table>';
 
$html .= '<tr>';
$html .= '<td style="width:140px; "></td>';
$html .= '<td style="width:200px;text-align:right"><img src="' . $fileurl1 . '2.png" style="width:150px" alt="Director Signature" /></td>';
$html .= '<td style="width:80px; "></td>';
$html .= '<td style="width:200px;margin-left:10px"><img src="' . $fileurl1 . '1.png" style="width:150px" alt="Chairman Signature" /></td>';
$html .= '</tr>';
 
$html .= '</table>';
$html .= '</div>';
$html .= '</div>';




///// PRINT CERTIFICATE FOR THE SHORT TIME STUDENT - CENTER ID = 1 //////////////
}else{



$html .= '<div style="size: A4 portrait;width:100%; font-size:15px; font-family: Calibri, sans-serif;">';
$html .= '<div style="margin: auto; width: fit-content; padding: 30px 0 30px 60px;">';
$html .= '<table style="width:100%;margin-top:0px">';
$html .= '<tr>';
$html .= '<td style="width:100%; height:150px;"></td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width:100%; text-align:left; font-weight:400; padding:120px 0px 10px 0px;">This is to certify that</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width:100%; font-size:18px; padding:5px 0px; font-weight:700; text-align:left;">'   .  $STUDENT->fname.' '. $STUDENT->lname  . '</td>';

$html .= '</tr>';


$html .= '<tr><td style="height:10px"></td></tr>';
$html .= '<tr>';
 
$html .= '<td style="width:100%; font-weight:400; text-align:left; padding:5px 0px;">Has successfully completed a short term certificate course in</td>';
 
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td style="width:100%; font-size:18px; padding:5px 0px; font-weight:700; text-align:left;">' 
    . $COURSE->cname
    . '</td>';

$html .= '</tr>';

// $html .= '<tr>';
// $html .= '<td style="width:100%; font-size:18px; padding:5px 0px; font-weight:700; text-align:left;"></td>';
// $html .= '</tr>';
$html .= '<tr><td style="height:10px"></td></tr>';
$html .= '<tr>';
$html .= '<td style="width:100%; font-weight:400; text-align:left; padding:5px 0px;">Conducted by the National Youth Services Training Centre</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width:100%; font-size:18px; padding:5px 0px; font-weight:700; text-align:left;">' . $CENTER->center_name . '</td>';
$html .= '</tr>';
$html .= '<tr><td style="height:10px"></td></tr>';
$html .= '<tr>';
$html .= '<td style="width:100%; font-weight:400; text-align:left; padding:5px 0px;">During the period</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width:100%; font-size:15px; padding:5px 0px; font-weight:600; text-align:left;">From: ' . $period . '</td>';
$html .= '</tr>';
$html .= '<tr><td style="height:20px"></td></tr>';
$html .= '<tr>';
$html .= '<td style="width:100%; font-size:18px font-weight:400; text-align:left; "> Date of Issue - ' . $exam_period['certificate_issued_date'] . '</td>';
$html .= '</tr>';
// $html .= '<tr>';

// $html .= '<td style="width:100%; text-align:left; "><img src="' . $fileurl . '/qr-' . $STUDENT->id . '.png" style="margin-left:-5px;  width:60px" alt="qr" /></td>';
// $html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width:100%; font-size:16px; font-weight:400; text-align:left; ">Student No - '.$STUDENT->id.' </td>';
// $html .= '<td style="width:100%; font-size:12px; font-weight:400; text-align:left; padding:0px 0px;">(Student Verification)</td>';
$html .= '</tr>';
$html .= '<tr><td style="height:130px"></td></tr>';
$html .= '</table>';
$html .= '<table>';

$html .= '<tr><td style="height:185px"></td></tr>';
$html .= '<tr>';
  
    
    
     
$html .= '<tr>';
$html .= '<td style="width:140px; "></td>';
$html .= '<td style="width:240px;text-align:right"> </td>';
$html .= '<td style="width:80px; "></td>';
$html .= '<td style="width:200px;margin-left:10px;  text-align: left;">( '.$PROVINCE->name.' )</td>';
$html .= '</tr>';


 
$html .= '</table>';
$html .= '</div>';
$html .= '</div>';

}





echo $html;
// $html .= '<div style="page-break-after: always;"></div>';
// dd( $html);
// echo $html;
// exit;
// Instantiate and use the dompdf class
// $dompdf = new Dompdf();
// // Load HTML content
// $options = $dompdf->getOptions();
// $options->set(array('isRemoteEnabled' => true));
// $dompdf->setOptions($options);
// $dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
// $dompdf->setPaper('A4', 'portrait');

// // Render the HTML as PDF
// $dompdf->render();

// // Output the generated PDF to Browser
// $dompdf->stream('Final-Certificate-' . $STUDENT->id . '.pdf');
// dd($CENTER->center_name);

?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // jQuery function to print the page when it loads
    $(document).ready(function() {
        var css = '@page { size: a4; }',
            head = document.head || document.getElementsByTagName('head')[0],
            style = document.createElement('style');
        style.type = 'text/css';
        style.media = 'print';
        if (style.styleSheet) {
            style.styleSheet.cssText = css;
        } else {
            style.appendChild(document.createTextNode(css));
        }
        head.appendChild(style);
        window.print();
    });
</script>