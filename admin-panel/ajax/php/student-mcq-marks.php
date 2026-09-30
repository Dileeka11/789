<?php

include '../../../class/include.php';
header('Content-Type: APPLICATION/json; charset=UTF8');
date_default_timezone_set('Asia/Colombo');
$createdAt = date('Y-m-d H:i:s');
if (!isset($_SESSION)) {
    session_start();
}
//update final marks
if (isset($_POST['action']) && $_POST['action'] == 'UPDATE') {
  
    
    $student_id = $_POST['stu_id'];
    $exam_id = $_POST['exam_id'];
    $exam_stu_id = $_POST['exam_stu_id'];

    $final_grade = calculateFinalGrade($student_id, $exam_id, $exam_stu_id);

    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}
//update correct answer
if (isset($_POST['action']) && $_POST['action'] == 'UPDATECORRECTANSWER') {
    $student_id = $_POST['stu_id'];
    $exam_id = $_POST['exam_id'];
    $exam_stu_id = $_POST['exam_stu_id'];
    $exam_stu_qu_id = $_POST['exam_stu_qu_id'];

    $EXAM_STU_QU = new ExamStudentQuestion($exam_stu_qu_id);
    $QUESTION = new Question($EXAM_STU_QU->question_id);
    $EXAM_STU_QU->answer = $QUESTION->correct_answer;
    $EXAM_STU_QU->is_correct = 1;
    $EXAM_STU_QU->points = 2;
    $EXAM_STU_QU->updateStudentAnswer();

    $final_grade = calculateFinalGrade($student_id, $exam_id, $exam_stu_id);
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}
//calculate final grade
function calculateFinalGrade($student_id, $exam_id, $exam_stu_id)
{
    $EXAM = new SheduleExam($exam_id);

    $stu_exam = ExamStudent::getStudentExam($student_id, $exam_id);

    if ($exam_stu_id != $stu_exam['id']) {
        $result = ["status" => 'error'];
        echo json_encode($result);
        exit();
    }

    $total = ExamStudentQuestion::getStudentTotalMarks($student_id, $exam_id);
    if ($EXAM->number_of_question == 0) {
        $average = 0;
    } else {
        $average = $total / $EXAM->number_of_question;
    }
    if ($EXAM->type == 1) {
        $percentage = $average * 100;
    } elseif ($EXAM->type == 3) {
        $percentage = $average * 40;
    }
    $percentage = round($percentage);
    if ($percentage == 34) {
        $percentage = 35;
    }
    if ($percentage >= 35)
        $grade = "Pass";
    else
        $grade = "Repeat";

    // $stu_marks = new ExamStudentMarks();
    if ($EXAM->is_had_practical == 1) {
        if ($EXAM->type == 1) {
            $full_marks = $percentage + $stu_exam['practical_marks'];
            $final_avg = $full_marks / 2;
            if ($percentage >= 35 && $stu_exam['practical_marks'] >= 50) {
                if ($final_avg >= 71)
                    $final_grade = "Distinction";
                else if ($final_avg >= 51)
                    $final_grade = "Merit";
                else if ($final_avg >= 35)
                    $final_grade = "Ordinary";
                else
                    $final_grade = "Repeat";
            } else {
                $final_grade = "Repeat";
            }
        } elseif ($EXAM->type == 3) {
            $full_marks = $percentage + $stu_exam['essay_marks'] + $stu_exam['practical_marks'];
            $final_avg = $full_marks / 2;
            if (($percentage + $stu_exam['essay_marks']) >= 35) {
                $grade = 'Pass';
                $EXAM_STUDENT1 = new ExamStudent($exam_stu_id);
                $EXAM_STUDENT1->mcq_grade = 'Pass';
                $EXAM_STUDENT1->essay_grade = 'Pass';
                $EXAM_STUDENT1->updateTheoryGrades();
            }
            if (($percentage + $stu_exam['essay_marks']) >= 35 && $stu_exam['practical_marks'] >= 50) {
                if ($final_avg >= 71)
                    $final_grade = "Distinction";
                else if ($final_avg >= 51)
                    $final_grade = "Merit";
                else if ($final_avg >= 35)
                    $final_grade = "Ordinary";
                else
                    $final_grade = "Repeat";
            } else {
                $final_grade = "Repeat";
            }
        }
    } else {
        if ($EXAM->type == 1) {
            $full_marks = $percentage;
            $final_avg = $percentage;
            if ($percentage >= 35) {
                if ($final_avg >= 71)
                    $final_grade = "Distinction";
                else if ($final_avg >= 51)
                    $final_grade = "Merit";
                else if ($final_avg >= 35)
                    $final_grade = "Ordinary";
                else
                    $final_grade = "Repeat";
            } else {
                $final_grade = "Repeat";
            }
        } elseif ($EXAM->type == 3) {
            $full_marks = $percentage + $stu_exam['essay_marks'];
            $final_avg = $full_marks / 2;

            if (($percentage + $stu_exam['essay_marks']) >= 35) {
                $grade = 'Pass';
                $EXAM_STUDENT1 = new ExamStudent($exam_stu_id);
                $EXAM_STUDENT1->mcq_grade = 'Pass';
                $EXAM_STUDENT1->essay_grade = 'Pass';
                $EXAM_STUDENT1->updateTheoryGrades();
            }
            if (($percentage + $stu_exam['essay_marks']) >= 35) {
                if ($final_avg >= 71)
                    $final_grade = "Distinction";
                else if ($final_avg >= 51)
                    $final_grade = "Merit";
                else if ($final_avg >= 35)
                    $final_grade = "Ordinary";
                else
                    $final_grade = "Repeat";
            } else {
                $final_grade = "Repeat";
            }
        }
    }


    $STUDENT_EXAM = new ExamStudent($stu_exam['id']);
    $STUDENT_EXAM->mcq_marks = $percentage;
    $STUDENT_EXAM->mcq_grade = $grade;
    $STUDENT_EXAM->full_marks = $final_avg;
    $STUDENT_EXAM->grade = $final_grade;
    $STUDENT_EXAM->status = 2;

    $result = $STUDENT_EXAM->updateExamMarks();
}
