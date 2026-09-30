<?php

include '../../../class/include.php';

// Create League Type
if (isset($_POST['create'])) {

    $LEAGUE_TYPE = new LeagueTypes(NULL);  // Instantiate the LeagueTypes class

    $LEAGUE_TYPE->name = $_POST['name'];  // Set the name field from POST data
    $LEAGUE_TYPE->queue = $_POST['queue'];  // Set the queue field from POST data

    // Call the create function from the LeagueTypes class
    $res = $LEAGUE_TYPE->create();

    if ($res) {
        $result = [
            "status" => 'success'  // If successful, return success
        ];
        echo json_encode($result);
        exit();
    } else {
        $result = [
            "status" => 'error'  // If failed, return error
        ];
        echo json_encode($result);
        exit();
    }
}

// Update League Type
if (isset($_POST['update'])) {

    $LEAGUE_TYPE = new LeagueTypes($_POST['id']);  // Load the LeagueType by ID for update

    $LEAGUE_TYPE->name = $_POST['name'];  // Set the name field from POST data
    $LEAGUE_TYPE->queue = $_POST['queue'];  // Set the queue field from POST data

    // Call the update function from the LeagueTypes class
    $res = $LEAGUE_TYPE->update();

    if ($res) {
        $result = [
            "status" => 'success'  // If successful, return success
        ];
        echo json_encode($result);
        exit();
    } else {
        $result = [
            "status" => 'error'  // If failed, return error
        ];
        echo json_encode($result);
        exit();
    }
}
