<?php

include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $uploadDir = '../../../nc_assets/uploads/practical-papers/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $PRACTICAL_PAPERS = new PracticalPapers(NULL);

    $PRACTICAL_PAPERS->course_id = $_POST['course_id'] ?? '';
    $PRACTICAL_PAPERS->title     = $_POST['title'] ?? '';
    $PRACTICAL_PAPERS->year      = $_POST['year'] ?? '';
    $PRACTICAL_PAPERS->batch     = $_POST['batch'] ?? '';
     $PRACTICAL_PAPERS->datetime_fp     = $_POST['datetime_fp'] ?? '';
    
    $PRACTICAL_PAPERS->active    = isset($_POST['active']) ? 1 : 0;

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
            $PRACTICAL_PAPERS->pdf_doc = $fileName;
        }
    }

    $result = $PRACTICAL_PAPERS->create();

    if ($result) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }

    exit();
}
