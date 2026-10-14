<?php

include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

// create record
if (isset($_POST['create'])) {

    if (!isset($_SESSION)) {
        session_start();
    }
    // center logins can only add instructors to their own center
    $LOGGED_USER = new User($_SESSION['id']);
    $IS_CENTER_LOGIN = $_SESSION['type'] != 1 && !empty($LOGGED_USER->center_id);

    $NON_NVQ = new NonNvqInstructor(NULL);
    $NON_NVQ->centercode = $IS_CENTER_LOGIN ? $LOGGED_USER->center_id : $_POST['centercode'];
    $NON_NVQ->course_name = $_POST['course_name'];
    $NON_NVQ->instructor_name = $_POST['instructor_name'];
    $NON_NVQ->employment_type = $_POST['employment_type'];
    $NON_NVQ->instructor_tel = $_POST['instructor_tel'];
    $NON_NVQ->service_details = $_POST['whatsapp_number'];
    $NON_NVQ->start_date = $_POST['start_date'];
    $NON_NVQ->end_date = $_POST['end_date'];
    $NON_NVQ->status = isset($_POST['status']) ? $_POST['status'] : 1;

    $result = $NON_NVQ->create();

    echo json_encode(["status" => $result ? 'success' : 'error']);
    exit();
}

// update active/inactive status from table
if (isset($_POST['option']) && $_POST['option'] == 'UPDATESTATUS') {

    $NON_NVQ = new NonNvqInstructor(NULL);
    $result = $NON_NVQ->updateStatus($_POST['status'], $_POST['id']);

    echo json_encode(["status" => $result ? TRUE : FALSE]);
    exit();
}

// update end date from table
if (isset($_POST['option']) && $_POST['option'] == 'UPDATEENDDATE') {

    $NON_NVQ = new NonNvqInstructor(NULL);
    $result = $NON_NVQ->updateEndDate($_POST['end_date'], $_POST['id']);

    echo json_encode(["status" => $result ? TRUE : FALSE]);
    exit();
}
