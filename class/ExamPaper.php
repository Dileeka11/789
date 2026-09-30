<?php

/**
 * Description of ExamPaper
 *
 * @author W j K n``
 * @web www.nysc.lk
 */
class ExamPaper
{

    public $id;
    public $course_id;
    public $exam_period_id;
    public $year;
    public $batch;
    public $is_submitted;
    public $approvel_1;
    public $approvel_2;
    public $approvel_3;

    public function __construct($id)
    {

        if ($id) {

            $query = "SELECT * FROM `exam_papers` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->course_id = $result['course_id'];
            $this->exam_period_id = $result['exam_period_id'];
            $this->year = $result['year'];
            $this->batch = $result['batch'];
            $this->is_submitted = $result['is_submitted'];
            $this->approvel_1 = $result['approvel_1'];
            $this->approvel_2 = $result['approvel_2'];
            $this->approvel_3 = $result['approvel_3'];


            return $result;
        }
    }

    public function create()
    {

        $query = "INSERT INTO `exam_papers` (`course_id`,`exam_period_id`,`year`, `batch`, `is_submitted`) VALUES  ('"
            . $this->course_id . "','"
            . $this->exam_period_id . "','"
            . $this->year . "','"
            . $this->batch . "','"
            . $this->is_submitted . "')";
// dd($query);
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
        $query = "SELECT * FROM `exam_papers` ORDER BY `year` DESC, `batch` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    public function getExamPaperByPeriodIdAndCourseId($period_id, $course_id)
    {
        $query = "SELECT * FROM `exam_papers` WHERE `exam_period_id` = $period_id AND `course_id` = '$course_id'";
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }
    public function getExamPaperByYearBatchAndCourse($year, $batch, $course_id)
    {
        $query = "SELECT * FROM `exam_papers` WHERE `year` = '$year' AND `batch` = $batch AND `course_id` = '$course_id'";
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }

    public function update()
    {

        $query = "UPDATE  `exam_papers` SET "
            . "`course_id` ='" . $this->course_id . "', "
            . "`exam_period_id` ='" . $this->exam_period_id . "', "
            . "`year` ='" . $this->year . "', "
            . "`batch` ='" . $this->batch . "' "
            . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {

            return TRUE;
        } else {

            return FALSE;
        }
    }
    public function updatePaperStatus()
    {

        $query = "UPDATE  `exam_papers` SET "
            . "`is_submitted` ='" . $this->is_submitted . "' "
            . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {

            return TRUE;
        } else {

            return FALSE;
        }
    }
    
    public function updateApproval()
{
    $query = "UPDATE `exam_papers` SET "
        . "`approvel_1` = '" . $this->approvel_1 . "', "
        . "`approvel_2` = '" . $this->approvel_2 . "', "
        . "`approvel_3` = '" . $this->approvel_3 . "' "
        . "WHERE `id` = '" . $this->id . "'";

    $db = new Database();
    $result = $db->readQuery($query);

    return $result ? true : false;
}

    
    

    public function delete()
    {
        $query = 'DELETE FROM `exam_papers` WHERE id="' . $this->id . '"';
        $db = new Database();
        return $db->readQuery($query);
    }
}
