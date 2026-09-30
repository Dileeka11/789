<?php

include_once(dirname(__FILE__) . '../../../class/include.php');
header('Content-Type: application/json; charset=UTF8');



//create fedaration
if (isset($_POST['create'])) {

    $CONDITIONS = new Conditions(NULL);
     
     
    $CONDITIONS->type = $_POST['type'];
    $CONDITIONS->title = $_POST['conditions'];

    $CONDITIONS->create();
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
} 