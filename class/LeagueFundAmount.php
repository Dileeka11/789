<?php

/**
 * Description of LeagueTypes
 *
 * @author Suharshana DsW
 */
class LeagueFundAmount {

    public $id;
    public $year;
    public $fund_type;
    public $league_type;
    public $amount;
    public $datetime;

    // Constructor to load data by id
    public function __construct($id = NULL) {
        if ($id) {
            $query = "SELECT `id`, `year`, `fund_type`, `league_type`, `amount`, `datetime` FROM `league_fund_amount` WHERE `id` = " . $id;

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

    // Create a new league fund amount
    public function create() {
        $query = "INSERT INTO `league_fund_amount` (`year`, `fund_type`, `league_type`, `amount`, `datetime`) VALUES ('" . $this->year . "', '" . $this->fund_type . "', '" . $this->league_type . "', '" . $this->amount . "', '" . $this->datetime . "')";

        $db = new Database();
        $result = $db->readQuery($query);

        return $result ? true : false;
    }

    // Get all league fund amounts
    public function all() {
        $query = "SELECT  * FROM `league_fund_amount` ORDER BY `datetime` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

     public static function getByFundType($fund_type) {
        
        $query = "SELECT `id`, `year`, `fund_type`, `league_type`, `amount`, `datetime` FROM `league_fund_amount` WHERE `fund_type` = '" . $fund_type . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    
    public static function getFundAmount($fund_type,$league_type , $year) {
        
        $query = "SELECT  `amount` FROM `league_fund_amount` WHERE `fund_type` = '" . $fund_type . "' AND `league_type` = '" . $league_type . "' AND `year` = '" . $year . "'";
 

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    
    public static function getAllLeagureFundAmount($league_type , $year) {
        
        $query = "SELECT  `amount` FROM `league_fund_amount` WHERE  `league_type` = '" . $league_type . "' AND `year` = '" . $year . "'";
 

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    
    
    
 public static function getByYear($year) {
     
        $query = "SELECT * FROM `league_fund_amount` WHERE `year` = '" . $year . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

 

  public static function getLeagueFundsByYearAndType($year, $type) {
      
      
    $query = "SELECT COUNT(*) as count FROM `league_fund_amount` WHERE `year` = '" . $year . "' AND `league_type` = $type";

    $db = new Database();
    $result = $db->readQuery($query);
    
    $row = mysqli_fetch_array($result);
    return $row['count'];  
}




 public static function getAmountByTypeAndYear($fund_type, $year) {
    $query = "SELECT amount AS total_amount FROM `league_fund_amount` 
              WHERE `fund_type` = '" . $fund_type . "' AND `year` = $year";

 
$db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    
    
    // Update league fund amount details
    public function update() {
        $query = "UPDATE `league_fund_amount` SET "
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

    // Delete a league fund amount
    public function delete() {
        $query = 'DELETE FROM `league_fund_amount` WHERE id="' . $this->id . '"';

        $db = new Database();
        return $db->readQuery($query);
    }
}

?>
