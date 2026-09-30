<?php

include '../../class/include.php'; 

//create student

if (isset($_POST['create'])) {
    

    $APPLICATIONS = new Applications(NULL);
    
    $APPLICATIONS->full_name = ucwords($_POST['full_name']);
    $APPLICATIONS->address = ucwords($_POST['address']);
    $APPLICATIONS->nic = $_POST['nic'];
    $APPLICATIONS->whatsapp_number = $_POST['whatsapp_number'];
    $APPLICATIONS->mobile_number = $_POST['mobile_number'];
    $APPLICATIONS->province_id = $_POST['province_id'];
    $APPLICATIONS->district_id = $_POST['district_id'];
    $APPLICATIONS->divisional_id = $_POST['divisional_id'];
    $APPLICATIONS->gn_id = $_POST['gn_id'];
    $APPLICATIONS->email = $_POST['email'];
    $APPLICATIONS->education_level = $_POST['education_level'];
    $APPLICATIONS->gender = $_POST['gender'];
    $APPLICATIONS->birth_date = $_POST['birth_date'];
    
    $APPLICATIONS->course_id = $_POST['course_id'];
    $APPLICATIONS->request_course_id = $_POST['request_course_id'];
    $APPLICATIONS->center_id = $_POST['center_id'];

    $res = $APPLICATIONS->create();
    if ($res) {
        $result = [
            "status" => 'success'
        ];
        echo json_encode($result);
        exit();
    } else {
        $result = [
            "status" => 'error'
        ];
        echo json_encode($result);
        exit();
    }
}


 
if (isset($_POST['create_instructor'])) {

    $USER = new User(NULL);
    $USER1 = $USER->createInstructors(ucwords($_POST['full_name']),$_POST['center_id'], $_POST['email'], $_POST['mobile_number'], $_POST['full_name'], $_POST['password']);
// dd(serialize($_POST['courses']));
    if ($USER1) {
        $INSTRUCTOR_COURSES = new InstructorCourses(null);
        $INSTRUCTOR_COURSES->user_id = $USER1;
        $INSTRUCTOR_COURSES->courses = serialize($_POST['courses']);
        $INSTRUCTOR_COURSES->create();
    }

    include '../../class/ESMSWS.php';


    $number = $_POST['mobile_number'];
    $url = 'http://www.nyscexam.com/admin-panel/';
    
    $message = 'Hellow.. ' . ucwords($_POST['full_name']) . '. Welcome to Online Exam System..! This is your Login Details. Your Login Email -  ' . $_POST['email'] . ' and Your Password  ' . $_POST['password'] . ' Please click this link for login ' . $url . ' Thank You.! ';

    $session = session_start();
    $session = createSession('', 'esmsusr_is1lsgxV', 'Pugoda@2023', '');
    sendMessagesMultiLang($session, 'SL YOUTH', $message, array($number), 0);
    closeSession($session);

    $result = ["status" => 'success'];

    echo json_encode($result);

    exit();
}
