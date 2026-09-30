<?php
// Include autoloader 
require_once 'plugin/dompdf/autoload.inc.php';
include '../class/include.php';
include('./plugin/phpqrcode/qrlib.php');

// Reference the Dompdf namespace 
use Dompdf\Dompdf;

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$serverName = $_SERVER['SERVER_NAME'];
$port = $_SERVER['SERVER_PORT'];
$portSuffix = ($protocol === 'http' && $port != 80) || ($protocol === 'https' && $port != 443) ? ':' . $port : '';
$basePath = dirname($_SERVER['PHP_SELF']);
$baseUrl = "$protocol://$serverName$portSuffix$basePath";
$domain = $_SERVER['SERVER_NAME'];

$exam_id = $_GET['id'];
$center_id = $_GET['center'];
$year = $_GET['year'];
$batch = $_GET['batch'];

$EXAM_STUDENTS = new ExamStudent(NULL);
$students = $EXAM_STUDENTS->getCertificateNotIssuedPassedStudentsByExamIdAndCenter($exam_id, $center_id, $year, $batch);
$EXAM = new SheduleExam($exam_id);
$CENTER = new Centers($center_id);
$COURSE = new Course($EXAM->course_id);
$fileurl = "$baseUrl/qr/certificates";
$fileurl1 = "$baseUrl/assets/images/signatures/";
if ($batch == 1) {
    $period = '01<sup>st</sup> January to 30<sup>th</sup> June';
} else {
    $period = '01<sup>st</sup> July to 31<sup>st</sup>December';
}
$html = '';
foreach ($students as $student) {
    $STUDENT = new Student($student['student_id']);

    $url = "$domain/student/profile.php?id=" . $student['student_id'];
    QRcode::png($url, "qr/certificates/qr-$STUDENT->id.png", QR_ECLEVEL_L, 6);

    $html .= '<div style="size: A4 portrait;width:100%; font-size:15px; font-family: Calibri, sans-serif;">';
    $html .= '<div style="margin: auto; width: fit-content; padding: 30px 0 30px 30px;">';
    $html .= '<table style="width:100%;margin-top:20px">';
    $html .= '<tr>';
    $html .= '<td style="width:100%; text-align:right; "><img src="' . $fileurl . '/qr-' . $STUDENT->id . '.png" style="margin-left:0px;  width:60px" alt="qr" /></td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td style="width:100%; height:100px;"></td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td style="width:100%; text-align:left; font-weight:400; padding:5px 0px;">This is to certify that</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td style="width:100%; font-size:18px; padding:5px 0px; font-weight:700; text-align:left;">' . ucfirst($STUDENT->fname) . ' ' . ucfirst($STUDENT->lname) . '</td>';
    $html .= '</tr>';
    $html .= '<tr><td style="height:30px"></td></tr>';
    $html .= '<tr>';
    $html .= '<td style="width:100%; font-weight:400; text-align:left; padding:5px 0px;">Was awarded the</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td style="width:100%; font-size:18px; padding:5px 0px; font-weight:700; text-align:left;">' . $COURSE->cname . '</td>';
    $html .= '</tr>';
    $html .= '<tr><td style="height:15px"></td></tr>';
    $html .= '<tr>';
    $html .= '<td style="width:100%; font-weight:400; text-align:left; padding:5px 0px;">Qualifications</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td style="width:100%; font-size:18px; padding:5px 0px; font-weight:700; text-align:left;"></td>';
    $html .= '</tr>';
    $html .= '<tr><td style="height:30px"></td></tr>';
    $html .= '<tr>';
    $html .= '<td style="width:100%; font-weight:400; text-align:left; padding:5px 0px;">Conducted by National Youth Services Training Center</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td style="width:100%; font-size:18px; padding:5px 0px; font-weight:700; text-align:left;">' . $CENTER->center_name . '</td>';
    $html .= '</tr>';
    $html .= '<tr><td style="height:30px"></td></tr>';
    $html .= '<tr>';
    $html .= '<td style="width:100%; font-weight:400; text-align:left; padding:5px 0px;">During the period</td>';
    $html .= '</tr>';
    $html .= '<tr>';
    $html .= '<td style="width:100%; font-size:18px; padding:5px 0px; font-weight:700; text-align:left;">' . $period . '</td>';
    $html .= '</tr>';
    $html .= '<tr><td style="height:60px"></td></tr>';
    $html .= '<tr>';
    $html .= '<td style="width:100%; font-size:18px font-weight:400; text-align:left; font-weight:600;">Issue Date - ' . $_GET['issue_date'] . '</td>';
    $html .= '</tr>';
    $html .= '<tr><td style="height:100px"></td></tr>';
    $html .= '</table>';
    $html .= '<table>';
    $html .= '<tr>';
    $html .= '<td style="width:160px; "></td>';
    $html .= '<td style="width:200px;"><img src="' . $fileurl1 . '1.png" style="width:140px" alt="Director Signature" /></td>';
    $html .= '<td style="width:50px; "></td>';
    $html .= '<td style="width:200px;"><img src="' . $fileurl1 . '2.png" style="width:150px;margin-top:30px;" alt="Chairman Signature" /></td>';
    $html .= '</tr>';
    $html .= '</table>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div style="page-break-after: always;"></div>';
}

// dd( $html);
// echo $html;
// exit;
// Instantiate and use the dompdf class 
$dompdf = new Dompdf();
// Load HTML content 
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation 
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF 
$dompdf->render();

// Output the generated PDF to Browser 
$dompdf->stream(strtoupper($COURSE->courseid) . '-' . strtoupper($CENTER->center_name) . '-Certificates.pdf');
// dd($CENTER->center_name);
