<?php

/**
 * Description of AnnualFund
 *
 * @author Suharshana DsW
 */
class AnnualFund {

    public $id;
    public $year;
    public $type;
    public $amount;
    public $datetime;

    // Constructor to load data by id
    public function __construct($id) {
        if ($id) {
            $query = "SELECT `id`, `year`, `type`, `amount`, `datetime` FROM `annual_fund` WHERE `id` = " . $id;

            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->year = $result['year'];
            $this->type = $result['type'];
            $this->amount = $result['amount'];
            $this->datetime = $result['datetime'];

            return $this;
        }
    }

    
    public function create() {
        $query = "INSERT INTO `annual_fund` (`year`, `type`, `amount`, `datetime`) VALUES ('"
                . $this->year . "', '"
                . $this->type . "', '"
                . $this->amount . "', '"
                . $this->datetime . "')";

        $db = new Database();
        $result = $db->readQuery($query);

        return $result ? true : false;
    }

    
    public function all() {
        $query = "SELECT `id`, `year`, `type`, `amount`, `datetime` FROM `annual_fund` ORDER BY `datetime` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

public function getByYear($year) {
    
        $query = "SELECT * FROM `annual_fund` WHERE `year` = '".$year."'  ORDER BY `datetime` DESC";
        
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    public function getByTypeAndYear($type, $year) {
    
        $query = "SELECT * FROM `annual_fund` WHERE  `type` = '".intval($type)."' AND `year` = '".$year."'  ";
        
       
        
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    

  public function getFundByType($fund_type_id,$year) {
      
    $query = "SELECT `amount` FROM `annual_fund` WHERE `type` = '".intval($fund_type_id)."' AND `year` = '".$year."' ORDER BY `datetime` DESC LIMIT 1";
   
    
    $db = new Database();
    $result = mysqli_fetch_assoc($db->readQuery($query));

    return $result ? $result : false;
}

 

  public static function getAnnualFundsByYearAndType($year, $type) {
      
      
    $query = "SELECT COUNT(*) as count FROM `annual_fund` WHERE `year` = '" . $year . "' AND `type` = $type";

    $db = new Database();
    $result = $db->readQuery($query);
    
    $row = mysqli_fetch_array($result);
    return $row['count']; // Returns the count of records
}


    // Update annual fund details
    public function update() {
        $query = "UPDATE `annual_fund` SET "
                . "`year` ='" . $this->year . "', "
                . "`type` ='" . $this->type . "', "
                . "`amount` ='" . $this->amount . "', "
                . "`datetime` ='" . $this->datetime . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        $result = $db->readQuery($query);

        return $result ? $this->__construct($this->id) : false;
    }

    // Delete an annual fund entry
    public function delete() {
        $query = 'DELETE FROM `annual_fund` WHERE id="' . $this->id . '"';

        $db = new Database();
        return $db->readQuery($query);
    }

    // Arrange annual fund by amount (or another field)
    public function arrangeByAmount($key) {
        $query = "UPDATE `annual_fund` SET `amount` = '" . $key . "' WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        return $db->readQuery($query);
    }
    
  



}
?>
