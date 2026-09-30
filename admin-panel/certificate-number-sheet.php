<?php
require_once 'plugin/dompdf/autoload.inc.php';
include '../class/include.php';

use Dompdf\Dompdf;

$exam_id = $_GET['id'];
$center_id = $_GET['center'];
$year = $_GET['year'];
$batch = $_GET['batch'];

$EXAM_STUDENTS = new ExamStudent(NULL);
$STUDENT = new Student(NULL);
$students = $EXAM_STUDENTS->getExamIdPassedStudentsByExamIdAndCenter($exam_id, $center_id);
$EXAM = new SheduleExam($exam_id);
$CENTER = new Centers($center_id);
$COURSE = new Course($EXAM->course_id);

$html = '';
$html .= '<div style="width:100%; font-size:11px; font-family: Calibri, sans-serif;">';
$html .= '<h3 style="text-align:center;text-decoration:underline;">National Youth Services Council - Exam & Assessment Division</h3>';
$html .= '<h4 style="text-align:center;text-decoration:underline;">Certificate Issued Report - ' . date('F Y', strtotime($EXAM->start_date)) . ' Exam</h4>';
$html .= '<table style="width:100%; margin-top:10px;">';
$html .= '<tr><td><strong>Training Center:</strong></td><td>' . strtoupper($CENTER->center_name) . '</td></tr>';
$html .= '<tr><td><strong>Course Name:</strong></td><td>' . strtoupper($COURSE->cname) . '</td></tr>';
$html .= '<tr><td><strong>Course Type:</strong></td><td>' . ($COURSE->fullpart == 1 ? 'FULL TIME' : 'PART TIME') . '</td></tr>';
$html .= '<tr><td><strong>Duration:</strong></td><td>' . $COURSE->durationm  . ' Month (' . $year . ' Batch ' . $batch . ')</td></tr>';
$html .= '</table>';

$html .= '<table style="width:100%; border:1px solid #000; border-collapse:collapse; margin-top:10px;">';
$html .= '<thead>
<tr>';
$html .= '<th style="border:1px solid #000;">No</th>';
$html .= '<th style="border:1px solid #000;">Exam No (MIS No)</th>';
$html .= '<th style="border:1px solid #000;">Name with Initials</th>';
$html .= '<th style="border:1px solid #000;">Final Grade</th>';
$html .= '<th style="border:1px solid #000;">Certificate Number</th>';
$html .= '</tr>
</thead><tbody>';

foreach ($students as $index => $student) {
    $STUDENT = new Student($student['student_id']);
    $rowStyle = ($STUDENT->year != $year) ? 'background-color:#f8d7da; color:#721c24;' : '';

    $html .= '<tr style="' . $rowStyle . '">';
    $html .= '<td style="border:1px solid #000;text-align:center;">' . ($index + 1) . '</td>';
    $html .= '<td style="border:1px solid #000;text-align:center;">' . $STUDENT->id . ' (' . $STUDENT->year . '-' . $STUDENT->batch . ')</td>';
    $html .= '<td style="border:1px solid #000;">' . $STUDENT->fname . ' ' . $STUDENT->lname . '</td>';
    $html .= '<td style="border:1px solid #000;text-align:center;">' . ($student['grade'] ?? '-') . '</td>';
    $html .= '<td style="border:1px solid #000;text-align:center;">' . ($student['certificate_no'] ?? '-') . '</td>';
    $html .= '</tr>';
}

$html .= '</tbody></table>';
$html .= '<p><strong>Total Passed Students:</strong> ' . count($students) . '</p>';

$html .= '<p style="margin-top:20px; font-weight:600;"><u><b>Issued To:</b></u></p>';

$html .= '<table style="width:100%; border-collapse: collapse; font-size:11px; margin-top:10px;">';

// Signature
$html .= '<tr>';
$html .= '<td style="padding: 5px; width:20%;"><strong>Signature:</strong></td>';
$html .= '<td style="padding: 5px; width:40%;"><input type="text" style="border: none; border-bottom: 1px dotted #000; width: 40%; max-width: 5ch;"></td>';
$html .= '</tr>';

// Name
$html .= '<tr>';
$html .= '<td style="padding: 5px;"><strong>Name:</strong></td>';
$html .= '<td style="padding: 5px; width:80%;"><input type="text" style="border: none; border-bottom: 1px dotted #000; width: 40%; max-width: 5ch;"></td>';
$html .= '</tr>';

// Designation
$html .= '<tr>';
$html .= '<td style="padding: 5px;"><strong>Designation:</strong></td>';
$html .= '<td style="padding: 5px; width:80%;"><input type="text" style="border: none; border-bottom: 1px dotted #000; width: 40%; max-width: 5ch;"></td>';
$html .= '</tr>';

// Mobile Number
$html .= '<tr>';
$html .= '<td style="padding: 5px;"><strong>Mobile Number:</strong></td>';
$html .= '<td style="padding: 5px; width:80%;"><input type="text" style="border: none; border-bottom: 1px dotted #000; width: 40%; max-width: 5ch;"></td>';
$html .= '</tr>';

// Date
$html .= '<tr>';
$html .= '<td style="padding: 5px;"><strong>Date:</strong></td>';
$html .= '<td style="padding: 5px; width:80%;"><input type="text" style="border: none; border-bottom: 1px dotted #000; width: 40%; max-width: 5ch;"></td>';
$html .= '</tr>';

$html .= '</table>';



//add sample table
$html .= '<p style="margin-top:30px; font-weight:600;"><u><b>Re Issued Certificated:</b></u></p>';
$html .= '<table style="width:100%; border:1px solid #000; border-collapse:collapse; font-size:11px; margin-top:10px;">';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th style="border:1px solid #000;">No</th>';
$html .= '<th style="border:1px solid #000;"> MIS No</th>';
$html .= '<th style="border:1px solid #000;">Name (Initials)</th>';
 $html .= '<th style="border:1px solid #000;">Cer No</th>';
$html .= '<th style="border:1px solid #000;">Issued To</th>';
$html .= '</tr>';
$html .= '<tbody>';

// 5 Sample Rows
for ($i = 1; $i <= 5; $i++) {
    $html .= '<tr>';
    $html .= '<td style="border:1px solid #000; padding:5px; text-align:center; height:35px;">' . $i . '</td>';
    $html .= '<td style="border:1px solid #000; padding:5px; height:35px;"></td>';
    $html .= '<td style="border:1px solid #000; padding:5px; height:35px;"></td>';
    $html .= '<td style="border:1px solid #000; padding:5px; text-align:center; height:35px;"></td>';
     
     $html .= '<td style="border:1px solid #000; padding:5px; height:35px;"></td>';
    $html .= '</tr>';
}


$html .= '</tbody></table>';

// Generate PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$filename = "Certificate_Report_" . date("Ymd_His") . ".pdf";
$dompdf->stream($filename, ["Attachment" => true]);
exit;
