<?php 
require "config.php";
require 'autoload.php';

    $profilecontroller = new ProfileController();
    $profilecontroller->run();

?>