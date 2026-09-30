<?php

class Applications {

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
    public $status;
    public $apply_date;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT  * FROM `applications` WHERE `id`=" . $id;
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
            $this->status = $result['status'];
            $this->apply_date = $result['apply_date'];
        }
    }

    public function create() {

        date_default_timezone_set('Asia/Colombo');
        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `applications` (`request_course_id`,`center_id`,`full_name`,`whatsapp_number`,`nic`,`address`,`mobile_number`,`province_id`,`district_id`,`divisional_id`,`gn_id`,`education_level`,`email`,`gender`,`birth_date`,`apply_date`) VALUES  ('"
                . $this->request_course_id . "', '"
                . $this->center_id . "', '"
                . $this->full_name . "', '"
                . $this->whatsapp_number . "', '"
                . $this->nic . "', '"
                . $this->address . "', '"
                . $this->mobile_number . "', '"
                . $this->province_id . "', '"
                . $this->district_id . "', '"
                . $this->divisional_id . "', '"
                . $this->gn_id . "', '"
                . $this->education_level . "', '"
                . $this->email . "', '"
                . $this->gender . "', '"
                . $this->birth_date . "', '"
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

        $query = "UPDATE  `applications` SET "
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

        $query = "UPDATE  `applications` SET "
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

  public function all($limit = 100, $offset = 0)
{
    $query = "SELECT * FROM `applications` LIMIT $offset, $limit";

    $db = new Database();
    $result = $db->readQuery($query);

    $array_res = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $array_res[] = $row;
    }

    return $array_res;
}


    public static function getApplicationsByCourseRequest($id) {

        $query = "SELECT * FROM `applications` WHERE `request_course_id` = '" . $id . "' AND `status` =0 ";
     
        
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }


    public static function getApplicationsByCenter($id) {

        $year = date("Y");
      
        $query = "SELECT count(applications.id) as 'count_applications' FROM `applications` INNER JOIN course_request ON course_request.id=applications.request_course_id WHERE applications.center_id =$id AND course_request.year = $year ";

     
     
        
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_applications'];
    }
    
    
        public static function getApplicationsByCenterAndCourse($id,$course_id) {

        $year = date("Y");
      
        $query = "SELECT count(applications.id) as 'count_applications' FROM `applications` INNER JOIN course_request ON course_request.id=applications.request_course_id WHERE   applications.center_id =$id AND course_request.year = $year AND  course_request.course_id = '" . $course_id  . "'  ";
 
     
     
        
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_applications'];
    }
    
    public static function getApplicationsByCenterThisYear() {

        $year = date("Y");
      
        $query = "SELECT count(applications.id) as 'count_applications' FROM `applications` INNER JOIN course_request ON course_request.id=applications.request_course_id WHERE  course_request.year = $year ";

     
     
        
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_applications'];
    }
    
       public static function getallApplicationsByCenter($center_id) {

        $year = date("Y");
        $query = "SELECT count(applications.id) as 'count_applications' FROM `applications` INNER JOIN course_request ON course_request.id=applications.request_course_id WHERE  course_request.center_id = $center_id AND  course_request.year = $year ";
 
     
     
        
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_applications'];
    }
    
    
      public static function getApplicationsByyearCenterAndBatchVise($year,$batch,$center) {

        
      
        $query = "SELECT DISTINCT(course.cname) as `course_name`,course.* FROM `applications` JOIN course_request on applications.request_course_id = course_request.id left JOIN course on course.courseid = course_request.course_id WHERE applications.center_id = $center AND course_request.year = 2024 AND course_request.batch =1 ";
   
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    
    public function delete() {
        $query = 'DELETE FROM `applications` WHERE centercode="' . $this->centercode . '"';
        $db = new Database();
        return $db->readQuery($query);
    }
    
    

    public static function getApplicationsCountByYearAndBatch($year, $batch) {

        $query = "SELECT count(`id`) as 'count_applications' FROM `applications` WHERE `request_course_id` IN (SELECT `id` FROM `course_request` WHERE `year` = $year AND `batch` = $batch)";
     
        
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_applications'];
    }
    
    
     public static function getNonNvqApplicationsCountByYear($year) {

      $query = " SELECT COUNT(applications.id) AS 'count_applications'FROM course_request JOIN course ON course.courseid = course_request.course_id JOIN applications ON course_request.id = applications.request_course_id WHERE course.is_favourite = 1 and course_request.year = $year  ";


        
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_applications'];
    }
    
     
//      public static function getNonNvqApplicationsCountByYearBatchType($year,$batch,$type) {


//     $batchCondition = is_null($batch) ? "IS NULL" : "= '$batch'";
//     $typeCondition = is_null($type) ? "IS NULL" : "= '$type'";



//       $query = " SELECT COUNT(applications.id) AS 'count_applications'FROM course_request JOIN course ON course.courseid = course_request.course_id JOIN applications ON course_request.id = applications.request_course_id WHERE course.nvqnon = $typeCondition and course_request.year = $year and course_request.batch = $batchCondition   ";
 
// var_dump($query);
// exit();
        
//         $db = new Database();
//         $result = mysqli_fetch_array($db->readQuery($query));
//         return $result['count_applications'];
//     }
    

public static function getNonNvqApplicationsCountByYearBatchType($year, $batch = null, $type = null) {
  

    
    $query = "SELECT COUNT(applications.id) AS 'count_applications'
              FROM course_request 
              JOIN course ON course.courseid = course_request.course_id 
              JOIN applications ON course_request.id = applications.request_course_id 
              WHERE course_request.year = $year";

    
 

 if (!is_null($type)) {
    $query .= " AND course.nvqnon = $type ";
} else {
    $query .= " AND course.nvqnon =  2";
}
    
    

    
    if (!is_null($batch)) {
        $query .= " AND course_request.batch = $batch";
        
    }
 
    
          
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_applications']; 
}
    
    
    public static function getApplicationsCountByCenterYearAndBatch($center, $year, $batch) {

        $query = "SELECT count(`id`) as 'count_applications' FROM `applications` WHERE `request_course_id` IN (SELECT `id` FROM `course_request` WHERE `year` = $year AND `batch` = $batch AND `center_id` = $center)";
       
     
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_applications'];
    }
    
    
    
    public static function getApplicationsCountByCenterYearAndBatchFilter($center, $year = null, $batch = null) {
 
    $query = "SELECT count(`id`) as 'count_applications' 
              FROM `applications` 
              WHERE `request_course_id` IN 
              (SELECT `id` FROM `course_request` WHERE `center_id` = " . intval($center);

    
    if (!empty($year)) {
        $query .= " AND `year` = " . intval($year);
    }
    if (!empty($batch)) {
        $query .= " AND `batch` = " . intval($batch);
    }

    $query .= ")"; // Close the subquery

 

    $db = new Database();
    $result = mysqli_fetch_array($db->readQuery($query));

    return $result ? $result['count_applications'] : 0; // Return 0 if no data found
}
 
    
    public static function getApplicationsCountByTypeCenterYearAndBatch($center, $type, $year, $batch) {

        $query = "SELECT count(`id`) as 'count_applications' FROM `applications` WHERE `request_course_id` IN (SELECT `id` FROM `course_request` WHERE `year` = $year AND `batch` = $batch AND `center_id` = $center AND `course_id` IN (SELECT `courseid` FROM `course` WHERE `fullpart` = $type))";
        // $query = "SELECT count(`id`) as 'count_applications' FROM `applications` WHERE `request_course_id` IN (SELECT `id` FROM `course_request` WHERE `year` = $year AND `batch` = $batch AND `center_id` = $center AND `course_id` IN (SELECT `courseid` FROM `course` WHERE `fullpart` = $type)) AND `status` =0 ";
     
        
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_applications'];
    }

}
