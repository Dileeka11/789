<?php

include '../../../class/include.php';


//course create
if (isset($_POST['create'])) {
    $count = $_POST['row_count'];

    for ($i = 1; $i <= $count; $i++) {
        if ($_POST['module_name_' . $i] != '' && $_POST['module_code_' . $i] != '') {
            $MODULE = new CourseModule(NULL);
            $MODULE->course_id = $_POST['course_id'];
            $MODULE->name = $_POST['module_name_' . $i];
            $MODULE->code = $_POST['module_code_' . $i];
            $MODULE->create();
        }
    }
    $result = [
        "status" => 'success'
    ];
    echo json_encode($result);
    exit();
}

//course update
if (isset($_POST['update'])) {

    $COURSEMODULE = new CourseModule($_POST['id']);
    $COURSEMODULE->name = $_POST['module_name'];
    $COURSEMODULE->code = $_POST['module_code'];
    $COURSEMODULE->update();

    $result = [
        "status" => 'success'
    ];
    echo json_encode($result);
    exit();
}
