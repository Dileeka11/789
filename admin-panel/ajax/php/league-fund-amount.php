<?php

include '../../../class/include.php';

// Create Annual Fund
if (isset($_POST['create'])) {

    $LEAGUE_FUND_AMOUNT = new LeagueFundAmount(NULL);

    $LEAGUE_FUND_AMOUNT->year = $_POST['year'];
    $LEAGUE_FUND_AMOUNT->fund_type = $_POST['fund_type'];
    $LEAGUE_FUND_AMOUNT->league_type = $_POST['league_type'];
    
    $LEAGUE_FUND_AMOUNT->amount = str_replace(',', '', $_POST['amount']);
    $LEAGUE_FUND_AMOUNT->datetime = $_POST['datetime']; 

    // Call the create function from the AnnualFund class
    $res = $LEAGUE_FUND_AMOUNT->create();

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

    $LEAGUE_FUND_AMOUNT = new AnnualFund($_POST['id']); // Assuming you are passing the 'id' for update

    $LEAGUE_FUND_AMOUNT->year = $_POST['year'];
    $LEAGUE_FUND_AMOUNT->fund_type = $_POST['fund_type'];
    $LEAGUE_FUND_AMOUNT->league_type = $_POST['league_type'];


    $LEAGUE_FUND_AMOUNT->amount = str_replace(',', '', $_POST['amount']); 
    $LEAGUE_FUND_AMOUNT->datetime = $_POST['datetime'];

    // Call the update function from the AnnualFund class
    $res = $LEAGUE_FUND_AMOUNT->update();

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
