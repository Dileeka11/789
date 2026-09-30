<?php

/**
 * Description of User
 *
 * @author Suharshana DsW
 * @web www.nysc.lk
 */
class WrittingPapers
{

    public $id;
    public $course_id;
    public $title;
    public $pdf_doc;
    public $pdf_doc_sinhala;
    public $pdf_doc_tamil;
    public $queue;

    public function __construct($id)
    {

        if ($id) {

            $query = "SELECT * FROM `writting_papers` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->course_id = $result['course_id'];
            $this->title = $result['title'];
            $this->pdf_doc = $result['pdf_doc'];
            $this->pdf_doc_sinhala = $result['pdf_doc_sinhala'];
            $this->pdf_doc_tamil = $result['pdf_doc_tamil'];
            $this->queue = $result['queue'];

            return $result;
        }
    }

    public function create()
    {

        $query = "INSERT INTO `writting_papers` (`course_id`,`title`,`pdf_doc`, `pdf_doc_sinhala`, `pdf_doc_tamil`) VALUES  ('"
            . $this->course_id . "','"
            . $this->title . "','"
            . $this->pdf_doc . "','"
            . $this->pdf_doc_sinhala . "','"
            . $this->pdf_doc_tamil . "')";

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
        $query = "SELECT * FROM `writting_papers`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function delete()
    {
        $query = 'DELETE FROM `writting_papers` WHERE id="' . $this->id . '"';
        $db = new Database();
        return $db->readQuery($query);
    }
    public static function getPaperByCourse($course_id)
    {

        $query = "SELECT * FROM `writting_papers` WHERE `course_id` = '" . $course_id . "' ORDER BY `id` DESC LIMIT 1";
        $db = new Database();

        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }
    public static function getPapersByCourse($course_id)
    {

        $query = "SELECT * FROM `writting_papers` WHERE `course_id` = '" . $course_id . "' ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
}
