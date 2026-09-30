<?php
 
include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

//update doc
if (isset($_POST['create'])) {

    $uploadDir = '../../../nc_assets/uploads/syllabus/';
    $COURSESYLLABUS = new CourseSyllabus(NULL);

    $COURSESYLLABUS->course_id = $_POST['course_id'];
    $COURSESYLLABUS->title = $_POST['title'];

    if (isset($_FILES['syllabus']) && $_FILES['syllabus']['name'] != '') {

        // File path configuration 
        $fileName =  $_POST['course_id']. '-' . basename($_FILES['syllabus']['name']);
        $uploadFilePath = $uploadDir . $fileName;

        // Upload file to server 
        if (move_uploaded_file($_FILES['syllabus']['tmp_name'], $uploadFilePath)) {
            $COURSESYLLABUS->syllabus = $fileName;
        }
    }
      
    $result = $COURSESYLLABUS->create();
    
    
    if ($result) {
        $result = ["status" => 'success'];
        echo json_encode($result);
        exit();
    } else {
        $result = ["status" => 'error'];
        echo json_encode($result);
        exit();
    }
}

