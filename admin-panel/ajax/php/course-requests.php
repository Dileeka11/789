<?php

include '../../../class/include.php';

//course create
if (isset($_POST['create'])) {

    date_default_timezone_set('Asia/Colombo');
    $createdAt = date('Y-m-d H:i:s');

    $COURSE_REQUEST = new CourseRequest(NULL);

    $COURSE_REQUEST->course_id = $_POST['course_id'];
    $COURSE_REQUEST->center_id = $_POST['center_id'];
    $COURSE_REQUEST->num_students = $_POST['num_students'];
    $COURSE_REQUEST->year = $_POST['year'];
    $COURSE_REQUEST->batch = $_POST['batch'];
    $COURSE_REQUEST->teaching_days = $_POST['teaching_days'];
    $COURSE_REQUEST->course_fee = $_POST['course_fee'];
    $COURSE_REQUEST->dg_approvel = $_POST['dg_approvel'];
    $COURSE_REQUEST->request_date = $createdAt;

    $res = $COURSE_REQUEST->create();
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

//course create
if (isset($_POST['update'])) {

    date_default_timezone_set('Asia/Colombo');
    $createdAt = date('Y-m-d H:i:s');

    $COURSE_REQUEST = new CourseRequest($_POST['id']);

    $COURSE_REQUEST->course_id = $_POST['course_id'];
    $COURSE_REQUEST->num_students = $_POST['num_students'];
    $COURSE_REQUEST->teaching_days = $_POST['teaching_days'];
    $COURSE_REQUEST->course_fee = $_POST['course_fee'];
    $COURSE_REQUEST->dg_approvel = $_POST['dg_approvel'];
    $COURSE_REQUEST->year = $_POST['year'];
    $COURSE_REQUEST->batch = $_POST['batch'];
    $COURSE_REQUEST->request_date = $createdAt;

    $res = $COURSE_REQUEST->update();

    $result = [
        "status" => 'success'
    ];
    echo json_encode($result);
    exit();
}
  