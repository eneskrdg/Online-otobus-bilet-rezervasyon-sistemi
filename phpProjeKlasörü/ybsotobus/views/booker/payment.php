<div id="timeOutBooking" style="text-align:center; color: #d14"></div>
<?php
echo '<div><h3>Rezervasyon Bilet Bilgileri</h3></div>';
echo '<link href="http://localhost/ybsotobus/public/css/booker/ticket.css" rel="stylesheet"></link>';
echo '<div class="table-responsive table-bordered">';
if (isset($this->bookingTicket)) {
    foreach ($this->bookingTicket as $key => $value) {
        echo '<label>Rezervasyon Numarası  </label><label class="">: ' . $value['bookingID'] . '</label><br/>';
        echo '<label>Müşteri TC  </label><label class="">: ' . $value['bookerTCNo'] . '</label><br/>';
        echo '<label>Otobüs No  </label><label class="">: ' . $value['busNo'] . '</label><br/>';
        echo '<label>Güzergah  </label><label class="">: ' . $value['routeNo'] . '</label><br/>';
        echo '<label>Seyahat Bilgisi  </label>: <label class=""> ' . $value['journeyFrom'] . '</label>';
        echo '<label></label><label class=""> - ' . $value['journeyTo'] . '</label><br/>';
        echo '<label>Biniş Noktası  </label><label class="">: ' . $value['entryPoint'] . '</label><br/>';
        echo '<label>Koltuk Sayısı  </label><label class="">: ' . $value['no_of_seat'] . '</label><br/>';
        echo '<label>Tutar  </label><label class="">: ' . $value['ammount'] . '</label><br/>';
        echo '<label>Tarih  </label><label class="">: ' . $value['date'] . '</label><br/>';
        echo '<label>Ödeme Durumu  </label><label class="">: Bekliyor</label><br/><br/>';
    }
}
echo '</div>';

    
?>
<form id="" action="http://localhost/ybsotobus/E-Odeme/E-Odeme.php" method="post">
    <?php
    if (isset($this->bookingTicket))
        foreach ($this->bookingTicket as $key => $value) {
            echo '<input type="hidden" name="bookingID" id="selecting_s" value="' . $value['bookingID'] . '">';
            echo '<input type="hidden" name="ammount" id="selecting_s" value="' . $value['ammount'] . '">';
        }
    ?>
    <div>
        <div>
            <input type="radio" name="payMethord" id="" value="" checked/>VISA / MASTER<br/>
            <input type="radio" name="payMethord" id="" value="" />PayPal<br/>
            <button type="submit" name="payment" id="" class="seabtn">Ödeme Sayfasına Git</button>
        </div>
    </div><br>
</form>