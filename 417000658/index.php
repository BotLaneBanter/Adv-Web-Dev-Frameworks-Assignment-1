<?php 
require "config.php";
require 'autoload.php';

    $controller = new IndexController();
    $controller->run();

?>