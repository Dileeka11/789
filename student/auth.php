<?php
 

if (!isset($_SESSION)) {
    session_start();
}

$USER = new Student(NULL);
if (!$USER->authenticate()) {
    redirect('login.php');
}

 