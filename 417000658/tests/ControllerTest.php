<?php
use PHPUnit\Framework\TestCase;
require "config.php";
require 'autoload.php';

class controllerHelper extends Controller{

    public function run(){



    }

    public function getModel(){

        return $this->observableModel;

    }

    public function getView(){

        return $this->view;

    }

}

class ControllerTest extends TestCase{

    public function testControllerObjectIsCreated(){

        $controller = new controllerHelper();
        $this->assertIsObject($controller);

    }

    public function testSetModel(){

        $model = new SignUpModel();
        $controller = new controllerHelper();
        $controller->setModel($model);
        $this->assertIsObject($controller->getModel());

    }

    public function testSetView(){

        $view = new View();
        $controller = new controllerHelper();
        $controller->setView($view);
        $this->assertIsObject($controller->getView());

    }


}

?>