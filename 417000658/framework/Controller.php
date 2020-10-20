<?php 

abstract class Controller{

protected $observableModel = null;
protected $view = null;
    
public function setModel(Observable_Model $m){
    
    $this->observableModel = $m;
    
}
    
public function setView(View $v){
    
     $this->view = $v;
    
}

abstract public function run();

}

?>