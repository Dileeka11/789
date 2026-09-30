<?php

class QuestionType {

    public $id;
    public $type; 

    public function __construct($id) {
        if ($id) {

            $query = "SELECT  * FROM `question-type` WHERE `id`=" . $id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->type = $result['type']; 
        }
    }

    public function create() {

        $query = "INSERT INTO `question-type` (`type`,`title`,`queue`) VALUES  ('"
                . $this->type . "', '"
                . $this->title . "', '"
                . $this->queue . "')";
        
        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update() {

        $query = "UPDATE  `question-type` SET " 
                . "`title` ='" . $this->title . "' "
                . "WHERE `id` = '" . $this->id . "'";
        
        
        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function getSelectedFile($id) {

        $query = "SELECT * FROM `question-type` WHERE `type` = '" . $id . "'  ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function all() {
        $query = "SELECT * FROM `question-type` ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function delete() {
        $query = 'DELETE FROM `question-type ` WHERE id="' . $this->id . '"';
        $db = new Database();
        return $db->readQuery($query);
    }

}
