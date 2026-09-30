<?php

/**
 * Description of LeagueTypes
 *
 * @author Suharshana DsW
 */
class LeagueTypes {

    public $id;
    public $name;
    public $queue;

    // Constructor to load data by id
    public function __construct($id = NULL) {
        if ($id) {
            $query = "SELECT `id`, `name`, `queue` FROM `league_types` WHERE `id` = " . $id;

            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->queue = $result['queue'];

            return $this;
        }
    }

    // Create a new league type
    public function create() {
        $query = "INSERT INTO `league_types` (`name`, `queue`) VALUES ('" . $this->name . "', '" . $this->queue . "')";

        $db = new Database();
        $result = $db->readQuery($query);

        return $result ? true : false;
    }

    // Get all league types
    public function all() {
        $query = "SELECT `id`, `name`, `queue` FROM `league_types` ORDER BY `queue`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    // Get league types by queue
    public static function getLeagueTypeByQueue($queue) {
        $query = "SELECT `id`, `name`, `queue` FROM `league_types` WHERE `queue` = '" . $queue . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    // Update league type details
    public function update() {
        $query = "UPDATE `league_types` SET "
                . "`name` ='" . $this->name . "', "
                . "`queue` ='" . $this->queue . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        $result = $db->readQuery($query);

        return $result ? $this->__construct($this->id) : false;
    }

    // Delete a league type
    public function delete() {
        $query = 'DELETE FROM `league_types` WHERE id="' . $this->id . '"';

        $db = new Database();
        return $db->readQuery($query);
    }

    // Arrange league types by queue
    public function arrange($key, $img) {
        $query = "UPDATE `league_types` SET `queue` = '" . $key . "' WHERE id = '" . $img . "'";

        $db = new Database();
        return $db->readQuery($query);
    }
}
