<?php

class SessionClass{
	
	//Hard coded for now to just manage the session and the respective users
	protected $access = ['profile'=>['tester@comp3170.com','bobross@gmail.com', 'joseph.hewitt@mycavehill.uwi.edu', 'test.user@mycavehill.uwi.edu'], 'courses' => ['tester@comp3170.com','bobross@gmail.com', 'joseph.hewitt@mycavehill.uwi.edu', 'test.user@mycavehill.uwi.edu']];

public function create() : void
{
	session_start();
}

public function destroy() : void 
{
	session_start();
	setcookie('key', time() - 3600);
	session_unset();
	session_destroy();

}

public function add($name, $value)
{
	if(isset($_SESSION)){
		$_SESSION[$name] = $value;
	}

}

public function receive($name){

	if(isset($_SESSION[$name])){
		return $_SESSION[$name];
	}
	return null;

}

public function remove($name){

	if(isset($_SESSION[$name])){
		unset($_SESSION[$name]);
	}
}

public function accessible($user, $page) : bool {

	if(isset($_SESSION)){
		if(in_array($user, $this->access[$page])){
			return true;
		}
	}
	return false;

}
	
}