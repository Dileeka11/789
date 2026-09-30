<?php

include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

//update doc
if (isset($_POST['create'])) {

    $uploadDir = '../../../nc_assets/uploads/essay-papers/';
    $WRITTING_PAPERS = new WrittingPapers(NULL);

    $WRITTING_PAPERS->course_id = $_POST['course_id'];
    $WRITTING_PAPERS->title = $_POST['title'];

    if (isset($_FILES['essay_paper']) && $_FILES['essay_paper']['name'] != '') {

        // File path configuration 
        $fileName =  '-' . basename($_FILES['essay_paper']['name']);
        $uploadFilePath = $uploadDir . $fileName;

        // Upload file to server 
        if (move_uploaded_file($_FILES['essay_paper']['tmp_name'], $uploadFilePath)) {
            $WRITTING_PAPERS->pdf_doc = $fileName;
        }
    }
    if (isset($_FILES['essay_paper_sinhala']) && $_FILES['essay_paper_sinhala']['name'] != '') {

        // File path configuration 
        $fileName1 =  '-' . basename($_FILES['essay_paper_sinhala']['name']);
        $uploadFilePath1 = $uploadDir . $fileName1;

        if (move_uploaded_file($_FILES['essay_paper_sinhala']['tmp_name'], $uploadFilePath1)) {
            $WRITTING_PAPERS->pdf_doc_sinhala = $fileName1;
        }
    }
    if (isset($_FILES['essay_paper_tamil']) && $_FILES['essay_paper_tamil']['name'] != '') {

        // File path configuration 
        $fileName2 =  '-' . basename($_FILES['essay_paper_tamil']['name']);
        $uploadFilePath2 = $uploadDir . $fileName2;

        if (move_uploaded_file($_FILES['essay_paper_tamil']['tmp_name'], $uploadFilePath2)) {
            $WRITTING_PAPERS->pdf_doc_tamil = $fileName2;
        }
    }
    $result = $WRITTING_PAPERS->create();
    if ($result) {
        $result = ["status" => 'success'];
        echo json_encode($result);
        exit();
    } else {
        $result = ["status" => 'error'];
        echo json_encode($result);
        exit();
    }
}
