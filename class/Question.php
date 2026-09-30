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
    public $module_id;
    public $question;
    public $question_sinhala;
    public $question_tamil;
    public $image_name;
    public $image_answer_1;
    public $image_answer_2;
    public $image_answer_3;
    public $image_answer_4;
    public $answer_1;
    public $answer_2;
    public $answer_3;
    public $answer_4;
    public $answer_1_sinhala;
    public $answer_2_sinhala;
    public $answer_3_sinhala;
    public $answer_4_sinhala;
    public $answer_1_tamil;
    public $answer_2_tamil;
    public $answer_3_tamil;
    public $answer_4_tamil;
    public $correct_answer;

    public function __construct($id)
    {

        if ($id) {

            $query = "SELECT * FROM `questions` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->course = $result['course'];
            $this->module_id = $result['module_id'];
            $this->question = $result['question'];
            $this->question_sinhala = $result['question_sinhala'];
            $this->question_tamil = $result['question_tamil'];
            $this->image_name = $result['image_name'];
            $this->image_answer_1 = $result['image_answer_1'];
            $this->image_answer_2 = $result['image_answer_2'];
            $this->image_answer_3 = $result['image_answer_3'];
            $this->image_answer_4 = $result['image_answer_4'];
            $this->answer_1 = $result['answer_1'];
            $this->answer_2 = $result['answer_2'];
            $this->answer_3 = $result['answer_3'];
            $this->answer_4 = $result['answer_4'];
            $this->answer_1_sinhala = $result['answer_1_sinhala'];
            $this->answer_2_sinhala = $result['answer_2_sinhala'];
            $this->answer_3_sinhala = $result['answer_3_sinhala'];
            $this->answer_4_sinhala = $result['answer_4_sinhala'];
            $this->answer_1_tamil = $result['answer_1_tamil'];
            $this->answer_2_tamil = $result['answer_2_tamil'];
            $this->answer_3_tamil = $result['answer_3_tamil'];
            $this->answer_4_tamil = $result['answer_4_tamil'];
            $this->correct_answer = $result['correct_answer'];

            return $result;
        }
    }

    public function create()
    {
        $db = new Database();
        $query = "INSERT INTO `questions` (`course`,`module_id`,`image_name`,`image_answer_1`,`image_answer_2`,`image_answer_3`,`image_answer_4`,`question`,`answer_1`,`answer_2`,`answer_3`,`answer_4`,`question_sinhala`,`answer_1_sinhala`,`answer_2_sinhala`,`answer_3_sinhala`,`answer_4_sinhala`,`question_tamil`,`answer_1_tamil`,`answer_2_tamil`,`answer_3_tamil`,`answer_4_tamil`,`correct_answer`) VALUES  ('"
            . $this->course . "','"
            . $this->module_id . "','"
            . $this->image_name . "','"
            . $this->image_answer_1 . "','"
            . $this->image_answer_2 . "','"
            . $this->image_answer_3 . "','"
            . $this->image_answer_4 . "','"
            . mysqli_real_escape_string($db->DB_CON, $this->question) . "', '"
            . mysqli_real_escape_string($db->DB_CON, $this->answer_1) . "', '"
            . mysqli_real_escape_string($db->DB_CON, $this->answer_2) . "', '"
            . mysqli_real_escape_string($db->DB_CON, $this->answer_3) . "', '"
            . mysqli_real_escape_string($db->DB_CON, $this->answer_4) . "', '"
            . mysqli_real_escape_string($db->DB_CON, $this->question_sinhala) . "', '"
            . mysqli_real_escape_string($db->DB_CON, $this->answer_1_sinhala) . "', '"
            . mysqli_real_escape_string($db->DB_CON, $this->answer_2_sinhala) . "', '"
            . mysqli_real_escape_string($db->DB_CON, $this->answer_3_sinhala) . "', '"
            . mysqli_real_escape_string($db->DB_CON, $this->answer_4_sinhala) . "', '"
            . mysqli_real_escape_string($db->DB_CON, $this->question_tamil) . "', '"
            . mysqli_real_escape_string($db->DB_CON, $this->answer_1_tamil) . "', '"
            . mysqli_real_escape_string($db->DB_CON, $this->answer_2_tamil) . "', '"
            . mysqli_real_escape_string($db->DB_CON, $this->answer_3_tamil) . "', '"
            . mysqli_real_escape_string($db->DB_CON, $this->answer_4_tamil) . "', '"
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
            . "`module_id` ='" . $this->module_id . "', "
            . "`image_name` ='" . $this->image_name . "', "
            . "`image_answer_1` ='" . $this->image_answer_1 . "', "
            . "`image_answer_2` ='" . $this->image_answer_2 . "', "
            . "`image_answer_3` ='" . $this->image_answer_3 . "', "
            . "`image_answer_4` ='" . $this->image_answer_4 . "', "
            . "`question` ='" . mysqli_real_escape_string($db->DB_CON, $this->question) . "', "
            . "`answer_1` ='" . mysqli_real_escape_string($db->DB_CON, $this->answer_1) . "', "
            . "`answer_2` ='" . mysqli_real_escape_string($db->DB_CON, $this->answer_2) . "', "
            . "`answer_3` ='" . mysqli_real_escape_string($db->DB_CON, $this->answer_3) . "', "
            . "`answer_4` ='" . mysqli_real_escape_string($db->DB_CON, $this->answer_4) . "', "
            . "`question_sinhala` ='" . mysqli_real_escape_string($db->DB_CON, $this->question_sinhala) . "', "
            . "`answer_1_sinhala` ='" . mysqli_real_escape_string($db->DB_CON, $this->answer_1_sinhala) . "', "
            . "`answer_2_sinhala` ='" . mysqli_real_escape_string($db->DB_CON, $this->answer_2_sinhala) . "', "
            . "`answer_3_sinhala` ='" . mysqli_real_escape_string($db->DB_CON, $this->answer_3_sinhala) . "', "
            . "`answer_4_sinhala` ='" . mysqli_real_escape_string($db->DB_CON, $this->answer_4_sinhala) . "', "
            . "`question_tamil` ='" . mysqli_real_escape_string($db->DB_CON, $this->question_tamil) . "', "
            . "`answer_1_tamil` ='" . mysqli_real_escape_string($db->DB_CON, $this->answer_1_tamil) . "', "
            . "`answer_2_tamil` ='" . mysqli_real_escape_string($db->DB_CON, $this->answer_2_tamil) . "', "
            . "`answer_3_tamil` ='" . mysqli_real_escape_string($db->DB_CON, $this->answer_3_tamil) . "', "
            . "`answer_4_tamil` ='" . mysqli_real_escape_string($db->DB_CON, $this->answer_4_tamil) . "', "
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
    public static function getQuestionByCourseAndModule($id, $module_id)
    {

        $query = 'SELECT * FROM  `questions` WHERE `course`="' . $id . '" AND  `module_id`="' . $module_id . '"';
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
    public static function getRandomQuestionByCourseYearAndBatch($id, $question_count, $year, $batch)
    {
        $EXAM_PAPER = new ExamPaper(null);
        $exam_paper = $EXAM_PAPER->getExamPaperByYearBatchAndCourse($year, $batch, $id);
        $EXAM_PAPER_QUESTIONS = new ExamPaperQuestions(null);
        $questions = $EXAM_PAPER_QUESTIONS->getRandomQuestionsByExamPaperId($exam_paper['id'], $question_count, $year, $batch);
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
