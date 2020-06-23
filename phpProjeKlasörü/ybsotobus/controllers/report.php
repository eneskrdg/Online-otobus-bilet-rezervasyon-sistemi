<?php

class Report extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
        require 'models/bus_model.php';
        $this->busNo = new Bus_Model();
        require 'models/journey_model.php';
        $this->journeyNo = new Journey_Model();

        if (Session::get('privilege') != 'Admin' && Session::get('privilege') != 'Muavin')
            $this->error();
    }

    function error() {
        require 'controllers/error.php';
        $controller = new Errorr();
        $controller->index('Üzgünüz ...! Bu Sayfa Görüntülenmiyor');
    }


    function index() {
        $this->view->searchAllBus = $this->busNo->searchAllBus();
        $this->view->searchAllJourney = $this->journeyNo->searchAllJourneyNo();
        $this->view->render('report/index');
    }
    
    function bookingReport() {
        if (isset($_POST['busNo'])) {
            $journeyDate = $_POST['journeyDate'];
            $busNo = $_POST['busNo'];
            $journeyNo = $_POST['journeyNo'];
            $this->view->journeyDate = $_POST['journeyDate'];
            $this->view->busNo = $_POST['busNo'];
            $this->view->journeyNo = trim($_POST['journeyNo']);
            $this->view->searchBookingData = $this->model->searchBookingData($journeyDate,$busNo,$journeyNo);
            $this->view->render('report/index');
        }
    }
    
    public function xhrSearchJourneyforSingleBus() {
        echo $this->model->xhrSearchJourneyforSingleBus();
    }
    
    public function xhrSearchBookingData() {
        $journeyDate = $_POST['journeyDate'];
        $busNo = $_POST['busNo'];
        $journeyNo = $_POST['journeyNo'];
        echo ($this->model->xhrSearchBookingData($journeyDate, $busNo,$journeyNo));
    }
    
    function bookingData() {
        $formDate = $_POST['date_from'];
        $toDate = $_POST['date_to'];
        $busNo = $_POST['busNo'];
        $journeyNo = $_POST['journeyNo'];
        if ($busNo == 'AB' && $journeyNo == 'AJ') {
            $this->searchAllBookingData($formDate, $toDate);
        } else if ($busNo != 'AB' && $journeyNo != 'AJ') {
            $this->searchBookingData($formDate, $toDate, $busNo, $journeyNo);
        } else if ($busNo != 'AB' && $journeyNo == 'AJ') {
            $this->searchAllBusBookingData($formDate, $toDate, $busNo);
        } else if ($busNo == 'AB' && $journeyNo != 'AJ') {
            $this->searchAllJourneyBookingData($formDate, $toDate, $journeyNo);
        }
    }

    function bookerReport() {
        $journeyDate = $_POST['journeyDate'];
        $busNo = $_POST['busNo'];
        $report_h = '';
        $table_h = '';
        $table_b = '';
        $table_f = '';
        $report_h = '<H3>Rezervasyon Bilgileri</H3><H5> Otobüs No : ' . $busNo . '</H5><H5> Sefer Tarih : ' . $journeyDate . '</H5>';
        $table_h = '<table ellpadding="0" cellspacing="0" rules="all" border="0"  width="*0%" align="center">
                    <hr/><tr> 
                        <th align="center" width="50px"></th>
                        <th align="center" width="170px" >BILET NUMARASI</th>
                        <th align="center" width="120px">TC NUMARASI</th>
                        <th align="center" width="120px">YOLCU ADI SOYADI</th>
                        <th align="center" width="100px">BINIS NOKTASI</th>
                        <th align="center" width="50px">KOLTUK SAYISI</th>
                        <th align="center" width="75px">FIYAT</th>
                        <th align="center" width="100px">TELEFON NUMARASI</th>
                    </tr><hr/>
                    ';
        foreach ($this->model->getBookerrData($journeyDate, $busNo) as $key => $value) {
            $table_b = $table_b . '<tr>
                          <td align="center" width="50px" >' . ++$key . '</td>
                          <td align="center" width="170px">' . $value['bookingID'] . '</td>
                          <td align="center" width="120px">' . $value['bookerTCNo'] . '</td>
                          <td align="center" width="120px">' . $value['bookerName'] . '</td>
                          <td align="center" width="100px">' . $value['entryPointNo'] . '</td>
                          <td align="center" width="50px">' . $value['no_of_seat'] . '</td>
                          <td align="center" width="75px">' . $value['ammount'] . '</td>
                          <td align="center" width="100px">' . $value['bookerMNo'] . '</td>
                          </tr>';
        }
        $table_f = '<hr/></table>';
        $main_tabale = $report_h . $table_h . $table_b . $table_f;
        $this->view_report($main_tabale, "Booker_Info_" . $busNo, 'L');
    }

    function passengerReport() {
        $journeyDate = $_POST['journeyDate'];
        $busNo = $_POST['busNo'];

        $report_h = '';
        $table_h = '';
        $table_b = '';
        $table_f = '';
        $report_h = '<H1></H1><H3>Yolcu Bilgileri</H3><H5> Otobüs No : ' . $busNo . '</H5><H5> Tarih : ' . $journeyDate . '</H5>';
        $table_h = '<table ellpadding="0" cellspacing="0" rules="all"  width="80%" align="center">
                    <hr/><tr> 
                        <th align="center" width="30px"></th>
                        <th align="center" width="50px" >Koltuk No</th>
                        <th align="center" width="160px">Bilet No</th>
                        <th align="center" width="180px">Yolcu Ad & Soyad</th>
                        <th align="center" width="50px">Cinsiyet</th>
                        <th align="center" width="160px">Rezervasyon No</th>
                    </tr><hr/>
                    ';
        foreach ($this->model->getPassengerData($journeyDate, $busNo) as $key => $value) {
            $table_b = $table_b . '<tr>
                          <td align="center" width="30px" >' . ++$key . '</td>
                          <td align="center" width="50px">' . $value['seatNo'] . '</td>
                          <td align="center" width="160px">' . $value['ticketNo'] . '</td>
                          <td align="center" width="180px">' . $value['passengerName'] . '</td>
                          <td align="center" width="50px">' . $value['gender'] . '</td>
                          <td align="right" width="160px">' . $value['bookingID'] . '</td>
                          </tr>';
        }
        $table_f = '<hr/></table>';
        $main_tabale = $report_h . $table_h . $table_b . $table_f;
        $this->view_report($main_tabale, "Passenger_Info_" . $busNo, 'P');
    }

    function searchAllBookingData($formDate, $toDate) {
        $report_h = '<H3> Otobüs Rezervasyon Raporu</H3><H4> Tarih Başlangıç ' . $formDate . ' Tatih Bitiş ' . $toDate . '</H4>';
        $table_h = '<table ellpadding="0" cellspacing="0" rules="all"  width="80%" align="center">
                    <hr/><tr> 
                        <th align="center" width="100px"></th>
                        <th align="center" width="120px"><H4>Otobüs No</H4></th>
                        <th align="center" width="120px"><H4>Sefer No</H4></th>
                        <th align="center" width="100px"><H4>Koltuk Sayısı</H4></th>
                        <th align="right" width="120px"><H4>Tutar</H4></th>
                        </tr><hr/>
                    ';
        $table_b = '';
        $total_ammount = 0.00;
        foreach ($this->model->getAllBookingData($formDate, $toDate) as $key => $value) {
            $table_b = $table_b . '<tr>
                          <td align="center" width="100px">' . ++$key . '</td>
                          <td align="center" width="120px">' . $value['busNo'] . '</td>
                          <td align="center" width="120px">' . $value['journeyNo'] . '</td>
                          <td align="center" width="100px">' . $value['no_of_seat'] . '</td>
                          <td align="right" width="120px">' . $value['ammount'] . '</td>
                          </tr>';
            $total_ammount = $total_ammount + $value['ammount'];
        }
        $table_f = '<hr/>
                    <tr cellspacing="10">
                        <th align="center" width="100px"><H4>Toplam</H4></th>
                        <th align="center" width="120px" ></th>
                        <th align="center" width="120px"></th>
                        <th align="center" width="100px"></th>
                        <th align="right" width="120px"><H4>' . $total_ammount . '</H4></th>
                        </tr>
                    <hr/></table>';
        $main_tabale = $report_h . $table_h . $table_b . $table_f;
        $this->view_report($main_tabale, "All_Booking", 'P');
    }

    function searchBookingData($formDate, $toDate, $busNo, $journeyNo) {
        $report_h = '<H3> Otobüs Rezervasyon Raporu</H3><H4> Otobüs No : ' . $busNo . ' - Sefer No : ' . $journeyNo . '</H4><H4> Başlangıç Tarih ' . $formDate . ' Bitiş Tarih ' . $toDate . '</H4>';
        $table_h = '<table ellpadding="0" cellspacing="0" rules="all"  width="80%" align="center">
                    <hr/><tr> 
                        <th align="center" width="100px"></th>
                        <th align="center" width="120px"><H4>Otobüs No</H4></th>
                        <th align="center" width="120px"><H4>Sefer No</H4></th>
                        <th align="center" width="80px"><H4>Koltuk Sayısı</H4></th>
                        <th align="right" width="80px"><H4>Tutar</H4></th>
                        <th align="center" width="120px"><H4>Tarih</H4></th>
                        </tr><hr/>
                    ';
        $table_b = '';
        $no_of_seat = 0;
        $total_ammount = 0.00;
        foreach ($this->model->getBookingData($formDate, $toDate, $busNo, $journeyNo) as $key => $value) {
            $table_b = $table_b . '<tr>
                          <td align="center" width="100px">' . ++$key . '</td>
                          <td align="center" width="120px">' . $value['busNo'] . '</td>
                          <td align="center" width="120px">' . $value['journeyNo'] . '</td>
                          <td align="center" width="80px">' . $value['no_of_seat'] . '</td>
                          <td align="right" width="80px">' . $value['ammount'] . '</td>
                          <td align="center" width="120px">' . $value['date'] . '</td>
                          </tr>';
            $no_of_seat = $no_of_seat + $value['no_of_seat'];
            $total_ammount = $total_ammount + $value['ammount'];
        }
        $table_f = '<hr/>
                    <tr cellspacing="10">
                        <th align="center" width="100px"><H4>Toplam</H4></th>
                        <th align="center" width="120px" ></th>
                        <th align="center" width="120px"></th>
                        <th align="center" width="80px">' . $no_of_seat . '</th>
                        <th align="right" width="80px"><H4>' . $total_ammount . '</H4></th>
                        <th align="center" width="120px"><H4></H4></th>
                        </tr>
                    <hr/></table>';
        $main_tabale = $report_h . $table_h . $table_b . $table_f;
        $this->view_report($main_tabale, "Booking_" . $busNo . '_' . $journeyNo, 'P');
    }

    function searchAllBusBookingData($formDate, $toDate, $busNo) {
        $report_h = '<H3> Otobüs Rezervasyon Raporu</H3><H4> Otobüs No : ' . $busNo . '</H4><H4> Tarih Başlangıç ' . $formDate . ' Tarih Bitiş ' . $toDate . '</H4>';
        $table_h = '<table ellpadding="0" cellspacing="0" rules="all"  width="80%" align="center">
                    <hr/><tr> 
                        <th align="center" width="100px"></th>
                        <th align="center" width="120px"><H4>Otobüs No</H4></th>
                        <th align="center" width="120px"><H4>Sefer No No</H4></th>
                        <th align="center" width="80px"><H4>Koltuk Sayısı</H4></th>
                        <th align="right" width="80px"><H4>Tutar</H4></th>
                        <th align="center" width="120px"><H4>Tarih</H4></th>
                        </tr><hr/>
                    ';
        $table_b = '';
        $no_of_seat = 0;
        $total_ammount = 0.00;
        foreach ($this->model->getAllBusBookingData($formDate, $toDate, $busNo) as $key => $value) {
            $table_b = $table_b . '<tr>
                          <td align="center" width="100px">' . ++$key . '</td>
                          <td align="center" width="120px">' . $value['busNo'] . '</td>
                          <td align="center" width="120px">' . $value['journeyNo'] . '</td>
                          <td align="center" width="80px">' . $value['no_of_seat'] . '</td>
                          <td align="right" width="80px">' . $value['ammount'] . '</td>
                          <td align="center" width="120px">' . $value['date'] . '</td>
                          </tr>';
            $no_of_seat = $no_of_seat + $value['no_of_seat'];
            $total_ammount = $total_ammount + $value['ammount'];
        }
        $table_f = '<hr/>
                    <tr cellspacing="10">
                        <th align="center" width="100px"><H4>Toplam</H4></th>
                        <th align="center" width="120px" ></th>
                        <th align="center" width="120px"></th>
                        <th align="center" width="80px">' . $no_of_seat . '</th>
                        <th align="right" width="80px"><H4>' . $total_ammount . '</H4></th>
                        <th align="center" width="120px"><H4></H4></th>
                        </tr>
                    <hr/></table>';
        $main_tabale = $report_h . $table_h . $table_b . $table_f;
        $this->view_report($main_tabale, "Booking_" . $busNo, 'P');
    }

    function searchAllJourneyBookingData($formDate, $toDate, $journeyNo) {
        $report_h = '<H3> Otobüs Rezervasyon Raporu</H3><H4> Sefer No : ' . $journeyNo . '</H4><H4> Tarih Başlangıç ' . $formDate . ' Tarih Bitiş ' . $toDate . '</H4>';
        $table_h = '<table ellpadding="0" cellspacing="0" rules="all"  width="80%" align="center">
                    <hr/><tr> 
                        <th align="center" width="100px"></th>
                        <th align="center" width="120px"><H4>Otobüs No</H4></th>
                        <th align="center" width="120px"><H4>Sefer No No</H4></th>
                        <th align="center" width="80px"><H4>Koltuk Sayısı</H4></th>
                        <th align="right" width="80px"><H4>Tutar</H4></th>
                        <th align="center" width="120px"><H4>Tarih</H4></th>
                        </tr><hr/>
                    ';
        $table_b = '';
        $no_of_seat = 0;
        $total_ammount = 0.00;
        foreach ($this->model->getAllJourneyBookingData($formDate, $toDate, $journeyNo) as $key => $value) {
            $table_b = $table_b . '<tr>
                          <td align="center" width="100px">' . ++$key . '</td>
                          <td align="center" width="120px">' . $value['busNo'] . '</td>
                          <td align="center" width="120px">' . $value['journeyNo'] . '</td>
                          <td align="center" width="80px">' . $value['no_of_seat'] . '</td>
                          <td align="right" width="80px">' . $value['ammount'] . '</td>
                          <td align="center" width="120px">' . $value['date'] . '</td>
                          </tr>';
            $no_of_seat = $no_of_seat + $value['no_of_seat'];
            $total_ammount = $total_ammount + $value['ammount'];
        }
        $table_f = '<hr/>
                    <tr cellspacing="10">
                        <th align="center" width="100px"><H4>Toplam</H4></th>
                        <th align="center" width="120px" ></th>
                        <th align="center" width="120px"></th>
                        <th align="center" width="80px">' . $no_of_seat . '</th>
                        <th align="right" width="80px"><H4>' . $total_ammount . '</H4></th>
                        <th align="center" width="120px"><H4></H4></th>
                        </tr>
                    <hr/></table>';
        $main_tabale = $report_h . $table_h . $table_b . $table_f;
        $this->view_report($main_tabale, "Booking_" . $journeyNo, 'P');
    }

    

    function bookingReportforPDF() {
        if (isset($_POST['busNo'])) {
            $journeyDate = $_POST['journeyDate'];
            $busNo = $_POST['busNo'];
            $journeyNo = $_POST['journeyNo'];
            $report_h = '<H3> Otobüs Rezervasyon Raporu</H3><H4> Tarih : ' . $journeyDate . '</H4>';
            $table_h = '<table>
                            <hr/>
                            <tr>
                                <th align="left" width="50px">Koltuk No</th>
                                <th align="center" width="50px">Durum</th>
                                <th align="center" width="160px">Bilet No</th>
                                <th align="center" width="130px">Adı</th>
                                <th align="center" width="50px">Cinsiyet</th>
                                <th align="center" width="100px">Biniş Noktası</th>
                                <th align="center" width="100px">Telefon No</th>
                            </tr>
                            <hr/>';

            $table_b = '';
            foreach ($this->model->searchBookingData($journeyDate, $busNo,$journeyNo) as $key => $value) {
                $table_b = $table_b . '<tr class="">
                                            <td align="left" width="50px">' . $value['seatNo'] . '</td>
                                            <td align="center" width="50px">' . $value['status'] . '</td>
                                            <td align="center" width="160px">' . $value['ticketNo'] . '</td>
                                            <td align="center" width="130px">' . $value['passengerName'] . '</td>
                                            <td align="center" width="50px">' . $value['gender'] . '</td>
                                            <td align="center" width="100px">' . $value['entryPoint'] . '</td>
                                            <td align="center" width="100px">' . $value['bookerMNo'] . '</td>
                                            </tr>
                                            ';
            }

            $table_f = '<hr/>
                                <tr>
                                <th align="left" width="50px">Koltuk No</th>
                                <th align="center" width="50px">Durum</th>
                                <th align="center" width="160px">Bilet No</th>
                                <th align="center" width="130px">Adı</th>
                                <th align="center" width="50px">Cinsiyet</th>
                                <th align="center" width="100px">Biniş Noktası</th>
                                <th align="center" width="100px">Telefon No</th>
                                </tr>
                                <hr/>
                                </table>';
            $main_tabale = $report_h . $table_h . $table_b;
            $this->view_report($main_tabale, "Booking_Infor_" . $journeyDate, 'P');
        }
    }



    function view_report($main_tabale, $reportName, $size) {


        require_once('pdf/tcpdf_include.php');
        require_once('pdf/tcpdf.php');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . '', PDF_HEADER_STRING);


        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);


        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);


        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }


        $pdf->SetFont('times', '', 10);
        $pdf->AddPage($size, 'A4');

        $pdf->writeHTML($main_tabale, true, false, true, false, '');


        $pdf->Output($reportName.'.pdf', 'I');

    }

}

?>
