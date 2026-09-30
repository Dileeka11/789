<?php
include '../../../class/include.php'; 
header('Content-Type: application/json; charset=UTF8');

//create course type
if (isset($_POST['create'])) {

    $DIVISION = new Divisions(NULL);

    $DIVISION->name = $_POST['name'];
    $DIVISION->create();

    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
} 

//update course type
if (isset($_POST['update'])) { 
    
    $DIVISION = new Divisions($_POST['id']);

    $DIVISION->name = $_POST['name']; 

    $DIVISION->update();

    $result = ["id" => $_POST['id']];
    echo json_encode($result);
    exit();
}

  