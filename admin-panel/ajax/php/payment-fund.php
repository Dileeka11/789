<?php
$currentYear = date("Y");
include '../../../class/include.php';

$response = ["status" => "error", "amount" => ""];

if (isset($_POST['action']) && $_POST['action'] == "get_amount" && isset($_POST['league_type_id'])) {
 

    $LEAGUE_FUND_AMOUNT = new LeagueFundAmount(NULL);
    $PAYMENT_FUND = new PaymentFund(NULL);
    
    
    $payment_amount_array = $PAYMENT_FUND->getFundAmount($_POST['fund_type'], $_POST['league_type_id'], $currentYear);
    $amountsArray = $LEAGUE_FUND_AMOUNT->getFundAmount($_POST['fund_type'], $_POST['league_type_id'], $currentYear);
   
    
    $totalAmount = 0;
    $payment_total = 0; 
    
    if (!empty($amountsArray)) {
        // Extract 'amount' values correctly
        $amountValues = array_column($amountsArray, 'amount');
        $totalAmount = array_sum($amountValues);
    }
    
  
    
      if (!empty($payment_amount_array)) {
        // Extract 'amount' values correctly
        $payment_amount_values = array_column($payment_amount_array, 'amount');
        $payment_total = array_sum($payment_amount_values);
    }
    
   
    $response = array();
 
    if ($totalAmount) {
        $response["status"] = "success";
        $response["amount"] =  $totalAmount -$payment_total ;
    } else {
        $response["status"] = "error";
        $response["message"] = "No fund data found for this type.";
    }
    
    // Return the response as a JSON object
    echo json_encode($response);
    exit();
}



// CREATE NEW PAYMENT FUND RECORD
if (isset($_POST['create'])) {
    $PAYMENT_FUND = new PaymentFund(NULL);

    $PAYMENT_FUND->year = $_POST['year'];
    $PAYMENT_FUND->fund_type = $_POST['type'];
    $PAYMENT_FUND->league_type = $_POST['league_type'];
    $PAYMENT_FUND->amount = $_POST['amount'];
    $PAYMENT_FUND->datetime = date("Y-m-d H:i:s"); // Store current timestamp

    $PAYMENT_FUND->create();

    $response = ["status" => "success", "message" => "Payment fund created successfully."];
    echo json_encode($response);
    exit();
}

// UPDATE PAYMENT FUND RECORD
if (isset($_POST['update'])) {
    if (!isset($_POST['id'])) {
        echo json_encode(["status" => "error", "message" => "ID is required for update."]);
        exit();
    }

    $PAYMENT_FUND = new PaymentFund($_POST['id']);

    $PAYMENT_FUND->year = $_POST['year'];
    $PAYMENT_FUND->fund_type = $_POST['type'];
    $PAYMENT_FUND->league_type = $_POST['league_type'];
    $PAYMENT_FUND->amount = $_POST['amount'];

    $PAYMENT_FUND->update();

    $response = ["status" => "success", "message" => "Payment fund updated successfully."];
    echo json_encode($response);
    exit();
}


?>
