<?php

/**
 * Description of Application
 *
 * @author Kavini Nisansala
 * @web www.nysc.lk
 */
class ActionPanel
{

    public $id;
    public $year;
    public $batch;
    public $action_name;
    public $status;
    public $status_name;
    public function __construct($id)
    {

        if ($id) {

            $query = "SELECT * FROM `action_panel` WHERE `id`='" . $id . "'";
            $db = new Database();

            $result = mysqli_fetch_array($db->readQuery($query));
             $this->year = $result['year'];
              $this->batch = $result['batch'];
            $this->action_name = $result['action_name'];
            $this->status = $result['status'];
             $this->status_name = $result['status_name'];


            return $result;
        }
    }

    public function create()
    {

        $query = "INSERT INTO `action_panel` (`action_name`,`year`,`batch`,`status`) VALUES  ('"
            . $this->action_name . "', '"
            . $this->year . "', '"
            . $this->batch . "', '"
            . $this->status . "')";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function all()
    {
        $query = "SELECT * FROM `action_panel` ORDER BY `id` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
       public function getWithoutExam()
    {
        $query = "SELECT * FROM `action_panel` WHERE `status_name` != 'exam_result'";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    

    public static function getaction_panelByaction_panelID($action_panel_id)
    {
        $query = "SELECT * FROM `action_panel` WHERE `action_panelid` LIKE '" . $action_panel_id . "'";
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }



    public function update($id)
    {

        $query = "UPDATE  `action_panel` SET "
            . "`status` ='" . $this->status . "' "
            . "WHERE `id` = '" . $id . "'";
 


        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
