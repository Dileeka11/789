<?php

class CourseRequest
{

    public $id;
    public $course_id;
    public $center_id;
    public $request_date;
    public $serial_number;
    public $year;
    public $batch;
    public $num_students;
    public $course_fee;
    public $teaching_days;
    public $dg_approvel;
    public $description;
    public $status;

    public function __construct($id)
    {
        if ($id) {

            $query = "SELECT  * FROM `course_request` WHERE `id`=" . $id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->course_id = $result['course_id'];
            $this->center_id = $result['center_id'];
            $this->request_date = $result['request_date'];
            $this->serial_number = $result['serial_number'];
            $this->year = $result['year'];
            $this->batch = $result['batch'];
            $this->num_students = $result['num_students'];
            $this->course_fee = $result['course_fee'];
            $this->teaching_days = $result['teaching_days'];
            $this->dg_approvel = $result['dg_approvel'];
            $this->description = $result['description'];
            $this->status = $result['status'];

            return $result;
        }
    }

    public function create()
    {

        $query = "INSERT INTO `course_request` (`course_id`,`center_id`,`year`,`batch`,`request_date`,`num_students`,`course_fee`,`teaching_days`,`dg_approvel`,`status`) VALUES  ('"
            . $this->course_id . "', '"
            . $this->center_id . "', '"
            . $this->year . "', '"
            . $this->batch . "', '"
            . $this->request_date . "', '"
            . $this->num_students . "', '"
            . $this->course_fee . "', '"
            . $this->teaching_days . "', '"
            . $this->dg_approvel . "', '"
            . $this->status . "')";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function updateStatus()
    {
        $query = "UPDATE  `course_request` SET "
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
    public function rejectRequest()
    {
        $query = "UPDATE  `course_request` SET "
            . "`description` ='" . $this->description . "', "
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

    public function update()
    {
        $query = "UPDATE  `course_request` SET "
            . "`course_id` ='" . $this->course_id . "', "
            . "`year` ='" . $this->year . "', "
            . "`batch` ='" . $this->batch . "', "
            . "`teaching_days` ='" . $this->teaching_days . "', "
            . "`request_date` ='" . $this->request_date . "', "
            . "`num_students` ='" . $this->num_students . "', "
            . "`course_fee` ='" . $this->course_fee . "', "
            . "`dg_approvel` ='" . $this->dg_approvel . "' "
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

        $query = "SELECT * FROM `course_request` ORDER BY request_date DESC ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public static function getCourseRequestByCenterId($center)
    {

        $query = "SELECT * FROM `course_request` WHERE `center_id` = '" . $center . "' ORDER BY request_date DESC ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public static function getCourseRequestByCenterIdWithStatus($center, $status)
    {

        $query = "SELECT * FROM `course_request` WHERE `center_id` = '" . $center . "' AND `status` = '" . $status . "' ORDER BY request_date DESC ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public static function getCourseIdByYear($year, $batch, $center_id)
    {

        $query = "SELECT * FROM course_request INNER JOIN course ON course.courseid =course_request.`course_id` WHERE course_request.year = '" . $year . "' AND course_request.batch = '" . $batch . "' AND course_request.center_id = '" . $center_id . "' AND course_request.status != '0'  ORDER BY course.cname ASC";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public static function getCourseIdByYearAndBatch($years = null, $batch = null)
    {
        
        
        
        
        if ($years != '' && $batch != '') {
            $this_year = date("Y");
            
            var_dump($batch);
            
            if($batch == 0 ){
                 $query = "SELECT * FROM course_request   WHERE year = '" . $years . "'";
            }else{
                 $query = "SELECT * FROM course_request   WHERE year = '" . $years . "' AND `batch`= '" . $batch . "'";
            }
           
            // if ($years == $this_year) {
            //     $query = "SELECT * FROM course_request   WHERE year = '" . $years . "' AND `batch`= '" . $batch . "' AND  `status` = 1";
            // } else {
            //     $query = "SELECT * FROM course_request   WHERE year = '" . $years . "' AND `batch`= '" . $batch . "' AND `status` = 3  ";
            // }



            $db = new Database();
            $result = $db->readQuery($query);
            $array_res = array();

            while ($row = mysqli_fetch_array($result)) {
                array_push($array_res, $row);
            }
            return $array_res;
        } else {
            return [];
        }
        
        
        
        
        
    }



   public static function getCourseIdByYearAndBatchWithCenters($years = null, $batch = null, $center = null )
    {
        if ($years != '' && $batch != '') {
            $this_year = date("Y");
            $query = "SELECT * FROM course_request   WHERE year = '" . $years . "' AND `batch`= '" . $batch . "' AND center_id = $center";
            



            $db = new Database();
            $result = $db->readQuery($query);
            $array_res = array();

            while ($row = mysqli_fetch_array($result)) {
                array_push($array_res, $row);
            }
            return $array_res;
        } else {
            return [];
        }
    }




    public static function getCourseIdByYearAndBatchWithCenter($center_id, $year)
    {

        $query = "SELECT * FROM course_request   WHERE  center_id = '" . $center_id . "'  AND  year = '" . $year . "' AND   `status` = 1";


        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }



    public static function getCourseRequestByStatus($status)
    {

        $query = "SELECT * FROM `course_request` WHERE `status` = '" . $status . "' ORDER BY request_date DESC ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function delete($id)
    {

        $query = 'DELETE FROM `course_request` WHERE `id` ="' . $id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }
    
    public static function getCourseRequestCountByStatusYearAndBatch($status, $year, $batch)
    {

        $query = "SELECT count(`id`) as 'req_count' FROM `course_request` WHERE `status` = '" . $status . "' AND `year` = $year AND `batch` = $batch ORDER BY `request_date` DESC ";

        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['req_count'];
    }
    
    public static function getDetailedCourseRequests($center_id, $year, $batch)
{
   $query = "
SELECT *
FROM course_request 
WHERE 
    status = 1 AND (
        center_id = '" . $center_id . "' 
        OR year = '" . $year . "' 
        OR batch = '" . $batch . "'
    )";

   
    $db = new Database();
    $result = $db->readQuery($query);

    $array_res = array();
    while ($row = mysqli_fetch_array($result)) {
       
        
        $CENTERS = new Centers($row['center_id']);
        $row['center_name'] = $CENTERS->center_name;
         $COURSES = new Course($row['course_id']);
         $row['course_name'] = $COURSES->cname;
         
        $STUDENT = new Student(NULL);
        $res= $STUDENT->getStudentCountForExam($row['year'], $row['batch'],$row['course_id'],$row['center_id']);
         
 
        $row['all_student'] = $res;
         
        array_push($array_res, $row);
    }

    return $array_res;
}


}
