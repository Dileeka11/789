<?php

class ExamStudent
{

    public $id;
    public $student_id;
    public $exam_id;
    public $mcq_marks;
    public $mcq_grade;
    public $essay_marks;
    public $essay_grade;
    public $practical_marks;
    public $practical_grade;
    public $full_marks;
    public $grade;
    public $essay_marks_updated_at;
    public $essay_marks_updated_by;
    public $practical_marks_updated_at;
    public $practical_marks_updated_by;
    public $status;
    public $mcq_started_at;
    public $essay_started_at;
    public $note;

    public function __construct($id)
    {
        if ($id) {

            $query = "SELECT  * FROM `exam_students` WHERE `id`=" . $id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->student_id = $result['student_id'];
            $this->exam_id = $result['exam_id'];
            $this->mcq_marks = $result['mcq_marks'];
            $this->mcq_grade = $result['mcq_grade'];
            $this->essay_marks = $result['essay_marks'];
            $this->essay_grade = $result['essay_grade'];
            $this->practical_marks = $result['practical_marks'];
            $this->practical_grade = $result['practical_grade'];
            $this->full_marks = $result['full_marks'];
            $this->grade = $result['grade'];
            $this->essay_marks_updated_at = $result['essay_marks_updated_at'];
            $this->essay_marks_updated_by = $result['essay_marks_updated_by'];
            $this->practical_marks_updated_at = $result['practical_marks_updated_at'];
            $this->practical_marks_updated_by = $result['practical_marks_updated_by'];
            $this->status = $result['status'];
            $this->mcq_started_at = $result['mcq_started_at'];
            $this->essay_started_at = $result['essay_started_at'];
            $this->note = $result['note'];

            return $this;
        }
    }

