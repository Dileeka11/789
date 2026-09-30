<?php

include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

if (isset($_POST['action']) && $_POST['action'] == 'COURSE_SUMMARY') {

    $year = $_POST['year'];
    $batch = $_POST['batch'];

    $COURSE_REQUEST = new CourseRequest(NULL);
    $requests = $COURSE_REQUEST->getCourseRequestCountByStatusYearAndBatch(1, $year, $batch);
    $APPLICATION = new Applications(null);
    $applications = $APPLICATION->getApplicationsCountByYearAndBatch($year, $batch);
    $STUDENT = new Student(null);
    $students = $STUDENT->getStudentsCountByYearAndBatch($year, $batch);
    $dropout_students = $STUDENT->getDropoutStudentsCountByYearAndBatch($year, $batch);
    $enrolled_courses = $STUDENT->getEnrolledCoursesCountByYearAndBatch($year, $batch);

    $arr = array();
    $arr['requests'] = $requests;
    $arr['applications'] = $applications;
    $arr['students'] = $students;
    $arr['dropout_students'] = $dropout_students;
    $arr['enrolled_courses'] = $enrolled_courses;
    echo json_encode($arr);

    exit();
}
