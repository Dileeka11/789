<?php
include '../../../class/include.php';

$id = $_POST['id'];
$level = $_POST['level'];

$EXAM = new ExamPaper($id);

if ($level == 1) {
    $EXAM->approvel_1 = 1;
} elseif ($level == 2) {
    $EXAM->approvel_2 = 1;
} elseif ($level == 3) {
    $EXAM->approvel_3 = 1;
}

if ($EXAM->updateApproval()) {
    echo 'success';
} else {
    echo 'error';
}
