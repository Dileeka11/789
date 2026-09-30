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
//$students = $EXAM_STUDENTS->getPassedStudentsByExamIdAndCenter($exam_id, $center_id, $year, $batch);

$students = $EXAM_STUDENTS->getExamIdPassedStudentsByExamIdAndCenter($exam_id,$center_id);



// $resit_students = $EXAM_STUDENTS->getReSitStudentsByExamIdAndCenter($exam_id, $center_id, $year, $batch);

 $resit_students = $EXAM_STUDENTS->getExamIdRepeatStudentsByExamIdAndCenter($exam_id, $center_id );


$ab_students = $EXAM_STUDENTS->getAbStudentsByExamIdAndCenter($exam_id, $center_id, $year, $batch);
$EXAM = new SheduleExam($exam_id);
$CENTER = new Centers($center_id);
$COURSE = new Course($EXAM->course_id);

$student_arr = $STUDENT->getStudentIDArrayByCourseAndBatch($COURSE->courseid, $year, $batch, $center_id);
$participated_student_arr = $EXAM_STUDENTS->getParticipatedStudentsIDByExamIdAndCenter($exam_id, $center_id, $year, $batch);

// $ab_resit_total = count($student_arr) - count($students);
$ab_resit_total = count($ab_students) + count($resit_students);
$ab_resit_total = count($student_arr) - count($participated_student_arr) + $ab_resit_total;

$html = '';
$html .= '<div style="size: A4 portrait;width:100%; font-size:11px; font-family: Calibri, sans-serif;">';
$html .= '<form action="final-results-by-center-report.php" class="report-form" method="get">';
$html .= '<table style="width:100%;">';
$html .= '<tr>';
$html .= '<td style="width:100%; font-weight:600; text-align:center; text-decoration: underline;">National Youth Services Council - Exam & Assessment Division</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width:100%; font-weight:600; text-align:center; text-decoration: underline;">Final Results of Vocational Training & Language Courses</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width:100%; font-weight:600; text-align:center; text-decoration: underline;">' . date('Y', strtotime($EXAM->start_date)) . ' ' . date('F', strtotime($EXAM->start_date)) . ' Exam</td>';
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
$html .= '<td style="width:68%; font-weight:400; text-align:left;">' . strtoupper($COURSE->cname) . '</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width:30%; font-weight:400; text-align:left; font-weight:600;">Type of the Course</td>';
$html .= '<td style="width:2%; font-weight:400; text-align:center;">:-</td>';
$html .= '<td style="width:68%; font-weight:400; text-align:left;">' . ($COURSE->fullpart == 1 ? 'FULL TIME' : 'PART TIME') . '</td>';
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
$html .= '<th style="width:15%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">Exam No(MIS No)</th>';
$html .= '<th style="width:45%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;">Name with Initials</th>';
$html .= '<th style="width:5%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;"><span style="writing-mode: tb-rl;transform: rotate(-180deg);">Practical Marks</span></th>';
$html .= '<th style="width:5%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;"><span style="writing-mode: tb-rl;transform: rotate(-180deg);">Grade of Practical Marks</span></th>';
$html .= '<th style="width:5%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;"><span style="writing-mode: tb-rl;transform: rotate(-180deg);">Theory Marks</span></th>';
$html .= '<th style="width:5%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;"><span style="writing-mode: tb-rl;transform: rotate(-180deg);">Grade of Theory Marks</span></th>';
$html .= '<th style="width:5%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;"><span style="writing-mode: tb-rl;transform: rotate(-180deg);">Average of Results</span></th>';
$html .= '<th style="width:10%; padding:3px;border:1px solid #000; font-weight:600; text-align:center; vertical-align:middle;"><span style="writing-mode: tb-rl;transform: rotate(-180deg);">Final Grade</span></th>';
$html .= '</tr>';




