<?php

include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');
date_default_timezone_set('Asia/Colombo');
$createdAt = date('Y-m-d H:i:s');
if (!isset($_SESSION)) {
    session_start();
}

// $student = new Student($_POST['student_id']);

if($_POST['student_id']){
   $student = Student::getStudentByNICAndBatch($_POST['student_id']);

if ($student) {
    $student_exam = ExamStudent::getLatestStudentExam($student['id']);
    
        $EXAM = new SheduleExam($student_exam['exam_id']);
         
            $course = Course::getCourseByCourseID($student['course_id']);
            $CENTER = new Centers($student['centercode']);
            
            // $startTimestamp = strtotime($EXAM->start_date);
            $arr = [];
            $arr['status'] = 'success';
            $arr['course'] = $course;
            $arr['exam_year'] = $student['year'] .' - '.$student['batch'];
            $arr['exam_participant_year_batch'] = $EXAM->year .' - '.$EXAM->batch;

            $arr['student_exam'] = $student_exam;
            $arr['student'] = $student;
            $arr['center'] = $CENTER->center_name;
            
            if($student_exam['exam_id'] == 0){
                 $arr['is_exam'] = 'No exam participant';
            } else {
                $arr['is_exam'] = 'Exam participant';
            }
            
             
              
            if ($student_exam['exam_id'] != 0) {
                $arr['exam'] = $EXAM;
            } else {
                $arr['exam'] = '';
            }
        
     
} else {
    $arr = [];
    $arr['status'] = 'error';
    $arr['msg'] = "There is no student in our recods according to this NIC number.";
}
echo json_encode($arr);
exit();
  
}else{
    
     $student = Student::getStudentByCertificateNo($_POST['certificate_id']);

if ($student) {
    $student_exam = ExamStudent::getLatestStudentExam($student['id']);
    
        $EXAM = new SheduleExam($student_exam['exam_id']);
         
            $course = Course::getCourseByCourseID($student['course_id']);
            $CENTER = new Centers($student['centercode']);
            
            // $startTimestamp = strtotime($EXAM->start_date);
            $arr = [];
            $arr['status'] = 'success';
            $arr['course'] = $course;
            $arr['exam_year'] = $student['year'] .' - '.$student['batch'];
            $arr['exam_participant_year_batch'] = $EXAM->year .' - '.$EXAM->batch;

            $arr['student_exam'] = $student_exam;
            $arr['student'] = $student;
            $arr['center'] = $CENTER->center_name;
            
            if($student_exam['exam_id'] == 0){
                 $arr['is_exam'] = 'No exam participant';
            } else {
                $arr['is_exam'] = 'Exam participant';
            }
            
             
              
            if ($student_exam['exam_id'] != 0) {
                $arr['exam'] = $EXAM;
            } else {
                $arr['exam'] = '';
            }
        
     
} else {
    $arr = [];
    $arr['status'] = 'error';
    $arr['msg'] = "There is no student in our recods according to this NIC number.";
}
echo json_encode($arr);
exit();

    
}
