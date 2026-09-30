<?php

include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');



//create fedaration
if (isset($_POST['create'])) {

    $SCHEDULE_EXAM = new SheduleExam(NULL);


    $SCHEDULE_EXAM->course_id = $_POST['course_id'];
    $SCHEDULE_EXAM->start_date = date("Y-m-d", strtotime($_POST['start_date']));
    $SCHEDULE_EXAM->time = $_POST['time'];
    $SCHEDULE_EXAM->type = $_POST['type'];
    $SCHEDULE_EXAM->year = $_POST['year'];
    $SCHEDULE_EXAM->batch = $_POST['batch'];
    $SCHEDULE_EXAM->is_had_practical = $_POST['is_had_practical'];
    $SCHEDULE_EXAM->duration = $_POST['duration'];
    $SCHEDULE_EXAM->number_of_question = $_POST['number_of_question'];
    $SCHEDULE_EXAM->is_manual = $_POST['is_manual'];
    $SCHEDULE_EXAM->is_center = $_POST['is_center'];
    $SCHEDULE_EXAM->exam_category = $_POST['exam_category'];
    
    $res = $SCHEDULE_EXAM->create();
    if ($_POST['is_manual'] == 1 && count($_POST['assign_students']) > 0) {
        foreach ($_POST['assign_students'] as $student) {
            $EXAMSTUDENT = new ExamStudent(null);
            $EXAMSTUDENT->student_id = $student;
            $EXAMSTUDENT->exam_id = $res;
            $EXAMSTUDENT->status = 0;
            $EXAMSTUDENT->create();
        }
    }
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}

//create update
if (isset($_POST['update'])) {

    $SCHEDULE_EXAM = new SheduleExam($_POST['id']);
    $SCHEDULE_EXAM->course_id = $_POST['course_id'];
    $SCHEDULE_EXAM->type = $_POST['type'];
    $SCHEDULE_EXAM->is_had_practical = $_POST['is_had_practical'];
    $SCHEDULE_EXAM->year = $_POST['year'];
    $SCHEDULE_EXAM->batch = $_POST['batch'];

    $SCHEDULE_EXAM->start_date = date("Y-m-d", strtotime($_POST['start_date']));
    $SCHEDULE_EXAM->time = $_POST['time'];
    $SCHEDULE_EXAM->duration = $_POST['duration'];
    $SCHEDULE_EXAM->number_of_question = $_POST['number_of_question'];
    $SCHEDULE_EXAM->is_manual = $_POST['is_manual'];

    $SCHEDULE_EXAM->update();
    if ($_POST['is_manual'] == 1 && count($_POST['assign_students']) > 0) {
        $EXAMSTUDENT = new ExamStudent(null);
        $exam_students = $EXAMSTUDENT->getStudentIdsByExamId($SCHEDULE_EXAM->id);
        foreach ($_POST['assign_students'] as $student) {
            if (!in_array($student, $exam_students)) {
                $EXAMSTUDENT = new ExamStudent(null);
                $EXAMSTUDENT->student_id = $student;
                $EXAMSTUDENT->exam_id = $SCHEDULE_EXAM->id;
                $EXAMSTUDENT->status = 0;
                $EXAMSTUDENT->create();
            }
        }
        foreach ($exam_students as $student) {
            if (!in_array($student, $_POST['assign_students'])) {
                $EXAMSTUDENT = new ExamStudent(null);
                $EXAMSTUDENT->deleteStudentByExamId($student, $SCHEDULE_EXAM->id);
            }
        }
    } else {
        $EXAMSTUDENT = new ExamStudent(null);
        $exam_students = $EXAMSTUDENT->deleteStudentsByExamId($SCHEDULE_EXAM->id);
    }
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}

if (isset($_POST['option']) && $_POST['option'] == 'updateresult') {

    $SCHEDULE_EXAM = new SheduleExam($_POST['id']);
    $SCHEDULE_EXAM->is_result_released = $_POST['status'] == 1 ? '0' : '1';

    $SCHEDULE_EXAM->updateReleaseStatus();
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}


//Update Practical mark
if ($_POST['option'] == 'updatepractical') {

 

    $STUDENT = new Student(Null);
     
    $STUDENT->updateStudentPracticalMark($_POST['course']);
     
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}

//update MCQ Mark
if ($_POST['option'] == 'updatemcq') {

 

    $STUDENT = new Student(Null);
     
    $STUDENT->updateMcqStudentMark($_POST['course']);
     
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}


//update MCQ Mark
if ($_POST['option'] == 'aditional_mcq') {


 
    $STUDENT = new SheduleExam(Null);
     
    $STUDENT->deleteAdditionalQuestions($_POST['id'],$_POST['exam_id']);
     
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}



if (isset($_POST['option']) && $_POST['option'] == 'GETASSIGNSTUDENTS') {
    $STUDENT = new Student(null);
    $students = $STUDENT->getStudentsByCourseAndBatch($_POST['course'], $_POST['year'], $_POST['batch']);

    $result['status'] = 'success';
    $result['students'] = $students;
    echo json_encode($result);
    exit();
}
