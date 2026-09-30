<?php
require_once 'plugin/dompdf/autoload.inc.php';
include '../class/include.php';

$exam_id = $_GET['id'];
$center_id = $_GET['center'];
$year = $_GET['year'];
$batch = $_GET['batch'];

$EXAM_STUDENTS = new ExamStudent(NULL);
$STUDENT = new Student(NULL);
$students = $EXAM_STUDENTS->getExamIdPassedStudentsByExamIdAndCenter($exam_id, $center_id);
$resit_students = $EXAM_STUDENTS->getExamIdRepeatStudentsByExamIdAndCenter($exam_id, $center_id);
$ab_students = $EXAM_STUDENTS->getAbStudentsByExamIdAndCenter($exam_id, $center_id, $year, $batch);
$EXAM = new SheduleExam($exam_id);
$CENTER = new Centers($center_id);
$COURSE = new Course($EXAM->course_id);

$student_arr = $STUDENT->getStudentIDArrayByCourseAndBatch($COURSE->courseid, $year, $batch, $center_id);
$participated_student_arr = $EXAM_STUDENTS->getParticipatedStudentsIDByExamIdAndCenter($exam_id, $center_id, $year, $batch);
$ab_resit_total = count($student_arr) - count($participated_student_arr) + count($ab_students) + count($resit_students);
?>

<form action="certificate-number-sheet.php" method="get">
  <input type="hidden" name="id" value="<?= $exam_id ?>">
  <input type="hidden" name="center" value="<?= $center_id ?>">
  <input type="hidden" name="year" value="<?= $year ?>">
  <input type="hidden" name="batch" value="<?= $batch ?>">
  <button type="submit" style="background: green; padding:10px; color:#fff; border:0; cursor:pointer; float:right; margin: 20px;">Download PDF</button>
</form>
