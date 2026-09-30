<?php

include '../../../class/include.php';

if ($_POST['option'] == 'delete') {

    $NON_NVQ = new NonNvqInstructor($_POST['id']);
    $result = $NON_NVQ->delete();

    if ($result) {
        header('Content-type: application/json');
        echo json_encode(array("status" => TRUE));
    }
}
