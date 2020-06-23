<pre>
    <?php
    
    date_default_timezone_set("Europe/Istanbul");
    ?>

</pre>

<div>
    <h2> Lütfen Aşağıdan Koltuk Seçimi Yapınız</h2>
    <div>
        <label><b>TARİH : </b></label><label><?php echo $this->busDara['book_date']; ?></label><br/>
        <label><b>OTOBÜS NO : </b></label><label><?php echo $this->busDara['book_busNo']; ?></label>
    </div>
        <div class="timeOut" style="text-align:center; color: #d14"></div>
    
    <div id="viweSeat" class="table-responsive">
    </div>


    <div>
        <form id="" action="<?php echo URL; ?>booker/<?php if (Session::get('privilege') == 'Rezervasyon') {
        echo 'manualBooker';
    } else {
        echo 'onlineBooker';
    } ?>/" method="post">
            <input type="hidden" name="selecting_s" id="selecting_s" value=""/>
            <input type="hidden" name="book_date" id="seat_book_date" value="<?php echo $this->busDara['book_date']; ?>"/>
            <input type="hidden" name="book_journeyNo" id="seat_book_journeyNo" value="<?php echo $this->journeyNo[0]['journeyNo']; ?>"/>
            <input type="hidden" name="book_busNo" id="seat_book_busNo" value="<?php echo $this->busDara['book_busNo']; ?>"/>
            <input type="hidden" name="book_numberOfSeat" id="seat_book_numberOfSeat" value="<?php echo $this->busDara['book_numberOfSeat']; ?>"/>
            <input type="hidden" name="book_price" id="seat_book_price" value="<?php echo $this->busDara['book_price']; ?>"/>
            <div><br>
                <h3><label> Seçilen Koltuklar:</label></h3>
                <input hidden type="text" size="15" name="book_total_ammount"  id="total_price_for_selecting_seate" value="0"/><br>
                <label for="" class="table-responsive">No:</label>
                <textarea name="" disabled id="selecting_seate_for_booker" data-validation="required" rows="4" cols="10"></textarea><br>
                <input  type="submit" name="Continue" value="Devam Et" />
                <input  type="button" id="reset" value="Sıfırla" />
            </div>
        </form>
    </div>

    <div>
        <ul id="seatDescription">
            <li id="a_seat" style="">Boş Koltuk</li>
            <li id="b_seat" style="">Dolu Koltuk</li>
            <li id="s_seat" style="">Seçilen Koltuk</li>
            <li id="h_seat" style="">Rezervasyonlu Koltuk</li>
        </ul>
    </div>
</div>
<br><br>