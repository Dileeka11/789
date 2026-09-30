<?php

include_once(dirname(__FILE__) . '../../../class/include.php');
header('Content-Type: APPLICATION/json; charset=UTF8');


//create fedaration
if (isset($_POST['create'])) {

    $APPLICATION = new Application(NULL);
    $APPLICATION_DOCUMENT = new ApplicationDocumentation(NULL);

    $APPLICATION->fedaration_id = $_POST['fedaration_id'];
    $APPLICATION->tournament_name = $_POST['tournament_name'];
    $APPLICATION->type = $_POST['type'];
    $APPLICATION->tournament_dg_status = $_POST['tournament_dg_status'];
    $APPLICATION->number_of_participant = $_POST['number_of_participant'];
    $APPLICATION->tournament_duration = $_POST['tournament_duration'];
    $APPLICATION->arrival_date = $_POST['arrival_date'];
    $APPLICATION->departure_date = $_POST['departure_date'];
    $APPLICATION->fedaration_status = $_POST['fedaration_status'];
    $APPLICATION->protocol_officer_status = $_POST['protocol_officer_status'];

    $res = $APPLICATION->create();
     


    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}


//update doc
if (isset($_POST['update'])) {

    $APPLICATION = new SelectedDocumentsByTypes($_POST['id']);

    $APPLICATION->document_id = $_POST['document_id'];

    $APPLICATION->update();
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}
 