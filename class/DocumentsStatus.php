<?php

/**
 * Description of ApplicationStatus
 *
 * @author Kavini Nisansala
 * @web www.nysc.lk
 */
class DocumentsStatus {

    public $id;
    public $document_id;
    public $division_id;
    public $position_id;
    public $status;
    public $updated_at;
    public $reason;

    public function __construct($id) {

        if ($id) {

            $query = "SELECT * FROM `document_status` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->document_id = $result['document_id'];
            $this->division_id = $result['division_id'];
            $this->position_id = $result['position_id'];
            $this->status = $result['status'];
            $this->updated_at = $result['updated_at'];
            $this->reason = $result['reason'];

            return $result;
        }
    }

    public function create() {

        date_default_timezone_set('Asia/Colombo');
        $updated_at = date('Y-m-d H:i:s');
        $db = new Database();
        $query = "INSERT INTO `document_status` (`document_id`,`division_id`,`position_id`,`send_position`,`status`,`updated_at`,`reason`) VALUES  ('"
                . $this->document_id . "','"
                . $this->division_id . "','"
                . $this->position_id . "','"
                . $this->send_position . "','"
                . $this->status . "', '"
                . $updated_at . "', '"
                . mysqli_real_escape_string($db->DB_CON, $this->reason) . "')";
        
        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return mysqli_insert_id($db->DB_CON);
        } else {
            return FALSE;
        }
    }

    public function all() {
        $query = "SELECT * FROM `document_status`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    public static function getStatusByAppId($id) {
        $query = "SELECT * FROM `document_status` WHERE `document_id` = $id ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

}
