<?php
include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

//create fedaration
if (isset($_POST['action']) && $_POST['action'] == 'UPDATEPASSWORD') {
    $STUDENT = new Student(null);
    $HELPER = new Helper(null);
    $students = $STUDENT->getEmptyPasswordStudents();
    foreach ($students as $student) {
        $pw = $HELPER->random_password();
        $encrypt_pw = $HELPER->encryptData($pw);
        $STU = new Student($student['id']);
        $STU->password = $pw;
        // $STU->password = $encrypt_pw;
        $STU->updateStudentPassword();
    }
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}
