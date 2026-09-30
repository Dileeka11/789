<?php

/**
 * Description of CourseModule
 *
 * @author W j K n``
 * @web www.nysc.lk
 */
class ExamPeriod
{

    public $id;
    public $year;
    public $batch;
    public $qu_count;
    public $batch_start_date;
    public $batch_end_date;
    public $certificate_issued_date;
    public $name_edit_status;
    public $practical_mark_status;
    public $certificate_count;
    public $printed_count;
    public $is_result_release; 
    
    
    public function __construct($id)
    {

        if ($id) {

            $query = "SELECT * FROM `exam_periods` WHERE `id`=" . $id;


            $db = new Database();

            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->year = $result['year'];
            $this->batch = $result['batch'];
            $this->qu_count = $result['qu_count'];
            $this->batch_start_date = $result['batch_start_date'];
            $this->batch_end_date = $result['batch_end_date'];
            $this->certificate_issued_date = $result['certificate_issued_date'];
            $this->name_edit_status = $result['name_edit_status'];
            $this->practical_mark_status = $result['practical_mark_status'];
            $this->certificate_count = $result['certificate_count'];
            $this->printed_count = $result['printed_count'];
            $this->is_result_release = $result['is_result_release'];


            return $result;
        }
    }

    public function create()
    {

        $query = "INSERT INTO `exam_periods` (`year`, `batch`,`batch_start_date`,`batch_end_date`, `certificate_issued_date`) VALUES  ('"
            . $this->year . "','"
            . $this->batch . "','"
            . $this->batch_start_date . "','"
            . $this->batch_end_date . "','"
            . $this->certificate_issued_date . "')";
        // dd($query);
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
        $query = "SELECT * FROM `exam_periods` ORDER BY `year` ASC, `batch` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function update()
    {

        $query = "UPDATE  `exam_periods` SET "
            . "`year` ='" . $this->year . "', "
            . "`batch` ='" . $this->batch . "', "
            . "`certificate_issued_date` ='" . $this->certificate_issued_date . "', "
            . "`batch_start_date` ='" . $this->batch_start_date . "', "
            . "`name_edit_status` ='" . $this->name_edit_status . "', "
            . "`practical_mark_status` ='" . $this->practical_mark_status . "', "
            . "`batch_end_date` ='" . $this->batch_end_date . "' "
            . "WHERE `id` = '" . $this->id . "'";
 
        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {

            return TRUE;
        } else {

            return FALSE;
        }
    }
    public function updateCertificatePrintedCount()
    {

        $query = "UPDATE  `exam_periods` SET "
            . "`printed_count` ='" . $this->printed_count . "' "
            . "WHERE `id` = '" . $this->id . "'";
 
        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {

            return TRUE;
        } else {

            return FALSE;
        }
    }
    
     

    public function delete()
    {
        $query = 'DELETE FROM `exam_periods` WHERE id="' . $this->id . '"';
        $db = new Database();
        return $db->readQuery($query);
    }
    
    
    public function getExamPeriodByYearAndBatch($year, $batch)
    {
        $query = "SELECT * FROM `exam_periods` WHERE `year` = $year AND `batch` = $batch ORDER BY `id` DESC LIMIT 1";
       
        
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }
    
   
    public function getExamPeriodByYear($year)
    {
        $query = "SELECT * FROM `exam_periods` WHERE `year` = $year AND `batch` = $batch ORDER BY `id` DESC LIMIT 1";
       
        
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }
    
    public function getExamBatch($year)
    {
        $query = "SELECT * FROM `exam_periods` WHERE `year` = $year AND  ORDER BY `year` ASC, `batch` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
}
