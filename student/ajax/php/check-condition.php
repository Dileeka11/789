<?php

include_once(dirname(__FILE__) . '../../../class/include.php');
header('Content-Type: application/json; charset=UTF8');




$CHECK_CONDITIONS = new CheckCondition(NULL);


$CHECK_CONDITIONS->app_id = $_POST['app_id'];
$CHECK_CONDITIONS->condition_id = $_POST['id'];
$CHECK_CONDITIONS->check_condition = 1;

$CHECK_CONDITIONS->create();
$result = ["status" => 'success'];
echo json_encode($result);
exit();
