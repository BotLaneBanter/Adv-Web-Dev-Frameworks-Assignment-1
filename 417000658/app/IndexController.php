<?php 

class IndexController extends Controller{


public function run(){
    
    

    //Check if Login was clicked
		if((isset($_GET['controller'])) && ($_GET['controller'] == 'Login')){
			//require "login.php";
            header('Location: login.php');
        }
        else if((isset($_GET['controller'])) && ($_GET['controller'] == 'SignUp')){
			//require "SignUp.php";
            header('Location: signup.php');
        }
        else if((isset($_GET['controller'])) && ($_GET['controller'] == 'Logout')){
			$logout = new Logout();
            $logout->logOutUser();
        }
    else{

    //Set the webpage template to be displayed
    $view = new View();
    $view->setTemplate(TPL_DIR . '/index.tpl.php');

    //Set the model to a new Observable_Model object
    $this->setModel(new IndexModel);
    //Set the view to the previously created view object
    $this->setView($view);

    //Attach the view to the observable_model so the view can recieve updates from it
    $this->observableModel->attach($this->view);
    //If data is needed from the model, get the array of data
    //(In this case it returns the sorted multi-dimensional array of popular/recommended courses)
    $data = $this->observableModel->getAll();
    //Tell the model to update the data which changed
    $this->observableModel->updateChangedData($data);

    //Tell the model to notify it's attached observers, pushing the updated data to them
    $this->observableModel->notify();
    
    }

}

}
?>