<?php

include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');
date_default_timezone_set('Asia/Colombo');
$createdAt = date('Y-m-d H:i:s');
if (!isset($_SESSION)) {
    session_start();
}
if ($_POST['action'] == 'GETQUESTION') {

    $id = $_POST['id'];
    $next_id = $id + 1;
    $prev_id = $id - 1;
    $STU_QU = new ExamStudentQuestion($id);
    $EXAM = new SheduleExam($STU_QU->exam_id);
    $QUESTION = new Question($STU_QU->question_id);
    $next_qu = ExamStudentQuestion::getStudentQuestionById($_SESSION['id'], $EXAM->id, $next_id);
    $prev_qu = ExamStudentQuestion::getStudentQuestionById($_SESSION['id'], $EXAM->id, $prev_id);
    $all_ques = ExamStudentQuestion::getStudentQuestions($_SESSION['id'], $EXAM->id);
    // dd($prev_qu);
    if ($next_qu != null) {
        $next_qu_id = $next_id;
    } else {
        $next_qu_id = '';
    }
    if ($prev_qu != null) {
        $prev_qu_id = $prev_id;
    } else {
        $prev_qu_id = '';
    }

    $arr['exam'] = $EXAM;
    $arr['stu_question'] = $STU_QU;
    $arr['question'] = $QUESTION;
    $arr['next_qu'] = $next_qu_id;
    $arr['prev_qu'] = $prev_qu_id;
    $arr['current_qu'] = $id;
    $arr['current_sort'] = $STU_QU->sort;
    $arr['answers'] = $STU_QU->answer;
    $arr['all_ques'] = $all_ques;

    // dd($arr);
    echo json_encode($arr);
    exit();
}

if ($_POST['action'] == 'UPDATEANSWER') {

    $STU_QU = new ExamStudentQuestion($_POST['current_qu']);
    $QUESTION = new Question($STU_QU->question_id);

    // dd($request->selected_choice);
    $STU_QU->answer = $_POST['selected_choice'];
    $count = 0;
    if ($_POST['selected_choice'] == $QUESTION->correct_answer) {
        $STU_QU->is_correct = 1;
        $STU_QU->points = 1;
    } else {
        $STU_QU->is_correct = 0;
        $STU_QU->points = 0;
    }

    $STU_QU->updateStudentAnswer();
    $data = [
        'current_sort' => $STU_QU->sort,
    ];
    // dd($data);
    echo json_encode($data);
    exit();
}
if ($_POST['action'] == 'SUBMITEXAM') {

    $student_id = $_SESSION['id'];
    $exam_id = $_POST['exam_id'];
    $type = $_POST['submit_type'];
    $lang = $_POST['lang'];
    $EXAM = new SheduleExam($exam_id);

    $has_empty_answeres = ExamStudentQuestion::getNonAnsweredQuestions($student_id, $exam_id);
    if ($type == 1) {
        if (count($has_empty_answeres) > 0) {
            $arr['status'] = 'error1';
            $arr['msg'] = 'Please answer every questions.';
        } else {

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
            $stu_exam = ExamStudent::getStudentExam($student_id, $exam_id);
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

            if ($result) {
                $arr['status'] = 'success';
                $arr['msg'] = 'Quiz has been submitted successfully.';
                if ($EXAM->type == 3) {
                    $STUDENT_EXAM = new ExamStudent($stu_exam['id']);
                    $STUDENT_EXAM->status = 3;
                    $STUDENT_EXAM->essay_started_at = $createdAt;
                    $result = $STUDENT_EXAM->updateStatusAndEssayStartedDate();
                    $arr['redirect'] = 'written-exam.php?id=' . $EXAM->id . '&lang=' . $lang;
                } else {
                    $arr['redirect'] = 'success.php';
                }
            } else {
                $arr['status'] = 'error';
                $arr['msg'] = 'There was an error.';
            }
        }
    } else {
        //auto submit
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

        // if ($percentage >= 80)
        //     $grade = "A";
        // else if ($percentage >= 66)
        //     $grade = "B";
        // else if ($percentage >= 45)
        //     $grade = "C";
        // else if ($percentage >= 35)
        //     $grade = "D";
        // else
        //     $grade = "F";

        // $stu_marks = new ExamStudentMarks();
        $stu_exam = ExamStudent::getStudentExam($student_id, $exam_id);
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
                $final_avg = $full_marks;
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

        if ($result) {
            $arr['status'] = 'success';
            $arr['msg'] = 'Quiz has been submitted successfully.';
            if ($EXAM->type == 3) {
                $STUDENT_EXAM = new ExamStudent($stu_exam['id']);
                $STUDENT_EXAM->status = 3;
                $STUDENT_EXAM->essay_started_at = $createdAt;
                $result = $STUDENT_EXAM->updateStatusAndEssayStartedDate();
                $arr['redirect'] = 'written-exam.php?id=' . $EXAM->id . '&lang=' . $lang;
            } else {
                $arr['redirect'] = 'success.php';
            }
        } else {
            $arr['status'] = 'error';
            $arr['msg'] = 'There was an error.';
        }
    }
    // dd($data);
    echo json_encode($arr);
    exit();
}