foreach ($students as $key1 => $student) {

    $STUDENT = new Student($student['student_id']);
    $index = $key1 + 1;

    // Check if student year does not match
    $rowStyle = ($STUDENT->year != $year) ? 'background-color: #f8d7da; color:#721c24;' : '';

    $html .= '<tr style="height:17px; font-size:11px;">';
    $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . $index . '</td>';
    $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;  ' . $rowStyle . '">' . $STUDENT->id . ' - (' . $STUDENT->year . ' - ' . $STUDENT->batch . ')</td>';
    $html .= '<td style="border:1px solid #000; text-align:left; vertical-align:middle;">' . $STUDENT->fname . ' ' . $STUDENT->lname . '</td>';
    $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . ((int)$student['practical_marks'] ?? 0) . '</td>';
    $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . ($student['practical_grade'] ?? '-') . '</td>';
    $total_written = ((int)$student['mcq_marks'] + (int)$student['essay_marks']);
    $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . $total_written . '</td>';
    $grade = ($student['essay_grade'] == null ? $student['mcq_grade'] : $student['essay_grade']);
    $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . $grade . '</td>';
    $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . ($student['full_marks'] ?? 0) . '</td>';
    $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . ($student['grade'] ?? '-') . '</td>';
    $html .= '</tr>';
}



$html .= '<tr style="height:17px; font-size:11px">';
$html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;;font-weight:600;" colspan="3">Number of Student Passed</td>';
$html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;" colspan="6">' . count($students) . '</td>';
$html .= '</tr>';
$html .= '<tr style="height:17px; font-size:11px">';
$html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;;font-weight:600;" colspan="3">Absent & Re-sit Students</td>';
$html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;" colspan="6">' . $ab_resit_total . '</td>';
$html .= '</tr>';


foreach ($resit_students as $key => $resit_student) {
    $STUDENT = new Student($resit_student['student_id']);
    $theory_marks = $resit_student['mcq_marks'] + $resit_student['essay_marks'];
    $theory_status = (($resit_student['mcq_grade'] == 'Repeat' || $resit_student['essay_grade'] == 'Repeat') ? 'Repeat' : $resit_student['mcq_grade']);
    $key++;
    
       $rowStyle = ($STUDENT->year != $year) ? 'background-color: #f8d7da; color:#721c24;' : '';
    
    $html .= '<tr style="height:17px; font-size:11px">';
    $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . $key . '</td>';
    $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;  ' . $rowStyle . '">' . $STUDENT->id . ' - (' . $STUDENT->year . ' - ' . $STUDENT->batch . ')</td>';

    $html .= '<td style="border:1px solid #000; text-align:left; vertical-align:middle;">' . $STUDENT->fname . ' ' . $STUDENT->lname . '</td>';
    
    $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' 
    . ((isset($resit_student['practical_marks']) && $resit_student['practical_marks'] == 0) 
        ? 'AB' 
        : ($resit_student['practical_marks'] ?? '')) 
    . '</td>';

    
    $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . $resit_student['practical_grade'] ?? '' . '</td>';
    $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . $theory_marks ?? '' . '</td>';
    $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . $theory_status ?? '' . '</td>';
     $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;"></td>';
        $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . $resit_student['grade'] . '</td>';

    // $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . ($resit_student['practical_grade'] == 'Repeat' ? $resit_student['practical_marks'] : '') . '</td>';
    // $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . ($resit_student['practical_grade'] == 'Repeat' ? $resit_student['practical_grade'] : '-') . '</td>';
    // $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . ($theory_status == 'repeat' ? $theory_marks : '') . '</td>';
    // $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . ($theory_status == 'repeat' ? 'Repeat' : '') . '</td>';
    // $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;"></td>';
    // $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;"></td>';
    $html .= '</tr>';
}


