<?php

include '../../../class/include.php';

header('Content-Type: application/json; charset=UTF8');

//create student

if (isset($_POST['create'])) {
    
    
    $COURSE = new Course($_POST['courseid']);
    $CENTERS = new Centers($_POST['centercode']);

    $STUDENT = new Student(NULL);
    
    $STUDENT->id = $_POST['st_id'];
    $STUDENT->nic = $_POST['nic'];
    $STUDENT->fname = ucwords($_POST['fname']);
    $STUDENT->lname = ucwords($_POST['lname']);
    $STUDENT->course_id = $_POST['courseid'];
    $STUDENT->course_name = $COURSE->cname;
    $STUDENT->centercode = $_POST['centercode'];
    $STUDENT->centername = $CENTERS->center_name;
    $STUDENT->year = $_POST['year'];
    $STUDENT->batch = $_POST['batch'];

    $STUDENT->createAdmin();
    $result = ["status" => 'success'];

    echo json_encode($result);

    exit();
}


//update doc

if (isset($_POST['update'])) {
  
    
    $STUDENT = new Student($_POST['id']);
    $APPLICATION = new Applications($STUDENT->application_id);
   
     
     
    $STUDENT->fname = ucwords($_POST['fname'] . ' ' . $_POST['lname']);
    $STUDENT->lname = ucwords($_POST['lname']);
  
    
     
    $STUDENT->nic =  $_POST['nic'];
     $res = $STUDENT->update();
    //$STUDENT->course_name =  $COURSE->cname ;
     
    //  $APPLICATION->address = $_POST['address'];
    $APPLICATION->mobile_number = $_POST['mobile_number'];
    $APPLICATION->whatsapp_number = $_POST['whatsapp_number'];
    $APPLICATION->email = $_POST['email'];
     $APPLICATION->gn_id = $_POST['gn_id'];

     $APPLICATION->update();
   
    if ($res) {
        $result = ["status" => 'success'];
    } else {
        $result = ["status" => 'error'];
    }

    echo json_encode($result);

    exit();
}




if (isset($_POST['payment_now'])) {

    $PAYMENT = new StudentPayment(NULL);
    $STUDENT = new Student($_POST['student_id']);


    $PAYMENT->payment_date = $_POST['date'];
    $PAYMENT->payment_amount = $_POST['amount'];
     $PAYMENT->reg_amount = $_POST['reg_amount'];
    $PAYMENT->student_id = $_POST['student_id'];

    $payment_all = intval($_POST['course_fee']) - (intval($_POST['amount']) + intval($_POST['paid_amount']));
     
    if ($payment_all == 0) {
        $STUDENT->payment_status = 1;
        $STUDENT->updatePaymentStatus();
    }  

    $res = $PAYMENT->create();

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
 