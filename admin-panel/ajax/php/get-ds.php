<?php
include '../../../class/include.php';


 
//get course by type
if ($_POST['action'] == 'GET_DISTRICT_BY_DISTRICT') {

    $DSDIVISION = new Dsdivision(NULL);
  
    $result = $DSDIVISION->GetDivisionByDistrictId($_POST["id"]);
    echo json_encode($result);
     
    exit();
}

