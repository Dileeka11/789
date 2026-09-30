<?php

// Include autoloader 
require_once 'plugin/dompdf/autoload.inc.php';
include '../class/include.php';

// Reference the Dompdf namespace 
use Dompdf\Dompdf;

$course = $_GET['course'];
$center_id = $_GET['center'];
$year = $_GET['course_year'];
$batch = $_GET['course_batch'];
$row_height = $_GET['row_height'] . 'px';

$STUDENTS = new Student(NULL);
$students = $STUDENTS->getDropOutStudentByCourseYearBatch($course, $year, $batch, $center_id);
 
$CENTER = new Centers($center_id);
$COURSE = new Course($course);



$html = '';
$html .= '<div style="size: A4 portrait;width:100%; font-size:11px; font-family: Calibri, sans-serif;">';
$html .= '<table style="width:100%;">';
$html .= '<tr>';
$html .= '<td style="width:100%; font-weight:600; text-align:center; text-decoration: underline;font-size=18px;">National Youth Services Council - Drop Out Student Details Report </td>';
$html .= '</tr>';  
$html .= '</table>';
$html .= '<table style="width:100%;margin-top:20px">';
$html .= '<tr>';
$html .= '<td style="width:30%; font-weight:400; text-align:left; font-weight:600;">Name of the Training Center</td>';
$html .= '<td style="width:2%; font-weight:400; text-align:center;">:-</td>';
$html .= '<td style="width:68%; font-weight:400; text-align:left;">' . strtoupper($CENTER->center_name) . '</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width:30%; font-weight:400; text-align:left; font-weight:600;">Course Name</td>';
$html .= '<td style="width:2%; font-weight:400; text-align:center;">:-</td>';
$html .= '<td style="width:68%; font-weight:400; text-align:left;">'.$COURSE->courseid.' - ' . strtoupper($COURSE->cname) . '</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width:30%; font-weight:400; text-align:left; font-weight:600;">Type of the Course</td>';
$html .= '<td style="width:2%; font-weight:400; text-align:center;">:-</td>';
$html .= '<td style="width:68%; font-weight:400; text-align:left;"> ' . ($COURSE->fullpart == 1 ? 'FULL TIME' : 'PART TIME'). '  LEVEL - ' . $COURSE->level.'</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width:30%; font-weight:400; text-align:left; font-weight:600;">Duration</td>';
$html .= '<td style="width:2%; font-weight:400; text-align:center;">:-</td>';
$html .= '<td style="width:68%; font-weight:400; text-align:left;">' . $COURSE->durationm  . ' Month (' . $year . ' Batch ' . $batch . ')</td>';
$html .= '</tr>';
$html .= '</table>';
//3rd table
$html .= '<table style="width:100%;border:2px solid #000;margin-top:10px">';
$html .= '<tr>';
$html .= '<th style="width:5%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">No</th>';
$html .= '<th style="width:30%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">Student No (MIS No)</th>';
$html .= '<th style="width:35%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">NIC</th>';
$html .= '<th style="width:55%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">Name with Initials</th>'; 

$html .= '<th style="width:20%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">Drop Out Date </th>'; 
$html .= '</tr>';
foreach ($students as $key => $student) {   
    $STUDENT = new Student($student['id']);
    $APP = new Applications($STUDENT->application_id);
    $key++;
    $html .= '<tr>';
    $html .= '<td style="height:' . $row_height . ';font-size:11px;border:1px solid #000; text-align:center; vertical-align:middle;"> ' . $key . '</td>';
    $html .= '<td style="height:' . $row_height . ';font-size:11px;border:1px solid #000; text-align:center; vertical-align:middle;"> ' . $STUDENT->id . '</td>';
     $html .= '<td style="height:' . $row_height . ';font-size:11px;border:1px solid #000; text-align:left; vertical-align:middle;">' .  $STUDENT->nic . ' </td>';
    $html .= '<td style="height:' . $row_height . ';font-size:11px;border:1px solid #000; text-align:left; vertical-align:middle;">' . $STUDENT->fname . ' ' . $STUDENT->lname . ' </td>';
   
   $html .= '<td style="height:' . $row_height . ';font-size:11px;border:1px solid #000; text-align:left; vertical-align:middle;">' .  $STUDENT->drop_out_date . ' </td>';

     
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
$dompdf->stream('Final-Results-' . $course . '-' . $center_id . '.pdf');
