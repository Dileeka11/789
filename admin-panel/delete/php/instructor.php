<?php

include '../../../class/include.php';

if ($_POST['option'] == 'delete') {
     
 

    $USER = new User($_POST['id']);

    $result = $USER->delete();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}