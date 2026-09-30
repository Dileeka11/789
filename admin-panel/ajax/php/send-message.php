<?php

include '../../../class/include.php';

//course create
if (isset($_POST['create'])) {
    date_default_timezone_set('Asia/Colombo');
    $createdAt = date('Y-m-d H:i:s');

    $SEND_MESSAGE = new SendMessage(NULL);

    $SEND_MESSAGE->message = $_POST['message'];
    $SEND_MESSAGE->date_time = $createdAt;

    $res = $SEND_MESSAGE->create();

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
}
 
//update message
if (isset($_POST['update'])) {
      
    $SEND_MESSAGE = new SendMessage($_POST['id']);

    $SEND_MESSAGE->message = $_POST['message']; 
    $res = $SEND_MESSAGE->update(); 

    $result = [
        "status" => 'success'
    ];
    echo json_encode($result);
    exit();
}
 