<?php 

class SignUpModel extends Observable_Model{

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

    public function storeUserData(string $name, string $email, string $password) : bool{

        if(!empty($name) && !empty($email) && !empty($password)){

            //Get users json file as an array to append new user
            $userData = $this->getAll();

            //Hash new users password
            $newPasswordHash = password_hash($password, PASSWORD_DEFAULT);

            //Pushback new user info into user array
            $userData['users'][] = ["Name" => $name, "Email" => $email, "Password" => $newPasswordHash];

            //Encode the array into json format
            $json = json_encode($userData, true);

            //Write to the users file
            file_put_contents(DATA_DIR . '/users.json' ,$json);

            return true;

        }

        return false;

    }



}

?>