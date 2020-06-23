<?php

class Conductor extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
        require 'models/bus_model.php';
        $this->busNo = new Bus_Model();
        if (Session::get('privilege') != 'Yonetici')
            $this->error();
    }

    function error() {
        require 'controllers/error.php';
        $controller = new Errorr();
        $controller->index('Üzgünüz ...! Sayfa Görüntülenmiyor.');
    }


    function index() {
        $this->view->searchAllConductor = $this->searchAllConductor();
        $this->view->render('conductor/index');
    }

    function create() {
        $this->view->searchAllBus = $this->busNo->searchAllBus();
        $this->view->render('conductor/create');
    }

    function updateFromTable($id) {
        $this->view->searchAllBus = $this->busNo->searchAllBus();
        $this->view->conductor = $this->model->searchSingleConductor($id);
        $this->view->render('conductor/update');
    }

    function update() {
        $this->view->searchAllBus = $this->busNo->searchAllBus();
        $this->view->render('conductor/update');
    }


    function createConductor() {
        $val = $this->model->createConductor($_POST);
        if ($val == 1) {
            $mag = 'Success';
            header('location: ' . URL . 'conductor/create/' . $mag . '');
        } else {
            $mag = 'Fail/" (' . $val . ') "';
            header('location: ' . URL . 'conductor/create/' . $mag . '');
        }
    }

    function updateConductor() {
        $val = $this->model->updateConductor($_POST);
        if ($val == 1) {
            $mag = 'Success';
            header('location: ' . URL . 'conductor/update/' . $mag . '');
        } else {
            $mag = 'Fail/" (' . $val . ') "';
            header('location: ' . URL . 'conductor/update/' . $mag . '');
        }
    }

    function searchSingleConductor($id) {
        return $this->model->searchSingleConductor($id);
    }

    function searchAllConductor() {
        return $this->model->searchAllConductor();
    }

    function deleteConductor($id) {
        $val = $this->model->deleteConductor($id);
        if ($val != 1)
            $mag = ' "Silinemiyor" Çünkü bu değer başka bir tablo için kullanılıyor. (Yeni değeri silebilirsiniz)';
        header('location: ' . URL . 'conductor/index/' . $mag . '');
    }

}

?>