foreach ($ab_students as $ab_student) {
   
    $STUDENT = new Student($ab_student['student_id']);
    // $theory_status = (($ab_student['mcq_grade'] == '' || $ab_student['mcq_grade'] == null || $ab_student['essay_grade'] == '' || $ab_student['essay_grade'] == null) ? 'ab' : '');
    $practical_status = '';
    $theory_status = '';
    if ($EXAM->is_had_practical == 1) {

        $practical_status = (($ab_student['practical_grade'] == '' || $ab_student['practical_grade'] == null) && $ab_student['practical_marks'] == 0) ? 'AB' : '';
    }
    if ($EXAM->type == 1) {
        $theory_status = (($ab_student['mcq_grade'] == '' || $ab_student['mcq_grade'] == null) && $ab_student['mcq_marks'] == 0) ? 'AB' : '';
    } elseif ($EXAM->type == 2) {
        $theory_status = (($ab_student['essay_grade'] == '' || $ab_student['essay_grade'] == null) && $ab_student['essay_marks'] == 0) ? 'AB' : '';
    } elseif ($EXAM->type == 3) {
        $theory_status = ((($ab_student['essay_grade'] == '' || $ab_student['essay_grade'] == null) && $ab_student['essay_marks'] == 0) || (($ab_student['mcq_grade'] == '' || $ab_student['mcq_grade'] == null) && $ab_student['mcq_marks'] == 0)) ? 'AB' : '';
    }

    if (isset($key)) {
        $key++;
    } else {
        $key = 1;
    }
    
       $rowStyle = ($STUDENT->year != $year) ? 'background-color: #f8d7da; color:#721c24;' : '';
       
    $html .= '<tr style="height:17px; font-size:11px">';
    $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . $key . '</td>';
    $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;  ' . $rowStyle . '">' . $STUDENT->id . ' - (' . $STUDENT->year . ' - ' . $STUDENT->batch . ')</td>';


    $html .= '<td style="border:1px solid #000; text-align:left; vertical-align:middle;">' . $STUDENT->fname . ' ' . $STUDENT->lname . '</td>';
    $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . ($practical_status != 'AB' ? $ab_student['practical_marks'] : $practical_status) . '</td>';
    $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . ($practical_status != 'AB' ? $ab_student['practical_grade'] : '') . '</td>';
    $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . ($theory_status != 'AB' ? ($ab_student['mcq_marks'] + $ab_student['essay_marks']) : $theory_status) . '</td>';
    $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . ($theory_status != 'AB' ? ($ab_student['mcq_grade'] ? $ab_student['mcq_grade'] : $ab_student['essay_grade']) : '') . '</td>';
    $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;"></td>';
    
  $final_status = ($practical_status === 'AB' || $theory_status === 'AB') 
    ? 'Repeat' 
    : ($ab_student['final_mark'] ?? '');
    
$html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . $final_status . '</td>'; 
    
    $html .= '</tr>';
}


foreach ($student_arr as $all_student) {
    if (!in_array($all_student, $participated_student_arr)) {
        $STUDENT = new Student($all_student);
        $practical_status = '';
        if ($EXAM->is_had_practical == 1) {
            if ($STUDENT->practical_mark == 0) {
                $practical_status = 'AB';
                $practical_grade = '';
            } else {
                $practical_status = $STUDENT->practical_mark;
                if ($practical_status >= 50) {
                    $practical_grade = 'Pass';
                } else {
                    $practical_grade = 'Repeat';
                }
            }
        }
        if (isset($key)) {
            $key++;
        } else {
            $key = 1;
        }

        $rowStyle = ($STUDENT->year != $year) ? 'background-color: #f8d7da; color:#721c24;' : '';
   
        $html .= '<tr style="height:17px; font-size:11px">';
        $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . $key . '</td>';
        
           $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;  ' . $rowStyle . '">' . $STUDENT->id . ' - (' . $STUDENT->year . ' - ' . $STUDENT->batch . ')</td>';


        $html .= '<td style="border:1px solid #000; text-align:left; vertical-align:middle;">' . $STUDENT->fname . ' ' . $STUDENT->lname . '</td>';
        $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . $practical_status . '</td>';
        $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">' . $practical_grade . '</td>';
        $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;">AB</td>';
        $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;"></td>';
        $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;"></td>';
        $html .= '<td style="border:1px solid #000; text-align:center; vertical-align:middle;"></td>';
        $html .= '</tr>';
    }
}
$html .= '</table>';


