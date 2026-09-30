<?php

class CourseSyllabus {

    public $id;
    public $course_id;
    public $title; 
    public $syllabus;

    public function __construct($id) {
        if ($id) {
            $query = "SELECT `id`, `course_id`,`title`, `syllabus` FROM `course_syllabus` WHERE `id`=" . $id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->course_id = $result['course_id'];
            $this->syllabus = $result['syllabus'];
        }
    }

    public function create() {
        $query = "INSERT INTO `course_syllabus` (`title`,`course_id`, `syllabus`) VALUES ('"
                 . $this->title . "', '" 
                . $this->course_id . "', '"
                . $this->syllabus . "')";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update() {
        $query = "UPDATE `course_syllabus` SET "
                . "`title` = '" . $this->title . "', "
                . "`course_id` = '" . $this->course_id . "', "
                . "`syllabus` = '" . $this->syllabus . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function all() {
        $query = "SELECT * FROM `course_syllabus`";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    
    
    public function getByCourseId($course_id) {
        
        $query = "SELECT * FROM `course_syllabus` WHERE `course_id` LIKE '" . $course_id . "'";
 

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }
    

    public function delete() {
        $query = 'DELETE FROM `course_syllabus` WHERE `id`="' . $this->id . '"';
        $db = new Database();
        return $db->readQuery($query);
    }
}
