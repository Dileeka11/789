<?php

include_once(dirname(__FILE__) . '../../../class/include.php');
header('Content-Type: application/json; charset=UTF8');

//create course type
if (isset($_POST['create'])) {

    
   
    
    $FILE = new File(NULL);

    $FILE->creator = $_POST['creator'];
    $FILE->name = $_POST['name'];
    $FILE->number = $_POST['number'];
    $FILE->type = $_POST['type'];
    $FILE->note = $_POST['note'];

    $CREATED = $FILE->create();

    $result = ["status" => 'success', "last_id" => $CREATED];
    echo json_encode($result);
    exit();
}

////update course type
//if (isset($_POST['update'])) {
//
//    $USER_TYPE = new UserType($_POST['id']);
//
//    $USER_TYPE->name = $_POST['name'];
//
//    $USER_TYPE->update();
//
//    $result = ["id" => $_POST['id']];
//    echo json_encode($result);
//    exit();
//}

  //update course type
//update course type
if (isset($_POST['update'])) {

    $FILE = new File($_POST['file']);

   
    $FILE->note = $_POST['note'];
    $FILE->queue = $_POST['type'];

    $FILE->update();
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}
