<?php

class EntryPoint extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
        if (Session::get('privilege') != 'Yonetici')
            $this->error();
    }

    function error() {
        require 'controllers/error.php';
        $controller = new Errorr();
        $controller->index('Üzgünüz ...! Sayfa Görüntülenmiyor.');
    }


    function index() {
        $this->view->searchAllEntryPoint = $this->searchAllEntryPoint();
        $this->view->render('entryPoint/index');
    }

    function create() {
        $this->view->render('entryPoint/create');
    }

    function updateFromTable($id) {
        $this->view->entryPoint = $this->model->searchSingleEntryPoint($id);
        $this->view->render('entryPoint/update');
    }

    function update() {
        $this->view->render('entryPoint/update');
    }



    function createEntryPoint() {
        $val = $this->model->createEntryPoint($_POST);
        if ($val == 1) {
            $mag = 'Success';
            header('location: ' . URL . 'entryPoint/create/' . $mag . '');
        } else {
            $mag = 'Fail/" (' . $val . ') "';
            header('location: ' . URL . 'entryPoint/create/' . $mag . '');
        }
    }

    function updateEntryPoint() {
        $val = $this->model->updateEntryPoint($_POST);
        if ($val == 1) {
            $mag = 'Success';
            header('location: ' . URL . 'entryPoint/update/' . $mag . '');
        } else {
            $mag = 'Fail/" (' . $val . ') "';
            header('location: ' . URL . 'entryPoint/update/' . $mag . '');
        }
    }

    function searchSingleEntryPoint($id) {
        return $this->model->searchAllEntryPoint($id);
    }

    function searchAllEntryPoint() {
        return $this->model->searchAllEntryPoint();
    }

    function deleteEntryPoint($id) {
        $val = $this->model->deleteEntryPoint($id);
        if ($val != 1)
            $mag = ' "Silinemiyor" Çünkü Bu değer başka bir tablo için kullanılıyor. (Yeni değeri silebilirsiniz)';
        header('location: ' . URL . 'entryPoint/index/' . $mag . '');
    }

}

?>
