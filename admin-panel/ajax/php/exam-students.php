<?php

include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

date_default_timezone_set('Asia/Colombo');
$createdAt = date('Y-m-d H:i:s');
if (!isset($_SESSION)) {
    session_start();
}

//update essay marks
if (isset($_POST['action']) && $_POST['action'] == 'UPDATEMARKS') {

    $EXAM_STUDENT = new ExamStudent($_POST['exam_student_id']);
    $EXAM = new SheduleExam($EXAM_STUDENT->exam_id);
    $mcq_marks = $EXAM_STUDENT->mcq_marks;
    $essay_marks = $_POST['marks'];
    // if ($essay_marks >= 80)
    //     $grade = "A";
    // else if ($essay_marks >= 66)
    //     $grade = "B";
    // else if ($essay_marks >= 45)
    //     $grade = "C";
    // else if ($essay_marks >= 35)
    //     $grade = "D";
    // else
    //     $grade = "F";

    if ($essay_marks >= 35)
        $grade = "Pass";
    else
        $grade = "Repeat";

    if ($EXAM->is_had_practical == 1) {
        if ($EXAM->type == 2) {
            $full_marks = $essay_marks + $EXAM_STUDENT->practical_marks;
            $final_avg = $full_marks / 2;
            if ($essay_marks >= 35 && $EXAM_STUDENT->practical_marks >= 50) {
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
            $full_marks = $mcq_marks + $essay_marks + $EXAM_STUDENT->practical_marks;
            $final_avg = $full_marks / 2;
            if (($mcq_marks + $essay_marks) >= 35) {
                $grade = 'Pass';
                $EXAM_STUDENT1 = new ExamStudent($_POST['exam_student_id']);
                $EXAM_STUDENT1->mcq_grade = 'Pass';
                $EXAM_STUDENT1->essay_grade = 'Pass';
                $EXAM_STUDENT1->updateTheoryGrades();
            }
            if (($mcq_marks + $essay_marks) >= 35 && $EXAM_STUDENT->practical_marks >= 50) {
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
        if ($EXAM->type == 2) {
            $full_marks = $essay_marks;
            $final_avg = $essay_marks;
            if ($essay_marks >= 35) {
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
            $full_marks = $mcq_marks + $essay_marks;
            $final_avg = $full_marks;
            if (($mcq_marks + $essay_marks) >= 35) {
                $grade = 'Pass';
                $EXAM_STUDENT1 = new ExamStudent($_POST['exam_student_id']);
                $EXAM_STUDENT1->mcq_grade = 'Pass';
                $EXAM_STUDENT1->essay_grade = 'Pass';
                $EXAM_STUDENT1->updateTheoryGrades();
            }
            if (($mcq_marks + $essay_marks) >= 35) {
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

    $EXAM_STUDENT->essay_marks = $essay_marks;
    $EXAM_STUDENT->essay_grade = $grade;
    $EXAM_STUDENT->full_marks = $final_avg;
    $EXAM_STUDENT->grade = $final_grade;
    $EXAM_STUDENT->essay_marks_updated_at = $createdAt;
    $EXAM_STUDENT->essay_marks_updated_by = $_SESSION['id'];

    $EXAM_STUDENT->updateEssayMarks();
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}
//update mcq marks
if (isset($_POST['action']) && $_POST['action'] == 'UPDATEMCQMARKS') {

    $EXAM_STUDENT = new ExamStudent($_POST['exam_student_id']);
    $EXAM = new SheduleExam($EXAM_STUDENT->exam_id);
    $mcq_marks = $_POST['marks'];
    $essay_marks = $EXAM_STUDENT->essay_marks;
    // if ($essay_marks >= 80)
    //     $grade = "A";
    // else if ($essay_marks >= 66)
    //     $grade = "B";
    // else if ($essay_marks >= 45)
    //     $grade = "C";
    // else if ($essay_marks >= 35)
    //     $grade = "D";
    // else
    //     $grade = "F";

    if ($mcq_marks >= 35)
        $grade = "Pass";
    else
        $grade = "Repeat";


    if ($EXAM->is_had_practical == 1) {
        if ($EXAM->type == 1) {
            $full_marks = $mcq_marks + $EXAM_STUDENT->practical_marks;
            $final_avg = $full_marks / 2;
            if ($mcq_marks >= 35 && $EXAM_STUDENT->practical_marks >= 50) {
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
            $full_marks = $mcq_marks + $essay_marks + $EXAM_STUDENT->practical_marks;
            $final_avg = $full_marks / 2;
            if (($mcq_marks + $essay_marks) >= 35) {
                $grade = 'Pass';
                $EXAM_STUDENT1 = new ExamStudent($_POST['exam_student_id']);
                $EXAM_STUDENT1->mcq_grade = 'Pass';
                $EXAM_STUDENT1->essay_grade = 'Pass';
                $EXAM_STUDENT1->updateTheoryGrades();
            }
            if (($mcq_marks + $essay_marks) >= 35 && $EXAM_STUDENT->practical_marks >= 50) {
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
            $full_marks = $mcq_marks;
            $final_avg = $mcq_marks;
            if ($mcq_marks >= 35) {
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
            $full_marks = $mcq_marks + $essay_marks;
            $final_avg = $full_marks / 2;
            if (($mcq_marks + $essay_marks) >= 35) {
                $grade = 'Pass';
                $EXAM_STUDENT1 = new ExamStudent($_POST['exam_student_id']);
                $EXAM_STUDENT1->mcq_grade = 'Pass';
                $EXAM_STUDENT1->essay_grade = 'Pass';
                $EXAM_STUDENT1->updateTheoryGrades();

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

    $EXAM_STUDENT->mcq_marks = $mcq_marks;
    $EXAM_STUDENT->mcq_grade = $grade;
    $EXAM_STUDENT->full_marks = $final_avg;
    $EXAM_STUDENT->grade = $final_grade;
    $EXAM_STUDENT->status = 4;

    $EXAM_STUDENT->updateExamMarks();
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}
//update practical marks
if (isset($_POST['action']) && $_POST['action'] == 'UPDATEPRACTICALMARKS') {

    $EXAM_STUDENT = new ExamStudent($_POST['exam_student_id']);
    $EXAM = new SheduleExam($EXAM_STUDENT->exam_id);
    $practical_marks = $_POST['marks'];
    $mcq_marks = $EXAM_STUDENT->mcq_marks;
    $essay_marks = $EXAM_STUDENT->essay_marks;

    if ($practical_marks >= 50)
        $grade = "Pass";
    else
        $grade = "Repeat";


    if ($EXAM->is_had_practical == 1) {
        if ($EXAM->type == 1) {
            $full_marks = $mcq_marks + $practical_marks;
            $final_avg = $full_marks / 2;
            if ($mcq_marks >= 35 && $practical_marks >= 50) {
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
        } elseif ($EXAM->type == 2) {
            $full_marks = $essay_marks + $practical_marks;
            $final_avg = $full_marks / 2;
            if ($essay_marks >= 35 && $practical_marks >= 50) {
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
            $full_marks = $mcq_marks + $essay_marks + $practical_marks;
            $final_avg = $full_marks / 2;
            if (($mcq_marks + $essay_marks) >= 35) {
                $EXAM_STUDENT1 = new ExamStudent($_POST['exam_student_id']);
                $EXAM_STUDENT1->mcq_grade = 'Pass';
                $EXAM_STUDENT1->essay_grade = 'Pass';
                $EXAM_STUDENT1->updateTheoryGrades();
            }
            if (($mcq_marks + $essay_marks) >= 35 && $practical_marks >= 50) {
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

    $EXAM_STUDENT->practical_marks = $practical_marks;
    $EXAM_STUDENT->practical_grade = $grade;
    $EXAM_STUDENT->full_marks = $final_avg;
    $EXAM_STUDENT->grade = $final_grade;
    $EXAM_STUDENT->practical_marks_updated_at = $createdAt;
    $EXAM_STUDENT->practical_marks_updated_by = $_SESSION['id'];
    $EXAM_STUDENT->updatePracticalExamAndFullMarks();
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}
if (isset($_POST['action']) && $_POST['action'] == 'UPDATECERTIFICATENO') {
    $STUDENT = new Student($_POST['student_id']);
    if ($_POST['certificate_no'] == 0) {
        $certificate_no = null;
    } else {
        $STU = new Student(null);
        $student_no_is_exist = $STU->checkCertificateNoIsExist($_POST['certificate_no']);
        if ($student_no_is_exist) {
            $result = ["status" => 'duplicate-no'];
            echo json_encode($result);
            exit();
        }
        $certificate_no = $_POST['certificate_no'];
    }
    $STUDENT->certificate_no = $certificate_no;
    $STUDENT->updateCertificateNo();
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}
if (isset($_POST['action']) && $_POST['action'] == 'CHECKAVAILABLECERTIFICATECOUNT') {
    $EXAM_PERIOD = new ExamPeriod(null);
    $exam_period = $EXAM_PERIOD->getExamPeriodByYearAndBatch($_POST['year'], $_POST['batch']);

    $printed_count = $exam_period['printed_count'];
    if ($exam_period['printed_count'] >= $exam_period['certificate_count']) {
        $status = "exceed";
    } else {
        $status = "not-exceed";
    }
    $result = ["status" => $status];
    echo json_encode($result);
    exit();
}

//create update
if (isset($_POST['update'])) {

    $SCHEDULE_EXAM = new SheduleExam($_POST['id']);
    $SCHEDULE_EXAM->course_id = $_POST['course_id'];
    $SCHEDULE_EXAM->type = $_POST['type'];

    $SCHEDULE_EXAM->start_date = date("Y-m-d", strtotime($_POST['start_date']));
    $SCHEDULE_EXAM->time = $_POST['time'];
    $SCHEDULE_EXAM->duration = $_POST['duration'];
    $SCHEDULE_EXAM->number_of_question = $_POST['number_of_question'];

    $SCHEDULE_EXAM->update();
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}

//  update note student 
if (isset($_POST['action']) && $_POST['action'] === 'update-note') {
   
    $id = $_POST['exam_id'];
    $note = $_POST['note'];

     

    $EXAM_STUDENT = new ExamStudent($id);
    $EXAM_STUDENT->note = $note;

    if ($EXAM_STUDENT->updateNote()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update note."]);
    }
    exit();
}

