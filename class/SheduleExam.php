<?php

class SheduleExam {

    public $id;
    public $course_id;
    public $type;
    public $is_had_practical;
    public $start_date;
    public $time;
    public $duration;
    public $number_of_question;
    public $is_result_released;
    public $released_date;
    public $year;
    public $batch;
    public $is_manual;
    public $is_center;
    public $exam_category;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT  * FROM `schedule_exam` WHERE `id`=" . $id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->course_id = $result['course_id'];
            $this->type = $result['type'];
            $this->is_had_practical = $result['is_had_practical'];
            $this->start_date = $result['start_date'];
            $this->time = $result['time'];
            $this->duration = $result['duration'];
            $this->number_of_question = $result['number_of_question'];
            $this->is_result_released = $result['is_result_released'];
            $this->released_date = $result['released_date'];
            $this->year = $result['year'];
            $this->batch = $result['batch'];
            $this->is_manual = $result['is_manual'];
            $this->is_center = $result['is_center'];
            $this->exam_category = $result['exam_category'];
        }
    }

    public function create() {

        $query = "INSERT INTO `schedule_exam` (`course_id`,`type`, `is_had_practical`,`start_date`,`time`,`duration`,`year`,`batch`,`number_of_question`,`is_center`,`exam_category`, `is_manual`) VALUES  ('"
                . $this->course_id . "', '"
                . $this->type . "', '"
                . $this->is_had_practical . "', '"
                . $this->start_date . "', '"
                . $this->time . "', '"
                . $this->duration . "', '"
                . $this->year . "', '"
                . $this->batch . "', '"
                . $this->number_of_question . "', '"
                . $this->is_center . "', '"
                . $this->exam_category . "', '"
                . $this->is_manual . "')";
        
        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return mysqli_insert_id($db->DB_CON);
        } else {
            return FALSE;
        }
    }

    public function update() {

        $query = "UPDATE  `schedule_exam` SET " 
                . "`course_id` ='" . $this->course_id . "', "
                . "`type` ='" . $this->type . "', "
                . "`is_had_practical` ='" . $this->is_had_practical . "', "
                . "`start_date` ='" . $this->start_date . "', "
                . "`time` ='" . $this->time . "', "
                . "`duration` ='" . $this->duration . "', "
                . "`year` ='" . $this->year . "', "
                . "`batch` ='" . $this->batch . "', "
                . "`number_of_question` ='" . $this->number_of_question . "', "
                . "`is_manual` ='" . $this->is_manual . "' "
                . "WHERE `id` = '" . $this->id . "'";
        
      
        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }
    public function updateReleaseStatus() {
        date_default_timezone_set('Asia/Colombo');
        $date = date('Y-m-d H:i:s');
        $query = "UPDATE  `schedule_exam` SET " 
                . "`is_result_released` ='" . $this->is_result_released . "', "
                . "`released_date` ='" . $date . "' "
                . "WHERE `id` = '" . $this->id . "'";
        
      
        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function getExamByCourse($course) {

        $query = "SELECT * FROM `schedule_exam` WHERE `course_id` = '" . $course . "' ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    public static function getUpcomingScheduledExamByCourse($course) {

        $query = "SELECT * FROM `schedule_exam` WHERE `course_id` = '" . $course . "' AND `start_date` >= CURDATE() AND `is_manual` = 0 ORDER BY `id` DESC LIMIT 1";
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }


    public static function getDetailsByCourseId($course)
    {

        $query = "SELECT * FROM `schedule_exam` WHERE `course_id` = '" . $course . "' ";
        
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }
    
    
    public function all() {
        $query = "SELECT * FROM `schedule_exam` ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
      public function getExamByYear($year) {
        $query = "SELECT * FROM `schedule_exam`  WHERE `year` = '" . $year . "'  ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    public function getExamByYearAndBatchShow($year,$batch) {
        $query = "SELECT * FROM `schedule_exam`  WHERE `year` = '" . $year . "' AND `batch` = '" . $batch . "'";
     

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
     public function getExamByYearAndBatchShowByCategory($year,$batch,$category) {
        $query = "SELECT * FROM `schedule_exam`  WHERE `year` = '" . $year . "' AND `batch` = '" . $batch . "' AND `exam_category` = '" . $category . "'";
     

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
        public function getExamByYearAndBatchShowByExamCenter($year,$batch) {
        $query = "SELECT * FROM `schedule_exam`  WHERE `year` = '" . $year . "' AND `batch` = '" . $batch . "' AND `is_center` = 1";
     

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
      public function getExamByYearAndBatch($year, $batch) {
        $query = "SELECT * FROM `schedule_exam`  WHERE `year` = '" . $year . "' AND `batch` = '" . $batch . "' AND `course_id` IN (SELECT `courseid` FROM `course` WHERE `nvqnon` = 2)";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function delete() {
        $query = 'DELETE FROM `schedule_exam` WHERE id="' . $this->id . '"';
        
        $db = new Database();
        return $db->readQuery($query);
    }
    
    public function deleteAdditionalQuestions($student_id, $exam_id) {
        $db = new Database();
        $query1 = "SELECT `number_of_question` FROM `schedule_exam`  WHERE `id` = '" . $exam_id . "'";
        $result = mysqli_fetch_array($db->readQuery($query1));
        
        $EXAM_STUDENT_QUESTION = new ExamStudentQuestion(NULL);
        $count_students = $EXAM_STUDENT_QUESTION->getStudentQuestionCount($student_id,$exam_id);
        
        
        if($count_students > $result['number_of_question']) {
            $delete_count = $count_students - $result['number_of_question'];
        } else {
            $delete_count = 0;
        }
        $query = "DELETE FROM `exam_student_questions` WHERE `student_id`='" . $student_id . "' AND  `exam_id`='" . $exam_id . "' LIMIT $delete_count";
        
        
        return $db->readQuery($query);
    }
    
public function getCourseYearBatchForCenterExams($year, $batch, $centerId) {

    $query = "
        SELECT DISTINCT 
            se.course_id, 
            se.year, 
            se.batch
        FROM 
            schedule_exam se
        INNER JOIN 
            center_courses cc ON se.course_id = cc.course_id
        WHERE 
            cc.center_id = $centerId
            AND se.year = '$year'
            AND se.batch = '$batch'";

    $db = new Database();
    $result = $db->readQuery($query);
    $array_res = array();

    while ($row = mysqli_fetch_array($result)) {
        array_push($array_res, $row);
    }

    return $array_res;
}

   
    
 

    
    
    

}
