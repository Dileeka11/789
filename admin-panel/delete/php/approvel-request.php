<?php

include '../../../class/include.php';

if ($_POST['option'] == 'delete') {
     

    $COURSE_REQUEST = new CourseRequest(NULL);

    $result = $COURSE_REQUEST->delete($_POST['id']);

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}