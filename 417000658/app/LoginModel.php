<?php 

class LoginModel extends Observable_Model{

    public function getAll() : array {

        //Get all contents of users.json file
        $userData = $this->loadData(DATA_DIR . '/users.json');

        //Return an associative multidimensional array of users
        return $userData;

    }

    public function getRecord(string $id) : array {

        $userData = $this->loadData(DATA_DIR . '/users.json');

        if(!empty($userData)){

            //Find the key corresponding to the id (email = id in this case) of the user
            $key = array_search($id, array_column($userData['users'], 'Email'));

            //Check if the email at that position is equal
            if($userData['users'][$key]['Email'] == $id){
                return ['users' => [ 'Name' => $userData['users'][$key]['Name'], 'Email' => $userData['users'][$key]['Email'], 'Password' => $userData['users'][$key]['Password']] ];
            }

        }

        return ['users' => [ 'Name' => '', 'Email' => '', 'Password' => '']];

    }



}

?>