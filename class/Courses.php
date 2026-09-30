<?php

/**
 * Description of User
 *
 * @author Suharshana DsW
 * @web www.nysc.lk
 */
class Courses
{

    public $id;
    public $course_type;
    public $name;
    public $course_id;
    public $max_student;
    public $nvq;
    public $duration_type;
    public $languages;
    public $image_name;
    public $level;
    public $duration;
    public $start_date;
    public $short_description;
    public $description;
    public $queue;

    public function __construct($id)
    {

        if ($id) {

            $query = "SELECT * FROM `courses` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->course_type = $result['course_type'];
            $this->name = $result['name'];
 	    $this->course_id = $result['course_id'];
            $this->max_student = $result['max_student'];
            $this->nvq = $result['nvq'];
            $this->duration_type = $result['duration_type'];
            $this->languages = $result['languages'];
            $this->image_name = $result['image_name'];
            $this->level = $result['level'];
            $this->duration = $result['duration'];
            $this->start_date = $result['start_date'];
            $this->short_description = $result['short_description'];
            $this->description = $result['description'];
            $this->queue = $result['queue'];

            return $result;
        }
    }


    public function create()
    {

        $query = "INSERT INTO `courses` (`course_type`,`name`,`max_student`,`nvq`,`duration_type`,`languages`,`image_name`,`level`,`duration`,`start_date`,`short_description`,`description`) VALUES  ('"
            . $this->course_type . "','"
            . $this->name . "','"
            . $this->max_student . "', '"
            . $this->nvq . "', '"
            . $this->duration_type . "', '"
            . $this->languages . "', '"
            . $this->image_name . "', '"
            . $this->level . "', '"
            . $this->duration . "', '"
            . $this->start_date . "', '"
            . $this->short_description . "', '"
            . $this->description . "')";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    public function getOne($course)
    {
        $query = "SELECT * FROM `courses` WHERE  id = " . $course;

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res[0];
    }

    public function getByCenter($center)
    {
        $query = "SELECT 
        -- *
         cou.id , cou.course_type, cou.name, cou.max_student, cou.nvq, cou.duration_type, cou.level, cou.languages, cou.duration, cou.start_date, cou.short_description, cou.description, cou.image_name, cou.queue
        
         FROM  course_by_centers cbc JOIN courses cou  on(cbc.course_id=cou.id) WHERE cbc.center_id = " . $center ." ORDER BY cou.queue ASC";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function all()
    {

        $query = "SELECT * FROM `courses` ORDER BY queue ASC";

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

        $query = "UPDATE  `courses` SET "
            . "`course_type` ='" . $this->course_type . "', "
            . "`name` ='" . $this->name . "', "
            . "`course_id` ='" . $this->course_id . "', "
            . "`max_student` ='" . $this->max_student . "', "
            . "`nvq` ='" . $this->nvq . "', "
            . "`duration_type` ='" . $this->duration_type . "', "
            . "`image_name` ='" . $this->image_name . "', "
            . "`languages` ='" . $this->languages . "', "
            . "`level` ='" . $this->level . "', "
            . "`duration` ='" . $this->duration . "', "
            . "`start_date` ='" . $this->start_date . "', "
            . "`short_description` ='" . $this->short_description . "', "
            . "`description` ='" . $this->description . "' "
            . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {

            return FALSE;
        }
    }

public function getLimited($offset, $limit)
{
    $query = "SELECT * FROM `courses` ORDER BY `queue` ASC LIMIT $offset, $limit";

    $db = new Database();
    $result = $db->readQuery($query);

    $array_res = array();
    while ($row = mysqli_fetch_array($result)) {
        array_push($array_res, $row);
    }
    return $array_res;
}


    public function delete()
    {
        $query = 'DELETE FROM `courses` WHERE id="' . $this->id . '"';
        $db = new Database();
        return $db->readQuery($query);
    }


    public function arrange($key, $img)
    {
        $query = "UPDATE `courses` SET `queue` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }


    //
    //    public function delete() {
    //
    //
    //
    //        $this->deletePhotos();
    //
    //
    //
    //        unlink(Helper::getSitePath() . "upload/service/" . $this->image_name);
    //
    //
    //
    //        $query = 'DELETE FROM `service` WHERE id="' . $this->id . '"';
    //
    //
    //
    //        $db = new Database();
    //
    //
    //
    //        return $db->readQuery($query);
    //    }
}
