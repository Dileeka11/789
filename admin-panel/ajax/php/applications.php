<?php

include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

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

    $APPLICATIONS->create();
    $result = ["status" => 'success'];

    echo json_encode($result);

    exit();
}





//update doc

if (isset($_POST['update'])) {
    $COURSE = new Course($_POST['course']);
    $CENTERS = new Centers($_POST['center']);

    $APPLICATIONS = new Student($_POST['id']);
    $APPLICATIONS->nic = $_POST['nic'];
    $APPLICATIONS->fname = $_POST['fname'];
    $APPLICATIONS->lname = $_POST['lname'];
    $APPLICATIONS->course_id = $_POST['course'];
    $APPLICATIONS->course_name = $COURSE->cname;
    $APPLICATIONS->centercode = $_POST['center'];
    $APPLICATIONS->centername = $CENTERS->center_name;
    $APPLICATIONS->year = $_POST['year'];
    $APPLICATIONS->batch = $_POST['batch'];

    $res = $APPLICATIONS->update();
    if ($res) {
        $result = ["status" => 'success'];
    } else {
        $result = ["status" => 'error'];
    }

    echo json_encode($result);

    exit();
}
 
//applied students
if ($_POST['option'] == 'applied_to_students') {


    $APPLICATIONS = new Applications($_POST['id']);
    $COURSE_REQUEST = new CourseRequest($APPLICATIONS->request_course_id);

    $STUDENT = new Student(NULL);

    $STUDENT->fname = $APPLICATIONS->full_name;
    $STUDENT->nic = $APPLICATIONS->nic;
    $STUDENT->course_id = $COURSE_REQUEST->course_id;
    $STUDENT->centercode = $APPLICATIONS->center_id;
    $STUDENT->year = $COURSE_REQUEST->year;
    $STUDENT->batch = $COURSE_REQUEST->batch;
    $STUDENT->application_id = $_POST['id'];
    $STUDENT->request_course_id = $APPLICATIONS->request_course_id;

    $APPLICATIONS->status = 1;

    $APPLICATIONS->updateStatus();
    $res = $STUDENT->create();
 
    if ($res) {
        $result = [
            "status" => 'success',
            "id" => base64_encode($res),
            
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