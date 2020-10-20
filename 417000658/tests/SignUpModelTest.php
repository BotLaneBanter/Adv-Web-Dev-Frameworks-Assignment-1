<?php
use PHPUnit\Framework\TestCase;
require "config.php";
require 'autoload.php';



class SignUpModelTest extends TestCase{

    public function testGetAll(){

        $model = new SignUpModel();
        $this->assertIsArray($model->getAll());

    }

    public function testGetRecord(){

        $model = new SignUpModel();
        $this->assertIsArray($model->getRecord("bobross@gmail.com"));

    }

}

?>