<?php

class BookingSeat_Model extends Model {

    public function __construct() {
        parent::__construct();
        Session::init();
        date_default_timezone_set("Europe/Istanbul");
    }

    public function insertBookerInfo($data) {
        foreach (Session::get('sessionforSelectin_s') as $key => $value) {
            $book_numberOfSeat = ++$key;
        }
        $book_busNo = $data['book_busNo'];
        $book_journeyNo = $data['book_journeyNo'];
        $booker_tc = $data['booker_tc'];
        $book_total_ammount = $data['book_total_ammount'];
        $book_date = $data['book_date'];
        $bookername = $data['bookername'];
        $booker_mno = $data['booker_mno'];
        $boardpoint = $data['boardpoint'];
        Session::set('booker_mno', $booker_mno);
        $editdate = substr($book_date, 2, -6) . substr($book_date, 5, -3) . substr($book_date, -2);

        $new_bookingID = $this->generatebookingID($book_busNo, $book_journeyNo, $book_date);
        $seat_time = $this->getSeatExpierTime($data['seat0'], $book_busNo, $book_journeyNo, $book_date);
        if ($new_bookingID != null && $seat_time != null) {

            $bookerInfo = $this->db->select('SELECT * FROM booker WHERE bookerTCNo ="' . $booker_tc . '" ');

            if ($bookerInfo == null) {
                $arrayData = array();
                $arrayData[0]['table'] = 'booker';
                $arrayData[0]['data'] = array(
                    'bookerTCNo' => $booker_tc,
                    'bookerName' => $bookername,
                    'bookerMNo' => $booker_mno
                );
                $arrayData[1]['table'] = 'booking';
                $arrayData[1]['data'] = array(
                    'bookingID' => $new_bookingID,
                    'bookerTCNo' => $booker_tc,
                    'busNo' => $book_busNo,
                    'journeyNo' => $book_journeyNo,
                    'no_of_seat' => $book_numberOfSeat,
                    'entryPointNo' => $boardpoint,
                    'ammount' => $book_total_ammount,
                    'date' => $book_date,
                    'payment_status' => 'P',
                    's_bookin_time' => $seat_time
                );
                $insert_data = $this->db->traInsert($arrayData);
            } else {
                $data_i = array(
                    'bookingID' => $new_bookingID,
                    'bookerTCNo' => $booker_tc,
                    'busNo' => $book_busNo,
                    'journeyNo' => $book_journeyNo,
                    'no_of_seat' => $book_numberOfSeat,
                    'entryPointNo' => $boardpoint,
                    'ammount' => $book_total_ammount,
                    'date' => $book_date,
                    'payment_status' => 'P',
                    's_bookin_time' => $seat_time
                );

                $postData = array(
                    'bookerMNo' => $booker_mno
                );

                $insert_data = $this->db->update_and_insert('booker', $postData, "`bookerTCNo` = '{$booker_tc}'", 'booking', $data_i);
            }

            if ($insert_data == 1) {
                $booking_array = array();
                for ($i = 0; isset($data['seat' . $i]); $i++) {
                    $booking_array[$i] = array(
                        'ticketNo' => $book_busNo . $book_journeyNo . $editdate . $data['seat' . $i],
                        'passengerName' => $data['passenger' . $i],
                        'seatNo' => $data['seat' . $i],
                        'gender' => $data['gender' . $i],
                        'bookingID' => $new_bookingID,
                        'date' => $book_date,
                        'journeyNo' => $book_journeyNo
                    );
                }
                Session::set($new_bookingID, $booking_array);
                return $new_bookingID;
            } else {
                echo $insert_data;
            }
        }
    }

