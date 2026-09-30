<?php
// Include autoloader 
require_once 'plugin/dompdf/autoload.inc.php';
include '../class/include.php';

// Reference the Dompdf namespace 
use Dompdf\Dompdf;

$exam_id = $_GET['id'];
$center_id = $_GET['center'];
$year = $_GET['year'];
$batch = $_GET['batch'];

$EXAM_STUDENTS = new ExamStudent(NULL);
$STUDENT = new Student(NULL);
$students = $EXAM_STUDENTS->getPassedStudentsByExamIdAndCenter($exam_id, $center_id, $year, $batch);
// dd($students);
$resit_students = $EXAM_STUDENTS->getReSitStudentsByExamIdAndCenter($exam_id, $center_id, $year, $batch);
$ab_students = $EXAM_STUDENTS->getAbStudentsByExamIdAndCenter($exam_id, $center_id, $year, $batch);
$EXAM = new SheduleExam($exam_id);
$CENTER = new Centers($center_id);
$COURSE = new Course($EXAM->course_id);



$html = '';
$html .= '<div style="size: A4 portrait;width:100%; font-size:11px; font-family: Calibri, sans-serif;">';
$html .= '<table style="width:100%;border:2px solid #000;">';
$html .= '<tr>';
$html .= '<td style="width:15%; font-weight:600; text-align:center;border:1px solid #000;">Center</td>';
$html .= '<td style="width:30%; font-weight:600; text-align:center;border:1px solid #000;">Course</td>';
$html .= '<td style="width:40%; font-weight:600; text-align:center;border:1px solid #000;">Name</td>';
$html .= '<td style="width:15%; font-weight:600; text-align:center;border:1px solid #000;">Division</td>';
$html .= '</tr>';
foreach ($students as $key => $student) {
    $STUDENT = new Student($student['student_id']);
    $key++;
    $html .= '<tr>';
    $html .= '<td style="width:15%; text-align:left;border:1px solid #000;">' .$CENTER->center_name . '</td>';
    $html .= '<td style="width:30%; text-align:left;border:1px solid #000;">' .$COURSE->cname . '</td>';
    $html .= '<td style="width:40%; text-align:left;border:1px solid #000;">' .$STUDENT->fname . ' ' . $STUDENT->lname . '</td>';
    $html .= '<td style="width:15%; text-align:left;border:1px solid #000;">' . $student['grade'] . '</td>';
    $html .= '</tr>';
}
$html .= '</table>';
$html .= '</div>';
echo $html;
exit();
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
$dompdf->stream('Results-By-Center-Report-2-' . $exam_id . '-' . $center_id . '.pdf');
