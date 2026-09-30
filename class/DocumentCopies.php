<?php

/**
 * Description of DocumentCopies
 *
 * @author Kavini Nisansala
 * @web www.nysc.lk
 */
class DocumentCopies {

    public $id;
    public $document_id;
    public $division_id;

    public function __construct($id) {

        if ($id) {

            $query = "SELECT * FROM `document_copies` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->document_id = $result['document_id'];
            $this->division_id = $result['division_id'];

            return $result;
        }
    }

    public function create() {

        date_default_timezone_set('Asia/Colombo');
        $date = date('Y-m-d H:i:s');
        $db = new Database();
        $query = "INSERT INTO `document_copies` (`document_id`,`division_id`) VALUES  ('"
                . $this->document_id . "','"
                . $this->division_id . "')";
 
//  var_dump($query);
//  exit();
 
        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return mysqli_insert_id($db->DB_CON);
        } else {
            return FALSE;
        }
    }

    public function all() {
        $query = "SELECT * FROM `document_copies`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    public static function getCopiesByDocumentId($id) {
        $query = "SELECT * FROM `document_copies` WHERE `document_id` = $id ORDER BY `id` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    public static function getDocumentIdsByDivisionId($id) {
        $query = "SELECT `document_id` FROM `document_copies` WHERE `division_id` = $id ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row['document_id']);
        }
        return $array_res;
    }
    
      public static function getDocumentByDivision($id) {
        $query = "SELECT * FROM `document_copies` WHERE `submit_division_id` = $id ORDER BY `submit_date` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    

}
