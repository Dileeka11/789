<?php

/**
 * Description of Application
 *
 * @author Kavini Nisansala
 * @web www.nysc.lk
 */
class Course {

    public $id; 
    public $tradecode;
    public $cname;
    public $courseid;
    public $level;
    public $fullpart;
    public $durationm;
    public $nvqnon;
    public $english_lang;
    public $sinhala_lang;
    public $tamil_lang;
    public $accreditation_end_date;
    public $qu_count;
    public $is_favourite;
    public $is_languages;

    public function __construct($id) {

        if ($id) {

            $query = "SELECT * FROM `course` WHERE `courseid`='" . $id . "'";
            $db = new Database();

            $result = mysqli_fetch_array($db->readQuery($query));
            // $this->id = $result['id'];
            $this->tradecode = $result['tradecode'];
            $this->cname = $result['cname'];
            $this->courseid = $result['courseid'];
            $this->level = $result['level'];
            $this->fullpart = $result['fullpart'];
            $this->durationm = $result['durationm'];
            $this->nvqnon = $result['nvqnon'];
            $this->english_lang = $result['english_lang'];
            $this->sinhala_lang = $result['sinhala_lang'];
            $this->tamil_lang = $result['tamil_lang'];
            $this->accreditation_end_date = $result['accreditation_end_date'];
            $this->qu_count = $result['qu_count'];
            $this->is_favourite = $result['is_favourite'];
            $this->is_languages = $result['is_languages'];

             
            
            return $result;
        }
    }

    public function create() {

        $query = "INSERT INTO `course` (`tradecode`,`cname`,`courseid`,`level`,`fullpart`,`durationm`,`nvqnon`,`english_lang`,`sinhala_lang`,`tamil_lang`,`qu_count`) VALUES  ('"
                . $this->tradecode . "', '"
                . $this->cname . "', '"
                . $this->courseid . "', '"
                . $this->level . "', '"
                . $this->fullpart . "', '"
                . $this->durationm . "', '"
                . $this->nvqnon . "', '"
                . $this->english_lang . "', '"
                . $this->sinhala_lang . "', '"
                . $this->tamil_lang . "', '"
                . $this->qu_count . "')";
// dd($query);
        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function all() {
        $query = "SELECT * FROM `course` ORDER BY `cname` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
public function getLimited($offset, $limit) {
    $offset = intval($offset);
    $limit = intval($limit);

    $query = "SELECT * FROM course ORDER BY id DESC LIMIT $offset, $limit";
    
    $db = new Database();
    $result = $db->readQuery($query);

    $array_res = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $array_res[] = $row; // More readable than array_push
    }
    return $array_res;
}

    
     public function getAllLanguagesCourses() {
         
        $query = "SELECT * FROM `course`  WHERE `is_languages` = 1";
        
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    

    public static function getCourseByCourseID($course_id) {
        
 
        $query = "SELECT * FROM `course` WHERE `courseid` LIKE '" . $course_id . "'";
        
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }

  public static function getNvqNonNvqCourses($is_favourite) {
        $query = "SELECT * FROM `course` WHERE `is_favourite` =  $is_favourite ";
        
          $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    
    public function updateLatestUserAndStatus() {
        
        $query = "UPDATE  `course` SET "
                . "`course_latest_user` ='" . $this->course_latest_user . "', "
                . "`course_latest_status` ='" . $this->course_latest_status . "', "
                . "`status_updated_at` ='" . $this->status_updated_at . "' "
                . "WHERE `coursetrade` = '" . $this->coursetrade . "'";
                
                
        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->coursetrade);
        } else {
            return FALSE;
        }
    }
    
    
        public function updateIsfavourite($courseId) {
        
        $query = "UPDATE  `course` SET " 
                . "`is_favourite` ='" . $this->is_favourite . "' "
                . "WHERE `courseid` = '" . $courseId . "'";
                    
        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    
   public function update() {
       
        $query = "UPDATE  `course` SET "
                . "`cname` ='" . $this->cname . "', "
                . "`tradecode` ='" . $this->tradecode . "', " 
                . "`level` ='" . $this->level . "', "
                 . "`english_lang` ='" . $this->english_lang . "', "
                . "`sinhala_lang` ='" . $this->sinhala_lang . "', "
                . "`tamil_lang` ='" . $this->tamil_lang . "', "
                . "`fullpart` ='" . $this->fullpart . "', "
                . "`durationm` ='" . $this->durationm . "', "
                . "`accreditation_end_date` ='" . $this->accreditation_end_date . "', "
                . "`nvqnon` ='" . $this->nvqnon . "', " 
                . "`qu_count` ='" . $this->qu_count . "' " 
                . "WHERE `courseid` = '" . $this->courseid . "'";
        
        
        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

  public static function getCourseByTypeAndDuration($type,$durationm) {

        $query = "SELECT * FROM `course` WHERE `fullpart` = '" . $type . "' AND `durationm` = '" . $durationm . "'";
 
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
      public static function getCourseByFavorite() {

        $query = "SELECT * FROM `course` WHERE `is_favourite` =  1";
 
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    public static function getCourseByType($type) {

        $query = "SELECT * FROM `course` WHERE `fullpart` = '" . $type . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }



   
  public static function getNonNvqCourseList() {

        $query = "SELECT * FROM `course` WHERE `nvqnon` = 2 ORDER BY `cname` ASC";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

  public static function getCourseByNonNvq() {

        $query = "SELECT * FROM `course` WHERE `level` =0 ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }



    public static function getApplicationsByUser($cname) {

        $query = "SELECT * FROM `course` WHERE `cname` = '" . $cname . "' ORDER BY `status_updated_at` DESC";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public static function getApplicationsByUserType($user_courseid) {
        $prev_user_courseid = (int) $user_courseid - 1;
        $db = new Database();

        $query1 = "SELECT distinct(`course_coursetrade`) FROM `course_status` WHERE `user_courseid` = '" . $user_courseid . "' AND `cname` = '" . $_SESSION['coursetrade'] . "'";

        $result1 = $db->readQuery($query1);
        $coursetrade_list = "";

        while ($row = mysqli_fetch_array($result1)) {
            if ($coursetrade_list == '') {
                $coursetrade_list = $row['course_coursetrade'];
            } else {
                $coursetrade_list .= ', ' . $row['course_coursetrade'];
            }
        }
        if ($coursetrade_list == '') {
            $query = "SELECT * FROM `course` WHERE `course_latest_user` = '" . $user_courseid . "' OR (`course_latest_user` = '" . $prev_user_courseid . "' AND `course_latest_status` = '" . 2 . "') ORDER BY `status_updated_at` DESC";
        } else {
            $query = "SELECT * FROM `course` WHERE `course_latest_user` = '" . $user_courseid . "' OR (`course_latest_user` = '" . $prev_user_courseid . "' AND `course_latest_status` = '" . 2 . "') OR `coursetrade` IN (" . $coursetrade_list . ") ORDER BY `status_updated_at` DESC";
        }
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

}
