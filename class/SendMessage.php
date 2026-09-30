<?php

class SendMessage {

    public $id;
    public $user_type;
    public $message;
    public $date_time;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT  * FROM `send_messages` WHERE `id`=" . $id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->user_type = $result['user_type'];
            $this->message = $result['message'];
            $this->date_time = $result['date_time'];
        }
    }

    public function create() {

        $query = "INSERT INTO `send_messages` (`message`,`date_time`) VALUES  ('"
                . $this->message . "', '"
                . $this->date_time . "')";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update() {

        $query = "UPDATE  `send_messages` SET "
                . "`message` ='" . $this->message . "' "
                . "WHERE `id` = '" . $this->id . "'";
 

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function all() {
        $query = "SELECT * FROM `send_messages` ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function delete() {
        $query = 'DELETE FROM `send_messages` WHERE id="' . $this->id . '"';
        $db = new Database();
        return $db->readQuery($query);
    }

}
