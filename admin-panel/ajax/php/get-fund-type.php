<?php
$currentYear = date("Y");
include '../../../class/include.php';

$response = ["status" => "error", "amount" => ""];

if (isset($_POST['action']) && $_POST['action'] == "get_amount" && isset($_POST['fund_type_id'])) {

    $LEAGUE_FUND_AMOUNT = new LeagueFundAmount(NULL);
    $FUND = new AnnualFund(NULL);
    $fundData = $FUND->getFundByType($_POST['fund_type_id'], $currentYear);
    
    // Get the array of amounts from getAmountByTypeAndYear
    $amountsArray = $LEAGUE_FUND_AMOUNT->getAmountByTypeAndYear($_POST['fund_type_id'], $currentYear);


    // If the amounts array is not empty, sum it up
    $totalAmount = 0;
    if (!empty($amountsArray)) {
        // Sum the amounts in the array
        $totalAmount = array_sum(array_column($amountsArray, 'total_amount')); // Assuming 'total_amount' is the key in the array
    }

    // Initialize the response array
    $response = array();
 
    if ($fundData) {
        $response["status"] = "success";
        // Deduct the summed totalAmount from the fundData['amount']
        $response["amount"] = $fundData['amount'] - $totalAmount;
    } else {
        $response["status"] = "error";
        $response["message"] = "No fund data found for this type.";
    }
    
    // Return the response as a JSON object
    echo json_encode($response);
    exit();
}
