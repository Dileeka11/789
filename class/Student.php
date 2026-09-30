<?php

/**
 * Description of User
 *
 * @author Suharshana DsW
 * @web www.nysc.lk
 */
class Student
{

    public $id;
    public $nic;
    public $application_id;
    public $request_course_id;
    public $fname;
    public $lname;
    public $course_id;
    public $course_name;
    public $centercode;
    public $centername;
    public $year;
    public $batch;
    public $mcq_mark;
    public $writing_paper_mark;
    public $practical_mark;
    public $total_mark;
    public $isActive;
    public $authToken;
    public $lastLogin;
    public $password;
    public $payment_status;
    public $drop_out_date;
    public $certificate_no;
    public $is_login;

    public function __construct($id)
    {

        if ($id) {
            $query = "SELECT * FROM `student` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysqli_fetch_array($db->readQuery($query));


            $this->id = $result['id'];
            $this->application_id = $result['application_id'];
            $this->request_course_id = $result['request_course_id'];
            $this->nic = $result['nic'];
            $this->fname = $result['fname'];
            $this->lname = $result['lname'];
            $this->course_id = $result['course_id'];
            $this->course_name = $result['course_name'];
            $this->centercode = $result['centercode'];
            $this->centername = $result['centername'];
            $this->year = $result['year'];
            $this->batch = $result['batch'];
            $this->mcq_mark = $result['mcq_mark'];
            $this->writing_paper_mark = $result['writing_paper_mark'];
            $this->practical_mark = $result['practical_mark'];
            $this->total_mark = $result['total_mark'];
            $this->isActive = $result['isActive'];
            $this->authToken = $result['authToken'];
            $this->lastLogin = $result['lastLogin'];
            $this->payment_status = $result['payment_status'];
            $this->drop_out_date = $result['drop_out_date'];
            $this->certificate_no = $result['certificate_no'];
            $this->is_login = $result['is_login'];


            return $result;
        }
    }

    public function create()
    {
        date_default_timezone_set('Asia/Colombo');
        $createdAt = date('Y-m-d H:i:s');
        $query = "INSERT INTO `student` (`application_id`,`request_course_id`,`nic`,`fname`, `lname`, `course_id`,`course_name`,`centercode`,`centername`,`year`,`batch`) VALUES  ('" . $this->application_id . "','" . $this->request_course_id . "','" . $this->nic . "', '" . $this->fname . "', '" . $this->lname . "','" . $this->course_id . "', '" . $this->course_name . "','" . $this->centercode . "', '" . $this->centername . "', '" . $this->year . "', '" . $this->batch . "')";

        $db = new Database();

        $result = $db->readQuery($query);
        if ($result) {
            return mysqli_insert_id($db->DB_CON);
        } else {

            return FALSE;
        }
    }

    public function createAdmin()
    {
        date_default_timezone_set('Asia/Colombo');
        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `student` (`nic`,`fname`, `lname`, `course_id`,`course_name`,`centercode`,`centername`,`year`,`batch`) VALUES  ('"  . $this->nic . "', '" . $this->fname . "', '" . $this->lname . "','" . $this->course_id . "', '" . $this->course_name . "','" . $this->centercode . "', '" . $this->centername . "', '" . $this->year . "', '" . $this->batch . "')";



        $db = new Database();

        $result = $db->readQuery($query);
        if ($result) {
            return mysqli_insert_id($db->DB_CON);
        } else {

            return FALSE;
        }
    }



    public function login($student_id, $password)
    {
        $query = "SELECT * FROM `student` WHERE  `id`= '" . $student_id . "' AND `password` LIKE '" . $password . "'";

        $db = new Database();

        $result = mysqli_fetch_array($db->readQuery($query));

        if (!$result) {

            return FALSE;
        } else {

            $this->id = $result['id'];
            $this->setAuthToken($result['id']);
            $this->setLastLogin($this->id);
            $user = $this->__construct($this->id);
            $this->setUserSession($user);

            return $user;
        }
    }

