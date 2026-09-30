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
if ($batch == 1) {
    $period = 'January - June';
} else {
    $period = 'July - December';
}
$title = $year . ' ' . $period . ' Student Applications';
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
$html .= '<th style="width:15%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">Province</th>';
$html .= '<th style="width:20%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">District</th>';
$html .= '<th style="width:5%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">No</th>';
$html .= '<th style="width:20%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">Center</th>';
$html .= '<th style="width:10%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">Application count</th>';
$html .= '<th style="width:10%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">Full time count</th>';
$html .= '<th style="width:10%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">Part time count</th>';
$html .= '<th style="width:10%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">Short time count</th>';
$html .= '</tr>';
$PROVINCE = new Province(null);
$provinces = $PROVINCE->all();
$count = 0;
$total_application_students = 0;
$total_fulltime_students = 0;
$total_parttime_students = 0;
$total_shorttime_students = 0;
foreach ($provinces as $key => $province) {
    $DISTRICT = new Districts(null);
    $districts = $DISTRICT->getDistrictByProvince($province['id']);
    $center_count = 0;
    foreach ($districts as $district) {
        $CENTER = new Centers(null);
        $centers = $CENTER->getCentersByDistrictId($district['id']);
        if (count($centers) == 0) {
            $center_count += 1;
        } else {
            $center_count += count($centers);
        }
    }
    if ($key > 0) {
        $html .= '<tr>';
    }
    $key++;
    $html .= '<tr>';
    $html .= '<td rowspan="' . $center_count . '" style="width:15%; padding:3px;border:1px solid #000;text-align:left; vertical-align:middle;">' . $province['name'] . '</td>';
    foreach ($districts as $key1 => $district) {
        $CENTER = new Centers(null);
        $centers = $CENTER->getCentersByDistrictId($district['id']);
        if ($key1 > 0) {
            $html .= '<tr>';
        }
        $key1++;
        $html .= '<td rowspan="' . count($centers) . '" style="width:20%; padding:3px;border:1px solid #000;text-align:left; vertical-align:middle;">' . $district['name'] . '</td>';
        if (count($centers) > 0) {
            foreach ($centers as $key2 => $center) {
                $APPLICATION = new Applications(null);
                $applications = $APPLICATION->getApplicationsCountByCenterYearAndBatch($center['centercode'], $year, $batch);
                $fulltime_applications = $APPLICATION->getApplicationsCountByTypeCenterYearAndBatch($center['centercode'], 1, $year, $batch);
                $parttime_applications = $APPLICATION->getApplicationsCountByTypeCenterYearAndBatch($center['centercode'], 2, $year, $batch);
                $shorttime_applications = $APPLICATION->getApplicationsCountByTypeCenterYearAndBatch($center['centercode'], 3, $year, $batch);

                $total_application_students += $applications;
                $total_fulltime_students += $fulltime_applications;
                $total_parttime_students += $parttime_applications;
                $total_shorttime_students += $shorttime_applications;
                if ($key2 > 0) {
                    $html .= '<tr>';
                }
                $key2++;
                $count++;
                $html .= '<td style="width:5%; padding:3px;border:1px solid #000;text-align:left; vertical-align:middle;">' . $count . '.</td>';
                $html .= '<td style="width:20%; padding:3px;border:1px solid #000;text-align:left; vertical-align:middle;">' . $center['center_name'] . '</td>';
                $html .= '<td style="width:10%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;">' . $applications . '</td>';
                $html .= '<td style="width:10%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;">' . $fulltime_applications . '</td>';
                $html .= '<td style="width:10%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;">' . $parttime_applications . '</td>';
                $html .= '<td style="width:10%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;">' . $shorttime_applications . '</td>';
                $html .= '</tr>';
            }
        } else {
            $html .= '<td style="width:5%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;">-</td>';
            $html .= '<td style="width:20%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;">-</td>';
            $html .= '<td style="width:10%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;">-</td>';
            $html .= '<td style="width:10%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;">-</td>';
            $html .= '<td style="width:10%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;">-</td>';
            $html .= '<td style="width:10%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;">-</td>';
            $html .= '</tr>';
        }
    }

    $html .= '</tr>';
}
$html .= '<td style="width:20%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;"></td>';
$html .= '<td style="width:15%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;"></td>';
$html .= '<td style="width:5%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;"></td>';
$html .= '<td style="width:20%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;"></td>';
$html .= '<td style="width:10%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle; font-weight:600;">' . $total_application_students . '</td>';
$html .= '<td style="width:10%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle; font-weight:600;">' . $total_fulltime_students . '</td>';
$html .= '<td style="width:10%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle; font-weight:600;">' . $total_parttime_students . '</td>';
$html .= '<td style="width:10%;padding:3px;border:1px solid #000;text-align:center; vertical-align:middle; font-weight:600;">' . $total_shorttime_students . '</td>';
$html .= '</tr>';
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
if ($batch == 1) {
    $period = 'January_June';
} else {
    $period = 'July_December';
}
$report_title = $year . '_' . $period . '_Student_Applications.pdf';
$dompdf->stream($report_title);
