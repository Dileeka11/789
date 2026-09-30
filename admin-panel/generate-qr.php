<?php
require_once 'plugin/dompdf/autoload.inc.php';
include '../class/include.php';
include './auth.php';
include('./plugin/phpqrcode/qrlib.php');

use Dompdf\Dompdf;

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$serverName = $_SERVER['SERVER_NAME'];
$port = $_SERVER['SERVER_PORT'];
$portSuffix = ($protocol === 'http' && $port != 80) || ($protocol === 'https' && $port != 443) ? ':' . $port : '';
$basePath = dirname($_SERVER['PHP_SELF']);
$baseUrl = "$protocol://$serverName$portSuffix$basePath";

$request_id = $_GET['id'];
// $request_id = 10;
$COURSE_REQUEST = new CourseRequest($request_id);
$COURSE = new Course($COURSE_REQUEST->course_id);
$CENTER = new Centers($COURSE_REQUEST->center_id);
$domain = $_SERVER['SERVER_NAME'];
$url = "$domain/application.php?id=$request_id";
$fileurl = "$baseUrl/qr";

if($COURSE->fullpart == 1){
    $name = 'Full Time';
}else if($COURSE->fullpart == 2){
     $name = 'Part Time';
}else{
     $name = 'Short Time';
}

// outputs image directly into browser, as PNG stream
// QRcode::png($url);

QRcode::png($url, "qr/qr-$request_id.png", QR_ECLEVEL_L, 15);

$html = '';
$html .= '<div style="size: A4 portrait;width:100%; font-size:11px; font-family: Calibri, sans-serif;">';
$html .= '<table style="width:100%;">';
$html .= '<tr>';
$html .= '<td style="width:100%; font-weight:600; text-align:center; text-decoration: underline; font-size:30px">'. $COURSE->cname .' - '. $name .' (M 0'.$COURSE->durationm .') </br>  Level - '.  $COURSE->level . ' | ' . $COURSE_REQUEST->year .' - Batch 0' . $COURSE_REQUEST->batch . '</td>';
$html .= '</tr>';
$html .= '</table>';
$html .= '<table style="width:100%;margin-top:50px">';
$html .= '<tr>';
$html .= '<td style="width:100%; text-align:center; "><img src="' . $fileurl . '/qr-' . $request_id . '.png" alt="qr" /></td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width:100%; text-align:center; font-size:20px">Scan for Registration</td>';
$html .= '</tr>';
$html .= '</table>';
$html .= '</div>';
// echo $html;
// exit;

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
$dompdf->stream('Course-QR-' . $request_id . '.pdf');