    public function seatBookingConform($new_bookingID) {
        if (Session::get('bookingTime') == true) {
            $time = time() - Session::get('bookingTime');
            if ($time >= 60 * 9) {
                echo 'time out';
            } else {
                $this->db->beginTransaction();
                try {
                    $i = 0;
                    $array = Session::get($new_bookingID);
                    Session::deset($new_bookingID);
                    Session::deset('bookingTime');
                    Session::deset('seatBookingTime');
                    Session::deset('sessionforSelectin_s');
                    Session::deset('sessionforSelectin_s_tot_price');
                    for ($x = 0; isset($array[$x]); $x++) {
                        $sth1 = $this->db->prepare('INSERT INTO receive_ticke (`ticketNo`,`passengerName`,`seatNo`,`gender`,`bookingID`)
                     VALUES 
                     ("' . $array[$x]['ticketNo'] . '","' . $array[$x]['passengerName'] . '","' . $array[$x]['seatNo'] . '","' . $array[$x]['gender'] . '","' . $array[$x]['bookingID'] . '")');
                        $val1 = $sth1->execute();
                        $sth2 = $this->db->prepare('UPDATE available_seat SET status = "B" 
                    WHERE seatNo ="' . $array[$x]['seatNo'] . '" AND date ="' . $array[$x]['date'] . '" AND journeyNo ="' . $array[$x]['journeyNo'] . '" ');
                        $val2 = $sth2->execute();
                    }
                    $sth3 = $this->db->prepare('UPDATE booking SET payment_status = "Ok" WHERE bookingID ="' . $array[0]['bookingID'] . '" ');
                    $val3 = $sth3->execute();
                    $this->db->commit();
                    return $array[0]['bookingID'];
                } catch (Exception $e) {
                    $this->db->rollBack();
                    return $e->getMessage();
                }
            }
        }
    }

    public function insertMBookerInfo($data) {
        if (Session::get('bookingTime') == true) {
            $time = time() - Session::get('bookingTime');
            if ($time >= 60 * 9) {
                echo 'time out';
            } else {
                foreach (Session::get('sessionforSelectin_s') as $key => $value) {
                    $book_numberOfSeat = ++$key;
                }
                $book_busNo = $data['book_busNo'];
                $book_journeyNo = $data['book_journeyNo'];
                $booker_tc = $data['booker_tc'];
                $book_total_ammount = $data['book_total_ammount'];
                $book_date = $data['book_date'];
                $bookername = $data['bookername'];
                $booker_mno = $data['booker_mno'];
                $boardpoint = $data['boardpoint'];
                $editdate = substr($book_date, 2, -6) . substr($book_date, 5, -3) . substr($book_date, -2);

                $new_bookingID = $this->generatebookingID($book_busNo, $book_journeyNo, $book_date);
                $seat_time = $this->getSeatExpierTime($data['seat0'], $book_busNo, $book_journeyNo, $book_date);
                if ($new_bookingID != null && $seat_time != null) {

                    $bookerInfo = $this->db->select('SELECT * FROM booker WHERE bookerTCNo ="' . $booker_tc . '" ');

                    if ($bookerInfo == null) {
                        $arrayData_i = array();
                        $arrayData_i[0]['table'] = 'booker';
                        $arrayData_i[0]['data'] = array(
                            'bookerTCNo' => $booker_tc,
                            'bookerName' => $bookername,
                            'bookerMNo' => $booker_mno
                        );
                        $arrayData_i[1]['table'] = 'booking';
                        $arrayData_i[1]['data'] = array(
                            'bookingID' => $new_bookingID,
                            'bookerTCNo' => $booker_tc,
                            'busNo' => $book_busNo,
                            'journeyNo' => $book_journeyNo,
                            'no_of_seat' => $book_numberOfSeat,
                            'entryPointNo' => $boardpoint,
                            'ammount' => $book_total_ammount,
                            'date' => $book_date,
                            'payment_status' => 'Ok',
                            's_bookin_time' => $seat_time
                        );
                        $arrayData_i[2]['table'] = 'manual_booking';
                        $arrayData_i[2]['data'] = array(
                            'userName' => Session::get('userName'),
                            'bookingID' => $new_bookingID,
                            'date' => date("Y-m-d")
                        );
                        $x = 0;
                        for ($i = 3; isset($data['seat' . $x]); $i++) {
                            $arrayData_i[$i]['table'] = 'receive_ticke';
                            $arrayData_i[$i]['data'] = array(
                                'ticketNo' => $book_busNo . $book_journeyNo . $editdate . $data['seat' . $x],
                                'passengerName' => $data['passenger' . $x],
                                'seatNo' => $data['seat' . $x],
                                'gender' => $data['gender' . $x],
                                'bookingID' => $new_bookingID
                            );
                            $x++;
                        }

                        $arrayData_u = array();
                        for ($j = 0; isset($data['seat' . $j]); $j++) {
                            $arrayData_u[$j]['table'] = 'available_seat';
                            $arrayData_u[$j]['where'] = " `seatNo` ='{$data['seat' . $j]}' AND `date` ='{$book_date}' AND `journeyNo` ='{$book_journeyNo}' ";
                            $arrayData_u[$j]['data'] = array(
                                'status' => 'B'
                            );
                        }
                        $trainsert_and_traupdate_data = $this->db->trainsert_and_traupdate($arrayData_i, $arrayData_u);
                    } else {
                        $arrayData_i = array();
                        $arrayData_i[0]['table'] = 'booking';
                        $arrayData_i[0]['data'] = array(
                            'bookingID' => $new_bookingID,
                            'bookerTCNo' => $booker_tc,
                            'busNo' => $book_busNo,
                            'journeyNo' => $book_journeyNo,
                            'no_of_seat' => $book_numberOfSeat,
                            'entryPointNo' => $boardpoint,
                            'ammount' => $book_total_ammount,
                            'date' => $book_date,
                            'payment_status' => 'Ok',
                            's_bookin_time' => $seat_time
                        );
                        $arrayData_i[1]['table'] = 'manual_booking';
                        $arrayData_i[1]['data'] = array(
                            'userName' => Session::get('userName'),
                            'bookingID' => $new_bookingID,
                            'date' => date("Y-m-d")
                        );
                        $x = 0;
                        for ($i = 2; isset($data['seat' . $x]); $i++) {
                            $arrayData_i[$i]['table'] = 'receive_ticke';
                            $arrayData_i[$i]['data'] = array(
                                'ticketNo' => $book_busNo . $book_journeyNo . $editdate . $data['seat' . $x],
                                'passengerName' => $data['passenger' . $x],
                                'seatNo' => $data['seat' . $x],
                                'gender' => $data['gender' . $x],
                                'bookingID' => $new_bookingID
                            );
                            $x++;
                        }

                        $arrayData_u = array();
                        $arrayData_u[0]['table'] = 'booker';
                        $arrayData_u[0]['where'] = "`bookerTCNo` = '{$booker_tc}'";
                        $arrayData_u[0]['data'] = array(
                            'bookerMNo' => $booker_mno
                        );
                        $y = 0;
                        for ($j = 1; isset($data['seat' . $y]); $j++) {
                            $arrayData_u[$j]['table'] = 'available_seat';
                            $arrayData_u[$j]['where'] = " `seatNo` ='{$data['seat' . $y]}' AND `date` ='{$book_date}' AND `journeyNo` ='{$book_journeyNo}' ";
                            $arrayData_u[$j]['data'] = array(
                                'status' => 'B'
                            );
                            $y++;
                        }
                        $trainsert_and_traupdate_data = $this->db->trainsert_and_traupdate($arrayData_i, $arrayData_u);
                    }

                    if ($trainsert_and_traupdate_data == 11) {
                        Session::deset('booking_array');
                        Session::deset('bookingTime');
                        Session::deset('seatBookingTime');
                        Session::deset('sessionforSelectin_s');
                        Session::deset('sessionforSelectin_s_tot_price');
                        header('location: ' . URL . 'printTicket/index/' . $new_bookingID);
                    } else {
                        echo $trainsert_and_traupdate_data;
                    }
                }
            }
        }
    }

    public function setBookinInfo() {

        try {
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function setPayment() {

        try {
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function searchBookingInfor() {

        try {
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function generatebookingID($book_busNo, $book_journeyNo, $book_date) {
        $new_bookingID = null;
        $bookingID_array = array();

        $bookingID = $this->db->select('SELECT bookingID FROM booking 
            WHERE busNo ="' . $book_busNo . '" AND journeyNo ="' . $book_journeyNo . '" AND date ="' . $book_date . '"');

        foreach ($bookingID as $key => $value) {
            $bookingID_array[$key] = substr($value['bookingID'], -2);
        }

        $editdate = substr($book_date, 2, -6) . substr($book_date, 5, -3) . substr($book_date, -2);

        for ($i = 0; $i < 50; $i++) {
            if ($i < 10) {
                if (in_array(0 . $i, $bookingID_array)) {
                    continue;
                } else {
                    $new_bookingID = $book_busNo . $book_journeyNo . $editdate . 0 . $i;
                    break;
                }
            } else {
                if (in_array($i, $bookingID_array)) {
                    continue;
                } else {
                    $new_bookingID = $book_busNo . $book_journeyNo . $editdate . $i;
                    break;
                }
            }
        }
        return $new_bookingID;
    }

    public function getSeatExpierTime($seat_no, $book_busNo, $book_journeyNo, $book_date) {
        $seat_time = $this->db->select('SELECT addtime(time,"00:11:00") AS time FROM `available_seat` 
            WHERE `seatNo`="' . $seat_no . '" AND `busNo`="' . $book_busNo . '" AND `journeyNo`="' . $book_journeyNo . '" AND `date`="' . $book_date . '" ');

        foreach ($seat_time as $key => $value) {
            return $value['time'];
        }
    }

}

?>
