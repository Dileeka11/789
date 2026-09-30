<?php

include '../../../class/include.php';

header('Content-Type: application/json; charset=UTF8');

//drop out student
if ($_POST['option'] == 'dropout') {


    $STUDENT = new Student($_POST['id']);

 date_default_timezone_set('Asia/Colombo');
    $createdAt = date('Y-m-d H:i:s');
    $STUDENT->drop_out_date = $createdAt;
    $STUDENT->isActive = 1;

    $res = $STUDENT->updateIsActive();

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
