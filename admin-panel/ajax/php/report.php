<?php

include '../../../class/include.php';

 
//get course by type
if ($_POST['action'] == 'GET_DROP_OUT_DETAILS') {

    $STUDENT = new Student(NULL);
  
    $result = $STUDENT->getDropOutStudentByCourseYearBatch($_POST["course_id"],$_POST["year"],$_POST["batch"],$_POST["center_id"]);
     
    echo json_encode($result);
     
    exit();
}

//get course request  by type
if ($_POST['action'] == 'GET_COURSE_REQUEST_DETAILS') {


$center_id = $_POST['center_id'];
$year = $_POST['year'];
$batch = $_POST['batch'];

$COURSE_REQUEST = new CourseRequest(NULL);
$result = $COURSE_REQUEST->getDetailedCourseRequests($center_id, $year, $batch);   
 
     
    echo json_encode($result);
     
    exit();
}


 //get student details
if ($_POST['action'] == 'GET_STUDENT_DETAILS') {

    $STUDENT = new Student(NULL);
  
    $result = $STUDENT->getStudentIDArrayByCourseAndBatchWithOutDropShow($_POST["course_id"],$_POST["year"],$_POST["batch"],$_POST["center_id"]);
     
    
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

 


//get practical mark report
if ($_POST['action'] == 'GET_PRACTICAL_MARK') {

    $STUDENT = new Student(NULL);
  
    $result = $STUDENT->getStudentIDArrayByCourseAndBatchWithOutDropShow($_POST["course_id"],$_POST["year"],$_POST["batch"],$_POST["center_id"]);
     
    echo json_encode($result);
     
    exit();
}


if ($_POST['action'] == 'GET_FINAL_MARK') {

    $STUDENT = new Student(NULL);
  
    $result = $STUDENT->getStudentIDArrayByCourseAndBatchWithOutDropShowMarks($_POST["course_id"],$_POST["year"],$_POST["batch"],$_POST["center_id"]);
    
     
    echo json_encode($result);
     
    exit();
}


//get report vourse vise appilcations and students registerd
if ($_POST['action'] == 'GET_COURSE_BY_CENTERS') {

    $APPLICATIONS = new Applications(NULL);
  
    $result = $APPLICATIONS->getApplicationsByyearCenterAndBatchVise($_POST["year"],$_POST["batch"],$_POST["center_id"]);
   
     
    echo json_encode($result);
     
    exit();
}

//get course requested by centervise
if ($_POST['action'] == 'GET_COURSES_BY_CENTER') {

    $CENTER_COURSES = new CenterCourses(NULL);
  
    $result = $CENTER_COURSES->getCenterCoursesWithDetailsYearVise($_POST["center_id"],$_POST["year"],$_POST["batch"]);
   
     
    echo json_encode($result);
     
    exit();
}




//get  students registerd
if ($_POST['action'] == 'GET_STUDENT_BY_CENTERS') {

    $STUDENT = new Student(NULL);
  
    $result = $STUDENT->getStudentCountByYear($_POST["year"],$_POST["batch"],$_POST["center_id"]);
   
     
    echo json_encode($result);
     
    exit();
}

//center exam pass count report
if ($_POST['action'] == 'GET_CENTER_EXAM_FINAL') {

    // $CENTER_COURSE = new CenterCourses(NULL);
  
    // $result = $CENTER_COURSE->getCenterCourseIdForExam($_POST["year"],$_POST["batch"],$_POST["center_id"]);
   
   $CENTERS = new Centers(NULL);
   $result = $CENTERS->getCenterCourseIdForExam($_POST["year"],$_POST["batch"],$_POST["center_id"]);
     
      
     
    echo json_encode($result);
     
    exit();
}

//center exam pass count report
if ($_POST['action'] == 'GET_EXAM_FINAL_MARK_REPORT') {

     
   
   $CENTERS = new Centers(NULL);
   $result = $CENTERS->getCenterCourseIdForExam($_POST["year"],$_POST["batch"],$_POST["center_id"]);
     
      
     
    echo json_encode($result);
     
    exit();
}

//center exam pass count report
if ($_POST['action'] == 'GET_EXAM_FINAL_MARK_CHECK') {

     
   
   $STUDENT = new Student(NULL);
   $result = $STUDENT->getFilteredStudentsCheckExam($_POST["course_id"],$_POST["center_id"],$_POST["year"],$_POST["batch"]);
     
      
     
    echo json_encode($result);
     
    exit();
}



//center exam pass count report by courses
if ($_POST['action'] == 'GET_CENTER_EXAM_FINAL_BY_COURSE') {

    
   $CENTERS = new Centers(NULL);
   $result = $CENTERS->getCenterCourseIdForExamBYCenter($_POST["year"],$_POST["batch"],$_POST["course_id"], $_POST["center_id"]);
     
      
     
    echo json_encode($result);
     
    exit();
}