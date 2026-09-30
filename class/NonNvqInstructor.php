<?php

/**
 * Non NVQ Course - Instructor Details
 *
 * Handles CRUD for the `non_nvq_course_instructor` table.
 * @web www.nysc.lk
 * */
class NonNvqInstructor {

    public $id;
    public $centercode;
    public $course_name;
    public $instructor_name;
    public $instructor_tel;
    public $service_details;
    public $start_date;
    public $end_date;
    public $status;
    public $created_at;

    public function __construct($id) {
        if ($id) {
            $db = new Database();
            $id = (int) $id;
            $query = "SELECT * FROM `non_nvq_course_instructor` WHERE `id` = " . $id;
            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->centercode = $result['centercode'];
            $this->course_name = $result['course_name'];
            $this->instructor_name = $result['instructor_name'];
            $this->instructor_tel = $result['instructor_tel'];
            $this->service_details = $result['service_details'];
            $this->start_date = $result['start_date'];
            $this->end_date = $result['end_date'];
            $this->status = $result['status'];
            $this->created_at = $result['created_at'];
        }
    }

    public function create() {
        $db = new Database();
        $con = $db->DB_CON;

        $centercode = mysqli_real_escape_string($con, $this->centercode);
        $course_name = mysqli_real_escape_string($con, $this->course_name);
        $instructor_name = mysqli_real_escape_string($con, $this->instructor_name);
        $instructor_tel = mysqli_real_escape_string($con, $this->instructor_tel);
        $service_details = mysqli_real_escape_string($con, $this->service_details);
        $start_date = mysqli_real_escape_string($con, $this->start_date);
        $end_date = mysqli_real_escape_string($con, $this->end_date);
        $status = (int) $this->status;

        $query = "INSERT INTO `non_nvq_course_instructor` "
                . "(`centercode`,`course_name`,`instructor_name`,`instructor_tel`,`service_details`,`start_date`,`end_date`,`status`) "
                . "VALUES ('" . $centercode . "','" . $course_name . "','" . $instructor_name . "','"
                . $instructor_tel . "','" . $service_details . "',"
                . ($start_date === '' ? "NULL" : "'" . $start_date . "'") . ","
                . ($end_date === '' ? "NULL" : "'" . $end_date . "'") . ","
                . $status . ")";

        return $db->readQuery($query) ? TRUE : FALSE;
    }

    public function update() {
        $db = new Database();
        $con = $db->DB_CON;

        $centercode = mysqli_real_escape_string($con, $this->centercode);
        $course_name = mysqli_real_escape_string($con, $this->course_name);
        $instructor_name = mysqli_real_escape_string($con, $this->instructor_name);
        $instructor_tel = mysqli_real_escape_string($con, $this->instructor_tel);
        $service_details = mysqli_real_escape_string($con, $this->service_details);
        $start_date = mysqli_real_escape_string($con, $this->start_date);
        $end_date = mysqli_real_escape_string($con, $this->end_date);
        $status = (int) $this->status;
        $id = (int) $this->id;

        $query = "UPDATE `non_nvq_course_instructor` SET "
                . "`centercode`='" . $centercode . "', "
                . "`course_name`='" . $course_name . "', "
                . "`instructor_name`='" . $instructor_name . "', "
                . "`instructor_tel`='" . $instructor_tel . "', "
                . "`service_details`='" . $service_details . "', "
                . "`start_date`=" . ($start_date === '' ? "NULL" : "'" . $start_date . "'") . ", "
                . "`end_date`=" . ($end_date === '' ? "NULL" : "'" . $end_date . "'") . ", "
                . "`status`=" . $status . " "
                . "WHERE `id`=" . $id;

        return $db->readQuery($query) ? $this->__construct($id) : FALSE;
    }

    public function updateStatus($status, $id) {
        $db = new Database();
        $status = (int) $status;
        $id = (int) $id;
        $query = "UPDATE `non_nvq_course_instructor` SET `status`=" . $status . " WHERE `id`=" . $id;
        return $db->readQuery($query);
    }

    public function updateEndDate($end_date, $id) {
        $db = new Database();
        $con = $db->DB_CON;
        $end_date = mysqli_real_escape_string($con, $end_date);
        $id = (int) $id;
        $query = "UPDATE `non_nvq_course_instructor` SET `end_date`="
                . ($end_date === '' ? "NULL" : "'" . $end_date . "'")
                . " WHERE `id`=" . $id;
        return $db->readQuery($query);
    }

    public function all() {
        $db = new Database();
        $query = "SELECT * FROM `non_nvq_course_instructor` ORDER BY `id` DESC";
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getByCenter($centercode) {
        $db = new Database();
        $con = $db->DB_CON;
        $centercode = mysqli_real_escape_string($con, $centercode);
        $query = "SELECT * FROM `non_nvq_course_instructor` WHERE `centercode`='" . $centercode . "' ORDER BY `id` DESC";
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function delete() {
        $db = new Database();
        $id = (int) $this->id;
        $query = "DELETE FROM `non_nvq_course_instructor` WHERE `id`=" . $id;
        return $db->readQuery($query);
    }
}
