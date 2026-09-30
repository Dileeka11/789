<?php

/**
 * Description of Application
 *
 * @author Kavini Nisansala
 * @web www.nysc.lk
 */
class StudentPayment {

    public $id;
    public $student_id;
    public $payment_amount;
    public $reg_amount;
    public $payment_date;
    public $payment_completed; 

    public function __construct($payment_date) {

        if ($payment_date) {

            $query = "SELECT * FROM `student_payment` WHERE `payment_date`='" . $payment_date . "'";

            $db = new Database();

            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->student_id = $result['student_id'];
            $this->payment_amount = $result['payment_amount'];
            $this->reg_amount = $result['reg_amount'];
            $this->payment_date = $result['payment_date'];
            $this->payment_completed = $result['payment_completed']; 


            return $result;
        }
    }

    public function create() {

        $query = "INSERT INTO `student_payment` (`student_id`,`reg_amount`,`payment_amount`,`payment_date`,`payment_completed`) VALUES  ('" 
                . $this->student_id . "', '"
                . $this->reg_amount . "', '"
                . $this->payment_amount . "', '"
                . $this->payment_date . "', '"  
                . $this->payment_completed . "')";
      
        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function all() {
        $query = "SELECT * FROM `student_payment` ORDER BY `payment_amount` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    
    
    public function getPayedAmountByStudent($id) {

        $query = 'SELECT SUM(`payment_amount`) FROM `student_payment` WHERE student_id="' . $id . '"   ORDER BY payment_amount ASC';

        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
         
        return $result[0];
    }
    
    
     public function getStudentPayment($id) {

        $query = 'SELECT * FROM `student_payment` WHERE `student_id` ="' . $id . '"   ORDER BY payment_date ASC';

        $db = new Database();

        $result = $db->readQuery($query);

        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }

        return $array_res;
    }


}
