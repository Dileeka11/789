<?php

include '../../class/include.php';


//get course by type
if ($_POST['action'] == 'GET_COURSE_NAME') {

    $COURSE = new Course(NULL);

    $result = $COURSE->getCourseByTypeAndDuration($_POST["type"], $_POST['duration']);
    echo json_encode($result);

    exit();
}
