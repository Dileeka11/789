<?php

include_once(dirname(__FILE__) . '../../../class/include.php');
header('Content-Type: application/json; charset=UTF8');


//create fedaration
if (isset($_POST['create'])) {

    $SELECTED_DOC_TYPES = new SelectedDocumentsByTypes(NULL);

    $SELECTED_DOC_TYPES->type = $_POST['type'];
    $SELECTED_DOC_TYPES->document_id = $_POST['document_id'];

    $SELECTED_DOC_TYPES->create();
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}


//update doc
if (isset($_POST['update'])) {
 
    $SELECTED_DOC_TYPES = new SelectedDocumentsByTypes($_POST['id']);

     $SELECTED_DOC_TYPES->document_id = $_POST['document_id'];

    $SELECTED_DOC_TYPES->update();
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}
 