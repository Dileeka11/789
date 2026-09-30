<?php

include '../../../class/include.php';

    

// ── DELETE ──────────────────────────────────────────
if (isset($_POST['delete_id'])) {
    

    $PRACTICAL = new TheoryPapers(intval($_POST['delete_id']));
    
     $result = $PRACTICAL->delete();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
    
    
   
}

// ── TOGGLE ACTIVE / INACTIVE ─────────────────────────
if (isset($_POST['toggle_id'])) {
 

    $PRACTICAL = new TheoryPapers(intval($_POST['toggle_id']));
    echo $PRACTICAL->toggleActive($_POST['active']) ? 'success' : 'error';
    exit;
}