<?php

class about extends Controller {

    function __construct() {
        parent::__construct();
        
    }

    function error() {
        require 'controllers/error.php';
        $controller = new Errorr();
        $controller->index('Üzgünüz ...! Sayfa Görüntülenmiyor.');
    }

    function index() {
        $this->view->render('about/index');
    }


    
}

?>
