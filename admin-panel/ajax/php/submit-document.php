<?php

include '../../../class/include.php';
if (!isset($_SESSION)) {
    session_start();
}
$USER = new User($_SESSION['id']);
//course create
if (isset($_POST['create'])) {

    $DOCUMENTS = new Documents(NULL);

    $DOCUMENTS->type = $_POST['type'];
    $DOCUMENTS->title = $_POST['title'];
    $DOCUMENTS->submit_date = $_POST['submit_date'];
    $DOCUMENTS->minit = $_POST['minit'];
    $DOCUMENTS->sender_division_id = $_POST['sender_division_id'];
    $DOCUMENTS->sender_position_id = $_POST['sender_position_id'];
    if ($_POST['type'] == 1) {
        $DOCUMENTS->receiver_division_id = $_POST['sender_division_id'];
        $DOCUMENTS->receiver_position_id = $_POST['receiver_position_id'];
        $DOCUMENTS->current_position = $_POST['receiver_position_id'];
        $DOCUMENTS->current_status = 0;
    } elseif ($_POST['type'] == 2) {
        $DOCUMENTS->receiver_division_id = 0;
        $DOCUMENTS->receiver_position_id = 0;
        $DOCUMENTS->current_position = 0;
        $DOCUMENTS->current_status = 0;
    } elseif ($_POST['type'] == 3) {
        $DOCUMENTS->receiver_division_id = $_POST['sender_division_id'];
        $DOCUMENTS->receiver_position_id = $_POST['receiver_position_id'];
        $DOCUMENTS->current_position = $_POST['receiver_position_id'];
        $DOCUMENTS->current_status = 0;
    }


    $target_dir = "../../../upload/files/";

    $target_file = $target_dir . basename($_FILES["document"]["name"]);

    $uploadOk = 1;



    // Check if file is a DOC or PDF file

    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($fileType != "doc" && $fileType != "pdf") {

        $error = "Sorry, only DOC and PDF files are allowed.";

        $uploadOk = 0;
    }



    if ($uploadOk == 0) {

        $error = "Sorry, your file was not uploaded.";

        // if everything is ok, try to upload file
    } else {

        if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file)) {

            $error = "The file " . basename($_FILES["document"]["name"]) . " has been uploaded.";
        } else {

            $error = "Sorry, there was an error uploading your file.";
        }

        $fileName = basename($_FILES['document']['name']);

        $DOCUMENTS->document = $fileName;


        $res = $DOCUMENTS->create();

        if ($_POST['type'] == 2 || $_POST['type'] == 3) {
            if (count($_POST['other_divisions']) > 0) {
                foreach ($_POST['other_divisions'] as $division) {
                    $OTHER_DOCUMENT_DIVISION = new OtherDocumentDivision(NULL);

                    $OTHER_DOCUMENT_DIVISION->document_id = $res;
                    $OTHER_DOCUMENT_DIVISION->division_id = $division;
                    $OTHER_DOCUMENT_DIVISION->current_position_id = 1;
                    $OTHER_DOCUMENT_DIVISION->current_status = 0;
                    $result = $OTHER_DOCUMENT_DIVISION->create();
                }
            }
        }


        if ($_POST['type'] == 1) {
            $DOCUMENT_STATUS = new DocumentStatus(NULL);

            $DOCUMENT_STATUS->document_id = $res;
            $DOCUMENT_STATUS->sender_division_id = $_POST['sender_division_id'];
            $DOCUMENT_STATUS->sender_position_id = $_POST['sender_position_id'];
            $DOCUMENT_STATUS->sender_user_id = $USER->id;
            $DOCUMENT_STATUS->receiver_division_id = $_POST['sender_division_id'];
            $DOCUMENT_STATUS->receiver_position_id = $_POST['receiver_position_id'];
            $DOCUMENT_STATUS->status = 0;
            $DOCUMENT_STATUS->reason = $_POST['minit'];
            $DOCUMENT_STATUS->file_name = $fileName;
            $result = $DOCUMENT_STATUS->create();
        } elseif ($_POST['type'] == 2) {
            if (count($_POST['other_divisions']) > 0) {
                foreach ($_POST['other_divisions'] as $division) {
                    $DOCUMENT_STATUS = new DocumentStatus(NULL);

                    $DOCUMENT_STATUS->document_id = $res;
                    $DOCUMENT_STATUS->sender_division_id = $_POST['sender_division_id'];
                    $DOCUMENT_STATUS->sender_position_id = $_POST['sender_position_id'];
                    $DOCUMENT_STATUS->sender_user_id = $USER->id;
                    $DOCUMENT_STATUS->receiver_division_id = $division;
                    $DOCUMENT_STATUS->receiver_position_id = 1;
                    $DOCUMENT_STATUS->status = 0;
                    $DOCUMENT_STATUS->reason = $_POST['minit'];
                    $DOCUMENT_STATUS->file_name = $fileName;
                    $result = $DOCUMENT_STATUS->create();
                }
            }
        } elseif ($_POST['type'] == 3) {
            $DOCUMENT_STATUS = new DocumentStatus(NULL);

            $DOCUMENT_STATUS->document_id = $res;
            $DOCUMENT_STATUS->sender_division_id = $_POST['sender_division_id'];
            $DOCUMENT_STATUS->sender_position_id = $_POST['sender_position_id'];
            $DOCUMENT_STATUS->sender_user_id = $USER->id;
            $DOCUMENT_STATUS->receiver_division_id = $_POST['sender_division_id'];
            $DOCUMENT_STATUS->receiver_position_id = $_POST['receiver_position_id'];
            $DOCUMENT_STATUS->status = 0;
            $DOCUMENT_STATUS->reason = $_POST['minit'];
            $DOCUMENT_STATUS->file_name = $fileName;
            $result = $DOCUMENT_STATUS->create();

            if (isset($_POST['other_divisions']) && count($_POST['other_divisions']) > 0) {
                foreach ($_POST['other_divisions'] as $division) {
                    $DOCUMENT_STATUS = new DocumentStatus(NULL);

                    $DOCUMENT_STATUS->document_id = $res;
                    $DOCUMENT_STATUS->sender_division_id = $_POST['sender_division_id'];
                    $DOCUMENT_STATUS->sender_position_id = $_POST['sender_position_id'];
                    $DOCUMENT_STATUS->sender_user_id = $USER->id;
                    $DOCUMENT_STATUS->receiver_division_id = $division;
                    $DOCUMENT_STATUS->receiver_position_id = 1;
                    $DOCUMENT_STATUS->status = 0;
                    $DOCUMENT_STATUS->reason = $_POST['minit'];
                    $DOCUMENT_STATUS->file_name = $fileName;
                    $result = $DOCUMENT_STATUS->create();
                }
            }
        }

        if (isset($_POST['copy_divisions']) && count($_POST['copy_divisions']) > 0) {  
            foreach ($_POST['copy_divisions'] as $division) {
                $DOCUMENT_COPY = new DocumentCopies(NULL);

                $DOCUMENT_COPY->document_id = $res;
                $DOCUMENT_COPY->division_id = $division;
                $result = $DOCUMENT_COPY->create();
            }
        }
    }


    if ($result) {
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
if (isset($_POST['upload_image'])) {

    $target_dir = "../../../upload/files/";

    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    $uploadOk = 1;

    // Check if file is a DOC or PDF file

    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($fileType != "doc" && $fileType != "pdf") {

        $error = "Sorry, only DOC and PDF files are allowed.";

        $uploadOk = 0;
    }



    if ($uploadOk == 0) {

        $error = "Sorry, your file was not uploaded.";

        // if everything is ok, try to upload file
    } else {

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {

            $error = "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
        } else {

            $error = "Sorry, there was an error uploading your file.";
        }

        $fileName = basename($_FILES['file']['name']);
    }


    if ($uploadOk == 1) {
        $result = [
            "file_name" => $fileName
        ];
        echo json_encode($result);
        exit();
    } else {
        $result = [
            "file_name" => ''
        ];
        echo json_encode($result);
        exit();
    }
}

if (isset($_POST['option']) && $_POST['option'] == "APPROVE") {

    date_default_timezone_set('Asia/Colombo');
    $datetime = date('Y-m-d H:i:s');

    $USER = new User($_SESSION['id']);
    $DOCUMENT = new Documents($_POST['id']);
    if (($DOCUMENT->type == 3 && $DOCUMENT->receiver_division_id != $USER->division) || $DOCUMENT->type == 2) {
        $OTHER_DIVISION = new OtherDocumentDivision(null);
        $other_division = $OTHER_DIVISION->getCurrentUserByDivision($DOCUMENT->id, $USER->division, $USER->position);
        $DIVISION_POSITION = new DivisionPositions(null);
        $position_id = $DIVISION_POSITION->getNextPositionIdOfDivision($USER->division, $USER->position);
        $OTHER_DIVISION1 = new OtherDocumentDivision($other_division['id']);
        if ($position_id == '') {
            $OTHER_DIVISION1->current_position_id = $USER->position;
            $OTHER_DIVISION1->current_status = 6;
        } else {
            $OTHER_DIVISION1->current_position_id = $position_id;
            $OTHER_DIVISION1->current_status = 0;
        }
        $OTHER_DIVISION1->status_updated_at = $datetime;
        $res = $OTHER_DIVISION1->updateStatus();
    } else {

        $DIVISION_POSITION = new DivisionPositions(null);
        $position_id = $DIVISION_POSITION->getNextPositionIdOfDivision($DOCUMENT->receiver_division_id, $USER->position);
        $DOCUMENT1 = new Documents($_POST['id']);

        if ($position_id == '') {
            $DOCUMENT1->current_position = $USER->position;
            $DOCUMENT1->current_status = 6;
        } else {
            $DOCUMENT1->current_position = $position_id;
            $DOCUMENT1->current_status = 0;
        }
        $DOCUMENT1->status_updated_at = $datetime;

        $res = $DOCUMENT1->updateStatus();
    }
    if ($res) {

        $DOCUMENT_STATUS = new DocumentStatus(NULL);
        $DIVISION_POSITION = new DivisionPositions(null);
        $position_id = $DIVISION_POSITION->getNextPositionIdOfDivision($USER->division, $USER->position);

        $DOCUMENT_STATUS->document_id = $_POST['id'];
        $DOCUMENT_STATUS->sender_division_id = $USER->division;
        $DOCUMENT_STATUS->sender_position_id = $USER->position;
        $DOCUMENT_STATUS->sender_user_id = $USER->id;
        $DOCUMENT_STATUS->receiver_division_id = $USER->division;
        if ($position_id == '') {
            $DOCUMENT_STATUS->receiver_position_id = $USER->position;
        } else {
            $DOCUMENT_STATUS->receiver_position_id = $position_id;
        }
        $DOCUMENT_STATUS->status = 1;
        $DOCUMENT_STATUS->reason = $_POST['val'];
        $DOCUMENT_STATUS->file_name = $DOCUMENT->document;
        $result1 = $DOCUMENT_STATUS->create();
        if ($result1) {
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
    } else {
        $result = [
            "status" => 'error'
        ];
        echo json_encode($result);
        exit();
    }
}

if (isset($_POST['option']) && $_POST['option'] == "ACCEPT") {

    date_default_timezone_set('Asia/Colombo');
    $datetime = date('Y-m-d H:i:s');

    $USER = new User($_SESSION['id']);
    $DOCUMENT = new Documents($_POST['id']);
    if (($DOCUMENT->type == 3 && $DOCUMENT->receiver_division_id != $USER->division) || $DOCUMENT->type == 2) {
        $OTHER_DIVISION = new OtherDocumentDivision(null);
        $other_division = $OTHER_DIVISION->getCurrentUserByDivision($DOCUMENT->id, $USER->division, $USER->position);
        $OTHER_DIVISION1 = new OtherDocumentDivision($other_division['id']);
        $OTHER_DIVISION1->current_position_id = $USER->position;
        $OTHER_DIVISION1->current_status = 6;
        $OTHER_DIVISION1->status_updated_at = $datetime;
        $res = $OTHER_DIVISION1->updateStatus();
    } else {

        $DOCUMENT1 = new Documents($_POST['id']);

        $DOCUMENT1->current_position = $USER->position;
        $DOCUMENT1->current_status = 6;
        $DOCUMENT1->status_updated_at = $datetime;

        $res = $DOCUMENT1->updateStatus();
    }
    if ($res) {

        $DOCUMENT_STATUS = new DocumentStatus(NULL);

        $DOCUMENT_STATUS->document_id = $_POST['id'];
        $DOCUMENT_STATUS->sender_division_id = $USER->division;
        $DOCUMENT_STATUS->sender_position_id = $USER->position;
        $DOCUMENT_STATUS->sender_user_id = $USER->id;
        $DOCUMENT_STATUS->receiver_division_id = $USER->division;
        $DOCUMENT_STATUS->receiver_position_id = $USER->position;
        $DOCUMENT_STATUS->status = 6;
        $DOCUMENT_STATUS->reason = $_POST['val'];
        $DOCUMENT_STATUS->file_name = $DOCUMENT->document;
        $result1 = $DOCUMENT_STATUS->create();
        if ($result1) {
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
    } else {
        $result = [
            "status" => 'error'
        ];
        echo json_encode($result);
        exit();
    }
}
if (isset($_POST['option']) && $_POST['option'] == "RETURN") {

    date_default_timezone_set('Asia/Colombo');
    $datetime = date('Y-m-d H:i:s');

    $USER = new User($_SESSION['id']);
    $DOCUMENT = new Documents($_POST['id']);
    if (($DOCUMENT->type == 3 && $DOCUMENT->receiver_division_id != $USER->division) || $DOCUMENT->type == 2) {
        $OTHER_DIVISION = new OtherDocumentDivision(null);
        $other_division = $OTHER_DIVISION->getCurrentUserByDivision($DOCUMENT->id, $USER->division, $USER->position);
        $DIVISION_POSITION = new DivisionPositions(null);
        $position_id = $DIVISION_POSITION->getPrevPositionIdOfDivision($USER->division, $USER->position);
        $DOCUMENT_STATUS = new DocumentStatus(null);
        $document_status = $DOCUMENT_STATUS->getDocumentStatusDetails($_POST['id'], $USER->division, $USER->position);
        $OTHER_DIVISION1 = new OtherDocumentDivision($other_division['id']);
        if ($document_status) {
            $OTHER_DIVISION1->current_position_id = $document_status['sender_position_id'];
            $OTHER_DIVISION1->current_status = 2;
        } else {
            $OTHER_DIVISION1->current_position_id = $position_id;
            $OTHER_DIVISION1->current_status = 2;
        }
        $OTHER_DIVISION1->status_updated_at = $datetime;
        $res = $OTHER_DIVISION1->updateStatus();
    } else {

        $DIVISION_POSITION = new DivisionPositions(null);
        $position_id = $DIVISION_POSITION->getPrevPositionIdOfDivision($DOCUMENT->receiver_division_id, $USER->position);
        $DOCUMENT_STATUS = new DocumentStatus(null);
        $document_status = $DOCUMENT_STATUS->getDocumentStatusDetails($_POST['id'], $DOCUMENT->receiver_division_id, $USER->position);

        if ($document_status) {
            $DOCUMENT->current_position = $document_status['sender_position_id'];
            $DOCUMENT->current_status = 2;
        } else {
            $DOCUMENT->current_position = $position_id;
            $DOCUMENT->current_status = 2;
        }
        $DOCUMENT->status_updated_at = $datetime;
        $res = $DOCUMENT->updateStatus();
    }


    if ($res) {

        $DOCUMENT_STATUS = new DocumentStatus(NULL);

        $DIVISION_POSITION = new DivisionPositions(null);
        $position_id = $DIVISION_POSITION->getPrevPositionIdOfDivision($USER->division, $USER->position);
        $DOCUMENT_STATUS = new DocumentStatus(null);
        $document_status = $DOCUMENT_STATUS->getDocumentStatusDetails($_POST['id'], $USER->division, $USER->position);

        $DOCUMENT_STATUS->document_id = $_POST['id'];
        $DOCUMENT_STATUS->sender_division_id = $USER->division;
        $DOCUMENT_STATUS->sender_position_id = $USER->position;
        $DOCUMENT_STATUS->sender_user_id = $USER->id;
        $DOCUMENT_STATUS->receiver_division_id = $document_status['sender_division_id'];
        $DOCUMENT_STATUS->receiver_position_id = $document_status['sender_position_id'];
        $DOCUMENT_STATUS->status = 2;
        $DOCUMENT_STATUS->reason = $_POST['val'];
        $DOCUMENT_STATUS->file_name = $DOCUMENT->document;
        $result1 = $DOCUMENT_STATUS->create();
        if ($result1) {
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
    } else {
        $result = [
            "status" => 'error'
        ];
        echo json_encode($result);
        exit();
    }
}
if (isset($_POST['option']) && $_POST['option'] == "REAPPLY") {

    date_default_timezone_set('Asia/Colombo');
    $datetime = date('Y-m-d H:i:s');

    $USER = new User($_SESSION['id']);
    $DOCUMENT = new Documents($_POST['id']);
    $old_doc_name = $DOCUMENT->document;
    if (($DOCUMENT->type == 3 && $DOCUMENT->receiver_division_id == $USER->division) || $DOCUMENT->type == 1) {
        $DIVISION_POSITION = new DivisionPositions(null);
        $position_id = $DIVISION_POSITION->getNextPositionIdOfDivision($DOCUMENT->receiver_division_id, $USER->position);
        $DOCUMENT1 = new Documents($_POST['id']);

        if ($position_id == '') {
            $DOCUMENT1->current_position = $USER->position;
            $DOCUMENT1->current_status = 6;
        } else {
            $DOCUMENT1->current_position = $position_id;
            $DOCUMENT1->current_status = 0;
        }
        $DOCUMENT1->status_updated_at = $datetime;
        $DOCUMENT1->document = $_POST['file_name'];

        $res = $DOCUMENT1->reApplyDocument();
    } 
    if ($res) {

        $DOCUMENT_STATUS = new DocumentStatus(NULL);
        $DIVISION_POSITION = new DivisionPositions(null);
        $position_id = $DIVISION_POSITION->getNextPositionIdOfDivision($USER->division, $USER->position);

        $DOCUMENT_STATUS->document_id = $_POST['id'];
        $DOCUMENT_STATUS->sender_division_id = $USER->division;
        $DOCUMENT_STATUS->sender_position_id = $USER->position;
        $DOCUMENT_STATUS->sender_user_id = $USER->id;
        $DOCUMENT_STATUS->receiver_division_id = $USER->division;
        if ($position_id == '') {
            $DOCUMENT_STATUS->receiver_position_id = $USER->position;
        } else {
            $DOCUMENT_STATUS->receiver_position_id = $position_id;
        }
        $DOCUMENT_STATUS->status = 3;
        $DOCUMENT_STATUS->reason = $_POST['minit'];
        $DOCUMENT_STATUS->file_name = $old_doc_name;
        $result1 = $DOCUMENT_STATUS->create();
        if ($result1) {
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
    } else {
        $result = [
            "status" => 'error'
        ];
        echo json_encode($result);
        exit();
    }
}
