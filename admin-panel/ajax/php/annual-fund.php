<?php

include '../../../class/include.php';

// Create Annual Fund
if (isset($_POST['create'])) {

    $ANNUAL_FUND = new AnnualFund(NULL);

    $ANNUAL_FUND->year = $_POST['year'];
    $ANNUAL_FUND->type = $_POST['type'];
    $ANNUAL_FUND->amount = str_replace(',', '', $_POST['amount']);
    $ANNUAL_FUND->datetime = $_POST['datetime']; 

    // Call the create function from the AnnualFund class
    $res = $ANNUAL_FUND->create();

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

// Update Annual Fund
if (isset($_POST['update'])) {

    $ANNUAL_FUND = new AnnualFund($_POST['id']); // Assuming you are passing the 'id' for update

    $ANNUAL_FUND->year = $_POST['year'];
    $ANNUAL_FUND->type = $_POST['type'];
    $ANNUAL_FUND->amount = str_replace(',', '', $_POST['amount']); 
    $ANNUAL_FUND->datetime = $_POST['datetime'];

    // Call the update function from the AnnualFund class
    $res = $ANNUAL_FUND->update();

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