    public function create()
    {

        $query = "INSERT INTO `exam_students` (`student_id`,`exam_id`,`status`,`mcq_started_at`,`essay_started_at`) VALUES  ('"
            . $this->student_id . "', '"
            . $this->exam_id . "', '"
            . $this->status . "', '"
            . $this->mcq_started_at . "', '"
            . $this->essay_started_at . "')";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update()
    {

        $query = "UPDATE  `exam_students` SET "
            . "`student_id` ='" . $this->student_id . "', "
            . "`exam_id` ='" . $this->exam_id . "', "
            . "`mcq_marks` ='" . $this->mcq_marks . "', "
            . "`essay_marks` ='" . $this->essay_marks . "', "
            . "`full_marks` ='" . $this->full_marks . "', "
            . "`grade` ='" . $this->grade . "' "
            . "WHERE `id` = '" . $this->id . "'";


        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public static function getStudentDetails($student_id)
    {

        $query = "SELECT * FROM `exam_students` WHERE `student_id` = '" . $student_id . "'";
        // $query = "SELECT * FROM `exam_students` WHERE `student_id` = '" . $student_id . "' AND `status` =  '0'";
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }
    public static function getStudentExam($student_id, $exam_id)
    {

        $query = "SELECT * FROM `exam_students` WHERE `student_id` = '" . $student_id . "' AND `exam_id` =  '" . $exam_id . "'";
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }
    public static function getLatestStudentExam($student_id)
    {

        $query = "SELECT * FROM `exam_students` WHERE `student_id` = '" . $student_id . "' ORDER BY `id` DESC LIMIT 1";
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }
    public static function getStudentExams($student_id)
    {

        $query = "SELECT * FROM `exam_students` WHERE `student_id` = '" . $student_id . "' ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    public function updateExamMarks()
    {

        $query = "UPDATE  `exam_students` SET "
            . "`mcq_marks` ='" . $this->mcq_marks . "', "
            . "`mcq_grade` ='" . $this->mcq_grade . "', "
            . "`full_marks` ='" . $this->full_marks . "', "
            . "`grade` ='" . $this->grade . "', "
            . "`status` ='" . $this->status . "' "
            . "WHERE `id` = '" . $this->id . "'";


        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }
    public function updateTheoryGrades()
    {

        $query = "UPDATE  `exam_students` SET "
            . "`mcq_grade` ='" . $this->mcq_grade . "', "
            . "`essay_grade` ='" . $this->essay_grade . "' "
            . "WHERE `id` = '" . $this->id . "'";


        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }
    public function updateEssayMarks()
    {

        $query = "UPDATE  `exam_students` SET "
            . "`essay_marks` ='" . $this->essay_marks . "', "
            . "`essay_grade` ='" . $this->essay_grade . "', "
            . "`full_marks` ='" . $this->full_marks . "', "
            . "`grade` ='" . $this->grade . "', "
            . "`essay_marks_updated_at` ='" . $this->essay_marks_updated_at . "', "
            . "`essay_marks_updated_by` ='" . $this->essay_marks_updated_by . "' "
            . "WHERE `id` = '" . $this->id . "'";


        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }
    public function updateTestMarks()
    {

        $query = "UPDATE  `exam_students` SET "
            . "`mcq_marks` ='" . $this->mcq_marks . "', "
            . "`mcq_grade` ='" . $this->mcq_grade . "', "
            . "`essay_marks` ='" . $this->essay_marks . "', "
            . "`essay_grade` ='" . $this->essay_grade . "', "
            . "`practical_marks` ='" . $this->practical_marks . "', "
            . "`practical_grade` ='" . $this->practical_grade . "', "
            . "`full_marks` ='" . $this->full_marks . "', "
            . "`grade` ='" . $this->grade . "', "
            . "`essay_marks_updated_at` ='" . $this->essay_marks_updated_at . "', "
            . "`essay_marks_updated_by` ='" . $this->essay_marks_updated_by . "', "
            . "`practical_marks_updated_at` ='" . $this->practical_marks_updated_at . "', "
            . "`practical_marks_updated_by` ='" . $this->practical_marks_updated_by . "' "
            . "WHERE `id` = '" . $this->id . "'";


        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }
    
    
    public function updateStatus()
    {

        $query = "UPDATE  `exam_students` SET "
            . "`status` ='" . $this->status . "' "
            . "WHERE `id` = '" . $this->id . "'";


        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }
    
     
    public function updateNote()
    {

        $query = "UPDATE  `exam_students` SET "
            . "`note` ='" . $this->note . "' "
            . "WHERE `id` = '" . $this->id . "'";


        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }
    
    
    
    public function updateStatusAndEssayStartedDate()
    {

        $query = "UPDATE  `exam_students` SET "
            . "`status` ='" . $this->status . "', "
            . "`essay_started_at` ='" . $this->essay_started_at . "' "
            . "WHERE `id` = '" . $this->id . "'";


        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }
    public function updateExamStartDetails()
    {

        $query = "UPDATE  `exam_students` SET "
            . "`exam_id` ='" . $this->exam_id . "', "
            . "`status` ='" . $this->status . "', "
            . "`essay_started_at` ='" . $this->essay_started_at . "', "
            . "`mcq_started_at` ='" . $this->mcq_started_at . "' "
            . "WHERE `id` = '" . $this->id . "'";


        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }
    public function getStudentsByExamId($exam_id)
    {

        $query = "SELECT  * FROM `exam_students` WHERE `exam_id`=" . $exam_id . " ORDER BY `mcq_marks` ASC, `essay_marks` ASC, `practical_marks` ASC";
         
      
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    public function getStudentIdsByExamId($exam_id)
    {

        $query = "SELECT  `student_id` FROM `exam_students` WHERE `exam_id`=" . $exam_id . " ORDER BY `id` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row['student_id']);
        }
        return $array_res;
    }
    public function getParticipatedStudentsIDByExamIdAndCenter($exam_id, $center, $year, $batch)
    {

        $query = "SELECT  `student`.`id` FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`centercode` = " . $center . " AND `exam_students`.`exam_id`=" . $exam_id . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch;
        
       
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row['id']);
        } 
        return $array_res;
    }
    public function getPassedStudentsByExamIdAndCenter($exam_id, $center, $year, $batch)
    {

        $query = "SELECT  * FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE  `student`.`centercode` = " . $center . " AND `exam_students`.`exam_id`=" . $exam_id . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND `student`.`isActive`= 0 AND (`exam_students`.`grade` LIKE 'Distinction' OR `exam_students`.`grade` LIKE 'Merit' OR `exam_students`.`grade` LIKE 'Ordinary')";
      
       
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    
    
  public function getExamIdPassedStudentsByExamIdAndCenter($exam_id, $center_id)
{
    $exam_id = intval($exam_id); // Sanitize input
    $center_id = intval($center_id); // Sanitize input

    $query = "SELECT * 
              FROM `exam_students`
              JOIN `student` ON `exam_students`.`student_id` = `student`.`id`
              WHERE `exam_students`.`exam_id` = $exam_id 
              AND `student`.`centercode` = $center_id
              AND (`exam_students`.`grade` = 'Distinction' OR `exam_students`.`grade` = 'Merit' OR `exam_students`.`grade` = 'Ordinary')";
    
  
    
    
    $db = new Database();
    $result = $db->readQuery($query);
    
    $array_res = array();
    while ($row = mysqli_fetch_array($result)) {
        array_push($array_res, $row);
    }
    return $array_res;
}

    
 public function getExamIdRepeatStudentsByExamIdAndCenter($exam_id, $center_id)
{
    $exam_id = intval($exam_id); // Sanitize input
    $center_id = intval($center_id); // Sanitize input

    $query = "SELECT * 
              FROM `exam_students`
              JOIN `student` ON `exam_students`.`student_id` = `student`.`id`
              WHERE `exam_students`.`exam_id` = $exam_id 
              AND `student`.`centercode` = $center_id
              AND `exam_students`.`grade` = 'Repeat'";
 
    $db = new Database();
    $result = $db->readQuery($query);
    
    $array_res = array();
    while ($row = mysqli_fetch_array($result)) {
        array_push($array_res, $row);
    }
    return $array_res;
}

 


 public function getPassStudentCountByCourse($center_id, $course_id, $year, $batch) 
{
    $center_id = intval($center_id);   // Sanitize input
    $course_id =  $course_id;   // Assuming $course_id is already sanitized
    $year = intval($year);             // Sanitize input
    $batch = intval($batch);           // Sanitize input

   
 $query = "
    SELECT 
        COUNT(DISTINCT es.student_id) AS pass_student_count
    FROM 
        schedule_exam se
    INNER JOIN 
        exam_students es ON se.id = es.exam_id
    INNER JOIN 
        student s ON s.id = es.student_id
    WHERE 
        s.centercode = $center_id
        AND se.course_id = '$course_id'
        AND se.year = $year
        AND se.batch = $batch
        AND (
            es.grade LIKE 'Distinction' 
            OR es.grade LIKE 'Merit' 
            OR es.grade LIKE 'Ordinary'
        )
    ";
 

    $db = new Database();
    $result = $db->readQuery($query);

    if ($row = mysqli_fetch_array($result)) {
        return intval($row['pass_student_count']);
    }

    return 0; // Return 0 if no matching records
}

 public function getFailStudentCountByCourse($center_id, $course_id, $year, $batch) 
{
    $center_id = intval($center_id);   // Sanitize input
    $course_id =  $course_id;   // Assuming $course_id is already sanitized
    $year = intval($year);             // Sanitize input
    $batch = intval($batch);           // Sanitize input

   
 $query = "
    SELECT 
        COUNT(DISTINCT es.student_id) AS pass_student_count
    FROM 
        schedule_exam se
    INNER JOIN 
        exam_students es ON se.id = es.exam_id
    INNER JOIN 
        student s ON s.id = es.student_id
    WHERE 
        s.centercode = $center_id
        AND se.course_id = '$course_id'
        AND se.year = $year
        AND se.batch = $batch
        AND (
            es.grade LIKE 'Repeat' 
        )
    ";
 

    $db = new Database();
    $result = $db->readQuery($query);

    if ($row = mysqli_fetch_array($result)) {
        return intval($row['pass_student_count']);
    }

    return 0; // Return 0 if no matching records
}

  
    
    //meka aluthin hadapu eka pass count eka balanna harida kiyala
    public function getPassedStudentsCountByYearAndBatchNewOne($year, $batch)
{
    $query = "SELECT *
              FROM `exam_students`
              JOIN `student`
              ON `exam_students`.`student_id` = `student`.`id`
              WHERE `student`.`year` = '" . $year . "'
              AND `student`.`batch` = " . $batch . "
              AND `exam_students`.`grade` IN ('Distinction', 'Merit', 'Ordinary')";

    // dd($query);

    $db = new Database();
    $result = $db->readQuery($query);

    $array_res = array();

    while ($row = mysqli_fetch_array($result)) {
        array_push($array_res, $row);
    }

    return $array_res;
}


    
    
    
    
    public function getPassedStudentsCountByYearAndBatch($year, $batch)
    {

        $query = "SELECT  * FROM `exam_students` JOIN `schedule_exam` ON `exam_students`.`exam_id` = `schedule_exam`.`id` WHERE  `schedule_exam`.`year`='" . $year . "' AND `schedule_exam`.`batch`=" . $batch . " AND (`exam_students`.`grade` LIKE 'Distinction' OR `exam_students`.`grade` LIKE 'Merit' OR `exam_students`.`grade` LIKE 'Ordinary')";
        // dd($query);
        // $query = "SELECT  * FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE  `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND (`exam_students`.`grade` LIKE 'Distinction' OR `exam_students`.`grade` LIKE 'Merit' OR `exam_students`.`grade` LIKE 'Ordinary')";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    
      public function getPassedStudentsCountByYear($year)
    {

        $query = "SELECT  COUNT(exam_students.student_id) AS student_pass_count FROM `exam_students` JOIN `schedule_exam` ON `exam_students`.`exam_id` = `schedule_exam`.`id` WHERE  `schedule_exam`.`year`='" . $year . "'  AND (`exam_students`.`grade` LIKE 'Distinction' OR `exam_students`.`grade` LIKE 'Merit' OR `exam_students`.`grade` LIKE 'Ordinary')";
 
 
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['student_pass_count'];
    }
    
       
      public function getFailedStudentsCountByYear($year)
    {

        $query = "SELECT  COUNT(exam_students.student_id) AS student_pass_count FROM `exam_students` JOIN `schedule_exam` ON `exam_students`.`exam_id` = `schedule_exam`.`id` WHERE  `schedule_exam`.`year`='" . $year . "'  AND (`exam_students`.`grade` LIKE 'Repeat' )";
 
 
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['student_pass_count'];
    } 
    
    public function getCertificateNotIssuedPassedStudentsByExamIdAndCenter($exam_id, $center, $year, $batch)
    {

        $query = "SELECT  * FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE  `student`.`certificate_no` is null AND `student`.`centercode` = " . $center . " AND `exam_students`.`exam_id`=" . $exam_id . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND (`exam_students`.`grade` LIKE 'Distinction' OR `exam_students`.`grade` LIKE 'Merit' OR `exam_students`.`grade` LIKE 'Ordinary')";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    public function getReSitStudentsByExamIdAndCenter($exam_id, $center, $year, $batch)
    {

        // $query = "SELECT  * FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`centercode` = " . $center . " AND `exam_students`.`exam_id`=" . $exam_id . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND (`exam_students`.`grade` LIKE 'Repeat')";
        $EXAM = new SheduleExam($exam_id);
        if ($EXAM->is_had_practical == 1) {
            if ($EXAM->type == 1) {
                $query = "SELECT  * FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`isActive`= 0 AND `student`.`centercode` = " . $center . " AND `exam_students`.`exam_id`=" . $exam_id . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND ((
                `exam_students`.`mcq_grade` LIKE 'Repeat' AND `exam_students`.`practical_grade` IS NOT NULL AND `exam_students`.`mcq_marks` >= 0) OR (
                `exam_students`.`practical_grade` LIKE 'Repeat' AND `exam_students`.`mcq_grade` IS NOT NULL AND `exam_students`.`practical_marks` >= 0))";
            } elseif ($EXAM->type == 2) {
                $query = "SELECT  * FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`isActive`= 0 AND  `student`.`centercode` = " . $center . " AND `exam_students`.`exam_id`=" . $exam_id . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND ((
                `exam_students`.`essay_grade` LIKE 'Repeat' AND `exam_students`.`practical_grade` IS NOT NULL AND `exam_students`.`essay_marks` >= 0) OR (
                `exam_students`.`practical_grade` LIKE 'Repeat' AND `exam_students`.`essay_grade` IS NOT NULL AND `exam_students`.`practical_marks` 
                >= 0))";
            } elseif ($EXAM->type == 3) {
                $query = "SELECT  * FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`isActive`= 0 AND  `student`.`centercode` = " . $center . " AND `exam_students`.`exam_id`=" . $exam_id . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND ((
                `exam_students`.`mcq_grade` LIKE 'Repeat' AND `exam_students`.`practical_grade` IS NOT NULL AND `exam_students`.`essay_grade` IS NOT NULL AND `exam_students`.`mcq_marks` >= 0)  OR (
                `exam_students`.`essay_grade` LIKE 'Repeat' AND `exam_students`.`practical_grade` IS NOT NULL AND `exam_students`.`mcq_grade` IS NOT NULL AND `exam_students`.`essay_marks` >= 0) OR (
                `exam_students`.`practical_grade` LIKE 'Repeat' AND `exam_students`.`mcq_grade` IS NOT NULL AND `exam_students`.`essay_grade` IS NOT NULL AND `exam_students`.`practical_marks` >= 0))";
            }
        } else {
            if ($EXAM->type == 1) {
                $query = "SELECT  * FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`isActive`= 0 AND  `student`.`centercode` = " . $center . " AND `exam_students`.`exam_id`=" . $exam_id . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND (
                `exam_students`.`mcq_grade` LIKE 'Repeat' AND `exam_students`.`mcq_marks` >= 0)";
            } elseif ($EXAM->type == 2) {
                $query = "SELECT  * FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`isActive`= 0 AND  `student`.`centercode` = " . $center . " AND `exam_students`.`exam_id`=" . $exam_id . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND (
                `exam_students`.`essay_grade` LIKE 'Repeat' AND `exam_students`.`essay_marks` >= 0)";
            } elseif ($EXAM->type == 3) {
                $query = "SELECT  * FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`isActive`= 0 AND  `student`.`centercode` = " . $center . " AND `exam_students`.`exam_id`=" . $exam_id . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND ((
                `exam_students`.`mcq_grade` LIKE 'Repeat' AND `exam_students`.`mcq_marks` >= 0) AND (
                `exam_students`.`essay_grade` LIKE 'Repeat' AND `exam_students`.`essay_marks` >= 0))";
            }
        }

        // dd($query);
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    // public function getAbStudentsByExamIdAndCenter($exam_id, $center, $year, $batch)
    // {
    //     $EXAM = new SheduleExam($exam_id);
        
      
        
    //     if ($EXAM->is_had_practical == 1) {
    //         if ($EXAM->type == 1) {
    //             $query = "SELECT  * FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`isActive`= 0 AND `student`.`centercode` = " . $center . " AND `exam_students`.`exam_id`=" . $exam_id . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND (((
    //             `exam_students`.`mcq_grade` = '' OR `exam_students`.`mcq_grade` is null)  AND `exam_students`.`mcq_marks` = 0) OR ((
    //             `exam_students`.`practical_grade` is null OR `exam_students`.`practical_grade` = '') AND `exam_students`.`practical_marks` = 0))";
                
                 
                 
    //         } elseif ($EXAM->type == 2) {
    //             $query = "SELECT  * FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`isActive`= 0 AND  `student`.`centercode` = " . $center . " AND `exam_students`.`exam_id`=" . $exam_id . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND (((
    //             `exam_students`.`essay_grade` = '' OR `exam_students`.`essay_grade` is null) AND `exam_students`.`essay_marks` = 0) OR ((
    //             `exam_students`.`practical_grade` is null OR `exam_students`.`practical_grade` = '') AND `exam_students`.`practical_marks` = 0))";
    //         } elseif ($EXAM->type == 3) {
    //             $query = "SELECT  * FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`isActive`= 0 AND  `student`.`centercode` = " . $center . " AND `exam_students`.`exam_id`=" . $exam_id . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND (((
    //             `exam_students`.`mcq_grade` = '' OR `exam_students`.`mcq_grade` is null)  AND `exam_students`.`mcq_marks` = 0) OR ((
    //             `exam_students`.`essay_grade` = '' OR `exam_students`.`essay_grade` is null) AND `exam_students`.`essay_marks` = 0) OR ((
    //             `exam_students`.`practical_grade` is null OR `exam_students`.`practical_grade` = '') AND `exam_students`.`practical_marks` = 0))";
    //         }
    //     } else {
    //         if ($EXAM->type == 1) {
    //             $query = "SELECT  * FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`isActive`= 0 AND  `student`.`centercode` = " . $center . " AND `exam_students`.`exam_id`=" . $exam_id . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND (((
    //             `exam_students`.`mcq_grade` = '' OR `exam_students`.`mcq_grade` is null)  AND `exam_students`.`mcq_marks` = 0))";
    //         } elseif ($EXAM->type == 2) {
    //             $query = "SELECT  * FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`isActive`= 0 AND  `student`.`centercode` = " . $center . " AND `exam_students`.`exam_id`=" . $exam_id . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND (((
    //             `exam_students`.`essay_grade` = '' OR `exam_students`.`essay_grade` is null) AND `exam_students`.`essay_marks` = 0))";
    //         } elseif ($EXAM->type == 3) {
    //             $query = "SELECT  * FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`isActive`= 0 AND  `student`.`centercode` = " . $center . " AND `exam_students`.`exam_id`=" . $exam_id . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND (((
    //             `exam_students`.`mcq_grade` = '' OR `exam_students`.`mcq_grade` is null)  AND `exam_students`.`mcq_marks` = 0) OR ((
    //             `exam_students`.`essay_grade` = '' OR `exam_students`.`essay_grade` is null) AND `exam_students`.`essay_marks` = 0))";
    //         }
    //     }
    //     // $query = "SELECT  * FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`centercode` = " . $center . " AND `exam_students`.`exam_id`=" . $exam_id . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND (((`exam_students`.`mcq_grade` = '' OR `exam_students`.`mcq_grade` is null)  AND `exam_students`.`mcq_marks` = 0) OR ((`exam_students`.`essay_grade` = '' OR `exam_students`.`essay_grade` is null) AND `exam_students`.`essay_marks` = 0) OR ((`exam_students`.`practical_grade` is null OR `exam_students`.`practical_grade` = '') AND `exam_students`.`practical_marks` = 0))";
    //     //dd($query);
    //     $db = new Database();
    //     $result = $db->readQuery($query);
    //     $array_res = array();
    //     while ($row = mysqli_fetch_array($result)) {
    //         array_push($array_res, $row);
    //     }
    //     return $array_res;
    // }
    
    
    public function getAbStudentsByExamIdAndCenter($exam_id, $center, $year, $batch)
{
    $EXAM = new SheduleExam($exam_id);

    $condition = "";

    if ($EXAM->is_had_practical == 1) {

        if ($EXAM->type == 1) {
            $condition = "(
                ((exam_students.mcq_grade = '' OR exam_students.mcq_grade IS NULL) 
                AND exam_students.mcq_marks = 0)
                OR
                ((exam_students.practical_grade IS NULL OR exam_students.practical_grade = '') 
                AND exam_students.practical_marks = 0)
            )";

        } elseif ($EXAM->type == 2) {
            $condition = "(
                ((exam_students.essay_grade = '' OR exam_students.essay_grade IS NULL) 
                AND exam_students.essay_marks = 0)
                OR
                ((exam_students.practical_grade IS NULL OR exam_students.practical_grade = '') 
                AND exam_students.practical_marks = 0)
            )";

        } elseif ($EXAM->type == 3) {
            $condition = "(
                ((exam_students.mcq_grade = '' OR exam_students.mcq_grade IS NULL) 
                AND exam_students.mcq_marks = 0)
                OR
                ((exam_students.essay_grade = '' OR exam_students.essay_grade IS NULL) 
                AND exam_students.essay_marks = 0)
                OR
                ((exam_students.practical_grade IS NULL OR exam_students.practical_grade = '') 
                AND exam_students.practical_marks = 0)
            )";
        }

    } else {

        if ($EXAM->type == 1) {
            $condition = "
                ((exam_students.mcq_grade = '' OR exam_students.mcq_grade IS NULL) 
                AND exam_students.mcq_marks = 0)
            ";

        } elseif ($EXAM->type == 2) {
            $condition = "
                ((exam_students.essay_grade = '' OR exam_students.essay_grade IS NULL) 
                AND exam_students.essay_marks = 0)
            ";

        } elseif ($EXAM->type == 3) {
            $condition = "(
                ((exam_students.mcq_grade = '' OR exam_students.mcq_grade IS NULL) 
                AND exam_students.mcq_marks = 0)
                OR
                ((exam_students.essay_grade = '' OR exam_students.essay_grade IS NULL) 
                AND exam_students.essay_marks = 0)
            )";
        }
    }


    $query = "SELECT exam_students.*, student.*
              FROM exam_students
              INNER JOIN student 
                  ON exam_students.student_id = student.id
              WHERE student.isActive = 0
              AND student.centercode = $center
              AND exam_students.exam_id = $exam_id
              AND exam_students.grade != 'Repeat'
              AND student.year = '$year'
              AND student.batch = $batch
              AND $condition";


    $db = new Database();
    $result = $db->readQuery($query);

    $array_res = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $array_res[] = $row;
    }

    return $array_res;
}

