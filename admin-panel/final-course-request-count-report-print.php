<?php
// Include autoloader 
require_once 'plugin/dompdf/autoload.inc.php';
include '../class/include.php';

// Reference the Dompdf namespace 
use Dompdf\Dompdf;

$year = '';
$batch = '';
if (isset($_GET['year'])) {
    $year = $_GET['year'];
}
if (isset($_GET['batch'])) {
    $batch = $_GET['batch'];
}

$EXAM_PERIOD = new ExamPeriod(null);
$exam_period = $EXAM_PERIOD->getExamPeriodByYearAndBatch($year, $batch);

$batch_start_date = $exam_period['batch_start_date'];
$batch_end_date = $exam_period['batch_end_date'];
// Parse the start date
$start = DateTime::createFromFormat('Y-m-d', $batch_start_date);
$end = DateTime::createFromFormat('Y-m-d', $batch_end_date);
$period = $start->format('F') . ' - ' . $end->format('F');

$title =  ' Course Request Details Report';
$html = '';
$html .= '<div style="size: A4 portrait;width:100%; font-size:11px; font-family: Calibri, sans-serif;">';
$html .= '<form action="final-results-by-center-report.php" class="report-form" method="get">';
$html .= '<table style="width:100%;">';
$html .= '<tr>';
$html .= '<td style="width:100%; font-size:30px; font-weight:600; text-align:center; text-decoration: underline;">' . $title . '</td>';
$html .= '</tr>';
// $html .= '<tr>';
// $html .= '<td style="width:100%; font-weight:600; text-align:center; text-decoration: underline;">Final Results of Vocational Training & Language Courses</td>';
// $html .= '</tr>';
// $html .= '<tr>';
// $html .= '<td style="width:100%; font-weight:600; text-align:center; text-decoration: underline;">' . date('Y', strtotime($EXAM->start_date)) . ' ' . date('F', strtotime($EXAM->start_date)) . ' Exam</td>';
// $html .= '</tr>';
$html .= '</table>';
//3rd table
$html .= '<table style="width:100%;border:0px solid #000;margin-top:30px">';
$html .= '<tr>';
$html .= '<th style="width:5%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">No#</th>';
$html .= '<th style="width:5%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">Province</th>';
$html .= '<th style="width:10%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">District</th>';
$html .= '<th style="width:20%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">Training Center</th>';
$html .= '<th style="width:10%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">Course Name</th>';
$html .= '<th style="width:10%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">Full / Part / Short</th>';
$html .= '<th style="width:10%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;"> NVQ Level</th>';
$html .= '<th style="width:10%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">Durarion (Month)</th>';
$html .= '<th style="width:10%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">Batch</th>';
$html .= '<th style="width:10%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">Students</th>';
$html .= '<th style="width:10%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">Drop Out</th>';
$html .= '<th style="width:10%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">Passed Exam</th>';
$html .= '<th style="width:10%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">Repeat Students</th>';
$html .= '<th style="width:10%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">AB Students</th>';
$html .= '</tr>';


$COURSE_REQUEST  = new CourseRequest(NULL);

foreach ($COURSE_REQUEST->getCourseIdByYearAndBatch($year, $batch) as $key => $request) {
    $key++;

    $CENTERS = new Centers($request['center_id']);
    $DISTRICT = new Districts($CENTERS->districid);
    $PROVINCE = new Province($DISTRICT->province);
    $COURSE = new Course($request['course_id']);
    $STUDENT = new Student(NULL);


    if ($COURSE->fullpart == 1) {
        $type = '<span class="text-warning"> Full Time </span>';
    } else if ($COURSE->fullpart == 2) {
        $type = '<span class="text-info">  Part Time </span>';
    } else {
        $type = '<span class="text-info">  Short Time </span>';
    }


    $all_students =  $STUDENT->getStudentIDArrayByCourseAndBatchWithDropCount($request['course_id'], $year, $request['batch'], $request['center_id']);
    $dropout_students =  count($STUDENT->getDropOutStudentByCourseYearBatch($request['course_id'], $year, $request['batch'], $request['center_id']));
    $EXAMSTUDENT = new ExamStudent(null);
    $passed_students = $EXAMSTUDENT->getPassStudentCount($year, $request['batch'], $request['course_id'], $request['center_id']);
    $repeat_students = $EXAMSTUDENT->getFaillStudentCount($year, $request['batch'], $request['course_id'], $request['center_id']);
    $ab_students = $EXAMSTUDENT->getAbStudentsByCenterYearAndBatch($request['center_id'], $year, $request['batch']);

    $html .= '<tr>';
    $html .= '<td style="width:5%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;">' . $key . '</td>';
    $html .= '<td style="width:20%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;">' . $PROVINCE->name . '</td>';
    $html .= '<td style="width:20%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;">' . $DISTRICT->name . '</td>';
    $html .= '<td style="width:20%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;">' . $CENTERS->center_name . '</td>';
    $html .= '<td style="width:15%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;">' . $COURSE->cname . '</td>';
    $html .= '<td style="width:8%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;">' . $type . '</td>';
    $html .= '<td style="width:8%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;">' . $COURSE->level . '</td>';
    $html .= '<td style="width:8%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;">' . $COURSE->durationm . '</td>';
    $html .= '<td style="width:5%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;">' . $request['batch'] . '</td>';
    $html .= '<td style="width:10%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;">' .  $all_students  . '</td>';
    $html .= '<td style="width:10%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;">' . $dropout_students . '</td>';
    $html .= '<td style="width:10%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;">' . $passed_students . '</td>';
    $html .= '<td style="width:10%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;">' . $repeat_students . '</td>';
    $html .= '<td style="width:10%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;">' . $ab_students . '</td>';

    $html .= '</tr>';
}


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

$report_title = $year . '_' . $period . '_Student_Applications.pdf';
$dompdf->stream($report_title);
