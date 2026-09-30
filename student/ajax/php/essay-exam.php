<?php

include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');
date_default_timezone_set('Asia/Colombo');
$createdAt = date('Y-m-d H:i:s');
if (!isset($_SESSION)) {
    session_start();
}
if ($_POST['action'] == 'SUBMITEXAM') {

    $student_id = $_SESSION['id'];
    $exam_id = $_POST['exam_id'];
    $EXAM = new SheduleExam($exam_id);

    // $has_empty_answeres = ExamStudentQuestion::getNonAnsweredQuestions($student_id, $exam_id);
    // $stu_marks = new ExamStudentMarks();
    $stu_exam = ExamStudent::getStudentExam($student_id, $exam_id);

    $STUDENT_EXAM = new ExamStudent($stu_exam['id']);
    $STUDENT_EXAM->status = 4;

    $result = $STUDENT_EXAM->updateStatus();

    if ($result) {
        $arr['status'] = 'success';
        $arr['msg'] = 'Quiz has been submitted successfully.';
    } else {
        $arr['status'] = 'error';
        $arr['msg'] = 'There was an error.';
    }
    // dd($data);
    echo json_encode($arr);
    exit();
}
