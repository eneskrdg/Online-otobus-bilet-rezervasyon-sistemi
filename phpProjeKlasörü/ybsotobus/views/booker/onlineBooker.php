<?php
Session::init();
foreach (Session::get('sessionforSelectin_s') as $key => $value) {
            $book_numberOfSeat = ++$key;
}
?>
<div>
    <h1>SEYAHAT DETAYLARI</h1>
<div>
            <label><b>TARİH : </b></label><label><?php echo $this->busDara['book_date'];?></label><br/>
            <label><b>OTOBÜS NO : </b></label><label><?php echo $this->busDara['book_busNo']; ?></label><br/>
            <label><b>SEÇTİĞİNİZ KOLTUK SAYISI : </b></label><label><?php echo $book_numberOfSeat; ?></label><br/>
            <label><b>TOPLAM TUTAR : </b></label><label><?php echo $this->busDara['book_total_ammount']; ?></label>
</div>
<div id="timeOutBooking" style="text-align:center; color: #d14"></div>

<form id="" action="<?php echo URL; ?>bookingSeat/onlineBookerConform/" method="post">

    <input type="hidden" name="selecting_s" id="selecting_s" value="">
    <input type="hidden" name="book_date" id="seat_book_date" value="<?php echo $this->busDara['book_date']; ?>"/>
    <input type="hidden" name="book_journeyNo" id="seat_book_journeyNo" value="<?php echo $this->busDara['book_journeyNo']; ?>"/>
    <input type="hidden" name="book_busNo" id="seat_book_busNo" value="<?php echo $this->busDara['book_busNo']; ?>"/>
    <input type="hidden" name="book_numberOfSeat" id="seat_book_numberOfSeat" value="<?php echo $this->busDara['book_numberOfSeat']; ?>"/>
    <input type="hidden" name="book_price" id="seat_book_price" value="<?php echo $this->busDara['book_price']; ?>"/>
    <input type="hidden" name="book_total_ammount" id="seat_book_price" value="<?php echo $this->busDara['book_total_ammount']; ?>"/>


    
    <div>
        <h3>YOLCU BİLGİLERİ</h3>
        <div id="passenger_info">
        </div>
    </div>
    
    <div id="booker_info">
        <h3>YOLCU DETAYLARI</h3>
        <div>
            <label>MÜŞTERİ TC :</label>
            <input name="booker_tc" autocomplete="off" type="text" maxlength="11" class="" id="booker_tc" data-validation="required"  value=""/><br/>
            <label>MÜŞTERİ ADI SOYADI :</label>
            <input name="bookername" type="text" class="" id="bookername" data-validation="required"  value=""/><br/>
            <label>TELEFON NUMARASI :</label>
            <input name="booker_mno" type="text" class="" id="booker_mno" data-validation="required"  value=""/><br/>
            <label>BİNİŞ NOKTASI :</label>
            <select name="boardpoint" class="select" style="width:180px;" id="onboardpoint" data-validation="required" >
                <option value="">Biniş Noktası Seçiniz...</option>
                <?php
                foreach ($this->searchAllBoardingPoint as $key => $value) {
                    echo '<option value="' . $value['entryPointNo'] . '" > ' . $value['entryPoint'] . '</option>';
                }
                ?>
            </select>
            <div>
                <button type="submit" name="Conform_o_b" class="seabtn">Rezervasyon Yap</button>
            </div>
        </div>

    </div>
    <br>
</form>
</div>