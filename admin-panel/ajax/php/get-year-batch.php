<?php
include '../../../class/include.php';


 
//get course by type
if ($_POST['action'] == 'GET_BATCH_BY_YEAR') {

    $DISTRICT = new Districts(NULL);
  
    $result = $DISTRICT->getExamBatch($_POST["id"]);
    echo json_encode($result);
     
    exit();
}

