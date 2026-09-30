<?php
// Include autoloader 
require_once 'plugin/dompdf/autoload.inc.php';
include '../class/include.php';

// Reference the Dompdf namespace 
use Dompdf\Dompdf;

$year = '';
$batch = '';
$center_id = '';

if (isset($_GET['year'])) {
    $year = $_GET['year'];
}

if (isset($_GET['batch'])) {
    $batch = $_GET['batch'];
}

if (isset($_GET['center_id'])) {
    $center_id = $_GET['center_id'];
}




if ($batch == 1) {
    $period = 'January - June';
} else {
    $period = 'July - December';
}


$count = 0;
$total_all_students = 0;
$total_passed_students = 0;
$total_ab_students = 0;
$total_failed_students = 0;
 
$title =  ' Final Student Exam Report - ' .$year.'  - ( ' . $period . ' )';
$html = '';
$html .= '<div style="size: A4 portrait;width:100%; font-size:11px; font-family: Calibri, sans-serif;">';
$html .= '<form action="final-results-by-center-report.php" class="report-form" method="get">';
$html .= '<table style="width:100%;">';
$html .= '<tr>';
$html .= '<td style="width:100%; font-size:25px; font-weight:600; text-align:center; text-decoration: underline;">' . $title . '</td>';
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



$html .= ' <tr class="bg-transparent" style="width:5%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;"> 
                 <th style="width:5%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle; ">No </th>
                 <th colspan="1" style="width:50%; padding:3px;border:1px solid #000;text-align:left; vertical-align:middle; "> Course Name </th>
                 <th style="width:5%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle; "> Total Student </th>
                 <th style="width:5%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle; "> Pass Student </th>
                 <th style="width:5%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle; "> Fail Student </th>
                 <th style="width:5%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle; "> AB Student </th>
                 </tr>
                 </thead>
                 <tbody';
                 
     
if($center_id == 1){
 

$CENTERS  = new Centers(NULL);
                                                   
foreach($CENTERS->all() as $key=> $centers){
         $key++; 
         
          $html .= '<tr > <td colspan="6" class="text-center text-danger" style="width:5%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;font-weight: 600;  text-transform: uppercase;">'.$centers["center_name"].'</td>   </tr>';
   
   
   
            $CENTER_COURSE = new CenterCourses(null);
            $STUDENTS =  new Student(null);
            $EXAM_STUDENTS = new ExamStudent(null);
             
        foreach($CENTER_COURSE->getcourseDetailsCenters($centers["centercode"]) as $key=>$course){
       
        
        $total_student = $STUDENTS->getStudentCountForExam($year,$batch,$course["courseid"],$centers["centercode"]);
         $total_pass_students = $EXAM_STUDENTS->getPassStudentCountByCourse($centers["centercode"],$course["courseid"],$year, $batch);
          $total_faill_students = $EXAM_STUDENTS->getFailStudentCountByCourse($centers["centercode"],$course["courseid"],$year, $batch);
          
        // $total_pass_students = $EXAM_STUDENTS->getPassStudentCount($year, $batch, $course["courseid"],$centers["centercode"]);
        // $total_faill_students = $EXAM_STUDENTS->getFaillStudentCount($year, $batch, $course["courseid"],$centers["centercode"]);
        $total_absent_student = $total_student - ($total_faill_students +$total_pass_students);
        
        $total_all_students +=$total_student;
        $total_passed_students +=$total_pass_students;
        $total_failed_students += $total_faill_students;
        $total_ab_students += $total_absent_student;
         
        $key++;
              $html .='<tr>
                        <td style="width:5%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle; "> '.$key.' </td> 
                        <td style="width:50%; padding:3px;border:1px solid #000;text-align:left; vertical-align:middle; "> '.$course["courseid"] .' - '.$course["cname"].'</td>
                        <td style="width:5%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle; ">  '.$total_student.'</td>
                        <td style="width:5%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle; "> '.$total_pass_students.' </td>
                        <td style="width:5%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle; "> '.$total_faill_students.'</td>
                         <td style="width:5%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle; "> '.$total_absent_student .'</td>
                     </tr>';
        }
        
        
        
        
}

}else{
    
    
    $CENTERS  = new Centers($center_id);
    
    
         $key++; 
         
          $html .= '<tr > <td colspan="6" class="text-center text-danger" style="width:5%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle;font-weight: 600;  text-transform: uppercase;">'.$CENTERS->center_name.'</td>   </tr>';
   
   
   
            $CENTER_COURSE = new CenterCourses(null);
            $STUDENTS =  new Student(null);
            $EXAM_STUDENTS = new ExamStudent(null);
             
        foreach($CENTER_COURSE->getcourseDetailsCenters($center_id) as $key=>$course){
       
        
        $total_student = $STUDENTS->getStudentCountForExam($year,$batch,$course["courseid"],$center_id);
        $total_pass_students = $EXAM_STUDENTS->getPassStudentCount($year, $batch, $course["courseid"],$center_id);
        $total_faill_students = $EXAM_STUDENTS->getFaillStudentCount($year, $batch, $course["courseid"],$center_id);
        $total_absent_student = $total_student - ($total_faill_students +$total_pass_students);
         
         
        $total_all_students +=$total_student;
        $total_passed_students +=$total_pass_students;
        $total_failed_students += $total_faill_students;
        $total_ab_students += $total_absent_student;
        
        
        $key++;
              $html .='<tr>
                        <td style="width:5%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle; "> '.$key.' </td> 
                        <td style="width:50%; padding:3px;border:1px solid #000;text-align:left; vertical-align:middle; "> '.$course["courseid"] .' - '.$course["cname"].'</td>
                        <td style="width:5%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle; ">  '.$total_student.'</td>
                        <td style="width:5%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle; "> '.$total_pass_students.' </td>
                        <td style="width:5%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle; "> '.$total_faill_students.'</td>
                         <td style="width:5%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle; "> '. $total_absent_student .'</td>
                     </tr>';
        }
}
    
 $html .='<tr>
 <td style="width:5%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle; ">  </td> 
                        <td style="width:50%; padding:3px;border:1px solid #000;text-align:left; vertical-align:middle; ">  Total </td>
                        <td style="width:5%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle; "> '.$total_all_students.'  </td>
                        <td style="width:5%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle; "> '.$total_passed_students.' </td>
                        <td style="width:5%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle; "> '.$total_failed_students.' </td>
                         <td style="width:5%; padding:3px;border:1px solid #000;text-align:center; vertical-align:middle; "> '.$total_ab_students.'  </td>
                         ';
 

 $html .= '</tbody>';

//  echo $html;
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
