<?php
use PHPUnit\Framework\TestCase;
require 'framework/SessionClass.php';

class SessionClassTest extends TestCase{

//Is the SessionManager object created
public function testSessionObjectIsCreated() : void
{

$this->assertIsObject(new SessionClass);	

}

//Check a session object is created

public function testSessionClassSessionIsCreated() : void
{
	SessionClass::create();
	$this->assertIsArray($_SESSION);
	
}

	
}
?>