    public function updatePracticalExamMarks()
    {

        $query = "UPDATE  `exam_students` SET "
            . "`practical_marks` ='" . $this->practical_marks . "', "
            . "`practical_grade` ='" . $this->practical_grade . "', "
            . "`practical_marks_updated_at` ='" . $this->practical_marks_updated_at . "', "
            . "`practical_marks_updated_by` ='" . $this->practical_marks_updated_by . "' "
            . "WHERE `id` = '" . $this->id . "'";


        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }
    public function updatePracticalExamAndFullMarks()
    {

        $query = "UPDATE  `exam_students` SET "
            . "`practical_marks` ='" . $this->practical_marks . "', "
            . "`practical_grade` ='" . $this->practical_grade . "', "
            . "`full_marks` ='" . $this->full_marks . "', "
            . "`grade` ='" . $this->grade . "', "
            . "`practical_marks_updated_at` ='" . $this->practical_marks_updated_at . "', "
            . "`practical_marks_updated_by` ='" . $this->practical_marks_updated_by . "' "
            . "WHERE `id` = '" . $this->id . "'";


        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }
    public function createPracticalExamMarks()
    {

        $query = "INSERT INTO `exam_students` (`student_id`,`status`,`practical_marks`,`practical_grade`,`practical_marks_updated_at`,`practical_marks_updated_by`) VALUES  ('"
            . $this->student_id . "', '"
            . $this->status . "', '"
            . $this->practical_marks . "', '"
            . $this->practical_grade . "', '"
            . $this->practical_marks_updated_at . "', '"
            . $this->practical_marks_updated_by . "')";

        $db = new Database();
        $result = $db->readQuery($query);
        
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    
    public function createExamRecord()
{
     
    
    $query = "INSERT INTO `exam_students` 
        (`student_id`, `exam_id`, `mcq_marks`, `mcq_grade`, `practical_marks`, `practical_grade`, `full_marks`, `grade`, `practical_marks_updated_at`, `practical_marks_updated_by`, `essay_marks_updated_at`, `essay_marks_updated_by`) 
        VALUES 
        ('" . $this->student_id . "', 
         '" . $this->exam_id . "', 
         '" . $this->mcq_marks . "', 
         '" . $this->mcq_grade . "', 
         '" . $this->practical_marks . "', 
         '" . $this->practical_grade . "', 
         '" . $this->full_marks . "', 
         '" . $this->grade . "', 
         '" . $this->practical_marks_updated_at . "', 
         '" . $this->practical_marks_updated_by . "', 
         '" . $this->essay_marks_updated_at . "', 
         '" . $this->essay_marks_updated_by . "')";

    $db = new Database();
    $result = $db->readQuery($query);
    
    return $result ? true : false;
}


    public function createTestMarks()
    {

        $query = "INSERT INTO `exam_students` (`student_id`,`status`,`mcq_marks`,`mcq_grade`,`essay_marks`,`essay_grade`,`practical_marks`,`practical_grade`,`full_marks`,`grade`,`practical_marks_updated_at`,`practical_marks_updated_by`,`essay_marks_updated_at`,`essay_marks_updated_by`) VALUES  ('"
            . $this->student_id . "', '"
            . $this->status . "', '"
            . $this->mcq_marks . "', '"
            . $this->mcq_grade . "', '"
            . $this->essay_marks . "', '"
            . $this->essay_grade . "', '"
            . $this->practical_marks . "', '"
            . $this->practical_grade . "', '"
            . $this->full_marks . "', '"
            . $this->grade . "', '"
            . $this->practical_marks_updated_at . "', '"
            . $this->practical_marks_updated_by . "', '"
            . $this->essay_marks_updated_at . "', '"
            . $this->essay_marks_updated_by . "')";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function deleteStudentsByExamId($exam_id)
    {
        $query = 'DELETE FROM `exam_students` WHERE `exam_id`="' . $exam_id . '"';
        $db = new Database();
        return $db->readQuery($query);
    }
    public function deleteStudentByExamId($student_id, $exam_id)
    {
        $query = 'DELETE FROM `exam_students` WHERE `student_id`="' . $student_id . '" AND `exam_id`="' . $exam_id . '"';
        $db = new Database();
        return $db->readQuery($query);
    }
    public function getPassedStudentsCount()
    {

        $query = "SELECT  count(id) as count FROM `exam_students` WHERE (`exam_students`.`grade` LIKE 'Distinction' OR `exam_students`.`grade` LIKE 'Merit' OR `exam_students`.`grade` LIKE 'Ordinary')";
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }

    public function getParticipatedStudentsCountByCenterYearAndBatch($center, $year, $batch)
    {

        $query = "SELECT count(DISTINCT `exam_students`.`id`) as 'stu_count' FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`centercode` = " . $center . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND `student`.`isActive` = 0  AND `student`.`course_id` IN (SELECT `courseid` FROM `course` WHERE `nvqnon` = 2)";
        // $query = "SELECT  * FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`centercode` = " . $center . " AND `exam_students`.`exam_id`=" . $exam_id . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch;
        $db = new Database();
        // $result = $db->readQuery($query);
        // $array_res = array();
        // while ($row = mysqli_fetch_array($result)) {
        //     array_push($array_res, $row['id']);
        // }
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['stu_count'];
    }
    public function getPassedStudentsCountByCenterYearAndBatch($center, $year, $batch)
    {

        $query = "SELECT count(`exam_students`.`id`) as 'stu_count' FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`centercode` = " . $center . " AND `exam_students`.`exam_id` <> 0 AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND `student`.`isActive` = 0  AND `student`.`course_id` IN (SELECT `courseid` FROM `course` WHERE `nvqnon` = 2) AND (`exam_students`.`grade` LIKE 'Distinction' OR `exam_students`.`grade` LIKE 'Merit' OR `exam_students`.`grade` LIKE 'Ordinary')";
        // $query = "SELECT  * FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`centercode` = " . $center . " AND `exam_students`.`exam_id`=" . $exam_id . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND (`exam_students`.`grade` LIKE 'Distinction' OR `exam_students`.`grade` LIKE 'Merit' OR `exam_students`.`grade` LIKE 'Ordinary')";
        $db = new Database();

        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['stu_count'];
    }
    public function getReSitStudentsByCenterYearAndBatch($center, $year, $batch)
    {
        // $query = "SELECT  * FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`centercode` = " . $center . " AND `exam_students`.`exam_id`=" . $exam_id . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND (`exam_students`.`grade` LIKE 'Repeat')";
        $EXAM1 = new SheduleExam(null);
        $exams = $EXAM1->getExamByYearAndBatch($year, $batch);
        $array_res = array();
        $count = 0;
        foreach ($exams as $exam) {
            $EXAM = new SheduleExam($exam['id']);
            $exam_id = $exam['id'];
            if ($EXAM->is_had_practical == 1) {
                if ($EXAM->type == 1) {
                    // $query = "SELECT count(`exam_students`.`id`) as 'stu_count' FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`centercode` = " . $center . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . "  AND  `exam_students`.`exam_id` = $exam_id AND ((`exam_students`.`mcq_grade` LIKE 'Repeat' AND `exam_students`.`practical_grade` IS NOT NULL AND `exam_students`.`mcq_marks` >= 0) OR (`exam_students`.`practical_grade` LIKE 'Repeat' AND `exam_students`.`mcq_grade` IS NOT NULL AND `exam_students`.`practical_marks` >= 0))";
                    $query = "SELECT count(`exam_students`.`id`) as 'stu_count' FROM `exam_students` WHERE ((`exam_students`.`mcq_grade` LIKE 'Repeat' AND `exam_students`.`practical_grade` IS NOT NULL AND `exam_students`.`mcq_marks` >= 0) OR (`exam_students`.`practical_grade` LIKE 'Repeat' AND `exam_students`.`mcq_grade` IS NOT NULL AND `exam_students`.`practical_marks` >= 0)) AND  `exam_students`.`exam_id` = $exam_id AND `exam_students`.`student_id` IN (SELECT `id` FROM `student` WHERE `student`.`centercode` = " . $center . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . "  AND `student`.`isActive` = 0  AND `student`.`course_id` IN (SELECT `courseid` FROM `course` WHERE `nvqnon` = 2))";
                } elseif ($EXAM->type == 2) {
                    // $query = "SELECT count(`exam_students`.`id`) as 'stu_count' FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`centercode` = " . $center . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND ((`exam_students`.`essay_grade` LIKE 'Repeat' AND `exam_students`.`practical_grade` IS NOT NULL AND `exam_students`.`essay_marks` >= 0) OR (`exam_students`.`practical_grade` LIKE 'Repeat' AND `exam_students`.`essay_grade` IS NOT NULL AND `exam_students`.`practical_marks` >= 0))";
                    $query = "SELECT count(`exam_students`.`id`) as 'stu_count' FROM `exam_students` WHERE ((`exam_students`.`essay_grade` LIKE 'Repeat' AND `exam_students`.`practical_grade` IS NOT NULL AND `exam_students`.`essay_marks` >= 0) OR (`exam_students`.`practical_grade` LIKE 'Repeat' AND `exam_students`.`essay_grade` IS NOT NULL AND `exam_students`.`practical_marks` >= 0)) AND  `exam_students`.`exam_id` = $exam_id AND `exam_students`.`student_id` IN (SELECT `id` FROM `student` WHERE `student`.`centercode` = " . $center . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . "  AND `student`.`isActive` = 0  AND `student`.`course_id` IN (SELECT `courseid` FROM `course` WHERE `nvqnon` = 2))";
                } elseif ($EXAM->type == 3) {
                    // $query = "SELECT count(`exam_students`.`id`) as 'stu_count' FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`centercode` = " . $center . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND ((`exam_students`.`mcq_grade` LIKE 'Repeat' AND `exam_students`.`practical_grade` IS NOT NULL AND `exam_students`.`mcq_marks` >= 0)  OR (`exam_students`.`essay_grade` LIKE 'Repeat' AND `exam_students`.`practical_grade` IS NOT NULL AND `exam_students`.`essay_marks` >= 0) OR (`exam_students`.`practical_grade` LIKE 'Repeat' AND `exam_students`.`mcq_grade` IS NOT NULL AND `exam_students`.`essay_grade` IS NOT NULL AND `exam_students`.`practical_marks` >= 0))";
                    $query = "SELECT count(`exam_students`.`id`) as 'stu_count' FROM `exam_students` WHERE ((`exam_students`.`mcq_grade` LIKE 'Repeat' AND `exam_students`.`practical_grade` IS NOT NULL AND `exam_students`.`mcq_marks` >= 0)  OR (`exam_students`.`essay_grade` LIKE 'Repeat' AND `exam_students`.`practical_grade` IS NOT NULL AND `exam_students`.`essay_marks` >= 0) OR (`exam_students`.`practical_grade` LIKE 'Repeat' AND `exam_students`.`mcq_grade` IS NOT NULL AND `exam_students`.`essay_grade` IS NOT NULL AND `exam_students`.`practical_marks` >= 0)) AND  `exam_students`.`exam_id` = $exam_id AND `exam_students`.`student_id` IN (SELECT `id` FROM `student` WHERE `student`.`centercode` = " . $center . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . "  AND `student`.`isActive` = 0  AND `student`.`course_id` IN (SELECT `courseid` FROM `course` WHERE `nvqnon` = 2))";
                }
            } else {
                if ($EXAM->type == 1) {
                    // $query = "SELECT count(`exam_students`.`id`) as 'stu_count' FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`centercode` = " . $center . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND (`exam_students`.`mcq_grade` LIKE 'Repeat' AND `exam_students`.`practical_grade` IS NOT NULL AND `exam_students`.`mcq_marks` >= 0)";

                    $query = "SELECT count(`exam_students`.`id`) as 'stu_count' FROM `exam_students` WHERE (`exam_students`.`mcq_grade` LIKE 'Repeat' AND `exam_students`.`mcq_marks` >= 0) AND  `exam_students`.`exam_id` = $exam_id AND `exam_students`.`student_id` IN (SELECT `id` FROM `student` WHERE `student`.`centercode` = " . $center . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND `student`.`isActive` = 0  AND `student`.`course_id` IN (SELECT `courseid` FROM `course` WHERE `nvqnon` = 2))";
                } elseif ($EXAM->type == 2) {
                    // $query = "SELECT count(`exam_students`.`id`) as 'stu_count' FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`centercode` = " . $center . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND (`exam_students`.`essay_grade` LIKE 'Repeat' AND `exam_students`.`practical_grade` IS NOT NULL AND `exam_students`.`essay_marks` >= 0)";

                    $query = "SELECT count(`exam_students`.`id`) as 'stu_count' FROM `exam_students` WHERE (`exam_students`.`essay_grade` LIKE 'Repeat' AND `exam_students`.`essay_marks` >= 0) AND  `exam_students`.`exam_id` = $exam_id AND `exam_students`.`student_id` IN (SELECT `id` FROM `student` WHERE `student`.`centercode` = " . $center . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND `student`.`isActive` = 0  AND `student`.`course_id` IN (SELECT `courseid` FROM `course` WHERE `nvqnon` = 2))";
                } elseif ($EXAM->type == 3) {
                    // $query = "SELECT count(`exam_students`.`id`) as 'stu_count' FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`centercode` = " . $center . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND ((`exam_students`.`mcq_grade` LIKE 'Repeat' AND `exam_students`.`practical_grade` IS NOT NULL AND `exam_students`.`mcq_marks` >= 0) OR (`exam_students`.`essay_grade` LIKE 'Repeat' AND `exam_students`.`practical_grade` IS NOT NULL AND `exam_students`.`essay_marks` >= 0))";

                    $query = "SELECT count(`exam_students`.`id`) as 'stu_count' FROM `exam_students` WHERE ((`exam_students`.`mcq_grade` LIKE 'Repeat' AND `exam_students`.`mcq_marks` >= 0) OR (`exam_students`.`essay_grade` LIKE 'Repeat' AND `exam_students`.`essay_marks` >= 0)) AND  `exam_students`.`exam_id` = $exam_id AND `exam_students`.`student_id` IN (SELECT `id` FROM `student` WHERE `student`.`centercode` = " . $center . " AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND `student`.`isActive` = 0  AND `student`.`course_id` IN (SELECT `courseid` FROM `course` WHERE `nvqnon` = 2))";
                }
            }

            $db = new Database();

            $result = mysqli_fetch_array($db->readQuery($query));
            // var_dump($result['stu_count']);
            $count += $result['stu_count'];
        }
        // var_dump($count);
        $STUDENT = new Student(null);
        $students = $STUDENT->getStudentsByCenterYearAndBatch($center, $year, $batch);
        $student_arr = implode(',', $students);
        // var_dump($student_arr);
        if (count($exams) > 0 && count($students) > 0) {
            $query = "SELECT count(`exam_students`.`id`) as 'stu_count' FROM `exam_students` WHERE `exam_students`.`exam_id` = 0 AND `exam_students`.`student_id` IN ($student_arr)";
            $result1 = mysqli_fetch_array($db->readQuery($query));
            // var_dump($result1);
            // var_dump($result1['stu_count']);
            $count += $result1['stu_count'];
        }
        return $count;
    }
    public function getAbStudentsByCenterYearAndBatch($center, $year, $batch)
    {
        $EXAM1 = new SheduleExam(null);
        $exams = $EXAM1->getExamByYearAndBatch($year, $batch);

        $array_res = array();
        $count = 0;
        foreach ($exams as $exam) {
            $EXAM = new SheduleExam($exam['id']);
            $exam_id = $exam['id'];
            if ($EXAM->is_had_practical == 1) {
                if ($EXAM->type == 1) {
                    $query = "SELECT count(`exam_students`.`id`) as 'stu_count' FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`centercode` = " . $center . " AND  `exam_students`.`exam_id` = $exam_id AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND `student`.`isActive` = 0  AND `student`.`course_id` IN (SELECT `courseid` FROM `course` WHERE `nvqnon` = 2) AND (((`exam_students`.`mcq_grade` = '' OR `exam_students`.`mcq_grade` is null)  AND `exam_students`.`mcq_marks` = 0) OR ((`exam_students`.`practical_grade` is null OR `exam_students`.`practical_grade` = '') AND `exam_students`.`practical_marks` = 0))";
                } elseif ($EXAM->type == 2) {
                    $query = "SELECT count(`exam_students`.`id`) as 'stu_count' FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`centercode` = " . $center . " AND  `exam_students`.`exam_id` = $exam_id AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND `student`.`isActive` = 0  AND `student`.`course_id` IN (SELECT `courseid` FROM `course` WHERE `nvqnon` = 2) AND (((`exam_students`.`essay_grade` = '' OR `exam_students`.`essay_grade` is null) AND `exam_students`.`essay_marks` = 0) OR ((`exam_students`.`practical_grade` is null OR `exam_students`.`practical_grade` = '') AND `exam_students`.`practical_marks` = 0))";
                } elseif ($EXAM->type == 3) {
                    $query = "SELECT count(`exam_students`.`id`) as 'stu_count' FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`centercode` = " . $center . " AND  `exam_students`.`exam_id` = $exam_id AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND `student`.`isActive` = 0  AND `student`.`course_id` IN (SELECT `courseid` FROM `course` WHERE `nvqnon` = 2) AND (((`exam_students`.`mcq_grade` = '' OR `exam_students`.`mcq_grade` is null)  AND `exam_students`.`mcq_marks` = 0) OR ((`exam_students`.`essay_grade` = '' OR `exam_students`.`essay_grade` is null) AND `exam_students`.`essay_marks` = 0) OR ((`exam_students`.`practical_grade` is null OR `exam_students`.`practical_grade` = '') AND `exam_students`.`practical_marks` = 0))";
                }
            } else {
                if ($EXAM->type == 1) {
                    $query = "SELECT count(`exam_students`.`id`) as 'stu_count' FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`centercode` = " . $center . " AND  `exam_students`.`exam_id` = $exam_id AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND `student`.`isActive` = 0  AND `student`.`course_id` IN (SELECT `courseid` FROM `course` WHERE `nvqnon` = 2) AND (((`exam_students`.`mcq_grade` = '' OR `exam_students`.`mcq_grade` is null)  AND `exam_students`.`mcq_marks` = 0))";
                } elseif ($EXAM->type == 2) {
                    $query = "SELECT count(`exam_students`.`id`) as 'stu_count' FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`centercode` = " . $center . " AND  `exam_students`.`exam_id` = $exam_id AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . "  AND `student`.`isActive` = 0  AND `student`.`course_id` IN (SELECT `courseid` FROM `course` WHERE `nvqnon` = 2)AND (((`exam_students`.`essay_grade` = '' OR `exam_students`.`essay_grade` is null) AND `exam_students`.`essay_marks` = 0))";
                } elseif ($EXAM->type == 3) {
                    $query = "SELECT count(`exam_students`.`id`) as 'stu_count' FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id` WHERE `student`.`centercode` = " . $center . " AND  `exam_students`.`exam_id` = $exam_id AND `student`.`year`='" . $year . "' AND `student`.`batch`=" . $batch . " AND `student`.`isActive` = 0  AND `student`.`course_id` IN (SELECT `courseid` FROM `course` WHERE `nvqnon` = 2) AND (((`exam_students`.`mcq_grade` = '' OR `exam_students`.`mcq_grade` is null)  AND `exam_students`.`mcq_marks` = 0) OR ((`exam_students`.`essay_grade` = '' OR `exam_students`.`essay_grade` is null) AND `exam_students`.`essay_marks` = 0))";
                }
            }
             
             // dd($query);
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));
            $count += $result['stu_count'];
        }
        return $count;
    }
    
    
    public function getPassStudentCount($year, $batch, $course_id,$center)
    {
             
        
         $query = "SELECT  count(exam_students.id) as 'stu_count'  FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id`   WHERE `student`.`centercode` = " . $center . "    AND `student`.`year`='" . $year . "' AND `student`.`course_id` ='".$course_id."' AND `student`.`batch`=" . $batch . " AND  `student`.`isActive`= 0  AND `exam_students`.`exam_id` !=0 AND    (`exam_students`.`grade` LIKE 'Distinction' OR `exam_students`.`grade` LIKE 'Merit' OR `exam_students`.`grade` LIKE 'Ordinary')";
    //   dd($query);
       
      $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['stu_count'];
        
    }
    
