<?php

include '../../class/include.php';
header('Content-Type: application/json; charset=UTF8');
if (!isset($_SESSION)) {
    session_start();
}
if ($_POST['action'] == 'APPROVE') {

    $APPLICATION = new Application($_POST['app_id']);
    $latest_user = $APPLICATION->application_latest_user;
    if ($latest_user == 9) {
        $APPLICATION->application_latest_user = 9;
        $APPLICATION->application_latest_status = 1;
    } else {
        $APPLICATION->application_latest_user = (int)$latest_user + 1;
        $APPLICATION->application_latest_status = 0;
    }
    $result = $APPLICATION->updateLatestUserAndStatus();

    $APPLICATIONSTATUS = new ApplicationStatus(null);
    $APPLICATIONSTATUS->application_id = $_POST['app_id'];
    $APPLICATIONSTATUS->user_type = $_SESSION['type'];
    $APPLICATIONSTATUS->user_id = $_SESSION['id'];
    $APPLICATIONSTATUS->status = 1;
    $APPLICATIONSTATUS->reason = 'OK';
    $APPLICATIONSTATUS->create();

    if ($result) {
        $arr['status'] = 'success';
    } else {
        $arr['status'] = 'error';
    }
    echo json_encode($arr);
    exit();
}
if ($_POST['action'] == 'REJECT') {

    $APPLICATION = new Application($_POST['app_id']);
    $latest_user = $APPLICATION->application_latest_user;
    $APPLICATION->application_latest_user = $latest_user;
    $APPLICATION->application_latest_status = 2;
    $result = $APPLICATION->updateLatestUserAndStatus();

    $APPLICATIONSTATUS = new ApplicationStatus(null);
    $APPLICATIONSTATUS->application_id = $_POST['app_id'];
    $APPLICATIONSTATUS->user_type = $_SESSION['type'];
    $APPLICATIONSTATUS->user_id = $_SESSION['id'];
    $APPLICATIONSTATUS->status = 2;
    $APPLICATIONSTATUS->reason = 'Rejected';
    $APPLICATIONSTATUS->create();

    if ($result) {
        $arr['status'] = 'success';
    } else {
        $arr['status'] = 'error';
    }
    echo json_encode($arr);
    exit();
}
if ($_POST['action'] == 'REJECTMEMBERPASSPORTCOPY') {
    $MEMBER = new ApplicationMember($_POST['member_id']);
    $APPLICATIONDOCSTATUS = new ApplicationDocumentsStatus(null);
    $APPLICATIONDOCSTATUS->application_id = $_POST['app_id'];
    $APPLICATIONDOCSTATUS->document_id = 0;
    $APPLICATIONDOCSTATUS->member_id = $_POST['member_id'];
    $APPLICATIONDOCSTATUS->old_file_name = $MEMBER->passport_image;
    $APPLICATIONDOCSTATUS->status = 2;
    $APPLICATIONDOCSTATUS->reason = 'Rejected';
    $result = $APPLICATIONDOCSTATUS->create();

    if ($result) {
        $arr['status'] = 'success';
    } else {
        $arr['status'] = 'error';
    }
    echo json_encode($arr);
    exit();
}
if ($_POST['action'] == 'REJECTDOCUMENT') {
    $DOC = new ApplicationDocumentation($_POST['doc_id']);
    $APPLICATIONDOCSTATUS = new ApplicationDocumentsStatus(null);
    $APPLICATIONDOCSTATUS->application_id = $_POST['app_id'];
    $APPLICATIONDOCSTATUS->document_id = $_POST['doc_id'];
    $APPLICATIONDOCSTATUS->member_id = 0;
    $APPLICATIONDOCSTATUS->old_file_name = $DOC->file_name;
    $APPLICATIONDOCSTATUS->status = 2;
    $APPLICATIONDOCSTATUS->reason = 'Rejected';
    $result = $APPLICATIONDOCSTATUS->create();

    if ($result) {
        $arr['status'] = 'success';
    } else {
        $arr['status'] = 'error';
    }
    echo json_encode($arr);
    exit();
}
