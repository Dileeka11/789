<?php

/**
 * Description of ApplicationDocumentation
 *
 * @author Kavini Nisansala
 * @web www.nysc.lk
 */
class Courseok {

    public $serialnumber;
    public $courseid;
    public $yearp;
    public $batch;
    public $centerid;

    public function __construct($serialnumber) {

        if ($serialnumber) {

            $query = "SELECT * FROM `courseok` WHERE `serialnumber`=" . $serialnumber;

            $db = new Database();

            $result = mysqli_fetch_array($db->readQuery($query));

            $this->serialnumber = $result['serialnumber'];
            $this->courseid = $result['courseid'];
            $this->yearp = $result['yearp'];
            $this->batch = $result['batch'];
            $this->centerid = $result['centerid'];

            return $result;
        }
    }

    public function create() {
        date_default_timezone_set('Asia/Colombo');
        $centerid = date('Y-m-d H:i:s');
        $query = "INSERT INTO `courseok` (`courseid`,`yearp`,`batch`,`centerid`,`status`) VALUES  ('"
                . $this->courseid . "','"
                . $this->yearp . "','"
                . $this->batch . "','"
                . $centerid . "', '"
                . $this->status . "')";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return mysqli_insert_serialnumber($db->DB_CON);
        } else {
            return FALSE;
        }
    }

    public function all() {
        $query = "SELECT * FROM `courseok`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function update() {
        $query = "UPDATE  `courseok` SET "
                . "`courseid` ='" . $this->courseid . "', "
                . "`yearp` ='" . $this->yearp . "', "
                . "`batch` ='" . $this->batch . "', "
                . "`status` ='" . $this->status . "' "
                . "WHERE `serialnumber` = '" . $this->serialnumber . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->serialnumber);
        } else {
            return FALSE;
        }
    }

    public static function getSeialNumber($id) {
        $query = "SELECT `serialnumber` FROM `courseok` WHERE `courseid` = '" . $id . "'";
           var_dump($query);
        exit();
        $db = new Database();
        $result = mysqli_fetch_row($db->readQuery($query));
      
        return $result;
    }

}
