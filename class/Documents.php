<?php

/**
 * Description of Documents
 *
 * @author Kavini Nisansala
 * @web www.nysc.lk
 */
class Documents
{

    public $id;
    public $type;
    public $title;
    public $document;
    public $minit;
    public $sender_division_id;
    public $sender_position_id;
    public $receiver_division_id;
    public $receiver_position_id;
    public $submit_date;
    public $current_position;
    public $current_status;
    public $status_updated_at;

    public function __construct($id)
    {

        if ($id) {

            $query = "SELECT * FROM `documents` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->type = $result['type'];
            $this->title = $result['title'];
            $this->document = $result['document'];
            $this->minit = $result['minit'];
            $this->submit_date = $result['submit_date'];
            $this->sender_division_id = $result['sender_division_id'];
            $this->sender_position_id = $result['sender_position_id'];
            $this->receiver_division_id = $result['receiver_division_id'];
            $this->receiver_position_id = $result['receiver_position_id'];
            $this->current_position = $result['current_position'];
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
        $query = "INSERT INTO `documents` (`type`,`title`,`document`,`submit_date`,`sender_division_id`,`sender_position_id`,`receiver_division_id`,`receiver_position_id`,`current_position`,`current_status`,`status_updated_at`,`minit`) VALUES  ('"
            . $this->type . "','"
            . $this->title . "','"
            . $this->document . "','"
            . $date . "', '"
            . $this->sender_division_id . "', '"
            . $this->sender_position_id . "', '"
            . $this->receiver_division_id . "', '"
            . $this->receiver_position_id . "', '"
            . $this->current_position . "', '"
            . $this->current_status . "', '"
            . $date . "', '"
            . mysqli_real_escape_string($db->DB_CON, $this->minit) . "')";

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
        $query = "SELECT * FROM `documents`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    public function getDocumentsByIds($ids)
    {
        $query = "SELECT * FROM `documents` WHERE `id` IN ($ids)";
        dd($query);
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

        $query = "UPDATE  `documents` SET "
            . "`current_position` ='" . $this->current_position . "', "
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
    public function reApplyDocument()
    {

        $query = "UPDATE  `documents` SET "
            . "`current_position` ='" . $this->current_position . "', "
            . "`current_status` ='" . $this->current_status . "', "
            . "`status_updated_at` ='" . $this->status_updated_at . "', "
            . "`document` ='" . $this->document . "' "
            . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public static function getStatusByAppId($id)
    {
        $query = "SELECT * FROM `documents` WHERE `type` = $id ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public static function getDocumentByDivision($id)
    {
        $query = "SELECT * FROM `documents` WHERE `sender_division_id` = $id OR `receiver_division_id` = $id ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    public static function getSentDocumentsIds($devision, $position)
    {
        $query = "SELECT `id` FROM `documents` WHERE `sender_division_id` = $devision AND `sender_position_id` = $position ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row['id']);
        }
        return $array_res;
    }
}
