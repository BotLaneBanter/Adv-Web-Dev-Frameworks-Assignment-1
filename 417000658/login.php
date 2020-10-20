<?php 

require "config.php";
require 'autoload.php';

if(!isset($loginController)){
    $loginController = new LoginController();
}
$loginController->run();

?>