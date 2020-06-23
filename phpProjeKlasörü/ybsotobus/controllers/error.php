<?php

class Errorr extends Controller{
    function __construct() {
        parent::__construct();
      }
    function index($msg="HATA") {
        $this->view->msg=$msg;
        $this->view->render('error/index');
        exit();
    }

}