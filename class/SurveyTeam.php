<?php

class SurveyTeam {

    public $id;
    public $full_name_1;
    public $full_name_2;
    public $whatsapp_number;
    public $nic;
    public $nic_2;
    public $address;
    public $address_2;
    public $mobile_number;
    public $mobile_number_2;
    public $province_id;
    public $district_id;
    public $divisional_id;
    public $gn_id;
    public $email;
    public $email_2;
    public $birth_date;
    public $birth_date_2;
    public $status;
    public $apply_date;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT  * FROM `survey_team` WHERE `id`=" . $id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];

            $this->full_name_1 = $result['full_name_1'];
            $this->full_name_2 = $result['full_name_2'];
            $this->whatsapp_number = $result['whatsapp_number'];
            $this->whatsapp_number_2 = $result['whatsapp_number_2'];
            $this->nic = $result['nic'];
            $this->nic_2 = $result['nic_2'];
            $this->address = $result['address'];
            $this->address_2 = $result['address_2'];
            $this->mobile_number = $result['mobile_number'];
            $this->mobile_number_2 = $result['mobile_number_2'];
            $this->province_id = $result['province_id'];
            $this->district_id = $result['district_id'];
            $this->divisional_id = $result['divisional_id'];
            $this->gn_id = $result['gn_id'];
             $this->email = $result['email'];
            $this->email_2 = $result['email_2'];
            $this->birth_date = $result['birth_date'];
            $this->birth_date_2 = $result['birth_date_2'];
            $this->status = $result['status'];
            $this->apply_date = $result['apply_date'];
        }
    }

    public function create() {

        date_default_timezone_set('Asia/Colombo');
        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `survey_team` (`full_name_1`,`full_name_2`,`whatsapp_number`,`whatsapp_number_2`,`nic`,`nic_2`,`address`,`address_2`,`mobile_number`,`mobile_number_2`,`province_id`,`district_id`,`divisional_id`,`gn_id`,`email`,`email_2`,`birth_date`,`birth_date_2`,`apply_date`) VALUES  ('"
                . $this->full_name_1 . "', '"
                . $this->full_name_2 . "', '"
                . $this->whatsapp_number . "', '"
                . $this->whatsapp_number_2 . "', '"
                . $this->nic . "', '"
                . $this->nic_2 . "', '"
                . $this->address . "', '"
                . $this->address_2 . "', '"
                . $this->mobile_number . "', '"
                . $this->mobile_number_2 . "', '"
                . $this->province_id . "', '"
                . $this->district_id . "', '"
                . $this->divisional_id . "', '"
                . $this->gn_id . "', '" 
                . $this->email . "', '" 
                . $this->email_2 . "', '" 
                . $this->birth_date . "', '"
                . $this->birth_date_2 . "', '"
                . $createdAt . "')";
 
        
        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update() {

        $query = "UPDATE  `survey_team` SET "
                . "`address` ='" . $this->address . "', "
                . "`mobile_number` ='" . $this->mobile_number . "', "
                . "`whatsapp_number` ='" . $this->whatsapp_number . "', "
                . "`email` ='" . $this->email . "', "
                . "`gn_id` ='" . $this->gn_id . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->centercode);
        } else {
            return FALSE;
        }
    }

    public function updateStatus() {

        $query = "UPDATE  `survey_team` SET "
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
    
     public function getApplicaionByDistrict($id) {

        $query = "SELECT count(`id`) as count_ds_no FROM `survey_team` WHERE `district_id` = '" . $id . "'  ";
        
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_ds_no'];
    }
    

    public function all() {
        $query = "SELECT * FROM `survey_team` ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public static function getApplicationsByCourseRequest($id) {

        $query = "SELECT * FROM `survey_team` WHERE `request_course_id` = '" . $id . "' AND `status` =0 ";


        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }


 public function getApplicaionByDs($id) {

        $query = "SELECT count(`id`) as count_ds_no FROM `survey_team` WHERE `divisional_id` = '" . $id . "'  ";
        
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_ds_no'];
    }
    
     public function getApplicaionByGn($id) {

        $query = "SELECT count(`id`) as count_ds_no FROM `survey_team` WHERE `gn_id` = '" . $id . "'  ";
        
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_ds_no'];
    }
    
    
    
    public function delete() {
        $query = 'DELETE FROM `survey_team` WHERE centercode="' . $this->centercode . '"';
        $db = new Database();
        return $db->readQuery($query);
    }

    public static function getApplicationsCountByYearAndBatch($year, $batch) {

        $query = "SELECT count(`id`) as 'count_survey_team' FROM `survey_team` WHERE `request_course_id` IN (SELECT `id` FROM `course_request` WHERE `year` = $year AND `batch` = $batch)";


        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_survey_team'];
    }

    public static function getApplicationsCountByCenterYearAndBatch($center, $year, $batch) {

        $query = "SELECT count(`id`) as 'count_survey_team' FROM `survey_team` WHERE `request_course_id` IN (SELECT `id` FROM `course_request` WHERE `year` = $year AND `batch` = $batch AND `center_id` = $center)";
        // $query = "SELECT count(`id`) as 'count_survey_team' FROM `survey_team` WHERE `request_course_id` IN (SELECT `id` FROM `course_request` WHERE `year` = $year AND `batch` = $batch AND `center_id` = $center) AND `status` =0";


        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_survey_team'];
    }

    public static function getApplicationsCountByTypeCenterYearAndBatch($center, $type, $year, $batch) {

        $query = "SELECT count(`id`) as 'count_survey_team' FROM `survey_team` WHERE `request_course_id` IN (SELECT `id` FROM `course_request` WHERE `year` = $year AND `batch` = $batch AND `center_id` = $center AND `course_id` IN (SELECT `courseid` FROM `course` WHERE `fullpart` = $type))";
        // $query = "SELECT count(`id`) as 'count_survey_team' FROM `survey_team` WHERE `request_course_id` IN (SELECT `id` FROM `course_request` WHERE `year` = $year AND `batch` = $batch AND `center_id` = $center AND `course_id` IN (SELECT `courseid` FROM `course` WHERE `fullpart` = $type)) AND `status` =0 ";


        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_survey_team'];
    }

}
