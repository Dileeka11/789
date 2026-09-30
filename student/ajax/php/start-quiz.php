<?php

include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');
date_default_timezone_set('Asia/Colombo');
$createdAt = date('Y-m-d H:i:s');
if (!isset($_SESSION)) {
    session_start();
}

$STUDENT = new Student($_SESSION['id']);
$course = Course::getCourseByCourseID($STUDENT->course_id);
$exam = SheduleExam::getUpcomingScheduledExamByCourse($STUDENT->course_id);
$currentTime = new DateTime($exam['time']);
$exam_end_time = $currentTime->modify('+' . $exam['duration'] . ' seconds');
$exam_end_time = $exam_end_time->format('H:i');

if ($_SESSION['id'] != $_POST['student_id']) {
    $arr['status'] = 'error';
    $arr['msg'] = 'You do not have permission to access this exam.';
} else if (!($exam && $exam['id'] == $_POST['exam_id']  && $exam['start_date'] == date("Y-m-d") && $exam['time'] <= date("h:i a") && date("H:i") <= $exam_end_time)) {
    $arr['status'] = 'error';
    $arr['msg'] = 'You do not have any assigned exams.';
} else {
    if ($exam['type'] == 1 || $exam['type'] == 3) {
        $exam_attempt = ExamStudent::getStudentExam($_SESSION['id'], $exam['id']);
        if ($exam_attempt) {
            if ($exam_attempt['status'] == 2 || $exam_attempt['status'] == 4) {
                $arr['status'] = 'error';
                $arr['msg'] = 'You have already attempted the exam.';
            } elseif ($exam_attempt['status'] == 3) {
                $arr['status'] = 'written-exam';
                $arr['redirect'] = 'written-exam.php?id=' . $exam['id'] . '&lang=' . $_POST['language'];
            } elseif ($exam_attempt['status'] == 1) {
                $arr['status'] = 'success';
                $arr['msg'] = '';
            }
        } else {

            // $questions = Question::getRandomQuestionByCourseId($exam['course_id'], $exam['number_of_question']);
            $EXAM_PAPER_QUESTIONS = new ExamPaperQuestions(null);
            $questions = $EXAM_PAPER_QUESTIONS->getRandomQuestionsByExamPaperId($exam['course_id'], $exam['number_of_question'], $exam['year'], $exam['batch']);   
            if (count($questions) > 0) {
                $is_practical_marks_exist = ExamStudent::getStudentDetails($_SESSION['id']);
                if ($is_practical_marks_exist) {
                    $EXAMSTUDENT = new ExamStudent($is_practical_marks_exist['id']);
                    $EXAMSTUDENT->exam_id = $exam['id'];
                    $EXAMSTUDENT->status = 1;
                    $EXAMSTUDENT->essay_started_at = '';
                    $EXAMSTUDENT->mcq_started_at = $createdAt;
                    $EXAMSTUDENT->updateExamStartDetails();
                } else {
                    $EXAMSTUDENT = new ExamStudent(null);
                    $EXAMSTUDENT->student_id = $_SESSION['id'];
                    $EXAMSTUDENT->exam_id = $exam['id'];
                    $EXAMSTUDENT->status = 1;
                    $EXAMSTUDENT->essay_started_at = '';
                    $EXAMSTUDENT->mcq_started_at = $createdAt;
                    $EXAMSTUDENT->create();
                }

$EXAMSTUDENTQUESTIONS = new ExamStudentQuestion(null);
$all_ques = $EXAMSTUDENTQUESTIONS->getStudentQuestions($_SESSION['id'],$exam['id']);
if(count($all_ques)==0) {
                foreach ($questions as $key => $question) {
                    $key++;
                    $EXAMSTUDENTQU = new ExamStudentQuestion(null);
                    $EXAMSTUDENTQU->student_id = $_SESSION['id'];
                    $EXAMSTUDENTQU->exam_id = $exam['id'];
                    $EXAMSTUDENTQU->question_id = $question;
                    $EXAMSTUDENTQU->sort = $key;
                    $EXAMSTUDENTQU->create();
                }
}
                $arr['status'] = 'success';
                $arr['msg'] = 'Success';
            } else {
                $arr['status'] = 'error';
                $arr['msg'] = 'Does not have required questions in questions pool.';
            }
        }
    }
}
echo json_encode($arr);
exit();
