<?php 


abstract class Observable_Model extends Model implements Observable {

protected $observersArray = [];
protected $updateData = [];

//Attach an observer to the array
public function attach(Observer $observer){

	$this->observersArray[] = $observer;

}

//Remove an observer from the array
public function detach(Observer $observer){

	$this->observersArray = array_filter($this->observersArray, function ($a) use ($observerableObj) { 
														return ( !( $a == $observerableObj) ); 
														});

}

//Notify all of the observers of changes
public function notify(){

	foreach($this->observersArray as $obs){
		$obs->update($this);	
	}

}

//Return updateData array
public function giveUpdateData(){

return $this->updateData;

}

//Update changed data (CHECK THIS IN CASE STUFF GOES WRONG, COULD MEAN THE VARIABLE IS THE WRONG ONE)
public function updateChangedData($data){

	$this->updateData = $data;

}

//Get all records from the JSON file and returns them in a multi-dimensional associative array
abstract public function getAll() : array;
abstract public function getRecord(string $id) : array;

/*$str = file_get_contents("data/courses.json");
$json = json_decode($str, true);

return $json;*/
}
?>