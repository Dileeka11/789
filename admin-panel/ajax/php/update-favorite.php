<?php

include '../../../class/include.php';


$COURSE = new Course($_POST['id']);

if ($COURSE->is_favourite == 0) {
    $COURSE->is_favourite = 1;
} else {
    $COURSE->is_favourite = 0;
}


$res = $COURSE->updateIsfavourite($_POST['id']);


$result = [
    "status" => 'success'
];
echo json_encode($result);
exit();
