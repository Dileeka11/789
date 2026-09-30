<?php
include '../../../class/include.php';


 
//get course by type
if ($_POST['action'] == 'GET_DISTRICT_BY_PROVINCE') {

    $DISTRICT = new Districts(NULL);
  
    $result = $DISTRICT->getDistrictByProvince($_POST["id"]);
    echo json_encode($result);
     
    exit();
}

