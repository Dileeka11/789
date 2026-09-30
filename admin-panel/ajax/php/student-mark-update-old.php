<?php

include '../../../class/include.php';
header('Content-Type: APPLICATION/json; charset=UTF8');
date_default_timezone_set('Asia/Colombo');
$createdAt = date('Y-m-d H:i:s');
if (!isset($_SESSION)) {
    session_start();
}
//update doc
if (isset($_POST['update'])) {

    $STUDENT = new Student($_POST['id']);

    $STUDENT->practical_mark = $_POST['practical_mark'];
    // $STUDENT->mcq_mark = $_POST['mcq_mark'];
    // $STUDENT->writing_paper_mark = $_POST['writing_paper_mark'];
    $STUDENT->total_mark = 0;

    $STUDENT->updateMarks();

    $marks = $_POST['practical_mark'];
    // if ($marks >= 80)
    //     $grade = "A";
    // else if ($marks >= 66)
    //     $grade = "B";
    // else if ($marks >= 50)
    //     $grade = "C";
    // else
    //     $grade = "F";

    if ($marks >= 50)
        $grade = "Pass";
    else
        $grade = "Repeat";

    $is_student_exist = ExamStudent::getStudentDetails($_POST['id']);
    if ($is_student_exist) {
        $EXAMSTUDENT = new ExamStudent($is_student_exist['id']);
        $EXAM = new SheduleExam($EXAMSTUDENT->exam_id);
        $mcq_marks = $EXAMSTUDENT->mcq_marks;
        $essay_marks = $EXAMSTUDENT->essay_marks;

        if ($EXAM->is_had_practical == 1) {
            if ($EXAM->type == 1) {
                $full_marks = $mcq_marks + $marks;
                $final_avg = $full_marks / 2;
                if ($mcq_marks >= 35 && $marks >= 50) {
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
                $full_marks = $essay_marks + $marks;
                $final_avg = $full_marks / 2;
                if ($essay_marks >= 35 && $marks >= 50) {
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
                $full_marks = $mcq_marks + $essay_marks + $marks;
                $final_avg = $full_marks / 2;
                if (($mcq_marks + $essay_marks) >= 35) {
                    $grade = 'Pass';
                    $EXAM_STUDENT1 = new ExamStudent($is_student_exist['id']);
                    $EXAM_STUDENT1->mcq_grade = 'Pass';
                    $EXAM_STUDENT1->essay_grade = 'Pass';
                    $EXAM_STUDENT1->updateTheoryGrades();
                }
                if (($mcq_marks + $essay_marks) >= 35 && $marks >= 50) {
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




        $EXAMSTUDENT->practical_marks = $marks;
        $EXAMSTUDENT->practical_grade = $grade;
        $EXAMSTUDENT->full_marks = $final_avg;
        $EXAMSTUDENT->grade = $final_grade;
        $EXAMSTUDENT->practical_marks_updated_at = $createdAt;
        $EXAMSTUDENT->practical_marks_updated_by = $_SESSION['id'];
        $EXAMSTUDENT->updatePracticalExamAndFullMarks();
    } else {
        $EXAMSTUDENT = new ExamStudent(null);
        $EXAMSTUDENT->student_id = $_POST['id'];
        $EXAMSTUDENT->status = 0;
        $EXAMSTUDENT->practical_marks = $marks;
        $EXAMSTUDENT->practical_grade = $grade;
        $EXAMSTUDENT->practical_marks_updated_at = $createdAt;
        $EXAMSTUDENT->practical_marks_updated_by = $_SESSION['id'];
        $EXAMSTUDENT->createPracticalExamMarks();
    }

    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}
if (isset($_POST['update1'])) {

    $STUDENT = new Student($_POST['id']);

    $STUDENT->practical_mark = $_POST['practical_mark'];
    $STUDENT->mcq_mark = $_POST['mcq_mark'];
    $STUDENT->writing_paper_mark = $_POST['theory_mark'];
    $STUDENT->total_mark = 0;

    $STUDENT->updateMarks();


    $mcq_marks = 0;
    $theory_marks = 0;
    $practical_marks = 0;
    $final_avg = '';
    $mcq_grade = '';
    $theory_grade = '';
    $practical_grade = '';
    $final_grade = '';

    if ($_POST['mcq_mark'] != '') {
        $mcq_marks =$_POST['mcq_mark'];
        if ($mcq_marks >= 35)
            $mcq_grade = "Pass";
        else
            $mcq_grade = "Repeat";
    }
    if ($_POST['theory_mark'] != '') {
        $theory_marks =$_POST['theory_mark'];
        if ($theory_marks >= 35)
            $theory_grade = "Pass";
        else
            $theory_grade = "Repeat";
    }
    if ($_POST['practical_mark'] != '') {
        $practical_marks =$_POST['practical_mark'];
        if ($practical_marks >= 50)
            $practical_grade = "Pass";
        else
            $practical_grade = "Repeat";
    }

    $is_student_exist = ExamStudent::getStudentDetails($_POST['id']);
    if ($is_student_exist) {
        $EXAMSTUDENT = new ExamStudent($is_student_exist['id']);
            // $mcq_marks = $EXAMSTUDENT->mcq_marks;
            // $essay_marks = $EXAMSTUDENT->essay_marks;
        
        if ($EXAMSTUDENT->exam_id != 0) {
            $EXAM = new SheduleExam($EXAMSTUDENT->exam_id);
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
                    $full_marks = $theory_marks + $practical_marks;
                    $final_avg = $full_marks / 2;
                    if ($theory_marks >= 35 && $practical_marks >= 50) {
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
                    $full_marks = $mcq_marks + $theory_marks + $practical_marks;
                    $final_avg = $full_marks / 2;
                    if (($mcq_marks + $theory_marks) >= 35) {
                        $grade = 'Pass';
                        $EXAM_STUDENT1 = new ExamStudent($is_student_exist['id']);
                        $EXAM_STUDENT1->mcq_grade = 'Pass';
                        $EXAM_STUDENT1->essay_grade = 'Pass';
                        $EXAM_STUDENT1->updateTheoryGrades();
                    }
                    if (($mcq_marks + $theory_marks) >= 35) {
                        $mcq_grade = "Pass";
                        $theory_grade = "Pass";
                    }
                    if (($mcq_marks + $theory_marks) >= 35 && $practical_marks >= 50) {
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
                } elseif ($EXAM->type == 2) {
                    $full_marks = $theory_marks;
                    $final_avg = $theory_marks;
                    if ($theory_marks >= 35) {
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
                    $full_marks = $mcq_marks + $theory_marks;
                    $final_avg = $full_marks;
                    if (($mcq_marks + $essay_marks) >= 35) {
                        $EXAM_STUDENT1 = new ExamStudent($_POST['exam_student_id']);
                        $EXAM_STUDENT1->mcq_grade = 'Pass';
                        $EXAM_STUDENT1->essay_grade = 'Pass';
                        $EXAM_STUDENT1->updateTheoryGrades();
                    }
                    if (($mcq_marks + $theory_marks) >= 35) {
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
        } else {
            if ($mcq_marks != '' && $theory_marks != '' && $practical_marks != '') {
                $final_avg = ($mcq_marks + $theory_marks + $practical_marks) / 2;
                if (($mcq_marks + $theory_marks) >= 35) {
                    $mcq_grade = "Pass";
                    $theory_grade = "Pass";
                }
                if (($mcq_marks + $theory_marks) >= 35 && $practical_marks >= 50) {
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
            } elseif ($mcq_marks != '' && $theory_marks != '' && $practical_marks == '') {
                $final_avg = ($mcq_marks + $theory_marks);
                if (($mcq_marks + $theory_marks) >= 35) {
                    $mcq_grade = "Pass";
                    $theory_grade = "Pass";
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
            } elseif ($mcq_marks != '' && $theory_marks == '' && $practical_marks == '') {
                $final_avg = ($mcq_marks);
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
            } elseif ($mcq_marks != '' && $theory_marks == '' && $practical_marks != '') {
                $final_avg = ($mcq_marks + $practical_marks) / 2;
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
            } elseif ($mcq_marks == '' && $theory_marks == '' && $practical_marks != '') {
                $final_avg = ($practical_marks) / 2;
                if ($practical_marks >= 50) {
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
            } elseif ($mcq_marks == '' && $theory_marks != '' && $practical_marks != '') {
                $final_avg = ($theory_marks + $practical_marks) / 2;
                if ($theory_marks >= 35 && $practical_marks >= 50) {
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
            } elseif ($mcq_marks == '' && $theory_marks != '' && $practical_marks == '') {
                $final_avg = ($theory_marks);
                if ($theory_marks >= 35) {
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
        $EXAMSTUDENT->mcq_marks = $mcq_marks;
        $EXAMSTUDENT->mcq_grade = $mcq_grade;
        $EXAMSTUDENT->essay_marks = $theory_marks;
        $EXAMSTUDENT->essay_grade = $theory_grade;
        $EXAMSTUDENT->practical_marks = $practical_marks;
        $EXAMSTUDENT->practical_grade = $practical_grade;
        $EXAMSTUDENT->full_marks = $final_avg;
        $EXAMSTUDENT->grade = $final_grade;
        $EXAMSTUDENT->practical_marks_updated_at = $createdAt;
        $EXAMSTUDENT->practical_marks_updated_by = $_SESSION['id'];
        $EXAMSTUDENT->essay_marks_updated_at = $createdAt;
        $EXAMSTUDENT->essay_marks_updated_by = $_SESSION['id'];
        $EXAMSTUDENT->updateTestMarks();
    } else {

        if ($mcq_marks != '' && $theory_marks != '' && $practical_marks != '') {
            $final_avg = ($mcq_marks + $theory_marks + $practical_marks) / 2;
            if (($mcq_marks + $theory_marks) >= 35) {
                $mcq_grade = "Pass";
                $theory_grade = "Pass";
            }
            if (($mcq_marks + $theory_marks) >= 35 && $practical_marks >= 50) {
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
        } elseif ($mcq_marks != '' && $theory_marks != '' && $practical_marks == '') {
            $final_avg = ($mcq_marks + $theory_marks);
            if (($mcq_marks + $theory_marks) >= 35) {
                $mcq_grade = "Pass";
                $theory_grade = "Pass";
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
        } elseif ($mcq_marks != '' && $theory_marks == '' && $practical_marks == '') {
            $final_avg = ($mcq_marks);
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
        } elseif ($mcq_marks != '' && $theory_marks == '' && $practical_marks != '') {
            $final_avg = ($mcq_marks + $practical_marks) / 2;
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
        } elseif ($mcq_marks == '' && $theory_marks == '' && $practical_marks != '') {
            $final_avg = ($practical_marks) / 2;
            if ($practical_marks >= 50) {
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
        } elseif ($mcq_marks == '' && $theory_marks != '' && $practical_marks != '') {
            $final_avg = ($theory_marks + $practical_marks) / 2;
            if ($theory_marks >= 35 && $practical_marks >= 50) {
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
        } elseif ($mcq_marks == '' && $theory_marks != '' && $practical_marks == '') {
            $final_avg = ($theory_marks);
            if ($theory_marks >= 35) {
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

        $EXAMSTUDENT = new ExamStudent(null);
        $EXAMSTUDENT->student_id = $_POST['id'];
        $EXAMSTUDENT->status = 0;
        $EXAMSTUDENT->mcq_marks = $mcq_marks;
        $EXAMSTUDENT->mcq_grade = $mcq_grade;
        $EXAMSTUDENT->essay_marks = $theory_marks;
        $EXAMSTUDENT->essay_grade = $theory_grade;
        $EXAMSTUDENT->practical_marks = $practical_marks;
        $EXAMSTUDENT->practical_grade = $practical_grade;
        $EXAMSTUDENT->full_marks = $final_avg;
        $EXAMSTUDENT->grade = $final_grade;
        $EXAMSTUDENT->practical_marks_updated_at = $createdAt;
        $EXAMSTUDENT->practical_marks_updated_by = $_SESSION['id'];
        $EXAMSTUDENT->essay_marks_updated_at = $createdAt;
        $EXAMSTUDENT->essay_marks_updated_by = $_SESSION['id'];
        $EXAMSTUDENT->createTestMarks();
    }

    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}
