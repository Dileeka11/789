<?php

include '../../class/include.php';
header('Content-Type: application/json; charset=UTF8');
if (!isset($_SESSION)) {
    session_start();
}
if ($_POST['application'] == 'application_01') {

    $APPLICATION = new Application(null);
    $APPLICATION->type = $_POST['type'];
    $APPLICATION->user_id = $_SESSION['id'];
    $APPLICATION->fedaration_id = $_POST['fedaration'];
    $APPLICATION->tournament_name = $_POST['tournament_name'];
    $APPLICATION->tournament_location = $_POST['location'];
    $APPLICATION->number_of_participant = $_POST['number_of_participation_countries'];
    $APPLICATION->tournament_duration = $_POST['tournament_duration'];
    $APPLICATION->arrival_date = $_POST['arrival_date'];
    $APPLICATION->departure_date = $_POST['departure_date'];

    $result = $APPLICATION->create();
    if ($result) {
        $arr['status'] = 'success';
        $arr['id'] = $result;
    } else {
        $arr['status'] = 'error';
    }
    echo json_encode($arr);
    exit();
}
if ($_POST['application'] == 'application_02') {
    $count = $_POST['member_count'];

var_dump($count);
exit();
    for ($i = 1; $i <= $count; $i++) {
        if (isset($_POST['member_name_' . $i])) {
            $MEMBER = new ApplicationMember(null);
            $MEMBER->application_id = $_POST['app_id'];
            $MEMBER->name = $_POST['member_name_' . $i];
            $MEMBER->position = $_POST['position_' . $i];
            $MEMBER->passport_no = $_POST['passport_no_' . $i];
            $MEMBER->passport_image = $_POST['file_name_' . $i];
            $MEMBER->queue = $i;
            $result = $MEMBER->create();
        }
    }
    if ($result) {
        $arr['status'] = 'success';
        $arr['id'] = $_POST['app_id'];
    } else {
        $arr['status'] = 'error';
    }
    echo json_encode($arr);
    exit();
}
if ($_POST['application'] == 'application_03') {
    $count = $_POST['doc_count'];


    for ($i = 1; $i <= $count; $i++) {
        $DOCUMENT = new ApplicationDocumentation(null);
        $DOCUMENT->application_id = $_POST['app_id'];
        $DOCUMENT->document_id = $_POST['doc_' . $i];
        $DOCUMENT->file_name = $_POST['file_name_' . $i];
        $DOCUMENT->status = 0;
        $result = $DOCUMENT->create();
    }
    if ($result) {
        $arr['status'] = 'success';
        $arr['id'] = $_POST['app_id'];
    } else {
        $arr['status'] = 'error';
    }
    echo json_encode($arr);
    exit();
}

if ($_POST['application'] == 'application_04') {
    $id = $_POST['app_id'];
    $APPLICATION = new Application($id);
    $APPLICATION->application_latest_user = 3;
    $APPLICATION->application_latest_status = 0;
    $result = $APPLICATION->updateLatestUserAndStatus();

    if ($result) {
        $arr['status'] = 'success';
        $arr['id'] = $_POST['app_id'];
    } else {
        $arr['status'] = 'error';
    }
    echo json_encode($arr);
    exit();
}
var_dump($_POST['application']);
exit();

if ($_POST['application'] == 'government_check') {

    $id = $_POST['app_id'];

    $APPFEDARATION = new Application($id);
    if ($_POST['name'] == 'players_participant') {
        $APPFEDARATION->players_participant = 1;

        $result = $APPLICATION->update();
    }


    if ($result) {
        $arr['status'] = 'success';
        $arr['id'] = $_POST['app_id'];
    } else {
        $arr['status'] = 'error';
    }
    echo json_encode($arr);
    exit();
}

if ($_POST['application'] == 'REAPPLY') {
    $id = $_POST['app_id'];
    $APPLICATION = new Application($id);
    $APPLICATION->application_latest_user = 3;
    $APPLICATION->application_latest_status = 3;
    $result = $APPLICATION->updateLatestUserAndStatus();

    if ($result) {
        $arr['status'] = 'success';
        $arr['id'] = $_POST['app_id'];
    } else {
        $arr['status'] = 'error';
    }
    echo json_encode($arr);
    exit();
}
