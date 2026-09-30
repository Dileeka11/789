<?php

class CourseTrade {

    public $id;
    public $trade_name;
    public $trade_code;
    public $queue;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT  * FROM `course_trade` WHERE `id`=" . $id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->trade_name = $result['trade_name'];
            $this->trade_code = $result['trade_code'];
            $this->queue = $result['queue'];
        }
    }

    public function create() {

        $query = "INSERT INTO `course_trade` (`trade_name`,`trade_code`) VALUES  ('"
                . $this->trade_name . "', '"
                . $this->trade_code . "')";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update() {

        $query = "UPDATE  `course_trade` SET "
                . "`trade_name` ='" . $this->trade_name . "', "
                . "`trade_code` ='" . $this->trade_code . "' "
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
        $query = "SELECT * FROM `course_trade` ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function delete() {
        $query = 'DELETE FROM `course_trade` WHERE id="' . $this->id . '"';
        $db = new Database();
        return $db->readQuery($query);
    }

}
