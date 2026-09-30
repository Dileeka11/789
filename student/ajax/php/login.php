<?php

include '../../../class/include.php';

$STUDENT = new Student(NULL);

$student_id = $_POST['student_id'];
$password = $_POST['password'];

if ($STUDENT->login($student_id, $password)) {
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
