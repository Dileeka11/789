<?php

include_once(dirname(__FILE__) . '../../../class/include.php');
header('Content-Type: application/json; charset=UTF8');


//create fedaration
if (isset($_POST['create'])) {

    $FEDARATION = new Fedaration(NULL);

    $FEDARATION->name = $_POST['name'];
    $FEDARATION->address = $_POST['address'];
    $FEDARATION->mobile_number = $_POST['mobile_number'];
    $FEDARATION->office_number = $_POST['office_number'];
    $FEDARATION->email = $_POST['email'];

    $FEDARATION->create();
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}

//create fedaration
if (isset($_POST['update'])) {

    $FEDARATION = new Fedaration($_POST['id']);

    $FEDARATION->name = $_POST['name'];
    $FEDARATION->address = $_POST['address'];
    $FEDARATION->mobile_number = $_POST['mobile_number'];
    $FEDARATION->office_number = $_POST['office_number'];
    $FEDARATION->email = $_POST['email'];

    $FEDARATION->update();
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}
