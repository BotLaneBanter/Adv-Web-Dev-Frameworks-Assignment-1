<?php 

require "config.php";
require 'autoload.php';

$controller = new SignUpController();
$controller->run();

?>