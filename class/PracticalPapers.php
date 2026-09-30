<?php

/**
 * Description of User
 *
 * @author Suharshana DsW
 * @web www.nysc.lk
 */
class PracticalPapers
{

    public $id;
    public $course_id;
    public $title;
    public $pdf_doc;
    public $year;
    public $batch;
    public $datetime_fp; 
    public $active;
    public $queue;

    public function __construct($id)
    {

        if ($id) {

            $query = "SELECT * FROM `practical_papers` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->course_id = $result['course_id'];
            $this->title = $result['title'];
            $this->pdf_doc = $result['pdf_doc'];
            $this->year = $result['year'];
            $this->batch = $result['batch'];
            $this->datetime_fp = $result['datetime_fp']; 
            $this->queue = $result['queue'];
            $this->active = $result['active'];

            

            return $result;
        }
    }

    public function create()
    {

        $query = "INSERT INTO `practical_papers` (`course_id`,`datetime_fp`,`title`,`pdf_doc`, `year`, `batch`) VALUES  ('"
            . $this->course_id . "','"
            . $this->datetime_fp . "','"
            . $this->title . "','" 
            . $this->pdf_doc . "','"
            . $this->year . "','"
            . $this->batch . "')";
            
             
            

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
        $query = "SELECT * FROM `practical_papers`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    // ── TOGGLE ACTIVE ────────────────────────────────   // ← ADD
    public function toggleActive($active)
    {
        $query = "UPDATE `practical_papers` SET `active` = " . intval($active) . " WHERE `id` = " . $this->id;
        $db = new Database();
        return $db->readQuery($query);
    }

    // ── GET BY ID ────────────────────────────────────   // ← ADD
    public function getById($id)
    {
        $query = "SELECT * FROM `practical_papers` WHERE `id` = " . intval($id) . " LIMIT 1";
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result ? $result : null;
    }
    public function delete()
    {
        $query = 'DELETE FROM `practical_papers` WHERE id="' . $this->id . '"';
        $db = new Database();
        return $db->readQuery($query);
    }
    
    
    public static function getPaperByCourse($course_id)
    {

        $query = "SELECT * FROM `practical_papers` WHERE `course_id` = '" . $course_id . "' ORDER BY `id` DESC LIMIT 1";
        $db = new Database();

        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }
    public static function getPapersByCourse($course_id)
    {

        $query = "SELECT * FROM `practical_papers` WHERE `course_id` = '" . $course_id . "' ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    public static function getAvailablePapersByCourse($course_id)
    {

        $query = "SELECT * FROM `practical_papers` WHERE `course_id` = '" . $course_id . "' and `active` = 1 ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
}
