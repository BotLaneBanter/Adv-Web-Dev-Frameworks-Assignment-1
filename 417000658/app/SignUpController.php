<?php 

class SignUpController extends Controller{

    public function run(){

        //Set the webpage template to be displayed
        $view = new View();
        $view->setTemplate(TPL_DIR . '/signup.tpl.php');

        //Set the view to the previously created view object
        $this->setView($view);


        //Set the model to a new Observable_Model object
        $this->setModel(new SignUpModel);
    
        //Attach the view to the observable_model so the view can recieve updates from it
        $this->observableModel->attach($this->view);
        //If data is needed from the model, get the array of data
        //(In this case it returns the sorted multi-dimensional array of popular/recommended courses)
        $data = $this->observableModel->getAll();

        //Error variable
        $errorExists = false;

        //Check if the register button was clicked
        if(isset($_POST['SignUp'])){

            //UNUSED
            //Create the controllers
            $loginController = new LoginController();

            //Create models
            // $loginModel = new LoginModel();

            //Create and set the different views
            //Login
            $loginView = new View();
            $loginView->setTemplate(TPL_DIR . '/login.tpl.php');

            //Set controller views
            $loginController->setView($loginView);
            //UNUSED
            

            //Create new validae object
            $validate = new Validate();


            $userRecord = $this->observableModel->getRecord($_POST['email']);
            $hashedPassword = "";
            $hashedPassword = $userRecord['users']['Password'];

            //Get user record
            $userData = $this->observableModel->getRecord($_POST['email']);

            $validate->isEmailValid($_POST['email']);
            $validate->isPasswordValid($_POST['password']);
                
                //Check the full name isn't empty
                if(empty($_POST['formFullName'])){
                    $fullNameError['Errors'] = "Please Enter Your Name";
                    $this->view->addVar("Errors", $fullNameError);
                    $errorExists = true;
                }
                //Check a valid email was entered
                else if($validate->getErrorEmailThrown()){
                    $emailError['Errors'] = "Invalid Email";
                    $this->view->addVar("Errors", $emailError);
                    $errorExists = true;
                }
                //Check a valid password was entered
                else if($validate->getErrorPasswordThrown()){
                    $passwordError['Errors'] = "Invalid Password";
                    $this->view->addVar("Errors", $passwordError);
                    $errorExists = true;
                }
                //Check the password matches the retyped password
                else if(($_POST['password']) != ($_POST['retypedPassword'])){
                    $mismatchError['Errors'] = "Passwords Do Not Match";
                    $this->view->addVar("Errors", $mismatchError);
                    $errorExists = true;
                }
                //Check the terms checkbox was ticked
                else if(!isset($_POST['termsCheckbox'])){
                    $termsError['Errors'] = "Please Read And Accept The Terms";
                    $this->view->addVar("Errors", $termsError);
                    $errorExists = true;
                }
                //Check the users email isn't already in use
                else if($_POST['email'] == $userData['users']['Email']){
                    $termsError['Errors'] = "Account Already Exists";
                    $this->view->addVar("Errors", $termsError);
                    $errorExists = true;
                }
                //If successful, run the loginController
                else if( (!$validate->getErrorEmailThrown()) && (!$validate->getErrorPasswordThrown())){

                    //Successful Sign Up Message
                    $successfulSignUp['successfulSignUp'] = "Sign Up Successful. Please login below";

                    $this->observableModel->storeUserData($_POST['formFullName'], $_POST['email'], $_POST['password']);

                    //FOR NOW WILL NEED TO ADD THE NEW USER EMAILS MANUALLY TO THE ACCESSIBLE ARRAY IN SessionClass.php
                    $successMessage = http_build_query($successfulSignUp);
                    header("Location: login.php" . "?" . $successMessage);
                    //require "login.php";

                }
                    
                if($errorExists == true){
                    //Tell the model to update the data which changed
                    $this->observableModel->updateChangedData($data);  
                        
                    //Tell the model to notify it's attached observers, pushing the updated data to them
                    $this->observableModel->notify();
                }

        }//End of POST check
        else{

            //Tell the model to update the data which changed
            $this->observableModel->updateChangedData($data);  
                
            //Tell the model to notify it's attached observers, pushing the updated data to them
            $this->observableModel->notify();
    }
    
}//End of run()

}
?>