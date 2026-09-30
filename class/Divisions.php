<?php

class Divisions {

    public $id;
    public $name;
    public $queue; 

    public function __construct($id) {
        if ($id) {

            $query = "SELECT  * FROM `divisions` WHERE `id`=" . $id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->queue = $result['queue']; 
        }
    }

    public function create() {

        $query = "INSERT INTO `divisions` (`name`) VALUES  ('"
                . $this->name . "')";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update() {

        $query = "UPDATE  `divisions` SET "
                . "`name` ='" . $this->name . "' "
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
        $query = "SELECT * FROM `divisions` ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function delete() {
        $query = 'DELETE FROM `divisions` WHERE id="' . $this->id . '"';
        $db = new Database();
        return $db->readQuery($query);
    }

}
