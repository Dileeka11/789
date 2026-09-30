<?php

include '../../../class/include.php';


//get course by type
if ($_POST['action'] == 'REQUEST_OPEN_OR_CLOSE') {

    $REQUEST_OPEN_CLOSE = new RequestOpenClose(1);
    $REQUEST_OPEN_CLOSE->status = $_POST["id"];

    $result = $REQUEST_OPEN_CLOSE->update();
    echo json_encode($result);

    exit();
}


//get course by year
if ($_POST['action'] == 'GET_COURSE_BY_YEAR') {

    $COURSE_REQUEST = new CourseRequest(NULL);

    $result = $COURSE_REQUEST->getCourseIdByYear($_POST["year"], $_POST["batch"], $_POST["center_id"]);

    echo json_encode($result);

    exit();
}

 
