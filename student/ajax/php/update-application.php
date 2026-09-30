<?php

include '../../class/include.php';
header('Content-Type: application/json; charset=UTF8');
if (!isset($_SESSION)) {
    session_start();
}
if ($_POST['application'] == 'application_01') {

    $APPLICATION = new Application($_POST['app_id']);
    $APPLICATION->type = $_POST['type'];
    $APPLICATION->user_id = $_SESSION['id'];
    $APPLICATION->fedaration_id = $_POST['fedaration'];
    $APPLICATION->tournament_name = $_POST['tournament_name'];
    $APPLICATION->tournament_location = $_POST['location'];
    $APPLICATION->number_of_participant = $_POST['number_of_participation_countries'];
    $APPLICATION->tournament_duration = $_POST['tournament_duration'];
    $APPLICATION->arrival_date = $_POST['arrival_date'];
    $APPLICATION->departure_date = $_POST['departure_date'];

    $result = $APPLICATION->update();
    if ($result) {
        $arr['status'] = 'success';
        $arr['id'] = $result['id'];
    } else {
        $arr['status'] = 'error';
    }
    echo json_encode($arr);
    exit();
}
if ($_POST['application'] == 'application_02') {
    $count = $_POST['member_count'];
    $old_members = ApplicationMember::getMemberIdsByApplicationId($_POST['app_id']);
    if (count($old_members) > 0) {
        $arr = [];
        for ($i = 1; $i <= $count; $i++) {
            if (isset($_POST['member_name_' . $i])) {
                if (isset($_POST['row_id_' . $i]) && $_POST['row_id_' . $i] != '') {

                    $MEMBER = new ApplicationMember($_POST['row_id_' . $i]);
                    $MEMBER->application_id = $_POST['app_id'];
                    $MEMBER->name = $_POST['member_name_' . $i];
                    $MEMBER->position = $_POST['position_' . $i];
                    $MEMBER->passport_no = $_POST['passport_no_' . $i];
                    $MEMBER->passport_image = $_POST['file_name_' . $i];
                    $MEMBER->queue = $i;
                    $result = $MEMBER->update();
                    array_push($arr, $_POST['row_id_' . $i]);
                } else {
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
        }
        foreach ($old_members as $old_member) {
            if (!in_array($old_member, $arr)) {
                $MEMBER = new ApplicationMember($old_member);
                $MEMBER->delete();
            }
        }
    } else {
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
        $DOCUMENT = new ApplicationDocumentation($_POST['row_id_' . $i]);
        $DOCUMENT->application_id = $_POST['app_id'];
        $DOCUMENT->document_id = $_POST['doc_' . $i];
        $DOCUMENT->file_name = $_POST['file_name_' . $i];
        $DOCUMENT->status = 0;
        $result = $DOCUMENT->update();
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
