<?php 

class LoginController extends Controller{

    public function run(){
    
        //Create new validae object
        $validate = new Validate();

        //Set the webpage template to be displayed
        if(!isset($this->view)){
        $view = new View();
        $view->setTemplate(TPL_DIR . '/login.tpl.php');

        //Set the view to the previously created view object
        $this->setView($view);
        }

        //Set the model to a new Observable_Model object
        if(!isset($this->observableModel)){
        $this->setModel(new LoginModel);
        }
        

        //Attach the view to the observable_model so the view can recieve updates from it
        $this->observableModel->attach($this->view);
        //If data is needed from the model, get the array of data
        //(In this case it returns the multi-dimensional array of users)
        $data = $this->observableModel->getAll();

        if(isset($_POST['login'])){

            $userRecord = $this->observableModel->getRecord($_POST['email']);
            $hashedPassword = "";
            $hashedPassword = $userRecord['users']['Password'];

            $validate->isEmailValid($_POST['email']);
            $validate->isPasswordValid($_POST['password']);
            $validate->passwordHashMatch($_POST['password'], $hashedPassword);
                
                if(!$validate->getErrorThrown()){

                    $session = new SessionClass();
                    $session->create();
                    $session->add("Email", $_POST['email']);
                    header('Location: profile.php');
                }
                else{
                    $errors['Errors'] = "Invalid email/password";
                    $this->view->addVar("Errors", $errors);
                }

            //Tell the model to update the data which changed
            $this->observableModel->updateChangedData($data);  
        
            //Tell the model to notify it's attached observers, pushing the updated data to them
            $this->observableModel->notify();

            }
            else{
            
                //Tell the model to update the data which changed
                $this->observableModel->updateChangedData($data);  
            
                //Tell the model to notify it's attached observers, pushing the updated data to them
                $this->observableModel->notify();

            }

        
    }

}
?>