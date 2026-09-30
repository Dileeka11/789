<?php

include_once(dirname(__FILE__) . '../../../class/include.php');

if (!empty($_FILES)) {


    // $file_id = $_POST['unit_id'];

    $uploadDir = '../../uploads/' . $_POST['directory'];
    // File path configuration 
    $path = $_FILES['file']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);

    $fileName = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . $ext;
    $uploadFilePath = $uploadDir . $fileName;

    // Upload file to server 
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath)) {
        $arr['status'] = 'success';
        $arr['fileName'] = $fileName;
    } else {
        $arr['status'] = 'error';
    }
    echo json_encode($arr);
    exit();
}
