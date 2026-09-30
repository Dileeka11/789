<?php

include '../../../class/include.php';

if ($_POST['option'] == 'delete') {
     
     
    $CENTER_COURSE = new CenterCourses($_POST['id']);

    $result = $CENTER_COURSE->delete();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}