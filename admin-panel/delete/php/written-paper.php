<?php
include '../../../class/include.php';

if ($_POST['option'] == 'delete') {

    $WRITTING_PAPERS = new WrittingPapers($_POST['id']);
    $result = $WRITTING_PAPERS->delete();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}
