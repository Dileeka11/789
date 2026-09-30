<?php

require_once 'plugin/dompdf/autoload.inc.php';
include '../class/include.php';

use Dompdf\Dompdf;

$center_id = $_GET['center'];
$year = $_GET['course_year'];
$batch = $_GET['course_batch'];
$row_height = $_GET['row_height'] . 'px';

// Fetch data
$courseRequests = CourseRequest::getDetailedCourseRequests($center_id, $year, $batch);

$html = '';
$html .= '<div style="size: A4 portrait;width:100%; font-size:11px; font-family: Calibri, sans-serif;">';

$html .= '<h3 style="text-align:center; text-decoration: underline; font-weight:bold;">National Youth Services Council - Course Request Report</h3>';

$html .= '<table style="width:100%;border:2px solid #000;margin-top:10px;border-collapse: collapse;">';
$html .= '<tr>';
$html .= '<th style="border:1px solid #000;padding:5px;">No</th>';
$html .= '<th style="border:1px solid #000;padding:5px;">Course ID - Name</th>';
$html .= '<th style="border:1px solid #000;padding:5px;">Year</th>';
$html .= '<th style="border:1px solid #000;padding:5px;">Batch</th>';
$html .= '<th style="border:1px solid #000;padding:5px;">Center Name</th>';
$html .= '<th style="border:1px solid #000;padding:5px;">No. of Students</th>';
$html .= '<th style="border:1px solid #000;padding:5px;">Course Fee</th>';
$html .= '<th style="border:1px solid #000;padding:5px;">Teaching Days</th>';
$html .= '<th style="border:1px solid #000;padding:5px;">Request Date</th>';
$html .= '<th style="border:1px solid #000;padding:5px;">Status</th>';
$html .= '</tr>';

$i = 0;
foreach ($courseRequests as $data) {
    $i++;
    $course_fee = 'Rs. ' . number_format((float)$data['course_fee'], 2, '.', ',');

    // Status formatting
    if ($data['status'] == '1') {
        $status = '<span style="color:green;font-weight:bold;">Approved</span>';
    } elseif ($data['status'] == '2') {
        $status = '<span style="color:red;font-weight:bold;">Rejected</span>';
    } else {
        $status = '<span style="color:gray;font-weight:bold;">Pending</span>';
    }

    $html .= '<tr>';
    $html .= '<td style="border:1px solid #000;padding:5px;text-align:center;">' . $i . '</td>';
    $html .= '<td style="border:1px solid #000;padding:5px;">' . $data['course_id'] . ' - ' . $data['course_name'] . '</td>';
    $html .= '<td style="border:1px solid #000;padding:5px;text-align:center;">' . $data['year'] . '</td>';
    $html .= '<td style="border:1px solid #000;padding:5px;text-align:center;">' . $data['batch'] . '</td>';
    $html .= '<td style="border:1px solid #000;padding:5px;">' . $data['center_name'] . '</td>';
    $html .= '<td style="border:1px solid #000;padding:5px;text-align:right;">' . $data['all_student'] . '</td>';
    $html .= '<td style="border:1px solid #000;padding:5px;text-align:right;">' . $course_fee . '</td>';
    $html .= '<td style="border:1px solid #000;padding:5px;text-align:center;">' . $data['teaching_days'] . '</td>';
    $html .= '<td style="border:1px solid #000;padding:5px;text-align:center;">' . $data['request_date'] . '</td>';
    $html .= '<td style="border:1px solid #000;padding:5px;text-align:center;">' . $status . '</td>';
    $html .= '</tr>';
}

$html .= '</table>';
$html .= '</div>';

// Generate PDF
$dompdf = new Dompdf();
$options = $dompdf->getOptions();
$options->set(['isRemoteEnabled' => true]);
$dompdf->setOptions($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream('Course_Request_Report_' . $center_id . '_' . $year . '_' . $batch . '.pdf');