//4th table
$html .= '<table style="width:100%;border:0;margin-top:20px">';
$html .= '<tr>';
$html .= '<td style="width:5%;"></td>';
$html .= '<td style="width:15%;text-align:left;vertical-align:top">Grading Order :-</td>';
$html .= '<td style="width:45%;text-align:left"><b>Theory:</b> Pass = 35 - 100, R = 34 below have to re-sit again<br />';
$html .= '<b>Practical:</b> Pass = 50 - 100, R = 49 below have to re-sit again</td>';
// $html .= '<td style="width:5%;"></td>';
// $html .= '<td style="width:15%;">Grading Order :-</td>';
// $html .= '<td style="width:15%;"><b>Theory:</b> A = 80 - 100 B = 66 - 79 C = 45 - 65 D = 35 - 44 <br />R = 34 below have to re-sit again<br />';
// $html .= '<b>Practical:</b> A = 80 - 100 B = 66 - 79 C = 50 - 65 <br />R = 49 below have to re-sit again</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width:5%;"></td>';
$html .= '<td style="width:15%;" colspan="2">Grade According to the Final Results :-</td>';
$html .= '<td style="width:45%;"></td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width:5%;"></td>';
$html .= '<td style="width:15%;"></td>';
$html .= '<td style="width:45%;">Distinction = 71% - 100% Merit Pass = 51% - 70% Ordinary Pass = 35% - 50%<br />Below 35% Repeat<br /></td>';
$html .= '</tr>';
$html .= '</table>';
//5th table
$html .= '<table style="width:100%;">';
$html .= '<tr>';
$html .= '<td style="width:5%;"></td>';
$html .= '<td style="width:60%; text-align:left;height:100px; vertical-align:bottom">Prepared by -: ..................................</td>';
$html .= '<td style="width:35%; text-align:left;height:100px; vertical-align:bottom">Checked by -: ..................................</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width:5%;"></td>';
$html .= '<td style="width:60%; text-align:left;"><input type="text" name="prepared_by_name"  class="prepared_by_name"></td>';
$html .= '<td style="width:35%; text-align:left;"><input type="text" name="checked_by_name"  class="checked_by_name"></td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width:5%;"></td>';
$html .= '<td style="width:60%; text-align:left;">Management Assistant (Exam and Assessment)</td>';
$html .= '<td style="width:35%; text-align:left;">Management Assistant (Exam and Assessment)</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width:5%;"></td>';
$html .= '<td style="width:60%; text-align:left;height:100px; vertical-align:bottom">Recommended by -: ..................................</td>';
$html .= '<td style="width:35%; text-align:left;height:100px; vertical-align:bottom">Approved by -: ..................................</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width:5%;"></td>';
$html .= '<td style="width:60%; text-align:left;"><input type="text" name="recommended_by_name"  class="recommended_by_name"></td>';
$html .= '<td style="width:35%; text-align:left;"><input type="text" name="approved_by_name"  class="approved_by_name"></td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width:5%;"></td>';
$html .= '<td style="width:60%; text-align:left;">Assistant Director (Exam and Assessment)</td>';
$html .= '<td style="width:35%; text-align:left;">Deputy Director (Exam and Assessment)</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td style="width:5%;"></td>';
$html .= '<td style="width:60%;left;height:50px; vertical-align:bottom">Date of the Issue :- <input type="text" name="issue_date"  class="issue_date"></td>';
$html .= '<td style="width:35%;left;height:50px; vertical-align:bottom">Row Height :- <input type="number" name="row_height" class="row_height" value="17" min="17"> px</td> ';
$html .= '</tr>';
$html .= '</table>';
$html .= '<input type="hidden" name="id" value="' . $exam_id . '">';
$html .= '<input type="hidden" name="center" value="' . $center_id . '">';
$html .= '<input type="hidden" name="year" value="' . $year . '">';
$html .= '<input type="hidden" name="batch" value="' . $batch . '">';
$html .= '<button type="submit" class="submit" style="background: green; padding:10px; color:#fff; border:0;cursor:cursor;float:right; margin: 20px 20px">Download</button>';
$html .= '</form>';
$html .= '</div>';
echo $html;
?>

<script src="assets/libs/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.submit', function(e) {
            e.preventDefault();
            if (!$(".prepared_by_name").val() || $(".prepared_by_name").val().length === 0) {
                alert("Please enter prepared person's name.");
            } else if (!$(".checked_by_name").val() || $(".checked_by_name").val().length === 0) {
                alert("Please enter checked person's name.");
            } else if (!$(".recommended_by_name").val() || $(".recommended_by_name").val().length === 0) {
                alert("Please enter recommended person's name.");
            } else if (!$(".approved_by_name").val() || $(".approved_by_name").val().length === 0) {
                alert("Please enter approved person's name.");
            } else if (!$(".issue_date").val() || $(".issue_date").val().length === 0) {
                alert("Please enter issue date.");
            } else {
                $('.report-form').submit();
            }
        })
    })
</script>