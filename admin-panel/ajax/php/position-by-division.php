<?php

include '../../../class/include.php';


 
//get course by type
if ($_POST['action'] == 'GET_All_POSITION_BY_DIVISION') {

    $DIVISION_POSITIONS = new DivisionPositions(NULL);

    $result = $DIVISION_POSITIONS->getPositionByDivision($_POST["type"]);
    
    echo json_encode($result);

    exit();
}


 
//get course by type
if ($_POST['action'] == 'GET_POSITION_BY_DIVISION') {

    $DIVISION_POSITIONS = new DivisionPositions(NULL);

    $result = $DIVISION_POSITIONS->getPositionNameByDivision($_POST["type"]);
    
    echo json_encode($result);

    exit();
}

//get course by type
if ($_POST['action'] == 'GET_POSITION_DETAILSN') {

    $DIVISION_POSITIONS = new DivisionPositions($_POST["type"]);

    $result = ["name" => $DIVISION_POSITIONS->name,"email"=>$DIVISION_POSITIONS->email,"phone"=>$DIVISION_POSITIONS->phone_number];
    echo json_encode($result);
    exit();
}

  
//hold position
if ($_POST['action'] == 'HOLD_POSITION') {

    date_default_timezone_set('Asia/Colombo');
    $createdAt = date('Y-m-d');
    
    $DIVISION_POSITIONS = new DivisionPositions($_POST["id"]);

    $DIVISION_POSITIONS->status = 1;
    $DIVISION_POSITIONS->end_time = $createdAt; 

    $res = $DIVISION_POSITIONS->updatePositionHold();

    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}