    public function checkOldPass($id, $password)
    {

        $enPass = md5($password);

        $query = "SELECT `id` FROM `student` WHERE `id`= '" . $id . "' AND `password`= '" . $enPass . "'";

        $db = new Database();

        $result = mysqli_fetch_array($db->readQuery($query));

        if (!$result) {

            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function changePassword($id, $password)
    {



        $enPass = md5($password);

        $query = "UPDATE  `student` SET "
            . "`password` ='" . $enPass . "' "
            . "WHERE `id` = '" . $id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

public function all($limit = 100, $offset = 0)
{
    $query = "SELECT * FROM `student` LIMIT $limit OFFSET $offset";

    $db = new Database();
    $result = $db->readQuery($query);

    $array_res = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $array_res[] = $row;
    }

    return $array_res;
}


    public function getStudentsLastID()
    {

        $query = "SELECT * FROM `student` ORDER BY `id` DESC LIMIT 1";
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['id'];
    }

    public static function getApplicationsByCenterStudent($id)
    {

        $year = date("Y");

        $query = "SELECT * FROM `student` WHERE `centercode` = $id AND year = $year ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }


    public static function getApplicationsByCenterStudentCourse($id, $course_id)
    {

        $year = date("Y");

        $query = "SELECT * FROM `student` WHERE `centercode` = $id AND year = $year AND course_id = '" . $course_id  . "' AND `isActive` = 0 ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }




    public static function getStudentThisYear()
    {

        $year = date("Y");

        $query = "SELECT * FROM `student` WHERE  year = $year ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }




    public static function getAllStudentscenters($center)
    {

        $year = date("Y");

        $query = "SELECT * FROM `student` WHERE  centercode = $center AND year = $year AND batch = 1 AND isActive = 0  ";



        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }



    public static function getStudentByCenterStudentCourseNvq($id, $course_id)
    {

        $year = date("Y");


        $query = "SELECT * FROM `student` INNER JOIN course ON course.courseid = student.course_id WHERE   student.isActive = 0 AND student.centercode = $id AND student.course_id = '" . $course_id  . "' AND student.year = $year AND course.nvqnon = 1";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }

    public static function getStudentByCenterStudentNvq($id)
    {

        $year = date("Y");


        $query = "SELECT * FROM `student` INNER JOIN course ON course.courseid = student.course_id WHERE student.centercode = $id AND student.year = $year AND course.nvqnon = 1";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }

    public static function getStudentByStudentNvqThisYear()
    {

        $year = date("Y");


        $query = "SELECT * FROM `student` INNER JOIN course ON course.courseid = student.course_id WHERE  student.year = $year AND course.nvqnon = 1";


        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }

    public static function getAllStudentByStudentNvqThisYear($center)
    {

        $year = date("Y");


        $query = "SELECT * FROM `student` INNER JOIN course ON course.courseid = student.course_id WHERE student.year = $year AND student.isActive = 0 AND  student.centercode = $center AND course.nvqnon = 1";


        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }

    public static function getAllStudentByStudentNonNvqThisYear($center)
    {

        $year = date("Y");


        $query = "SELECT * FROM `student` INNER JOIN course ON course.courseid = student.course_id WHERE  student.year = $year AND student.isActive = 0 AND  student.centercode = $center AND course.nvqnon = 2";


        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }


    public static function getStudentByStudentNonNvqThisYear()
    {

        $year = date("Y");


        $query = "SELECT * FROM `student` INNER JOIN course ON course.courseid = student.course_id WHERE  student.year = $year AND course.nvqnon = 2";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }

   public static function getStudentLiveCount()
    {

       
        $query = "SELECT * FROM `student`  WHERE `is_login` = 1";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }
    

    public static function getStudentByCenterStudentNonNvq($id)
    {

        $year = date("Y");


        $query = "SELECT * FROM `student` INNER JOIN course ON course.courseid = student.course_id WHERE student.centercode = $id AND student.year = $year AND course.nvqnon = 2";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }



    public static function getStudentByCenterCourseStudentNonNvq($id, $course_id)
    {

        $year = date("Y");


        $query = "SELECT * FROM `student` INNER JOIN course ON course.courseid = student.course_id WHERE student.isActive = 0  AND student.centercode = $id AND student.course_id = '" . $course_id  . "' AND student.year = $year AND course.nvqnon = 2";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }


    public static function getStudentByCenterStudentCourseType($id, $type)
    {

        $year = date("Y");


        $query = "SELECT * FROM `student` INNER JOIN course ON course.courseid = student.course_id WHERE student.centercode = $id AND student.year = $year AND course.fullpart = $type";


        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }

    public static function getStudentByCenterViseStudentCourseType($id, $type, $course_id)
    {

        $year = date("Y");


        $query = "SELECT * FROM `student` INNER JOIN course ON course.courseid = student.course_id WHERE student.isActive = 0  AND student.centercode = $id AND student.course_id = '" . $course_id  . "' AND student.year = $year AND course.fullpart = $type";


        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }


    public function getStudentsByCourse($course)
    {

        $query = "SELECT * FROM `student` WHERE `course_id` LIKE '" . $course . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function updatePaymentStatus()
    {



        $query = "UPDATE  `student` SET "
            . "`payment_status` ='" . $this->payment_status . "' "
            . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();



        $result = $db->readQuery($query);



        if ($result) {

            return $this->__construct($this->id);
        } else {

            return FALSE;
        }
    }
    public function updateCertificateNo()
    {


        if ($this->certificate_no == null) {
            $query = "UPDATE  `student` SET "
                . "`certificate_no` =null "
                . "WHERE `id` = '" . $this->id . "'";
        } else {
            $query = "UPDATE  `student` SET "
                . "`certificate_no` ='" . $this->certificate_no . "' "
                . "WHERE `id` = '" . $this->id . "'";
        }


        $db = new Database();



        $result = $db->readQuery($query);



        if ($result) {

            return $this->__construct($this->id);
        } else {

            return FALSE;
        }
    }

    public function getFilteredStudents($course, $center, $year, $batch)
    {

        $query = "SELECT * FROM `student` WHERE `course_id` LIKE '" . $course . "'";
        if ($center != '') {
            $query .= " AND `centercode` LIKE  '" . $center . "'";
        }
        if ($year != '') {
            $query .= " AND `year` LIKE  '" . $year . "'";
        }
        if ($batch != '') {
            $query .= " AND `batch` LIKE  '" . $batch . "'";
        }
        $query .= "AND `isActive` =0  ORDER BY `id` DESC";
        
      
        
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }
public function getFilteredStudentsCheckExam($course = '', $center = '', $year = '', $batch = '') {
    $db = new Database();

    $query = "SELECT 
                s.id AS mis_no, 
                s.fname,
                s.lname,
                s.course_id,
                s.course_name,
                s.centercode,
                s.centername,
                s.year,
                s.batch,
                e.id AS exam_student_id,
                e.exam_id,
                e.mcq_marks,
                e.mcq_grade,
                e.essay_marks,
                e.essay_grade,
                e.practical_marks,
                e.practical_grade,
                e.full_marks,
                e.grade,
                e.status,
                e.mcq_started_at,
                e.essay_started_at,
                e.created_at,
                e.updated_at,
                e.note
              FROM student s
              INNER JOIN exam_students e ON s.id = e.student_id
              WHERE s.isActive = 0";

    if ($course != '') {
        $query .= " AND s.course_id = '" . $course . "'";
    }
    if ($center != '') {
        $query .= " AND s.centercode = '" . $center . "'";
    }
    if ($year != '') {
        $query .= " AND s.year = '" . $year . "'";
    }
    if ($batch != '') {
        $query .= " AND s.batch = '" . $batch . "'";
    }

    $query .= " ORDER BY s.id DESC";


 

    $result = $db->readQuery($query);
    $array_res = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $array_res[] = $row;
    }

    return $array_res;
}


    public static function getStudentByNIC($nic)
    {

        $query = "SELECT * FROM `student` WHERE `nic` = '" . $nic . "' AND ";

        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }
    
     public static function getStudentByNICAndBatch($nic)
    {

        $query = "SELECT * FROM `student` WHERE `nic` = '" . $nic . "' OR  `id` = '" . $nic . "' ";
        

        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }
    
       public static function getStudentByCertificateNo($certificate_no)
    {

        $query = "SELECT * FROM `student` WHERE `certificate_no` = '" . $certificate_no . "' ";

        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }
    
    
    public static function getStudentByNIC1($nic)
    {

     $query = "SELECT * FROM `student` WHERE LOWER(REPLACE(`nic`, ' ', '')) = LOWER(REPLACE('" . $nic . "', ' ', ''))";

        
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getByCenter($id)
    {

        $query = "SELECT * FROM `student` WHERE `centercode`= '" . $id . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getStudentByCourseRequest($id)
    {

        $query = "SELECT * FROM `student` WHERE `request_course_id`= '" . $id . "' AND `isActive` = 0";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getDropOutStudentByCourseRequest($id)
    {

        $query = "SELECT * FROM `student` WHERE `request_course_id`= '" . $id . "' AND `isActive` = 1";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getDropOutStudentByCourseYearBatch($course_id = null, $year = null, $batch = null, $center_id = null)
    {

        $query = "SELECT * FROM `student` WHERE `course_id`= '" . $course_id . "' AND `year`= '" . $year . "' AND `batch`= '" . $batch . "' AND `centercode`= '" . $center_id . "'  AND `isActive` = 1";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getStudentsByCourseAndCenter($course, $center, $year, $batch)
    {

        $query = "SELECT * FROM `student` WHERE `centercode`= '" . $center . "' AND `course_id`= '" . $course . "' AND `batch`= '" . $batch . "' AND `year`= '" . $year . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }
    public function getStudentsByCourseAndCenterWithoutDropOut($course, $center, $year, $batch)
    {

        $query = "SELECT * FROM `student` WHERE `centercode`= '" . $center . "' AND `course_id`= '" . $course . "' AND `batch`= '" . $batch . "' AND `year`= '" . $year . "'  AND `isActive` = 0 ";
 
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getStudentsByCenterYearAndBatch($center, $year, $batch)
    {

        $query = "SELECT * FROM `student` WHERE `centercode`= '" . $center . "' AND `batch`= '" . $batch . "' AND `year`= '" . $year . "' AND `isActive` = 0  AND `course_id` IN (SELECT `courseid` FROM `course` WHERE `nvqnon` = 2)";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row['id']);
        }
        return $array_res;
    }

    public function authenticate()
    {

        if (!isset($_SESSION)) {

            session_start();
        }

        $id = NULL;

        $authToken = NULL;

        if (isset($_SESSION["id"])) {

            $id = $_SESSION["id"];
        }



        if (isset($_SESSION["authToken"])) {

            $authToken = $_SESSION["authToken"];
        }


        $query = "SELECT `id` FROM `student` WHERE `id`= '" . $id . "' AND `authToken`= '" . $authToken . "'";

        $db = new Database();

        $result = mysqli_fetch_array($db->readQuery($query));

        if (!$result) {

            return FALSE;
        } else {



            return TRUE;
        }
    }

    public function logOut()
    {



        if (!isset($_SESSION)) {

            session_start();
        }



        unset($_SESSION["id"]);

        unset($_SESSION["nic"]);


        unset($_SESSION["fname"]);
        unset($_SESSION["lname"]);

        unset($_SESSION["isActive"]);

        unset($_SESSION["authToken"]);

        unset($_SESSION["lastLogin"]);

        unset($_SESSION["usernic"]);

        return TRUE;
    }

    public function update()
    {

        $query = "UPDATE  `student` SET "
            . "`nic` ='" . $this->nic . "', "
            . "`fname` ='" . $this->fname . "', "
            . "`lname` ='" . $this->lname . "', "
            . "`course_id` ='" . $this->course_id . "', "
            . "`course_name` ='" . $this->course_name . "', "
            . "`centercode` ='" . $this->centercode . "', "
            . "`centername` ='" . $this->centername . "', "
            . "`year` ='" . $this->year . "', "
            . "`batch` ='" . $this->batch . "'  "
            . "WHERE `id` = '" . $this->id . "'";
 

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    public function updateIsActive()
    {

        $query = "UPDATE  `student` SET "
            . "`drop_out_date` ='" . $this->drop_out_date . "',  "
            . "`isActive` ='" . $this->isActive . "'  "
            . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    public function updateMarks()
    {

        $query = "UPDATE  `student` SET "
            . "`practical_mark` ='" . $this->practical_mark . "', "
            . "`mcq_mark` ='" . $this->mcq_mark . "', "
            . "`writing_paper_mark` ='" . $this->writing_paper_mark . "', "
            . "`total_mark` ='" . $this->total_mark . "'  "
            . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    private function setUserSession($user)
    {

        if (!isset($_SESSION)) {
            session_start([
                'cookie_lifetime' => 3200,
            ]);
        }

        $_SESSION["id"] = $user['id'];

        $_SESSION["nic"] = $user['nic'];

        $_SESSION["fname"] = $user['fname'];
        $_SESSION["lname"] = $user['lname'];

        $_SESSION["isActive"] = $user['isActive'];

        $_SESSION["authToken"] = $user['authToken'];

        $_SESSION["lastLogin"] = $user['lastLogin'];
    }

    private function setAuthToken($id)
    {

        $authToken = md5(uniqid(rand(), true));

        $query = "UPDATE `student` SET `authToken` ='" . $authToken . "' WHERE `id`='" . $id . "'";

        $db = new Database();

        if ($db->readQuery($query)) {
            return $authToken;
        } else {

            return FALSE;
        }
    }

    private function setLastLogin($id)
    {



        date_default_timezone_set('Asia/Colombo');

        $now = date('Y-m-d H:i:s');

       $query = "UPDATE `student` SET `lastLogin` = '$now', `is_login` = 1 WHERE `id` = '$id'";

        $db = new Database();

        if ($db->readQuery($query)) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    public function checkEmail($email)
    {



        $query = "SELECT `email`,`usernic` FROM `student` WHERE `email`= '" . $email . "'";

        $db = new Database();

        $result = mysqli_fetch_array($db->readQuery($query));

        if (!$result) {

            return FALSE;
        } else {

            return $result;
        }
    }

    public function GenarateCode($email)
    {

        $rand = rand(10000, 99999);

        $query = "UPDATE  `student` SET "
            . "`resetcode` ='" . $rand . "' "
            . "WHERE `email` = '" . $email . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    public function SelectForgetUser($email)
    {



        if ($email) {



            $query = "SELECT `email`,`usernic`,`resetcode` FROM `student` WHERE `email`= '" . $email . "'";

            $db = new Database();

            $result = mysqli_fetch_array($db->readQuery($query));

            $this->usernic = $result['usernic'];

            $this->email = $result['email'];

            $this->restCode = $result['resetcode'];

            return $result;
        }
    }

    public function SelectResetCode($code)
    {



        $query = "SELECT `id` FROM `student` WHERE `resetcode`= '" . $code . "'";

        $db = new Database();

        $result = mysqli_fetch_array($db->readQuery($query));

        if (!$result) {

            return FALSE;
        } else {



            return TRUE;
        }
    }

    public function updatePassword($password, $code)
    {



        $enPass = md5($password);

        $query = "UPDATE  `student` SET "
            . "`password` ='" . $enPass . "' "
            . "WHERE `resetcode` = '" . $code . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    public function updateStudentPassword()
    {

        $query = "UPDATE  `student` SET "
            . "`password` ='" . $this->password . "' "
            . "WHERE `id` = '" . $this->id . "'";
        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    public function getEmptyPasswordStudents()
    {

        // $query = "SELECT * FROM `student` WHERE `id` IN (89,90,91)";
        // $query = "SELECT * FROM `student`";
        $query = "SELECT * FROM `student` WHERE `password` IS NULL";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getStudentIDArrayByCourseAndBatch($courseid, $year, $batch, $center_id)
    {
        //$query = "SELECT student.id,applications.address,applications.mobile_number  FROM `student` JOIN applications ON student.nic = applications.nic WHERE `course_id` LIKE '" . $courseid . "' AND `year` =  '" . $year . "' AND `batch` = " . $batch . " AND `centercode` = " . $center_id;
        $query = "SELECT `id`  FROM `student`  WHERE  `isActive` =  0 AND `course_id` LIKE '" . $courseid . "' AND `year` =  '" . $year . "' AND `batch` = " . $batch . " AND `centercode` = " . $center_id . " ORDER BY `practical_mark` DESC";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row['id']);
        }
        return $array_res;
    }
    
    public function getStudentCountByCenterYearAndBatch($year, $batch, $center_id)
    {
        $query = "SELECT count(`id`) as 'stu_count'  FROM `student`  WHERE `year` =  '" . $year . "' AND `batch` = " . $batch . " AND `centercode` = " . $center_id . " AND `batch` = 1 AND `course_id` IN (SELECT `courseid` FROM `course` WHERE `nvqnon` = 2)";
     

        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['stu_count'];
    }


public function getStudentCountByCenterYearAndBatchFilter($year = null, $batch = null, $center_id = null)
{
    
  $query = "SELECT count(`id`) as 'stu_count'  
              FROM `student`  
              WHERE `centercode` = " . intval($center_id);


     
    if (!empty($year)) {
        $query .= " AND `year` = '" . intval($year) . "'";
    }
    if (!empty($batch)) {
        $query .= " AND `batch` = " . intval($batch);
    }

     

    $db = new Database();
    $result = mysqli_fetch_array($db->readQuery($query));

    return $result ? $result['stu_count'] : 0;  
}



    public function AllgetStudentCountByCenterYearAndBatch($year, $batch, $center_id)
    {
        //$query = "SELECT student.id,applications.address,applications.mobile_number  FROM `student` JOIN applications ON student.nic = applications.nic WHERE `course_id` LIKE '" . $courseid . "' AND `year` =  '" . $year . "' AND `batch` = " . $batch . " AND `centercode` = " . $center_id;
        $query = "SELECT count(`id`) as 'stu_count'  FROM `student`  WHERE `year` =  '" . $year . "' AND `batch` = " . $batch . " AND `centercode` = " . $center_id . " ";


        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['stu_count'];
    }


    public function getStudentIDArrayByCourseAndBatchWithOutDrop($courseid, $year, $batch, $center_id)
    {
        //$query = "SELECT student.id,applications.address,applications.mobile_number  FROM `student` JOIN applications ON student.nic = applications.nic WHERE `course_id` LIKE '" . $courseid . "' AND `year` =  '" . $year . "' AND `batch` = " . $batch . " AND `centercode` = " . $center_id;
        $query = "SELECT `id`  FROM `student`  WHERE `course_id` LIKE '" . $courseid . "' AND `year` =  '" . $year . "' AND `batch` = '" . $batch . "' AND `isActive` = 0 AND `centercode` = " . $center_id . " AND `isActive` = 0";


        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row['id']);
        }
        return $array_res;
    }


    public function getStudentIDArrayByCourseAndBatchWithOutDropCount($courseid = null, $year = null, $batch = null, $center_id = null)
    {
        $query = "SELECT count(`id`) as 'stu_count' FROM `student`  WHERE `course_id` LIKE '" . $courseid . "' AND `year` =  '" . $year . "' AND `batch` = '" . $batch . "'  AND `centercode` = " . $center_id . " AND `isActive` = 0 ";
 

        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['stu_count'];
    }

 
    public function getStudentIDArrayByCourseAndBatchCount($courseid = null, $year = null, $batch = null, $center_id = null)
    {
    
    $query = "SELECT count(`id`) as 'stu_count' 
          FROM `student`  
          WHERE `course_id` LIKE '" . $courseid . "' 
          AND `year` =  '" . $year . "' 
          AND `batch` = '" . $batch . "'  
          AND `centercode` = '" . $center_id . "'";
 

        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['stu_count'];
    }
    
      public function getStudentIDArrayByCourseAndBatchCountGender($courseid = null, $year = null, $batch = null, $center_id = null,$gender = null)
    {
   
       $query = "SELECT COUNT(s.id) AS 'stu_count' 
              FROM student s
              JOIN applications a ON s.application_id = a.id
              WHERE a.gender = '" .$gender."'
              AND s.course_id LIKE '" . $courseid . "' 
              AND s.year = '" . $year . "' 
              AND s.batch = '" . $batch . "'  
              AND s.centercode = '" . $center_id . "'";

 

        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['stu_count'];
    }
    
      public function getStudentIDArrayByCourseAndBatchCountGenderDropout($courseid = null, $year = null, $batch = null, $center_id = null,$gender = null)
    {
   
       $query = "SELECT COUNT(s.id) AS 'stu_count' 
              FROM student s
              JOIN applications a ON s.application_id = a.id
              WHERE a.gender = '" .$gender."'
              AND s.isActive = 1
              AND s.course_id LIKE '" . $courseid . "' 
              AND s.year = '" . $year . "' 
              AND s.batch = '" . $batch . "'  
              AND s.centercode = '" . $center_id . "'";

 

        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['stu_count'];
    }
    

    public function getStudentIDArrayByCourseAndBatchWithDropCount($courseid = null, $year = null, $batch = null, $center_id = null)
    {
        $query = "SELECT count(`id`) as 'stu_count' FROM `student`  WHERE `course_id` LIKE '" . $courseid . "' AND `year` =  '" . $year . "' AND `batch` = '" . $batch . "' AND `centercode` = " . $center_id ." AND `isActive` =1 ";

 

        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['stu_count'];
    }
    
    public function getStudentIDArrayByCourseAndBatchWithOutDropShowMarks($courseid, $year, $batch, $center_id)
    {
        $query = "SELECT * FROM `student`  INNER JOIN  `exam_students` ON exam_students.student_id=student.id WHERE student.course_id LIKE '" . $courseid . "' AND student.year =  '" . $year . "' AND student.batch = '" . $batch . "' AND student.isActive = 0 AND student.centercode = " . $center_id;
 

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }
    
  public static function getNonNvqStudentCountByYear($year) {

      $query = "SELECT COUNT(student.id) AS student_count FROM student JOIN course ON course.courseid = student.course_id WHERE course.nvqnon = 2 AND student.year = $year AND student.isActive = 0";
        //  $query = "SELECT count(`id`) as 'count_student' FROM `student` WHERE `course_id` =  '" . $course_id . "' AND `year` =  '" . $year . "' AND `batch` = " . $batch . " AND  `centercode` = $centercode AND `isActive` = 0";

        
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['student_count'];
    } 
  
   public static function getCourseTypeStudentCountBy($year = null, $batch = null,$type = null) {

    $query = "SELECT COUNT(student.id) AS student_count 
              FROM student 
              JOIN course ON course.courseid = student.course_id 
              WHERE student.isActive = 0";
    
    // Append conditions if provided
   if (!is_null($type)) {
    $query .= " AND course.nvqnon = $type ";
} else {
    $query .= " AND course.nvqnon = 2 ";
}

    if (!is_null($year)) {
        $query .= " AND student.year = $year";
    }

    if (!is_null($batch)) {
        $query .= " AND student.batch = $batch";
    }
 
        
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['student_count'];
    } 
   
    

    public function getStudentIDArrayByCourseAndBatchWithOutDropShow($courseid, $year, $batch, $center_id)
    {
        //$query = "SELECT student.id,applications.address,applications.mobile_number  FROM `student` JOIN applications ON student.nic = applications.nic WHERE `course_id` LIKE '" . $courseid . "' AND `year` =  '" . $year . "' AND `batch` = " . $batch . " AND `centercode` = " . $center_id;
        $query = "SELECT * FROM `student`  WHERE `course_id` LIKE '" . $courseid . "' AND `year` =  '" . $year . "' AND `batch` = '" . $batch . "' AND `isActive` = 0 AND `centercode` = " . $center_id;


        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }





    public function getStudentsByCourseAndBatch($courseid, $year, $batch)
    {
        $query = "SELECT * FROM `student` WHERE `course_id` LIKE '" . $courseid . "' AND `year` =  '" . $year . "' AND `batch` = " . $batch . " ORDER BY `id` ASC";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    public function getStudentsCountByYearAndBatch($year, $batch)
    {
        $query = "SELECT count(`id`) as 'count_student' FROM `student` WHERE `year` =  '" . $year . "' AND `batch` = " . $batch . "";

        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_student'];
    }


  public function getAllStudentsCountByYearAndBatch($year, $batch)
    {
        
           $query = "SELECT * FROM `student` WHERE `year` =  '" . $year . "' AND `batch` = " . $batch . "";

         $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
        
        
    }
    
    public function getDropoutStudentsCountByYearAndBatch($year, $batch)
    {
        $query = "SELECT count(`id`) as 'count_student' FROM `student` WHERE `year` =  '" . $year . "' AND `batch` = " . $batch . " AND `isActive` = 1";

        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_student'];
    }
    
    
    public function getDropoutStudentsCountByYearAndBatchAndType($year, $batch,$type)
    {
$query = "SELECT COUNT(student.id) AS 'count_student' 
          FROM student 
          JOIN course ON course.courseid = student.course_id 
          WHERE student.isActive = 1";

// Append conditions if provided
if (!is_null($type)) {
    $query .= " AND course.nvqnon = $type";
}

if (!is_null($year)) {
    $query .= " AND student.year = '$year'";
}

if (!is_null($batch)) {
    $query .= " AND student.batch = $batch";
}
 
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_student'];
    }
    
    

 public function getDropoutStudentsCountByYear($year)
    {
        $query = "SELECT count(`id`) as 'count_student' FROM `student` WHERE `year` =  '" . $year . "'   AND `isActive` = 1";

        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_student'];
    }
    
     


    public function getCountAllStudentsby($year, $batch, $course_id)
    {
        $query = "SELECT count(`id`) as 'count_student' FROM `student` WHERE `course_id` LIKE '" . $course_id . "' AND `year` =  '" . $year . "' AND `batch` = " . $batch . " AND `isActive` = 0";
 


        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_student'];
    }


    public function getEnrolledCoursesCountByYearAndBatch($year, $batch)
    {
        $query = "SELECT count(DISTINCT `course_id`) as 'count_course' FROM `student` WHERE `year` =  '" . $year . "' AND `batch` = " . $batch . "";

        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_course'];
    }

    public function getStudentsByCourseAndCenterId($center, $course)
    {

        $query = "SELECT * FROM `student` WHERE `centercode` LIKE  '" . $center . "' AND `course_id` LIKE '" . $course . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }


    //update practical mark
    public function updateStudentPracticalMark($course)
    {

        $query = "SELECT * FROM `student` WHERE `course_id` ='" . $course . "' AND `year` = '2023'";
        // $query = "SELECT * FROM `student` WHERE `course_id` ='" . $course . "' AND `year` = '2023' AND `batch`=2";




        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        foreach ($array_res as $student) {
            $marks = $student['practical_mark'];


            if ($marks >= 50) {
                $grade = 'Pass';
            } else {
                $grade = 'Repeat';
            }




            $query1 = "UPDATE  `exam_students` SET "
                . "`practical_marks` ='" . $marks . "', "
                . "`practical_grade` ='" . $grade . "' "
                . "WHERE `student_id` = '" . $student['id'] . "'";

            $result2 = $db->readQuery($query1);
        }
    }


    //update mcq mark
    public function updateMcqStudentMark($exam_id)
    {


        $query = "SELECT distinct(student_id) FROM `exam_student_questions` WHERE `exam_id` = '$exam_id'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }

        foreach ($array_res as $student) {
            $query1 = "SELECT * FROM `exam_students` WHERE `student_id` = '" . $student['student_id'] . "'";
            $result1 = mysqli_fetch_array($db->readQuery($query1));

            if (!$result1) {
                $query2 = "INSERT INTO `exam_students`(`student_id`, `exam_id`) VALUES ('" . $student['student_id'] . "', '" . $exam_id . "')";
                $result = $db->readQuery($query2);
            }
        }
    }
    public function getStudentCountForExam($year, $batch, $course_id, $centercode)
    {
        $query = "SELECT count(`id`) as 'count_student' FROM `student` WHERE `course_id` =  '" . $course_id . "' AND `year` =  '" . $year . "' AND `batch` = " . $batch . " AND  `centercode` = $centercode AND `isActive` = 0";
 

        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_student'];
    }
    public function checkCertificateNoIsExist($certificate_no)
    {
        $query = "SELECT * FROM `student` WHERE `certificate_no` LIKE  '" . $certificate_no . "'";



        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }
    
public static function getPendingCertificateCountByCenterCourseYearBatch($courseId, $year, $batch)
{
    $query = "SELECT COUNT(DISTINCT s.id) AS total
FROM `student` s
INNER JOIN `exam_students` es ON es.student_id = s.id
INNER JOIN `schedule_exam` se ON se.id = es.exam_id
WHERE s.course_id = '$courseId'
  AND se.year = '$year'
  AND se.batch = '$batch'
  AND (s.certificate_no IS NULL OR s.certificate_no = '')
  AND (es.grade != 'Repeat') ";
 
 
    $db = new Database();
    $result = $db->readQuery($query);
    $row = mysqli_fetch_array($result);

    return $row['total'];
}

    public function getIssuedCertificateCountByCenterCourseYearBatch($course_id, $center_id, $year, $batch)
    {
        $query = "SELECT count(`id`) as 'count_student' FROM `student` WHERE `course_id` =  '" . $course_id . "' AND `centercode` = '" . $center_id . "' AND `year` =  '" . $year . "' AND `batch` = " . $batch . " AND `certificate_no` IS NOT NULL AND `certificate_no` != '' AND `isActive` = 0";

        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['count_student'];
    }
}
