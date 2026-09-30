<?php
 include '../../../class/include.php';

if ($_POST['option'] == 'delete') {

    $SCHEDULE_EXAM = new SheduleExam($_POST['id']);
 
    $result = $SCHEDULE_EXAM->delete();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}