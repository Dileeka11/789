<?php
include '../../../class/include.php';


$APPLICATIONS = new Applications(NULL);
$STUDENT = new Student(NULL);
$EXAMSTUDENT = new ExamStudent(NULL);

$selectedCenter = isset($_GET['center']) ? $_GET['center'] : '1';
$selectedYear = isset($_GET['year']) ? $_GET['year'] : '';
$selectedBatch = isset($_GET['batch']) ? $_GET['batch'] : '';

$currentYear = date("Y");
$years = range(2023, $currentYear);
if (!empty($selectedYear)) {
    $years = [$selectedYear]; // Show only the selected year if chosen
}

$applicationCounts = [];
$studentCounts = [];
$studentPassCounts = [];
$studentFailCounts = [];

foreach ($years as $year) {
     
    $applicationCount = $APPLICATIONS->getApplicationsCountByCenterYearAndBatch($selectedCenter,$year, $selectedBatch);
    $studentCount = $STUDENT->getNonNvqStudentCountByYear($year,$selectedCenter, $selectedBatch); 
    $studentPassCount = $EXAMSTUDENT->getPassedStudentsCountByYear($year,$selectedCenter, $selectedBatch); 
    $studentFailCount = $EXAMSTUDENT->getFailedStudentsCountByYear($year,$selectedCenter, $selectedBatch); 
    
    

    $applicationCounts[] = $applicationCount;
    $studentCounts[] = $studentCount;
    $studentPassCounts[] = $studentPassCount;
    $studentFailCounts[] = $studentFailCount;
}

echo json_encode([
    "years" => $years,
    "applicationCounts" => $applicationCounts,
    "studentCounts" => $studentCounts,
    "passStudentCounts" => $studentPassCounts,
    "failStudentCounts" => $studentFailCounts
]);
?>
