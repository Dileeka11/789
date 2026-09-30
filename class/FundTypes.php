<?php

/**
 * Description of Comments
 *
 * @author Suharshana DsW
 */
class FundTypes {

    public $id;
    public $type;
    public $queue;

    // Constructor to load data by id
    public function __construct($id) {
        if ($id) {
            $query = "SELECT `id`, `type`, `queue` FROM `fund_type` WHERE `id` = " . $id;

            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->type = $result['type'];
            $this->queue = $result['queue'];

            return $this;
        }
    }

    // Create a new fund type
    public function create() {
        $query = "INSERT INTO `fund_type` (`type`) VALUES ('" . $this->type . "')";

        $db = new Database();
        $result = $db->readQuery($query);

        return $result ? true : false;
    }

    // Get all fund types
    public function all() {
        $query = "SELECT `id`, `type`, `queue` FROM `fund_type` ORDER BY `type` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    // Get fund types by queue
    public static function getFundTypeByQueue($queue) {
        $query = "SELECT `id`, `type`, `queue` FROM `fund_type` WHERE `queue` = '" . $queue . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    // Update fund type details
    public function update() {
        $query = "UPDATE `fund_type` SET "
                . "`type` ='" . $this->type . "'"
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        $result = $db->readQuery($query);

        return $result ? $this->__construct($this->id) : false;
    }

    // Delete a fund type
    public function delete() {
        $query = 'DELETE FROM `fund_type` WHERE id="' . $this->id . '"';

        $db = new Database();
        return $db->readQuery($query);
    }

    // Arrange fund types by queue
    public function arrange($key, $img) {
        $query = "UPDATE `fund_type` SET `queue` = '" . $key . "' WHERE id = '" . $img . "'";

        $db = new Database();
        return $db->readQuery($query);
    }

}
