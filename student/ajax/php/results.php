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
    if ($student) {
        $student_exams = ExamStudent::getStudentExams($student->id);
        if (count($student_exams) > 0) {
            $main_arr = [];
            foreach ($student_exams as $student_exam) {
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
                    if ($EXAM->type == 1) {
                        $theory_status = ($student_exam['mcq_grade'] == 'Repeat') ? 'Repeat' : ((($student_exam['mcq_grade'] == '' || $student_exam['mcq_grade'] == null) && $student_exam['mcq_marks'] == 0) ? 'AB' : $student_exam['mcq_grade']);
                    } elseif ($EXAM->type == 2) {
                        $theory_status = ($student_exam['essay_grade'] == 'Repeat') ? 'Repeat' : ((($student_exam['essay_grade'] == '' || $student_exam['essay_grade'] == null) && $student_exam['essay_marks'] == 0) ? 'AB' : $student_exam['essay_grade']);
                    } elseif ($EXAM->type == 3) {
                        $theory_status = ($student_exam['mcq_grade'] == 'Repeat' || $student_exam['essay_grade'] == 'Repeat') ? 'Repeat' : (((($student_exam['essay_grade'] == '' || $student_exam['essay_grade'] == null) && $student_exam['essay_marks'] == 0) || (($student_exam['mcq_grade'] == '' || $student_exam['mcq_grade'] == null) && $student_exam['mcq_marks'] == 0)) ? 'AB' : $student_exam['mcq_grade']);
                    }
                    $arr['theory_status'] = $theory_status;
                } else {
                    $arr = [];
                    $arr['status'] = 'error';
                    $arr['msg'] = "Your exam results are not released yet.";
                }
                array_push($main_arr, $arr);
            }
            $arr1 = [];
            $arr1['status'] = 'success';
            $arr1['results'] = $main_arr;
        } else {
            $arr1 = [];
            $arr1['status'] = 'error';
            $arr1['msg'] = "There is no exam you have attended.";
        }
    } else {
        $arr1 = [];
        $arr1['status'] = 'error';
        $arr1['msg'] = "There is no student in our recods according to this NIC number.";
    }
} elseif ($_POST['nic_no'] != '') {
    $student1 = new Student(null);
    $student1 = $student1->getStudentByNIC1($_POST['nic_no']);

    $main_arr = [];
    foreach ($student1 as $st1) {
        $student = new Student($st1['id']);
        if ($student) {
            $student_exams = ExamStudent::getStudentExams($student->id);
            if (count($student_exams) > 0) {
                foreach ($student_exams as $student_exam) {
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
                    array_push($main_arr, $arr);
                }
                $arr1 = [];
                $arr1['status'] = 'success';
            } else {
                $arr1 = [];
                $arr1['status'] = 'error';
                $arr1['msg'] = "There is no exam you have attended.";
            }
        } else {
            $arr1 = [];
            $arr1['status'] = 'error';
            $arr1['msg'] = "There is no student in our recods according to this NIC number.";
        }
        $arr1['results'] = $main_arr;
    }
}

// dd($arr1);
// $student = Student::getStudentByNIC($_POST['student_id']);

echo json_encode($arr1);
exit();
