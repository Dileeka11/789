<?php

include '../../../class/include.php';

//course create
if (isset($_POST['create'])) {


    $CENTER = new Centers(NULL);
   
    
    $CENTER->centercode = $_POST['centercode'];
    $CENTER->center_name = $_POST['center_name'];
    $CENTER->province = $_POST['province'];
    $CENTER->districid = $_POST['district_id'];

    $res = $CENTER->create();
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

    $COURSE_TRADE = new CourseTrade($_POST['id']);


    $COURSE_TRADE->trade_name = $_POST['trade_name'];
    $COURSE_TRADE->trade_code = $_POST['trade_code'];


    $res = $COURSE_TRADE->update();

    $result = [
        "status" => 'success'
    ];
    echo json_encode($result);
    exit();
}

if ($_POST['option'] == 'approved') {


    $COURSE_REQUEST = new CourseRequest($_POST['id']);


    $COURSE_REQUEST->status = 1;

    $res = $COURSE_REQUEST->updateStatus();
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