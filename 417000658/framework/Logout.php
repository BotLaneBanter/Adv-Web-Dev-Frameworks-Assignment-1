<?php 

class Logout{

  public function logOutUser()
{
    $session = new SessionClass();
   // $session->create();
    $session->remove('Email');
    $session->destroy();
    header('Location: index.php');
}


}

?>