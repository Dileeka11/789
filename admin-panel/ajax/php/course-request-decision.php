<?php

include '../../../class/include.php';

//approved course request
if ($_POST['action'] == 'approved') {
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
 
//Reject course request
if ($_POST['action'] == 'rejected') {


    $COURSE_REQUEST = new CourseRequest($_POST['id']);

 
    $COURSE_REQUEST->description = $_POST['description'];
    $COURSE_REQUEST->status = 2;

    $res = $COURSE_REQUEST->rejectRequest();
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

