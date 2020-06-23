<?php
echo '<div class=""><h3>Rezervasyon Bilgileri</h3></div>';
echo '<div id="booking_ticket_area" class="table-bordered table-responsive">';
echo '<link href="http://localhost/ybsotobus/public/css/booker/ticket.css" rel="stylesheet"></link>';
if(isset($this->bookingTicket)){
    foreach ($this->bookingTicket as $key => $value) {
    echo '<label class="">Rezervasyon Numarası  </label><label class="">: '.$value['bookingID'].'</label><br/>';
    echo '<label>Müşteri TC  </label><label class="">: '.$value['bookerTCNo'].'</label><br/>';
    echo '<label>Otobüs No  </label><label class="">: '.$value['busNo'].'</label><br/>';
    echo '<label>Güzergah  </label><label class="">: '.$value['routeNo'].'</label><br/>';
    echo '<label>Seyahat  </label>: <label class="">  '.$value['journeyFrom'].'</label>';
    echo '<label> </label><label class=""> - '.$value['journeyTo'].'</label><br/>';
    echo '<label>Biniş Noktası  </label><label class="">: '.$value['entryPoint'].'</label><br/>';
    echo '<label>Koltuk Sayısı  </label><label class="">: '.$value['no_of_seat'].'</label><br/>';
    echo '<label>Tutar  </label><label class="">: '.$value['ammount'].' TL</label><br/>';
    echo '<label>Tarih  </label><label class="">: '.$value['date'].'</label><br/><br/>';
    }
}
echo '</div>';
echo '<div><input type="button" name="" id="test" value="Yazdır"></div><br>';

echo '<div id="bus_ticket_area_main">';
echo '<h3>Otobüs Bileti</h3>';
echo '<div id="bus_ticket_sub_area" class="table-bordered table-responsive">';
echo '<link href="http://localhost/ybsotobus/public/css/booker/ticket.css" rel="stylesheet"></link>';
if(isset($this->busTicket)){
    foreach ($this->busTicket as $key => $value) {
    echo '<div>';
    echo '<label>Bilet Numarası : </label><label class="">'.$value['ticketNo'].'</label><br/>';
    echo '<label>Seyahat :</label><label class="">'.$value['journeyFrom'] .'</label>';
    echo '<label></label><label class=""> - '.$value['journeyTo'].'</label><br/>';
    echo '<label>Koltuk Numarası : </label><label class="">'.$value['seatNo'].'</label>';
    echo '<label>'.' , '.' Cinsiyet : </label><label class="">'.$value['gender'].'</label><br/>';
    echo '<label>Tarih : </label><label class="">'.$value['date'].'</label><br/>';
    echo '<label>Rezervasyon Numarası : </label><label class="">'.$value['bookingID'].'</label><br/><br/>';
    echo '</div>';
    }
}
echo '</div>';
echo '</div>';
echo '<div><label></label><input type="button" name="" id="printbusTicketsbtn" value="Yazdır"></div>';
?>


