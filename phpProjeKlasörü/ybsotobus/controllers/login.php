<?php

class Login extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
    }



    function index() {
        $this->view->render('login/index');
    }
    
    

    function loginToSystem() {
        $this->model->loginToSystem();
    }
    
    function logout()
    {
        Session::destroy();
        header('location: ' . URL .  'login');
    }

}

?>
