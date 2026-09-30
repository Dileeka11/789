<?php

/**
 * Description of ApplicationMember
 *
 * @author Kavini Nisansala
 * @web www.nysc.lk
 */
class Question
{

    public $id;
    public $course;
    public $question;
    public $answer_1;
    public $answer_2;
    public $answer_3;
    public $answer_4;
    public $correct_answer;

    public function __construct($id)
    {

        if ($id) {

            $query = "SELECT * FROM `questions` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->course = $result['course'];
            $this->question = $result['question'];
            $this->answer_1 = $result['answer_1'];
            $this->answer_2 = $result['answer_2'];
            $this->answer_3 = $result['answer_3'];
            $this->answer_4 = $result['answer_4'];
            $this->correct_answer = $result['correct_answer'];

            return $result;
        }
    }

    public function create()
    {
        $db = new Database();
        $query = "INSERT INTO `questions` (`course`,`question`,`answer_1`,`answer_2`,`answer_3`,`answer_4`,`correct_answer`) VALUES  ('"
            . $this->course . "','"
            . mysqli_real_escape_string($db->DB_CON, $this->question) . "', '"
            . mysqli_real_escape_string($db->DB_CON, $this->answer_1) . "', '"
            . mysqli_real_escape_string($db->DB_CON, $this->answer_2) . "', '"
            . mysqli_real_escape_string($db->DB_CON, $this->answer_3) . "', '"
            . mysqli_real_escape_string($db->DB_CON, $this->answer_4) . "', '"
            . $this->correct_answer . "')";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return mysqli_insert_id($db->DB_CON);
        } else {
            return FALSE;
        }
    }

    public function all()
    {
        $query = "SELECT * FROM `questions`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function update()
    {

        $db = new Database();

        $query = "UPDATE  `questions` SET "
            . "`question` ='" . mysqli_real_escape_string($db->DB_CON, $this->question)   . "', "
            . "`answer_1` ='" . mysqli_real_escape_string($db->DB_CON, $this->answer_1)  . "', "
            . "`answer_2` ='" . mysqli_real_escape_string($db->DB_CON, $this->answer_2)  . "', "
            . "`answer_3` ='" . mysqli_real_escape_string($db->DB_CON, $this->answer_3)   . "', "
            . "`answer_4` ='" . mysqli_real_escape_string($db->DB_CON, $this->answer_4)  . "', "
            . "`correct_answer` ='" . $this->correct_answer . "' "
            . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function delete()
    {
        $query = 'DELETE FROM `questions` WHERE id="' . $this->id . '"';
        $db = new Database();
        return $db->readQuery($query);
    }

    public static function getQuestionById($id)
    {

        $query = 'SELECT * FROM  `questions` WHERE course="' . $id . '"';

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    public static function getRandomQuestionByCourseId($id, $question_count)
    {

        $query = 'SELECT `id` FROM `questions` WHERE `course`="' . $id . '" ORDER BY RAND() LIMIT ' . $question_count;
        // $query = 'SELECT `id` FROM `questions` JOIN (SELECT ROUND(RAND() * (SELECT MAX(id) FROM `questions`)) AS id) AS r2 WHERE questions.id >= r2.id AND  WHERE questions.course="' . $id . '" LIMIT 10';
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row['id']);
        }
        return $array_res;
    }

    public static function getMemberIdsByApplicationId($id)
    {
        $query = "SELECT `id` FROM `questions` WHERE `course` = $id";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row['id']);
        }
        return $array_res;
    }
}
