<?php

class Bus extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
        require 'models/journey_model.php';
        $this->busJourneyNo = new Journey_Model();

        if (Session::get('privilege') != 'Yonetici')
        $this->error();
            
    }

    function error() {
        require 'controllers/error.php';
        $controller = new Errorr();
        $controller->index('Üzgünüz...! Sayfa Görüntülenmiyor.');
    }



    function index() {
        $this->view->searchAllBus = $this->searchAllBus();
        $this->view->render('bus/index');
    }

    function create() {
        $this->view->render('bus/create');
    }

    function update() {
        $this->view->render('bus/update');
    }

    function updateFromTable($id) {
        $this->view->searchAllJourney = $this->busJourneyNo->searchAllJourneyNo();
        $this->view->bus = $this->model->searchSingleBus($id);
        $this->view->render('bus/update');
    }
    
    function addJourneytoBus($id) {
        $this->view->searchJourneyforBus = $this->searchJourneyforBus($id);
        $this->view->searchAllJourney = $this->busJourneyNo->searchAvailableAllJourney();
        $this->view->render('bus/addJourneytoBus');
    }
    


    function createBus() {

        $val = $this->model->createBus($_POST);
        if ($val == 1) {
            $mag = 'Success';
            header('location: ' . URL . 'bus/create/' . $mag . '');
        } else {
            $mag = 'Fail/" (' . $val . ') "';
            header('location: ' . URL . 'bus/create/' . $mag . '');
        }
    }

    function updateBus() {

        $val = $this->model->updateBus($_POST);
        if ($val == 1) {
            $mag = 'Success';
            header('location: ' . URL . 'bus/update/' . $mag . '');
        } else {
            $mag = 'Fail/" (' . $val . ') "';
            header('location: ' . URL . 'bus/update/' . $mag . '');
        }
    }

    function searchSingleBus($id) {
        return $this->model->searchSingleBus($id);
    }

    function xhrSearchAllBusandJourney() {
        echo json_encode($this->model->xhrSearchAllBusandJourney());
    }
    
    function xhrSearchSingleBus() {
        return $this->model->xhrSearchSingleBus();
    }
    
    function searchAllBus() {
        return $this->model->searchAllBus();
    }

    function deleteBus($d) {
        $val = $this->model->deleteBus($d);
        if ($val != 1)
            $mag = ' "Silinemiyor" Çünkü bu değer başka bir tablo için kullanılıyor. (Yeni değeri silebilirsiniz)';
        header('location: ' . URL . 'bus/index/' . $mag . '');
    }
    
    function searchJourneyforBus($id) {
        return $this->model->searchJourneyforBus($id);
    }
    
    function addJourneyforBus() {
        if (isset($_POST)) {
            $val = $this->model->addJourneytoBus($_POST);
            header('location: ' . URL . 'bus/addJourneytoBus/' . $val . '');
        }
    }
    
    function deleteJourneyforBus($id) {
        $url = explode('/', $_GET['url']);
        $val = $this->model->deleteJourneyforBus($url[2], $url[3]);
        header('location: ' . URL . 'bus/addJourneytoBus/' . $val . '');
    }
}

?>
