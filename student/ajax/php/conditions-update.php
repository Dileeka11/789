<?php

include_once(dirname(__FILE__) . '../../../class/include.php');
header('Content-Type: application/json; charset=UTF8');


 


//update doc
if (isset($_POST['update'])) {

    $CONDITIONS = new Conditions($_POST['id']);
 
    $CONDITIONS->title = $_POST['conditions'];

    $CONDITIONS->update();
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}
 