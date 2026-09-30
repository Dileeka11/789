<?php

include '../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

if ($_POST['action'] == 'GET_FEDARATION') {

    $FEDARATION = new Fedaration($_POST["fedaration"]);

    $result = [
        "address" => $FEDARATION->address,
        "mobile_number" => $FEDARATION->mobile_number,
        "office_number" => $FEDARATION->office_number,
        "email" => $FEDARATION->email,
    ];

    echo json_encode($result);
    exit();
}