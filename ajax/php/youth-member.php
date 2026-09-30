<?php

include '../../class/include.php';

//create student

    $APPLICATIONS = new SurveyTeam(NULL);
  
 
    $APPLICATIONS->full_name_1 = $_POST['full_name_1'];
    $APPLICATIONS->full_name_2 = $_POST['full_name_2'];
    $APPLICATIONS->address = $_POST['address'];
    $APPLICATIONS->address_2 = $_POST['address_2'];

    $APPLICATIONS->nic = $_POST['nic'];
    $APPLICATIONS->nic_2 = $_POST['nic_2'];
    
    $APPLICATIONS->whatsapp_number = $_POST['whatsapp_number'];
    $APPLICATIONS->whatsapp_number_2 = $_POST['whatsapp_number_2'];
    
    $APPLICATIONS->mobile_number = $_POST['mobile_number'];
    $APPLICATIONS->mobile_number_2 = $_POST['mobile_number_2'];
    
    $APPLICATIONS->province_id = $_POST['province_id'];
    $APPLICATIONS->district_id = $_POST['district_id'];
    $APPLICATIONS->divisional_id = $_POST['divisional_id'];
    $APPLICATIONS->gn_id = $_POST['gn_id'];
    
    
    $APPLICATIONS->email = $_POST['email'];
    $APPLICATIONS->email_2 = $_POST['email_2'];
    
    $APPLICATIONS->birth_date = $_POST['birth_date'];
    $APPLICATIONS->birth_date_2 = $_POST['birth_date_2'];

 
    $res = $APPLICATIONS->create();
    if ($res) {
        $result = [
            "status" => 'success'
        ];
        echo json_encode($result);
        exit();
    } else {
        $result = [
            "status" => 'error'
        ];
        echo json_encode($result);
        exit();
    }
  
