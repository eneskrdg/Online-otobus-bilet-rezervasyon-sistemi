<?php 
Session::init(); 
?>
<?php if (Session::get('privilege') == 'Admin') { ?>
    <div class="">
        <h3>Otobüs Rezervasyon Raporu</h3><br/>
        <form id="" target="_blank" action="<?php echo URL; ?>report/bookingData/" method="post">
            <label for="" class="repot_date_la">Tarih Başlangıç</label>
            <input  size="10" name="date_from" id="" class="datepicker_repot" data-validation="required" value="<?php echo date("Y-m-d"); ?>"><br/>
            <label for="" class="repot_date_la">Tarih Bitiş</label>
            <input  size="10" name="date_to" id="" class="datepicker_repot" data-validation="required" value="<?php echo date("Y-m-d"); ?>"><br/>
            <label for="busNo" class="required">Otobüs No</label>
            <select name="busNo" data-validation="required">
                <option value="AB">Tüm Otobüsler</option>
                <?php
                foreach ($this->searchAllBus as $key => $value) {
                    echo '<option value="' . $value['busNo'] . '" > ' . $value['busNo'] . '</option>';
                }
                ?>
            </select><br/>
            <label for="journeyNo" class="required">Sefer No</label>
            <select name="journeyNo" data-validation="required">
                <option value="AJ">Tüm Seferler</option>
                <?php
                foreach ($this->searchAllJourney as $key => $value) {
                    echo '<option value="' . $value['journeyNo'] . '" > ' . $value['journeyNo'] . '</option>';
                }
                ?>
            </select><br/>
            <label ></label>
            <input type="submit" class="btn-danger" name="" id="" value="Rapor Al">
        </form>
    </div>
<?php } ?>

<?php if (Session::get('privilege') == 'Admin') { ?>
    <div class="">
        <h3>Yolcu Rezervasyon Bilgi Raporu</h3><br/>
        <form id="bus_create_form" target="_blank" action="<?php echo URL; ?>report/bookerReport/" method="post">
            <label for="" class="repot_date_la">Tarih</label>
            <input  size="10" name="journeyDate" id="" class="datepicker_repot" data-validation="required" value="<?php echo date("Y-m-d"); ?>"><br/>
            <label for="busNo" class="required">Otobüs No</label>
            <select name="busNo" data-validation="required">
                <option ></option>
                <?php
                foreach ($this->searchAllBus as $key => $value) {
                    echo '<option value="' . $value['busNo'] . '" > ' . $value['busNo'] . '</option>';
                }
                ?>
            </select><br/>
            <label ></label>
            <input type="submit" class="btn-danger" name="" id="" value="Rapor Al">
        </form>
    </div>
<?php } ?>

<?php if (Session::get('privilege') == 'Admin') { ?>
    <div class="">
        <h3>Yolcu Bilgi Raporu</h3><br/>
        <form id="bus_create_form" target="_blank" action="<?php echo URL; ?>report/passengerReport/" method="post">
            <label for="" class="repot_date_la">Tarih</label>
            <input  size="10" name="journeyDate" id="" class="datepicker_repot" data-validation="required" value="<?php echo date("Y-m-d"); ?>"><br/>
            <label for="busNo" class="required">Otobüs No</label>
            <select name="busNo" data-validation="required">
                <option ></option>
                <?php
                foreach ($this->searchAllBus as $key => $value) {
                    echo '<option value="' . $value['busNo'] . '" > ' . $value['busNo'] . '</option>';
                }
                ?>
            </select><br/>
            <label ></label>
            <input type="submit" class="btn-danger" name="" id="" value="Rapor Al">
        </form>
    </div>
<?php } ?>



<?php if (Session::get('privilege') == 'Admin_Not') { ?>
    <div class="">
        <h3>Rezervasyon Bilgi Raporu</h3><br/>
        <form id="bus_create_form" target="_blank" action="" method="post">
            <label for="" class="repot_date_la">Yolculuk Tarihi</label>
            <input  size="10" name="journeyDate" id="" class="datepicker_repot" data-validation="required" value="<?php echo date("Y-m-d"); ?>"><br/>
            <label for="busNo" class="required">Otobüs No</label>
            <select name="busNo" data-validation="required">
                <option ></option>
                <?php
                foreach ($this->searchAllBus as $key => $value) {
                    echo '<option value="' . $value['busNo'] . '" > ' . $value['busNo'] . '</option>';
                }
                ?>
            </select><br/>
            <label ></label>
            <input type="submit" class="btn-danger" name="" id="" value="Rapor Al">
        </form>
    </div>
<?php } ?>

<?php if (Session::get('privilege') == 'Muavin') { ?>
    <div class="">
        <h3>Rezervasyon Bilgi Raporu</h3><br/>
        <form id="bus_create_form" action="<?php echo URL; ?>report/bookingReport/" method="post">
            <label for="" class="repot_date_la">Yolculuk Tarihi</label>
            <input  size="10" name="journeyDate" id="" class="datepicker_repot" data-validation="required" value="<?php echo date("Y-m-d"); ?>"><br/>
            <label for="busNo" class="required">Otobüs No</label>
            <select name="busNo" id="busNoforBookingReport" data-validation="required">
                <option ></option>
                <?php
                foreach ($this->searchAllBus as $key => $value) {
                    echo '<option value="'.$value['busNo'].'" > '.$value['busNo'].'</option>';
                }
                ?>
            </select><br/>
            <label for="journeyNo" class="required">Yolculuk No</label>
            <select name="journeyNo" id="journeyNoforBookingReport" data-validation="required">
               
            </select><br/>
            <label ></label>
            <input type="submit" class="btn-danger" name="" id="" value="Rapor Al">
        </form>
    </div>
<?php } ?>

<?php if (Session::get('privilege') == 'Muavin') { ?>
    <div class="table-responsive">
        <div id="tSize">
            <div class="demo_jui"> 
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="exampleBooker">
                    <thead>
                        <tr>
                            <th>Koltuk Numarası</th>
                            <th>Durum</th>
                            <th>Bilet Numarası</th>
                            <th>Adı</th>
                            <th>Cinsiyet</th>
                            <th>Biniş Noktası</th>
                            <th>Telefon Numarası</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if (isset($this->searchBookingData)) {
                            foreach ($this->searchBookingData as $key => $value) {
                                echo '<tr class="">';
                                echo '<td>' . $value['seatNo'] . '</td>';
                                echo '<td>' . $value['status'] . '</td>';
                                echo '<td>' . $value['ticketNo']. '</td>';
                                echo '<td>' . $value['passengerName']. '</td>';
                                echo '<td>' . $value['gender']. '</td>';
                                echo '<td>' . $value['entryPoint']. '</td>';
                                echo '<td>' . $value['bookerMNo']. '</td>';
                                
                                echo '</tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="spacer"></div>
        </div>   
    </div>
 <div class="">
        <form id="bus_create_form" target="_blank" action="<?php echo URL; ?>report/bookingReportforPDF/" method="post">
            <input type="hidden" name="journeyDate" id="r_journeyDate" value="<?php if(isset($this->journeyDate)) {echo $this->journeyDate;} ?>"/>
            <input type="hidden" name="busNo" id="r_busNo" value="<?php if(isset($this->journeyDate)) { echo $this->busNo; }?>"/>
            <input type="hidden" name="journeyNo" id="r_journeyNo" value="<?php if(isset($this->journeyNo)) { echo $this->journeyNo; }?>"/>
            <input type="submit" class="btn-danger" name="booking" id="" value="PDF RAPOR AL">
        </form>
 </div>
<?php } ?>


