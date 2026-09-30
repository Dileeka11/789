<?php

include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

//create course type
if (isset($_POST['create'])) {

    $EXAMPERIOD = new ExamPeriod(NULL);
    $EXAMPERIOD->year = $_POST['year'];
    $EXAMPERIOD->batch = $_POST['batch'];
    $EXAMPERIOD->qu_count = $_POST['qu_count'];

    $EXAMPERIOD->batch_start_date = date('Y-m-d', strtotime($_POST['batch_start_date']));
    $EXAMPERIOD->batch_end_date = date('Y-m-d', strtotime($_POST['batch_end_date']));

    $EXAMPERIOD->create();

    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}

//update course type
if (isset($_POST['update'])) {

    $EXAMPERIOD = new ExamPeriod($_POST['id']);

    $EXAMPERIOD->year = $_POST['year'];
    $EXAMPERIOD->batch = $_POST['batch'];

    $EXAMPERIOD->batch_start_date = date('Y-m-d', strtotime($_POST['batch_start_date']));
    $EXAMPERIOD->batch_end_date = date('Y-m-d', strtotime($_POST['batch_end_date']));
    $EXAMPERIOD->certificate_issued_date =  date('Y-m-d', strtotime($_POST['certificate_issued_date']));  

    $EXAMPERIOD->update();

    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}
