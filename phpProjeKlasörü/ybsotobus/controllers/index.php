<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
    Session::init();
        require 'models/journey_model.php';
        $this->journey = new Journey_Model();

        if (Session::get('privilege') == 'Admin' || Session::get('privilege') == 'Yonetici' || Session::get('privilege') == 'Muavin')
        $this->error();
            
    }

    function error() {
        require 'controllers/error.php';
        $controller = new Errorr();
        $controller->index('Üzgünüz ...! Sayfa Görüntülenmiyor.');
    }

    function index() {
        $this->view->journeyFrom = $this->journey->searchAllJourneyFrom();
        $this->view->journeyTo = $this->journey->searchAllJourneyTo();
        Session::deset('bookingTime');
            Session::deset('seatBookingTime');
            Session::deset('sessionforSelectin_s');
            Session::deset('sessionforSelectin_s_tot_price');
        $this->view->render('index/index');
    }

    

}

?>