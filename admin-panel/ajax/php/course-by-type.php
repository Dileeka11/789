<?php

include '../../../class/include.php';

 
//get course by type
if ($_POST['action'] == 'GET_COURSE_BY_TYPE') {

    $COURSE = new Course(NULL);
  
    $result = $COURSE->getCourseByType($_POST["type"]);
    echo json_encode($result);
     
    exit();
}


//get course by year
if ($_POST['action'] == 'GET_COURSE_BY_YEAR') {

    $COURSE_REQUEST = new CourseRequest(NULL);
  
      $result = $COURSE_REQUEST->getCourseIdByYear($_POST["year"],$_POST["batch"],$_POST["center_id"]);

    
    echo json_encode($result);
     
    exit();
}
