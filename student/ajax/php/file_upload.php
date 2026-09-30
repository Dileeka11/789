<?php

include_once(dirname(__FILE__) . '../../../class/include.php');

if (!empty($_FILES)) {


    $file_id = $_POST['unit_id'];

    $uploadDir = '../../uploads/files/';
    // File path configuration 

   
    $fileName = $file_id . '-' . basename($_FILES['file']['name']);
    $uploadFilePath = $uploadDir . $fileName;

    // Upload file to server 
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 
        $FILE = new Files(NULL);

        $FILE->file = $file_id;
        $FILE->name = $fileName;
        
        $FILE->create();

//        $insert = $db->query("INSERT INTO files (file,name, uploaded_on) VALUES ('" . $file_id . "','" . $fileName . "', NOW())");
    }
} 

  