<?php

class PaymentFund {

    public $id;
    public $year;
    public $fund_type;  
    public $league_type;  
    public $amount;
    public $datetime;

    // Constructor to load data by id
    public function __construct($id) {
        if ($id) {
            $query = "SELECT `id`, `year`, `fund_type`, `league_type`, `amount`, `datetime` FROM `payment_fund` WHERE `id` = " . $id;

            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->year = $result['year'];
            $this->fund_type = $result['fund_type'];   
            $this->league_type = $result['league_type'];   
            $this->amount = $result['amount'];
            $this->datetime = $result['datetime'];

            return $this;
        }
    }

     
    public function create() {
        $query = "INSERT INTO `payment_fund` (`year`, `fund_type`, `league_type`, `amount`, `datetime`) VALUES ('"
                . $this->year . "', '"
                . $this->fund_type . "', '"
                . $this->league_type . "', '"
                . $this->amount . "', '"
                . $this->datetime . "')";

        $db = new Database();
        $result = $db->readQuery($query);

        return $result ? true : false;
    }

     public function all() {
        $query = "SELECT `id`, `year`, `fund_type`, `league_type`, `amount`, `datetime` FROM `payment_fund` ORDER BY `datetime` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

 
     public function getFundByType($fund_type_id, $year) {
         
        $query = "SELECT `amount` FROM `payment_fund` WHERE `fund_type` = '".intval($fund_type_id)."' AND `year` = '".$year."' ORDER BY `datetime` DESC LIMIT 1";
    
    
        $db = new Database();
        $result = mysqli_fetch_assoc($db->readQuery($query));

        return $result ? $result : false;
    }
    
    
    
    public function getAllByYear($year) {
        
        $query = "SELECT * FROM `payment_fund` WHERE `year` = '".$year."' ORDER BY `datetime` DESC";
     
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    

  public static function getFundAmount($fund_type,$league_type , $year) {
        
        $query = "SELECT  `amount` FROM `payment_fund` WHERE `fund_type` = '" . $fund_type . "' AND `league_type` = '" . $league_type . "' AND `year` = '" . $year . "'";
 

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
     public static function getLeagueFundAmount($league_type , $year) {
        
        $query = "SELECT  * FROM `payment_fund` WHERE   `league_type` = '" . $league_type . "' AND `year` = '" . $year . "'";
 

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    
     public static function getFundTypeAmount($fund_type , $year) {
        
        $query = "SELECT  `amount` FROM `payment_fund` WHERE `fund_type` = '" . $fund_type . "' AND  `year` = '" . $year . "'";
 

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
      public static function getFundAllByType($fund_type , $year) {
        
        $query = "SELECT  * FROM `payment_fund` WHERE `fund_type` = '" . $fund_type . "' AND  `year` = '" . $year . "'";
 
  

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
 
     public static function getAnnualFundsByYearAndType($year, $type) {
        $query = "SELECT COUNT(*) as count FROM `payment_fund` WHERE `year` = '" . $year . "' AND `fund_type` = $type";

        $db = new Database();
        $result = $db->readQuery($query);
        
        $row = mysqli_fetch_array($result);
        return $row['count']; 
    }

 
     public function update() {
        $query = "UPDATE `payment_fund` SET "
                . "`year` ='" . $this->year . "', "
                . "`fund_type` ='" . $this->fund_type . "', "
                . "`league_type` ='" . $this->league_type . "', "
                . "`amount` ='" . $this->amount . "', "
                . "`datetime` ='" . $this->datetime . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        $result = $db->readQuery($query);

        return $result ? $this->__construct($this->id) : false;
    }

 
     public function delete() {
        $query = 'DELETE FROM `payment_fund` WHERE id="' . $this->id . '"';

        $db = new Database();
        return $db->readQuery($query);
    }

 
     public function arrangeByAmount($key) {
        $query = "UPDATE `payment_fund` SET `amount` = '" . $key . "' WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        return $db->readQuery($query);
    }
}
?>
