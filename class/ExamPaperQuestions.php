<?php

/**
 * Description of ExamPaperQuestions
 *
 * @author W j K n``
 * @web www.nysc.lk
 */
class ExamPaperQuestions
{

    public $id;
    public $exam_paper_id;
    public $qu_id;

    public function __construct($id)
    {

        if ($id) {

            $query = "SELECT `id`,`exam_paper_id`,`qu_id` FROM `exam_paper_questions` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->exam_paper_id = $result['exam_paper_id'];
            $this->qu_id = $result['qu_id'];

            return $result;
        }
    }

    public function create()
    {

        $query = "INSERT INTO `exam_paper_questions` (`exam_paper_id`, `qu_id`) VALUES  ('"
            . $this->exam_paper_id . "','"
            . $this->qu_id . "')";
// dd($query);
        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function all()
    {
        $query = "SELECT * FROM `exam_paper_questions` ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    public function getQuestionsByExamPaperId($paper_id)
    {
        $query = "SELECT * FROM `exam_paper_questions` WHERE `exam_paper_id` = $paper_id ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    public function getQuestionsByExamPaperIdAndModuleId($paper_id, $module_id, $course_id)
    {
        $query = "SELECT * FROM `exam_paper_questions` WHERE `exam_paper_id` = $paper_id AND `qu_id` IN (SELECT `id` FROM `questions` WHERE `module_id` = $module_id AND `course`= '$course_id') ORDER BY `id` DESC";
        // dd($query);
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    public function getRandomQuestionsByExamPaperId($id, $question_count, $year, $batch)
    {
        $EXAM_PAPER = new ExamPaper(null);
        $exam_paper = $EXAM_PAPER->getExamPaperByYearBatchAndCourse($year, $batch, $id);
        $exam_paper_id = $exam_paper['id'];
        $query = "SELECT * FROM `exam_paper_questions` WHERE `exam_paper_id` = $exam_paper_id ORDER BY RAND() LIMIT $question_count";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row['qu_id']);
        }
        return $array_res;
    }
    public function getQuestionIdsByExamPaperId($paper_id)
    {
        $query = "SELECT `qu_id` FROM `exam_paper_questions` WHERE `exam_paper_id` = $paper_id ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row['qu_id']);
        }
        return $array_res;
    }
    public function getQuestionIdsByExamPaperIdAndModuleId($paper_id, $module_id, $course_id)
    {
        $query = "SELECT `qu_id` FROM `exam_paper_questions` WHERE `exam_paper_id` = $paper_id AND `qu_id` IN (SELECT `id` FROM `questions` WHERE `module_id` = $module_id AND `course`= '$course_id') ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row['qu_id']);
        }
        return $array_res;
    }

    public function update()
    {

        $query = "UPDATE  `exam_paper_questions` SET "
            . "`exam_paper_id` ='" . $this->exam_paper_id . "', "
            . "`qu_id` ='" . $this->qu_id . "' "
            . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    public function delete()
    {
        $query = 'DELETE FROM `exam_paper_questions` WHERE id="' . $this->id . '"';
        $db = new Database();
        return $db->readQuery($query);
    }
    public function deleteQuestionByExamPaperIdAndQuestionId($paper_id, $qu_id)
    {
        $query = 'DELETE FROM `exam_paper_questions` WHERE `exam_paper_id`="' . $paper_id . '" AND `qu_id` = "'.$qu_id.'"';
        $db = new Database();
        return $db->readQuery($query);
    }
}
