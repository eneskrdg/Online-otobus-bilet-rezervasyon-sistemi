<?php

class BookingSeat extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
        require 'controllers/booker.php';
        $this->booker = new Booker();
        
    }



    function onlineBookerConform() {
        if (isset($_POST['seat0'])) {
            $new_bookingID = $this->insertBookerInfo($_POST);
            header('location: ' . URL . 'booker/payment/' . $new_bookingID);
        } else {
            header('location: ' . URL);
        }
    }

    function manualBookerConform() {
        if (isset($_POST['seat0'])) {
            if (Session::get('privilege') == 'Rezervasyon') {
                $this->insertMBookerInfo($_POST);
            } else {
                header('location:' . URL . 'login');
            }
        } else {
            header('location: ' . URL);
        }
    }


    function paymentConform() {
        if (isset($_POST['bookingID'])) {
            $time = time() - Session::get('bookingTime');
            if ($time >= 60 * 9) {
                echo 'Süreniz Doldu...';
            } else {
                $this->seatBookingConform($_POST['bookingID']);
            }
        }
    }

    function seatBookingConform($bookingID) {


        $rebookingID = $this->model->seatBookingConform($bookingID);
        if ($rebookingID != "") {
            header('location: ' . URL . 'printTicket/index/' . $rebookingID . '');
        }
    }

    function insertBookerInfo($data) {
        return $this->model->insertBookerInfo($data);
    }

    function insertMBookerInfo($data) {
        return $this->model->insertMBookerInfo($data);
    }

}

?>
