<?php

include '../../../class/include.php';


//course create
if (isset($_POST['create'])) {

    $COURSE = new Course(NULL);

    $COURSE->tradecode = $_POST['tradecode'];
    $COURSE->cname = $_POST['cname'];
    $COURSE->courseid = $_POST['courseid'];
    $COURSE->level = $_POST['level'];
    $COURSE->fullpart = $_POST['fullpart'];
    $COURSE->durationm = $_POST['durationm'];
    $COURSE->nvqnon = $_POST['nvqnon'];
    $COURSE->qu_count = $_POST['qu_count'];
 
    if (isset($_POST['english_lang'])) {
        $COURSE->english_lang = 1;
    } else {
        $COURSE->english_lang = 0;
    }
    if (isset($_POST['tamil_lang'])) {
        $COURSE->tamil_lang = 1;
    } else {
        $COURSE->tamil_lang = 0;
    }
    if (isset($_POST['sinhala_lang'])) {
        $COURSE->sinhala_lang = 1;
    } else {
        $COURSE->sinhala_lang = 0;
    }

    $res = $COURSE->create();


    if ($res) {
        $count = $_POST['row_count'];

        for ($i = 1; $i <= $count; $i++) {
            if ($_POST['module_name_' . $i] != '' && $_POST['module_code_' . $i] != '') {
                $MODULE = new CourseModule(NULL);
                $MODULE->course_id = $_POST['courseid'];
                $MODULE->name = $_POST['module_name_' . $i];
                $MODULE->code = $_POST['module_code_' . $i];
                $MODULE->create();
            }
        }
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
}



//course create
if (isset($_POST['assign-courses'])) {

    $CENTER_COURSE = new CenterCourses(NULL);

    $CENTER_COURSE->course_id = $_POST['course_id'];
    $CENTER_COURSE->center_id = $_POST['center_id'];
    $CENTER_COURSE->year = $_POST['year'];
    $CENTER_COURSE->batch = $_POST['batch'];

    $res = $CENTER_COURSE->create();

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
}


if (isset($_POST['update_if_favorite'])) {
 var_dump('dsdsds');
 exit();
 
    $COURSE = new Course($_POST['id']);


    
    $COURSE->is_favourite = $_POST['status'];

    $res = $COURSE->updateIsfavourite();
 

    $result = [
        "status" => 'success'
    ];
    echo json_encode($result);
    exit();
}

//course update
if (isset($_POST['update'])) {
 
    $COURSE = new Course($_POST['courseid']);


    $COURSE->tradecode = $_POST['tradecode'];
    $COURSE->cname = $_POST['cname'];

    $COURSE->level = $_POST['level'];
    $COURSE->fullpart = $_POST['fullpart'];
    $COURSE->durationm = $_POST['durationm'];
    $COURSE->nvqnon = $_POST['nvqnon'];
    $COURSE->accreditation_end_date = $_POST['accreditation_end_date']??null;
    $COURSE->qu_count = $_POST['qu_count'];
    
    
    if (isset($_POST['english_lang'])) {
        $COURSE->english_lang = 1;
    } else {
        $COURSE->english_lang = 0;
    }
    if (isset($_POST['tamil_lang'])) {
        $COURSE->tamil_lang = 1;
    } else {
        $COURSE->tamil_lang = 0;
    }
    if (isset($_POST['sinhala_lang'])) {
        $COURSE->sinhala_lang = 1;
    } else {
        $COURSE->sinhala_lang = 0;
    }
    // $COURSE->english_lang = $_POST['english_lang'];
    // $COURSE->sinhala_lang = $_POST['sinhala_lang'];
    // $COURSE->tamil_lang = $_POST['tamil_lang'];


    $res = $COURSE->update();

    if ($res) {
        $count = $_POST['row_count'];

        for ($i = 1; $i <= $count; $i++) {
            if (!isset($_POST['module_id_' . $i])) {
                if ($_POST['module_name_' . $i] != '' && $_POST['module_code_' . $i] != '') {
                    $MODULE = new CourseModule(NULL);
                    $MODULE->course_id = $_POST['courseid'];
                    $MODULE->name = $_POST['module_name_' . $i];
                    $MODULE->code = $_POST['module_code_' . $i];
                    $MODULE->create();
                }
            } else {
                if ($_POST['module_name_' . $i] != '' && $_POST['module_code_' . $i] != '') {
                $MODULE = new CourseModule($_POST['module_id_' . $i]);
                $MODULE->name = $_POST['module_name_' . $i];
                $MODULE->code = $_POST['module_code_' . $i];
                $MODULE->update();
                } else {
                    $MODULE = new CourseModule($_POST['module_id_' . $i]);
                    $MODULE->delete();
                }
            }
        }
    }

    $result = [
        "status" => 'success'
    ];
    echo json_encode($result);
    exit();
}
