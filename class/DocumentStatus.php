<?php

/**
 * Description of DocumentStatus
 *
 * @author Kavini Nisansala
 * @web www.nysc.lk
 */
class DocumentStatus
{

    public $id;
    public $document_id;
    public $sender_division_id;
    public $sender_position_id;
    public $sender_user_id;
    public $receiver_division_id;
    public $receiver_position_id;
    public $file_name;
    public $status;
    public $updated_at;
    public $reason;

    public function __construct($id)
    {

        if ($id) {

            $query = "SELECT * FROM `document_status` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->document_id = $result['document_id'];
            $this->sender_division_id = $result['sender_division_id'];
            $this->sender_position_id = $result['sender_position_id'];
            $this->sender_user_id = $result['sender_user_id'];
            $this->receiver_division_id = $result['receiver_division_id'];
            $this->receiver_position_id = $result['receiver_position_id'];
            $this->file_name = $result['file_name'];
            $this->status = $result['status'];
            $this->updated_at = $result['updated_at'];
            $this->reason = $result['reason'];

            return $result;
        }
    }

    public function create()
    {

        date_default_timezone_set('Asia/Colombo');
        $updated_at = date('Y-m-d H:i:s');
        $db = new Database();
        $query = "INSERT INTO `document_status` (`document_id`,`sender_division_id`,`sender_position_id`,`sender_user_id`,`receiver_division_id`,`receiver_position_id`,`file_name`,`status`,`updated_at`,`reason`) VALUES  ('"
            . $this->document_id . "','"
            . $this->sender_division_id . "','"
            . $this->sender_position_id . "','"
            . $this->sender_user_id . "','"
            . $this->receiver_division_id . "','"
            . $this->receiver_position_id . "','"
            . $this->file_name . "','"
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

    public function all()
    {
        $query = "SELECT * FROM `document_status`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    public static function getDocumentStatusByDocumentId($id)
    {
        $query = "SELECT * FROM `document_status` WHERE `document_id` = $id ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    public static function getDocumentStatusDetails($id, $division_id, $position_id)
    {
        $query = "SELECT * FROM `document_status` WHERE `document_id` = $id AND `receiver_division_id`=$division_id AND `receiver_position_id` = $position_id AND `sender_position_id` < $position_id ORDER BY `id` DESC LIMIT 1";
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }
    public static function getLatestDocumentStatusByDivision($division_id, $position_id)
    {
        $query = "SELECT `document_id` FROM `document_status` WHERE `receiver_division_id`=$division_id AND `receiver_position_id` >= $position_id GROUP BY `document_id`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row['document_id']);
        }
        return $array_res;
    }
}
