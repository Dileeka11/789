<?php

header('Content-Type: application/json');
include '../../../class/include.php';

$CENTERS = new Centers(NULL);
$APPLICATIONS = new Applications(NULL);
$STUDENTS = new Student(NULL);

$year = isset($_POST['year']) ? $_POST['year'] : date('Y');  // Default to current year
$batch = isset($_POST['batch']) ? $_POST['batch'] : '';       // Default empty batch
$centerFilter = isset($_POST['center']) ? $_POST['center'] : '';  // Optional center filter

$centersData = [];

foreach ($CENTERS->all() as $center) {
    $centerName = $center['center_name'];
    $centerCode = $center['centercode']; 

     
    if (!empty($centerFilter) && $centerCode != $centerFilter) {
        continue;
    }

    
    $applications = $APPLICATIONS->getApplicationsCountByCenterYearAndBatchFilter($centerCode, $year, $batch);
    $applications = $applications ? $applications : 0;   

     
    $students = $STUDENTS->getStudentCountByCenterYearAndBatchFilter($year, $batch,$centerCode);
    $students = $students ? $students : 0; 

    $centersData[] = [
        'name' => $centerName,
        'applications' => $applications,
        'students' => $students,
    ];
}

echo json_encode($centersData);
?>
