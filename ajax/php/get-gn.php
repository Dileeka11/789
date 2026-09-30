<?php

include '../../class/include.php';

 
//get course by type
if ($_POST['action'] == 'GET_DISTRICT_BY_GN') {

    $GNDIVISION = new Gndivision(NULL);
  
    $result = $GNDIVISION->GetGnByDsdivision($_POST["id"]);
    echo json_encode($result);
     
    exit();
}

