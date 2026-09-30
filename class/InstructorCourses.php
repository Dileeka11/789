<?php

/**
 * Description of InstructorCourses
 *
 * @author W j K n``
 * @web www.nysc.lk
 */
class InstructorCourses
{

    public $id;
    public $user_id;
    public $courses;

    public function __construct($id)
    {

        if ($id) {

            $query = "SELECT `id`,`user_id`,`courses` FROM `instructor_courses` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->user_id = $result['user_id'];
            $this->courses = $result['courses'];

            return $result;
        }
    }

    public function create()
    {

        $query = "INSERT INTO `instructor_courses` (`user_id`, `courses`) VALUES  ('"
            . $this->user_id . "','"
            . $this->courses . "')";
// dd($query);
        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getInstructorCourses($user_id)
    {
        $query = "SELECT * FROM `instructor_courses` WHERE `user_id` = $user_id";
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }

    public function update()
    {

        $query = "UPDATE  `instructor_courses` SET "
            . "`courses` ='" . $this->courses . "' "
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
        $query = 'DELETE FROM `instructor_courses` WHERE id="' . $this->id . '"';
        $db = new Database();
        return $db->readQuery($query);
    }
}
