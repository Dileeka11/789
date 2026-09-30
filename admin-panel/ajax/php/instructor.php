<?php

include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

//create course type
if (isset($_POST['create'])) {

    $USER = new User(NULL);
    $USER1 = $USER->createInstructors($_POST['name'],$_POST['center'], $_POST['email'], $_POST['phone'], $_POST['username'], $_POST['password']);
// dd(serialize($_POST['courses']));
    if($USER1) {
        $INSTRUCTOR_COURSES = new InstructorCourses(null);
        $INSTRUCTOR_COURSES->user_id =$USER1;
        $INSTRUCTOR_COURSES->courses = serialize($_POST['courses']);
        $INSTRUCTOR_COURSES->create();
    }

    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}

//update course type
if (isset($_POST['update'])) {

    $USER = new User($_POST['id']);

    $USER->name = $_POST['name'];
    $USER->type = 7;
    $USER->center_id = $_POST['center_id'];
    $USER->email = $_POST['email'];
    $USER->phone = $_POST['phone'];
    $USER->username = $_POST['username'];
    $USER->isActive = $_POST['paper_instructor'];

    $USER->update();
     
    $INSTRUCTOR_COURSES = new InstructorCourses(null);
    $res = $INSTRUCTOR_COURSES->getInstructorCourses($_POST['id']);
    $INSTRUCTOR_COURSES1 = new InstructorCourses($res['id']);
    $INSTRUCTOR_COURSES1->courses = serialize($_POST['courses']);
    $INSTRUCTOR_COURSES1->update();

    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}

//update password

if (isset($_POST['change_password'])) {
    $USER = new User(NULL);
    $id = $_POST["id"];
    $password = $_POST["password"];


    if ($password != NULL) {

        $USER->updatePasswordAdmin($password, $id);
        $result = ["status" => 'success'];
        echo json_encode($result);
        exit();
    } else {
        $result = ["status" => 'error'];
        echo json_encode($result);
        exit();
    }
}
if (isset($_POST['option']) && $_POST['option'] == 'UPDATESTATUS') {
 

    $USER = new User(null);

    $result = $USER->updateInstructorStatus($_POST['status'],$_POST['id']);

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}