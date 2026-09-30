<?php
include '../../../class/include.php';

$STUDENT = new Student(null);
$student_live_count = count($STUDENT->getStudentLiveCount());

echo json_encode(['live_count' => $student_live_count]);
?>
