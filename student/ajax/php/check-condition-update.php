<?php

include_once(dirname(__FILE__) . '../../../class/include.php');
header('Content-Type: application/json; charset=UTF8');




$CHECK_CONDITIONS = new CheckCondition($_POST['id']);

  
$CHECK_CONDITIONS->check_condition = 0;

$CHECK_CONDITIONS->update();
$result = ["status" => 'success'];
echo json_encode($result);
exit();
