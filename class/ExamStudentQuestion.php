<?php

class ExamStudentQuestion
{

    public $id;
    public $student_id;
    public $exam_id;
    public $question_id;
    public $answer;
    public $is_correct;
    public $points;
    public $sort;

    public function __construct($id)
    {
        if ($id) {

            $query = "SELECT  * FROM `exam_student_questions` WHERE `id`=" . $id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->student_id = $result['student_id'];
            $this->exam_id = $result['exam_id'];
            $this->question_id = $result['question_id'];
            $this->answer = $result['answer'];
            $this->is_correct = $result['is_correct'];
            $this->points = $result['points'];
            $this->sort = $result['sort'];
            return $this;
        }
    }

    public function create()
    {

        $query = "INSERT INTO `exam_student_questions` (`student_id`,`exam_id`,`question_id`,`sort`) VALUES  ('"
            . $this->student_id . "', '"
            . $this->exam_id . "', '"
            . $this->question_id . "', '"
            . $this->sort . "')";

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

        $query = "UPDATE  `exam_student_questions` SET "
            . "`student_id` ='" . $this->student_id . "', "
            . "`exam_id` ='" . $this->exam_id . "', "
            . "`question_id` ='" . $this->question_id . "', "
            . "`answer` ='" . $this->answer . "', "
            . "`is_correct` ='" . $this->is_correct . "', "
            . "`points` ='" . $this->points . "' "
            . "WHERE `id` = '" . $this->id . "'";


        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }
    public function updateStudentAnswer()
    {

        $query = "UPDATE  `exam_student_questions` SET "
            . "`answer` ='" . $this->answer . "', "
            . "`is_correct` ='" . $this->is_correct . "', "
            . "`points` ='" . $this->points . "' "
            . "WHERE `id` = '" . $this->id . "'";
 

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public static function getFirstQuestion($student_id, $exam_id)
    {

        $query = "SELECT * FROM `exam_student_questions` WHERE `student_id` = '" . $student_id . "' AND `exam_id` = '" . $exam_id . "' AND `sort` = 1";
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }
    public static function getStudentQuestionById($student_id, $exam_id, $id)
    {

        $query = "SELECT * FROM `exam_student_questions` WHERE `student_id` = '" . $student_id . "' AND `exam_id` = '" . $exam_id . "' AND `id` = '" . $id . "'";
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }
    public static function getStudentQuestions($student_id, $exam_id)
    {

        $query = "SELECT * FROM `exam_student_questions` WHERE `student_id` = '" . $student_id . "' AND `exam_id` = '" . $exam_id . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public static function getNonAnsweredQuestions($student_id, $exam_id)
    {
        $query = "SELECT * FROM `exam_student_questions` WHERE `student_id` = '" . $student_id . "' AND `exam_id` = '" . $exam_id . "' AND (`answer` = '' OR `answer` IS NULL)";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    public static function getStudentTotalMarks($student_id, $exam_id)
    {

        $query = "SELECT sum(points) as total FROM `exam_student_questions` WHERE `student_id` = '" . $student_id . "' AND `exam_id` = '" . $exam_id . "' AND `is_correct` = 1";
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['total'];
    }
    
     public static function getStudentQuestionCount($student_id, $exam_id)
    {

        $query = "SELECT count(question_id) as total FROM `exam_student_questions` WHERE `student_id` = '" . $student_id . "' AND `exam_id` = '" . $exam_id . "'  ";
      
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
       
        return $result['total'];
    }
}
