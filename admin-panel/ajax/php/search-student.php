<?php
include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8'); 

if (!isset($_POST['student_id']) || empty(trim($_POST['student_id']))) {
    echo json_encode([
        'status' => 'error',
        'message' => 'NIC or MIS number is required.'
    ]);
    exit;
}

$student_id = trim($_POST['student_id']);
$students = new Student($student_id);

if (count($students) > 0) {
    $data = [];
   
        $data[] = [
            'full_name'   => $students->fname. ' ' . $students->lname,
          
        ];
    
    echo json_encode(['status' => 'success', 'data' => $data]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No student found with the given NIC or MIS number.']);
}