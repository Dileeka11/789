<?php

/**
 * Description of CourseModule
 *
 * @author W j K n``
 * @web www.nysc.lk
 */
class CourseModule
{

    public $id;
    public $course_id;
    public $name;
    public $code;

    public function __construct($id)
    {

        if ($id) {

            $query = "SELECT `id`,`course_id`,`name`,`code` FROM `course_modules` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->course_id = $result['course_id'];
            $this->name = $result['name'];
            $this->code = $result['code'];

            return $result;
        }
    }

    public function create()
    {

        $query = "INSERT INTO `course_modules` (`course_id`, `name`, `code`) VALUES  ('"
            . $this->course_id . "','"
            . $this->name . "','"
            . $this->code . "')";
// dd($query);
        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getModulesByCourse($course_id)
    {
        $query = "SELECT * FROM `course_modules` WHERE `course_id` = '" . $course_id . "'";
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

        $query = "UPDATE  `course_modules` SET "
            . "`name` ='" . $this->name . "', "
            . "`code` ='" . $this->code . "' "
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
        $query = 'DELETE FROM `course_modules` WHERE id="' . $this->id . '"';
        $db = new Database();
        return $db->readQuery($query);
    }
}
