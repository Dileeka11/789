<?php

include '../../../class/include.php';
 
 
$ACTION_PANEL = new ActionPanel($_POST['id']);
 
 
if ($ACTION_PANEL->status_name == 'name_edit') {
  
  $EXAM_PERIOD = new ExamPeriod($_POST['exam_id']);
  
  
if ($EXAM_PERIOD->name_edit_status == 0) {
    $EXAM_PERIOD->name_edit_status = 1;
} else {
    $EXAM_PERIOD->name_edit_status = 0;
}
$res = $EXAM_PERIOD->update($_POST['exam_id']);

///practical mark  
} else  if ($ACTION_PANEL->status_name == 'practical_mark') {
  
  $EXAM_PERIOD = new ExamPeriod($_POST['exam_id']);
  
  
if ($EXAM_PERIOD->practical_mark_status == 0) {
    $EXAM_PERIOD->practical_mark_status = 1;
} else {
    $EXAM_PERIOD->practical_mark_status = 0;
}
$res = $EXAM_PERIOD->update($_POST['exam_id']);
}


if ($res) {
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
