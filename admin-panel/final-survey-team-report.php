<?php

// Include autoloader 
require_once 'plugin/dompdf/autoload.inc.php';
include '../class/include.php';

// Reference the Dompdf namespace 
use Dompdf\Dompdf;

$id = $_GET['id'];  
$row_height =  '15px';  
 
 


$html = '';
$html .= '<div style="size: A4 portrait;width:100%; font-size:12px; font-family: Calibri, sans-serif;">';
$html .= '<table style="width:100%;">';
$html .= '<tr>';
$html .= '<td style="width:100%; font-weight:600; text-align:center; text-decoration: underline;font-size=18px;">National Youth Services Council - Student Attendance Report </td>';
$html .= '</tr>';  
$html .= '</table>';
$html .= '<table style="width:100%;margin-top:20px">';
$html .= '<tr>';
 


$html .= '</table>';
//3rd table
$html .= '<table style="width:100%;border:2px solid #000;margin-top:10px">';
$html .= '<tr>';
$html .= '<th style="width:5%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">No</th>';
$html .= '<th style="width:20%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">Student No (MIS No)</th>'; 
$html .= '</tr>';
 $GNDIVISION = new Gndivision(NULL);
foreach ($GNDIVISION->GetGnByDsdivision($id) as $key => $gn_division) {  
   
    $key++;
    $html .= '<tr>';
    $html .= '<td style="height:' . $row_height . ';font-size:11px;border:1px solid #000; text-align:center; vertical-align:middle;"> ' . $key . '</td>';
    $html .= '<td style="height:' . $row_height . ';font-size:11px;border:1px solid #000; text-align:center; vertical-align:middle;"> ' . $gn_division['name'] . '</td>';
    
    $html .= '</tr>';
}
$html .= '<tr>';
$html .= '<td style="height:' . $row_height . ';font-size:11px;border:1px solid #000; text-align:center; vertical-align:middle;font-weight:600" colspan="2">Number of Total Students</td>';
$html .= '<td style="height:' . $row_height . ';font-size:11px;border:1px solid #000; text-align:center; vertical-align:middle;" colspan="6">' . count($students) . '</td>';
$html .= '</tr>'; 

$html .= '</table>';
  


$html .= '</div>';

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
$dompdf->stream('Final-report-gn-'. $id . '.pdf');
