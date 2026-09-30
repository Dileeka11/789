<?php
include '../../../class/include.php'; 
header('Content-Type: application/json; charset=UTF8');

//create course type
if (isset($_POST['create'])) {

    $POSITIONS = new Positions(NULL);

    $POSITIONS->name = $_POST['name'];
    $POSITIONS->level = $_POST['level'];
    $POSITIONS->create();

    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
} 

//update course type
if (isset($_POST['update'])) { 
    
    $POSITIONS = new Positions($_POST['id']);

    $POSITIONS->name = $_POST['name']; 
    $POSITIONS->level = $_POST['level']; 

    $POSITIONS->update();

    $result = ["id" => $_POST['id']];
    echo json_encode($result);
    exit();
}
//create course type
if (isset($_POST['create_position'])) {

    $DIVISION_POSITIONS = new DivisionPositions(NULL);

    $DIVISION_POSITIONS->name = ucwords($_POST['name']);
    $DIVISION_POSITIONS->position_id = $_POST['position'];
    $DIVISION_POSITIONS->division_id = $_POST['division_id'];
    $DIVISION_POSITIONS->email = $_POST['email'];
    $DIVISION_POSITIONS->phone_number = $_POST['phone_number'];
    $DIVISION_POSITIONS->start_date = $_POST['start_date'];

    $DIVISION_POSITIONS->create();

    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
} 

//update course type
if (isset($_POST['update_position'])) { 
    
    $DIVISION_POSITIONS = new DivisionPositions($_POST['id']);

    $DIVISION_POSITIONS->name = ucwords($_POST['name']);
    $DIVISION_POSITIONS->position_id = $_POST['position']; 
    $DIVISION_POSITIONS->email = $_POST['email'];
    $DIVISION_POSITIONS->phone_number = $_POST['phone_number'];
    $DIVISION_POSITIONS->start_date = $_POST['start_date'];

    $DIVISION_POSITIONS->update();

    $result = ["id" => $_POST['id']];
    echo json_encode($result);
    exit();
}

  