<?php

include '../../../class/include.php';
  
$USER = new User(NULL);

$email = $_POST['email'];
$password = $_POST['password'];
 

if ($USER->login($email, $password)) {
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
