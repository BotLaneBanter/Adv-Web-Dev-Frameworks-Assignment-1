<?php 
require "config.php";
require 'autoload.php';

    $coursesController = new CoursesController();
    $coursesController->run();

?>