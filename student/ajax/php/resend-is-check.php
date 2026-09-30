<?php

include '../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

$id = $_POST['app_id'];
$name = $_POST['name'];
 
$APPLICATION = new Application($id);

if ($name == 'players_participant') {
    $APPLICATION->players_participant = 1;

    $result = $APPLICATION->update();
}

if ($name == 'selection_commity') {
    $APPLICATION->selection_commity = 1;

    $result = $APPLICATION->update();
}

if ($name == 'sport_council_commity') {
    $APPLICATION->sport_council_commity = 1;

    $result = $APPLICATION->update();
}

if ($name == 'contract_bond') {
    $APPLICATION->contract_bond = 1;

    $result = $APPLICATION->update();
}

if ($name == 'grants') {
    $APPLICATION->grants = 1;

    $result = $APPLICATION->update();
}

if ($name == 'recommended') {
    $APPLICATION->recommended = 1;

    $result = $APPLICATION->update();
}

if ($name == 'not_recommended') {
    $APPLICATION->not_recommended = 1;

    $result = $APPLICATION->update();
}

if ($name == 'air_tickets') {
    $APPLICATION->air_tickets = 1;

    $result = $APPLICATION->update();
}

if ($name == 'food') {
    $APPLICATION->food = 1;

    $result = $APPLICATION->update();
}

if ($name == 'accommodation') {
    $APPLICATION->accommodation = 1;

    $result = $APPLICATION->update();
}

if ($name == 'visa_fee') {
    $APPLICATION->visa_fee = 1;

    $result = $APPLICATION->update();
}

if ($name == 'entrance_fee') {
    $APPLICATION->entrance_fee = 1;

    $result = $APPLICATION->update();
}
if ($name == 'grant_amount') {
    $APPLICATION->grant_amount = $_POST['grant_amount'];

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

