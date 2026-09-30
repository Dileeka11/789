<?php

/**
 * Description of OtherDocumentDivision
 *
 * @author Kavini Nisansala
 * @web www.nysc.lk
 */
class OtherDocumentDivision
{

    public $id;
    public $document_id;
    public $division_id;
    public $current_position_id;
    public $current_status;
    public $status_updated_at;

    public function __construct($id)
    {

        if ($id) {

            $query = "SELECT * FROM `other_document_divisions` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->document_id = $result['document_id'];
            $this->division_id = $result['division_id'];
            $this->current_position_id = $result['current_position_id'];
            $this->current_status = $result['current_status'];
            $this->status_updated_at = $result['status_updated_at'];

            return $result;
        }
    }

    public function create()
    {

        date_default_timezone_set('Asia/Colombo');
        $date = date('Y-m-d H:i:s');
        $db = new Database();
        $query = "INSERT INTO `other_document_divisions` (`document_id`,`division_id`,`current_position_id`,`current_status`,`status_updated_at`) VALUES  ('"
            . $this->document_id . "','"
            . $this->division_id . "','"
            . $this->current_position_id . "','"
            . $this->current_status . "', '"
            . $date . "')";

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

    public function all()
    {
        $query = "SELECT * FROM `other_document_divisions`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function updateStatus()
    {

        $query = "UPDATE  `other_document_divisions` SET "
            . "`current_position_id` ='" . $this->current_position_id . "', "
            . "`current_status` ='" . $this->current_status . "', "
            . "`status_updated_at` ='" . $this->status_updated_at . "' "
            . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public static function getOtherDivisionsByDocumentId($id)
    {
        $query = "SELECT * FROM `other_document_divisions` WHERE `document_id` = $id ORDER BY `id` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    public static function getCurrentUserByDivision($id, $division, $position)
    {
        $query = "SELECT * FROM `other_document_divisions` WHERE `document_id` = $id AND `division_id` = $division AND `current_position_id` = $position";
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }

    public static function getDocumentByDivision($id)
    {
        $query = "SELECT * FROM `other_document_divisions` WHERE `current_status` = $id OR `receiver_division_id` = $id ORDER BY `submit_date` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
}
