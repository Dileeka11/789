<?php

class DivisionPositions
{

    public $id;
    public $position_id;
    public $division_id;
    public $name;
    public $email;
    public $phone_number;
    public $status;
    public $start_date;
    public $end_time;
    public $queue;

    public function __construct($id)
    {
        if ($id) {

            $query = "SELECT  * FROM `division_with_positions` WHERE `id`=" . $id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->position_id = $result['position_id'];
            $this->division_id = $result['division_id'];
            $this->name = $result['name'];
            $this->email = $result['email'];
            $this->phone_number = $result['phone_number'];
            $this->status = $result['status'];
            $this->start_date = $result['start_date'];
            $this->end_time = $result['end_time'];
            $this->queue = $result['queue'];
        }
    }

    public function create()
    {

        $query = "INSERT INTO `division_with_positions` (`position_id`,`division_id`,`name`,`email`,`start_date`,`phone_number`) VALUES  ('"
            . $this->position_id . "', '"
            . $this->division_id . "', '"
            . $this->name . "', '"
            . $this->email . "', '"
            . $this->start_date . "', '"
            . $this->phone_number . "')";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function getPositionByDivision($id)
    {

        $query = "SELECT * FROM `division_with_positions` WHERE `division_id` = '" . $id . "' AND `status` = 0";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    public static function getHigherPositionsByCurrentUserofDivision($id, $position_id)
    {

        $query = "SELECT * FROM `division_with_positions` WHERE `division_id` = '" . $id . "' AND `status` = 0 AND `position_id` > $position_id ORDER bY `position_id` ASC";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public static function getPositionNameByDivision($id)
    {

        $query = "SELECT positions.name,division_with_positions.id FROM `division_with_positions` INNER JOIN positions ON positions.id = division_with_positions.position_id WHERE `division_id` = '" . $id . "' AND `division_with_positions.status` = 0   ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    public static function getPositionByDivisionByStatus($id)
    {

        $query = "SELECT * FROM `division_with_positions` WHERE `division_id` = '" . $id . "'   ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    public static function getNextPositionIdOfDivision($id, $position)
    {

        $query = "SELECT `position_id` FROM `division_with_positions` WHERE `division_id` = '" . $id . "' AND `position_id` > $position AND `status`=0 ORDER BY `position_id` ASC LIMIT 1";

        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        if($result) {
            return $result['position_id'];
        } else {
            return '';
        }
    }
    public static function getPrevPositionIdOfDivision($id, $position)
    {

        $query = "SELECT `position_id` FROM `division_with_positions` WHERE `division_id` = '" . $id . "' AND `position_id` < $position AND `status`=0 ORDER BY `position_id` DESC LIMIT 1";
        // dd($query);
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        if($result) {
            return $result['position_id'];
        } else {
            return '';
        }
    }

    public function update()
    {

        $query = "UPDATE  `division_with_positions` SET "
            . "`position_id` ='" . $this->position_id . "', "
            . "`name` ='" . $this->name . "', "
            . "`start_date` ='" . $this->start_date . "', "
            . "`email` ='" . $this->email . "', "
            . "`phone_number` ='" . $this->phone_number . "' "
            . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function updatePositionHold()
    {

        $query = "UPDATE  `division_with_positions` SET "
            . "`end_time` ='" . $this->end_time . "', "
            . "`status` ='" . $this->status . "' "
            . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }


    public function all()
    {
        $query = "SELECT * FROM `division_with_positions` ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function delete()
    {
        $query = 'DELETE FROM `division_with_positions` WHERE id="' . $this->id . '"';
        $db = new Database();
        return $db->readQuery($query);
    }
}
