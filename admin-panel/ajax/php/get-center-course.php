<?php
include '../../../class/include.php';


 
//get course by type
if ($_POST['action'] == 'GET_COURSE_BY_CENTER') {

    $CENTER_COURSE = new CenterCourses(NULL);
  
    $result = $CENTER_COURSE->getCenterCoursesWithDetails($_POST["id"]);
    echo json_encode($result);
     
    exit();
}

