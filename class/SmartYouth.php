<?php

class SmartYouth {

    public $id;
    public $request_course_id;
    public $center_id;
    public $full_name;
    public $whatsapp_number;
    public $nic;
    public $address;
    public $mobile_number;
    public $province_id;
    public $district_id;
    public $divisional_id;
    public $gn_id;
    public $education_level;
    public $email;
    public $gender;
    public $birth_date;
    public $still_member;
    public $apply_date;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT  * FROM `smart_youth_members` WHERE `id`=" . $id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];

            $this->request_course_id = $result['request_course_id'];
            $this->center_id = $result['center_id'];
            $this->full_name = $result['full_name'];
            $this->whatsapp_number = $result['whatsapp_number'];
            $this->nic = $result['nic'];
            $this->address = $result['address'];
            $this->mobile_number = $result['mobile_number'];
            $this->province_id = $result['province_id'];
            $this->district_id = $result['district_id'];
            $this->divisional_id = $result['divisional_id'];
            $this->gn_id = $result['gn_id'];
            $this->education_level = $result['education_level'];
            $this->email = $result['email'];
            $this->gender = $result['gender'];
            $this->birth_date = $result['birth_date'];
            $this->still_member = $result['still_member'];
            $this->apply_date = $result['apply_date'];
        }
    }

    public function create() {

        date_default_timezone_set('Asia/Colombo');
        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `smart_youth_members` (`full_name`,`birth_date`,`mobile_number`,`email`,`address`,`province_id`,`district_id`,`divisional_id`,`gn_id`,`still_member`,`apply_date`) VALUES  ('"
                . $this->full_name . "', '"
                . $this->birth_date . "', '"
                . $this->mobile_number . "', '"
                . $this->email . "', '"
                . $this->address . "', '"
                . $this->province_id . "', '"
                . $this->district_id . "', '"
                . $this->divisional_id . "', '"
                . $this->gn_id . "', '" 
                . $this->still_member . "', '"
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

        $query = "UPDATE  `smart_youth_members` SET "
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

        $query = "UPDATE  `smart_youth_members` SET "
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

    public function all() {
        $query = "SELECT * FROM `smart_youth_members` ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public static function getsmart_youth_membersByCourseRequest($id) {

        $query = "SELECT * FROM `smart_youth_members` WHERE `request_course_id` = '" . $id . "' AND `status` =0 ";
     
        
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }


    public static function getsmart_youth_membersByCenter($id) {

        $year = date("Y");
      
        $query = "SELECT count(smart_youth_members.id) as 'count_smart_youth_members' FROM `smart_youth_members` INNER JOIN course_request ON course_request.id=smart_youth_members.request_course_id WHERE smart_youth_members.center_id =$id AND course_request.year = $year ";

     
     
        
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_smart_youth_members'];
    }
    
    
    public static function getsmart_youth_membersByCenterThisYear() {

        $year = date("Y");
      
        $query = "SELECT count(smart_youth_members.id) as 'count_smart_youth_members' FROM `smart_youth_members` INNER JOIN course_request ON course_request.id=smart_youth_members.request_course_id WHERE  course_request.year = $year ";

     
     
        
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_smart_youth_members'];
    }
    
    
      public static function getsmart_youth_membersByyearCenterAndBatchVise($year,$batch,$center) {

        
      
        $query = "SELECT DISTINCT(course.cname) as `course_name`,course.* FROM `smart_youth_members` JOIN course_request on smart_youth_members.request_course_id = course_request.id left JOIN course on course.courseid = course_request.course_id WHERE smart_youth_members.center_id = $center AND course_request.year = 2024 AND course_request.batch =1 ";
   
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    
    public function delete() {
        $query = 'DELETE FROM `smart_youth_members` WHERE centercode="' . $this->centercode . '"';
        $db = new Database();
        return $db->readQuery($query);
    }

    public static function getsmart_youth_membersCountByYearAndBatch($year, $batch) {

        $query = "SELECT count(`id`) as 'count_smart_youth_members' FROM `smart_youth_members` WHERE `request_course_id` IN (SELECT `id` FROM `course_request` WHERE `year` = $year AND `batch` = $batch)";
     
        
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_smart_youth_members'];
    }
    public static function getsmart_youth_membersCountByCenterYearAndBatch($center, $year, $batch) {

        $query = "SELECT count(`id`) as 'count_smart_youth_members' FROM `smart_youth_members` WHERE `request_course_id` IN (SELECT `id` FROM `course_request` WHERE `year` = $year AND `batch` = $batch AND `center_id` = $center)";
        // $query = "SELECT count(`id`) as 'count_smart_youth_members' FROM `smart_youth_members` WHERE `request_course_id` IN (SELECT `id` FROM `course_request` WHERE `year` = $year AND `batch` = $batch AND `center_id` = $center) AND `status` =0";
     
        
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_smart_youth_members'];
    }
    public static function getsmart_youth_membersCountByTypeCenterYearAndBatch($center, $type, $year, $batch) {

        $query = "SELECT count(`id`) as 'count_smart_youth_members' FROM `smart_youth_members` WHERE `request_course_id` IN (SELECT `id` FROM `course_request` WHERE `year` = $year AND `batch` = $batch AND `center_id` = $center AND `course_id` IN (SELECT `courseid` FROM `course` WHERE `fullpart` = $type))";
        // $query = "SELECT count(`id`) as 'count_smart_youth_members' FROM `smart_youth_members` WHERE `request_course_id` IN (SELECT `id` FROM `course_request` WHERE `year` = $year AND `batch` = $batch AND `center_id` = $center AND `course_id` IN (SELECT `courseid` FROM `course` WHERE `fullpart` = $type)) AND `status` =0 ";
     
        
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_smart_youth_members'];
    }

}
