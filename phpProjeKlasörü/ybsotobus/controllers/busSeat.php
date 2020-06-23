<?php

class SystemUser extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
    }


    function setSeatNo() {
        $this->model->setSeatNo();
    }

    function selectBusSeat() {
        $this->model->selectBusSeat();
    }

    function deselectBusSeat() {
        $this->model->deselectBusSeat();
    }

    function serachBusSeat() {
        $this->model->serachBusSeat();
    }

}

?>