public function getPassStudentCountByCourseType($year, $batch, $type)
{
    $query = "SELECT COUNT(exam_students.id) AS 'stu_count' 
              FROM exam_students 
              JOIN student ON exam_students.student_id = student.id 
              JOIN course ON course.courseid = student.course_id 
              JOIN schedule_exam ON schedule_exam.id = exam_students.exam_id 
              WHERE student.isActive = 0 
              AND exam_students.exam_id != 0
              AND (
                  exam_students.grade LIKE 'Distinction' 
                  OR exam_students.grade LIKE 'Merit' 
                  OR exam_students.grade LIKE 'Ordinary'
              )";

    // Apply year filter from schedule_exam
    if (!is_null($year)) {
        $query .= " AND schedule_exam.year = $year";
    }

    // Apply course type (nvqnon) filter
    if (!is_null($type)) {
        $query .= " AND course.nvqnon = $type";
    } else {
        $query .= " AND course.nvqnon = 2";
    }

    // Apply batch filter from schedule_exam
    if (!is_null($batch)) {
        $query .= " AND schedule_exam.batch = $batch";
    }

    $db = new Database();
    $result = mysqli_fetch_array($db->readQuery($query));
    return $result['stu_count'];
}


public function getFaillStudentCountByCourseType($year, $batch, $type)
{
    $query = "SELECT COUNT(exam_students.id) AS 'stu_count' 
              FROM exam_students 
              JOIN student ON exam_students.student_id = student.id 
              JOIN course ON course.courseid = student.course_id 
              JOIN schedule_exam ON schedule_exam.id = exam_students.exam_id 
              WHERE student.isActive = 0 
              AND exam_students.exam_id != 0
             AND (`exam_students`.`grade` LIKE 'Repeat')";

    // Apply year filter from schedule_exam
    if (!is_null($year)) {
        $query .= " AND schedule_exam.year = $year";
    }

    // Apply course type (nvqnon) filter
    if (!is_null($type)) {
        $query .= " AND course.nvqnon = $type";
    } else {
        $query .= " AND course.nvqnon = 2";
    }

    // Apply batch filter from schedule_exam
    if (!is_null($batch)) {
        $query .= " AND schedule_exam.batch = $batch";
    }

    $db = new Database();
    $result = mysqli_fetch_array($db->readQuery($query));
    return $result['stu_count'];
}


    

    
    // Per-center live statistics for a single exam.
    // Returns one row per center that has students in this exam's cohort
    // (course + year + batch, active students), with:
    //   expected_count  -> how many students SHOULD sit the exam
    //   attended_count  -> how many have actually started/attended, based on
    //                      the exam_students.status column (1 = MCQ started,
    //                      2 = MCQ done, 3 = essay started, 4 = essay done).
    // Students with status 0 (assigned but not yet started) are NOT counted
    // as attended.
    public function getLiveExamCenterStats($exam_id, $course_id, $year, $batch)
    {
        $db = new Database();

        $exam_id   = intval($exam_id);
        $year      = intval($year);
        $batch     = intval($batch);
        $course_id = mysqli_real_escape_string($db->DB_CON, $course_id);

        $query = "
            SELECT
                tc.centercode,
                tc.center_name,
                COUNT(DISTINCT s.id) AS expected_count,
                COUNT(DISTINCT CASE WHEN es.status IN (1, 2, 3, 4) THEN es.student_id END) AS attended_count
            FROM student s
            INNER JOIN training_centre tc ON tc.centercode = s.centercode
            LEFT JOIN exam_students es ON es.student_id = s.id AND es.exam_id = $exam_id
            WHERE s.course_id = '$course_id'
              AND s.year = '$year'
              AND s.batch = $batch
              AND s.isActive = 0
            GROUP BY tc.centercode, tc.center_name
            HAVING expected_count > 0 OR attended_count > 0
            ORDER BY tc.center_name ASC";

        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getFaillStudentCount($year, $batch, $course_id,$center)
    {
     
        // $query = "SELECT  count(exam_students.id) as 'stu_count'  FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id`   WHERE `student`.`centercode` = " . $center . "    AND `student`.`year`='" . $year . "' AND `student`.`course_id` ='".$course_id."' AND `student`.`batch`=" . $batch . " AND  `student`.`isActive`= 0  AND `exam_students`.`exam_id` !=0 AND   (`exam_students`.`grade` LIKE 'Repeat')";
 
        $query = "SELECT  count(exam_students.id) as 'stu_count'  FROM `exam_students` JOIN `student` ON `exam_students`.`student_id` = `student`.`id`   WHERE `student`.`centercode` = " . $center . "    AND `student`.`year`='" . $year . "' AND `student`.`course_id` ='".$course_id."' AND `student`.`batch`=" . $batch . " AND  `student`.`isActive` = 0  AND   (`exam_students`.`grade` LIKE 'Repeat')";

        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['stu_count'];
    }
}
