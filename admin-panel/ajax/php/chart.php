<?php
include '../../../class/include.php';

if (isset($_POST['start_year']) && isset($_POST['end_year'])) {
    
    
    $startYear = $_POST['start_year'];
    $endYear = $_POST['end_year'];

    $course_type = isset($_POST['course_type']) && !empty($_POST['course_type']) && $_POST['course_type'] !== '0' ? $_POST['course_type'] : null;
 
     
    $batch = isset($_POST['chart_batch']) && !empty($_POST['chart_batch']) && $_POST['chart_batch'] !== '0' ? $_POST['chart_batch'] : null;
 
 
    $APPLICATIONS = new Applications(NULL);
    $STUDENT = new Student(NULL);
    $EXAMSTUDENT = new ExamStudent(NULL);
    
    $response = [];

    for ($year = $startYear; $year <= $endYear; $year++) {
        
        $appCount = $APPLICATIONS->getNonNvqApplicationsCountByYearBatchType($year,$batch,$course_type);
        $student_count =  $STUDENT->getCourseTypeStudentCountBy($year,$batch,$course_type);
        $pass_count = $EXAMSTUDENT->getPassStudentCountByCourseType($year,$batch,$course_type);
        $fail_students = $EXAMSTUDENT->getFaillStudentCountByCourseType($year,$batch,$course_type);
        $dropout_student =  $STUDENT->getDropoutStudentsCountByYearAndBatchAndType($year,$batch,$course_type);
        $ab_students = 1250;
        
        
         $response[$year] = [
        'applications' => $appCount,
        'students' => $student_count,
        'pass_students' => $pass_count,
        'fail_students' => $fail_students,
        'ab_students' =>  $ab_students,
        'drop_out_students' => $dropout_student,
       
    ];
        
    }

    echo json_encode($response);
} else {
    echo json_encode(['error' => 'Start and End years not provided']);
}
?>
