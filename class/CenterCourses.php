<?php

class CenterCourses {

    public $id;
    public $center_id;
    public $course_id;
    public $year;
    public $batch;
    public $queue;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT  * FROM `center_courses` WHERE `id`=" . $id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->center_id = $result['center_id'];
            $this->course_id = $result['course_id'];
             $this->year = $result['year'];
            $this->batch = $result['batch'];
            $this->queue = $result['queue'];
        }
    }

    public function create() {

        $query = "INSERT INTO `center_courses` (`center_id`,`course_id`,`year`,`batch`) VALUES  ('"
                . $this->center_id . "', '"
                . $this->course_id . "', '"
                . $this->year . "', '"
                . $this->batch . "')";
 
        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
      public function getCenterCourses($id,$year,$batch) {

        $query = "SELECT * FROM `center_courses` WHERE `center_id` = '" . $id . "' AND `year`='".$year."' AND `batch`='".$batch."' ORDER BY `queue` ASC";
         
         
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    
        public function getCenterCoursesWithDetailsYearVise($id,$year,$batch) {
 $query =" SELECT 
    c.id, 
    c.tradecode, 
    c.cname, 
    c.courseid, 
    c.level, 
    c.fullpart, 
    c.durationm, 
    c.nvqnon, 
    c.english_lang, 
    c.sinhala_lang, 
    c.tamil_lang, 
    c.accreditation_end_date, 
    c.qu_count, 
    c.is_favourite, 
    c.is_languages, 
    cc.center_id, 
    cc.year, 
    cc.batch, 
    cc.queue
FROM course c
INNER JOIN center_courses cc 
    ON c.id = cc.course_id
WHERE 
    cc.center_id = $id 
    AND cc.year = $year 
    AND cc.batch = $batch";

        
  
         var_dump($query);
         exit();
         
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    
    
    
    
        public function getCoursesByCenters($id) {

        $query = "SELECT * FROM `center_courses` WHERE `center_id` = '" . $id . "' ORDER BY `queue` ASC";
      
         
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    
    
         public function getCourseDetailsByCenter($id) {

        $query = "SELECT * FROM `center_courses` WHERE `center_id` = '" . $id . "'  ORDER BY `queue` ASC";
         
         
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    
      public function getCenterByCourseId($id,$year,$batch) {
        $query = "SELECT * FROM `center_courses` WHERE `course_id` = '" . $id . "' AND `year`='".$year."' AND `batch`='".$batch."' ORDER BY `queue` ASC";

          
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
 public function getCenterCoursesWithDetails($id) {

        $query = "SELECT course.* FROM `center_courses` INNER JOIN course ON center_courses.course_id=course.courseid  WHERE `center_id` = '" . $id . "' ORDER BY `queue` ASC";
 
 
 
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
     public function getCenterCoursesWithAllDetails($id) {

       // $query = "SELECT DISTINCT(applications.id),course_request.course_id,course.cname,DISTINCT(course.course_id)  FROM `center_courses` INNER JOIN `course_request` ON course_request.course_id = center_courses.course_id join applications on applications.request_course_id = course_request.id JOIN course on course_request.course_id = course.courseid WHERE applications.center_id = $id AND course_request.course_id = 'K05F06L4' 
//AND course_request.year =2024 AND course_request.batch = 1";
 
 
 
 $query ="SELECT course.* FROM `center_courses` INNER JOIN course ON center_courses.course_id=course.courseid  join course_request on course_request.course_id = course.courseid  WHERE `center_id` = '" . $id . "' ORDER BY `queue` ASC ";
 
 
 
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
     
    
    public function update() {

        $query = "UPDATE  `center_courses` SET "
                . "`course_id` ='" . $this->course_id . "' "
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
        $query = "SELECT * FROM `center_courses` ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function delete() {
        $query = 'DELETE FROM `center_courses` WHERE id="' . $this->id . '"';
       
        $db = new Database();
        return $db->readQuery($query);
    }
    
    //get center by course exam student count
     public function getCenterCourseIdForExam($year,$batcg, $center_id) {

        $query = "SELECT * FROM `center_courses` INNER JOIN course ON center_courses.course_id=course.courseid  WHERE `center_id` = '" . $center_id . "'  AND `level` = 0  ORDER BY `queue` ASC";
 
 
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
      public function getcourseDetailsCenters( $id) {

    $query = "SELECT course.* FROM `center_courses` INNER JOIN course ON center_courses.course_id=course.courseid  WHERE `center_id` = '" . $id . "' AND course.level = 0 ORDER BY `queue` ASC";

 
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
   
    

    

}
