<?php

include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');
date_default_timezone_set('Asia/Colombo');
$createdAt = date('Y-m-d H:i:s');
if (!isset($_SESSION)) {
    session_start();
}
if ($_POST['student_id'] != '') {
    $student = new Student($_POST['student_id']);
} elseif ($_POST['nic_no'] != '') {
    $student1 = new Student(null);
    $student1 = $student1->getStudentByNIC($_POST['nic_no']);
    $student = new Student($student1['id']);
}
// $student = Student::getStudentByNIC($_POST['student_id']);
if ($student) {
    $student_exam = ExamStudent::getLatestStudentExam($student->id);
    if ($student_exam) {
        $EXAM = new SheduleExam($student_exam['exam_id']);
        if ($EXAM->is_result_released == 1) {
            $course = Course::getCourseByCourseID($student->course_id);
            // $startTimestamp = strtotime($EXAM->start_date);
            $arr = [];
            $arr['status'] = 'success';
            $arr['course'] = $course;
            $arr['exam_year'] = $student->year;
            $arr['student_exam'] = $student_exam;
            $arr['student'] = $student;
            if ($student_exam['exam_id'] != 0) {
                $arr['exam'] = $EXAM;
            } else {
                $arr['exam'] = '';
            }
        } else {
            $arr = [];
            $arr['status'] = 'error';
            $arr['msg'] = "Your exam results are not released yet.";
        }
    } else {
        $arr = [];
        $arr['status'] = 'error';
        $arr['msg'] = "There is no exam you have attended.";
    }
} else {
    $arr = [];
    $arr['status'] = 'error';
    $arr['msg'] = "There is no student in our recods according to this NIC number.";
}
echo json_encode($arr);
exit();
