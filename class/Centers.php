<?php

class Centers {

    public $centercode;
    public $districid;
    public $center_name;
    public $province;

    public function __construct($centercode) {
        if ($centercode) {

            $query = "SELECT  * FROM `training_centre` WHERE `centercode`=" . $centercode;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            $this->centercode = $result['centercode'];
            $this->districid = $result['districid'];
            $this->center_name = $result['center_name'];
            $this->province = $result['province'];
        }
    }

   public function create() {

        $query = "INSERT INTO `training_centre` (`centercode`,`center_name`,`districid`,`province`) VALUES  ('"
                . $this->centercode . "', '"
                . $this->center_name . "', '"
                . $this->districid . "', '"
                . $this->province . "')";
 
        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update() {

        $query = "UPDATE  `training_centre` SET "
                . "`center_name` ='" . $this->center_name . "' "
                . "WHERE `centercode` = '" . $this->centercode . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->centercode);
        } else {
            return FALSE;
        }
    }

    public function all() {
        $query = "SELECT * FROM `training_centre` ORDER BY `center_name` ASC; ";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    public function getCentersByDistrictId($district_id) {
        $query = "SELECT * FROM `training_centre` WHERE `districid` = $district_id";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
     public function getCenterLastId() {

        $query = "SELECT * FROM `training_centre` ORDER BY `centercode` DESC LIMIT 1";

        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['centercode'];
    }
    

    public function delete() {
        $query = 'DELETE FROM `training_centre` WHERE centercode="' . $this->centercode . '"';
        $db = new Database();
        return $db->readQuery($query);
    }
    
    
    
    public function getCenterCourseIdForExam($year,$batch , $center) {
 

if($center == 1){
    
     $query = "SELECT * FROM `training_centre` ORDER BY `center_name` ASC";
     $db = new Database();
     $result = $db->readQuery($query);
        
         $html ='<thead>
                 <tr class="bg-transparent"> 
                 <th>No </th>
                 <th colspan="1"> Course Name </th>
                 <th> Total Student </th>
                 <th> Pass Student </th>
                 <th> Repeat Student </th>
                 <th> AB Student </th>
                 <th> Certificates Issued </th>
                 </tr>
                 </thead>
                 <tbody>';

        while ($row = mysqli_fetch_array($result)) {
           
          $html .='<tr>
                    <td colspan="7" class="text-center text-danger">'.$row["center_name"].'</td>
                 </tr>';
                 
            $CENTER_COURSE = new CenterCourses(null);
            $STUDENTS =  new Student(null);
           $EXAM_STUDENTS = new ExamStudent(null);
             
        foreach($CENTER_COURSE->getcourseDetailsCenters($row["centercode"]) as $key=>$course){
       
        
         $total_student = $STUDENTS->getStudentCountForExam($year,$batch,$course["courseid"],$row["centercode"]);
         
        // $total_pass_students = $EXAM_STUDENTS->getPassStudentCount($year, $batch, $course["courseid"],$row["centercode"]);
       // $total_faill_students = $EXAM_STUDENTS->getFaillStudentCount($year, $batch, $course["courseid"],$row["centercode"]);
       
        $total_pass_students = $EXAM_STUDENTS->getPassStudentCountByCourse($row["centercode"],$course["courseid"],$year, $batch);
        $total_faill_students = $EXAM_STUDENTS->getFailStudentCountByCourse($row["centercode"],$course["courseid"],$year, $batch);
  
   
        $key++;
              $html .='<tr>
                        <td> '.$key.' </td> 
                        <td> '.$course["courseid"] .' - '.$course["cname"].'</td>
                        <td>  '.$total_student.'</td>
                        <td> '.$total_pass_students.' </td>
                        <td> '.$total_faill_students.'</td>
                         <td> '.$total_student - ($total_faill_students +$total_pass_students).'</td>
                         <td> '.$STUDENTS->getIssuedCertificateCountByCenterCourseYearBatch($course["courseid"], $row["centercode"], $year, $batch).'</td>
                     </tr>';
        }
        
        
        }
        
        
         $html .= '</tbody>
         </tr>';

        return   $html;
}else{
    
    
     $query = "SELECT * FROM `training_centre` WHERE `centercode`=" . $center;
 
        $db = new Database();

        $result = $db->readQuery($query);
        

         $html ='<thead>
         
                 <tr class="bg-transparent"> 
                 <th>No </th>
                 <th colspan="1"> Course Name </th>
                 <th> Total Student </th>
                 <th> Pass Student </th>
                 <th> Repeat Student </th>
                 <th> AB Student </th>
                 <th> Drop Out </th>
                 <th> Certificates Issued </th>
                 </tr>
                 </thead>
                 <tbody>';

        while ($row = mysqli_fetch_array($result)) {
           
            
           $html .='<tr>
                    <td colspan="8" class="text-center text-danger">'.$row["center_name"].'</td>
                 </tr>';
                 
            $CENTER_COURSE = new CenterCourses(null);
            $STUDENTS =  new Student(null);
            $EXAM_STUDENTS = new ExamStudent(null);
            
        foreach($CENTER_COURSE->getcourseDetailsCenters($center) as $key=>$course){
      
        $total_student = $STUDENTS->getStudentCountForExam($year,$batch,$course["courseid"],$row["centercode"]);
        $total_pass_students = $EXAM_STUDENTS->getPassStudentCount($year, $batch, $course["courseid"],$row["centercode"]);
        $total_faill_students = $EXAM_STUDENTS->getFaillStudentCount($year, $batch, $course["courseid"],$row["centercode"]);
        $drop_out = $STUDENTS->getStudentIDArrayByCourseAndBatchWithDropCount($course["courseid"],$year,$batch,$row["centercode"]);
        $key++;
               $html .='<tr>
                        <td> '.$key.' </td> 
                        <td> '.$course["courseid"] .' - '.$course["cname"].'</td>
                        <td>  '.$total_student.'</td>
                        <td> '.$total_pass_students.' </td>
                        <td> '.$total_faill_students.'</td>
                        <td> '.$total_student - ($total_faill_students +$total_pass_students).'</td>
                        <td> '.$drop_out.' </td>
                        <td> '.$STUDENTS->getIssuedCertificateCountByCenterCourseYearBatch($course["courseid"], $row["centercode"], $year, $batch).'</td>
                     </tr>';
}
           
        }
         $html .= '</tbody>
         </tr>';
      

        return   $html;
}
       
    }
    
    
}
