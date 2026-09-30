<?php

include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $uploadDir = '../../../nc_assets/uploads/theory-papers/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $THEORY_PAPERS = new TheoryPapers(NULL);

    $THEORY_PAPERS->course_id = $_POST['course_id'] ?? '';
    $THEORY_PAPERS->title     = $_POST['title'] ?? '';
    $THEORY_PAPERS->year      = $_POST['year'] ?? '';
    $THEORY_PAPERS->batch     = $_POST['batch'] ?? '';
     $THEORY_PAPERS->datetime_fp     = $_POST['datetime_fp'] ?? '';
   
    
    $THEORY_PAPERS->active    = isset($_POST['active']) ? 1 : 0;

    // FILE UPLOAD
    if (isset($_FILES['pdf_doc']) && $_FILES['pdf_doc']['error'] == 0) {

        $fileName = time() . '-' . basename($_FILES['pdf_doc']['name']);
        $uploadFilePath = $uploadDir . $fileName;

        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Only PDF allowed
        if ($ext !== "pdf") {
            echo json_encode([
                "status" => "error",
                "message" => "Only PDF files are allowed"
            ]);
            exit();
        }

        if (move_uploaded_file($_FILES['pdf_doc']['tmp_name'], $uploadFilePath)) {
            $THEORY_PAPERS->pdf_doc = $fileName;
        }
    }

    $result = $THEORY_PAPERS->create();

    if ($result) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }

    exit();
}
