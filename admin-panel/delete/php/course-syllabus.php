<?php

include '../../../class/include.php';

if ($_POST['option'] == 'delete') {
     
     
    $COURSESYLLABUS = new CourseSyllabus($_POST['id']);

    $result = $COURSESYLLABUS->delete();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}