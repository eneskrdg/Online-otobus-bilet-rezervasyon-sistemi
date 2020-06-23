<?php
    date_default_timezone_set("Europe/Istanbul");
    $date = new DateTime(date("H:i"));
    $date->sub(new DateInterval('PT00H20M00S'));
    ?>

<div>
    <div><h1>SEFERLER</h1></div>
    <form id="" action="<?php echo URL; ?>booker/booking/" method="post">
        <div>
            <label><b>TARİH :</b></label><label><?php echo $this->bookDate ?></label>
        </div>
        <br>
        <div class="table-responsive">

                <table class="table-bordered table-hover" id="exampleBooker" >
                        <tr>
                            <th>OTOBÜS No</th>
                            <th>KOLTUK SAYISI</th>
                            <th>GÜZERGAH</th>
                            <th>HAREKET SAATİ</th>
                            <th>VARIŞ SAATİ</th>
                            <th></th>
                            <th>FİYAT</th>
                            <th></th>
                        </tr>

                        <?php
                        if (isset($this->availablelBus)) {
                            foreach ($this->availablelBus as $key => $value1) {
                                echo '<tr class="table">';
                                echo '<td>' . $value1['busNo'] . '</td>';
                                echo '<td>' . $value1['numberOfSeat'] . '</td>';
                                echo '<td>' . $value1['routeNo'] . '</td>';
                                echo '<td>' . $value1['departureTime'] . '</td>';
                                echo '<td>' . $value1['arrivalTime'] . '</td>';
                                echo '<td><select hidden>';
                                echo '<option hidden>Entry Point</option>';
                                foreach ($value1['entry_Point'] as $key => $value2) {
                                    echo '<option hidden>' . $value2['entryPoint'] . '</option>';
                                }
                                echo '</select></td>';
                                echo '<td>' . $value1['price'] . ' TL</td>';
                                echo '<td>';if ($date->format('H:i')<$value1['departureTime'] || date('d-m-Y')<$this->bookDate) { echo'<button type="submit" name="bookNow" class="seabtn">BİLET AL</button><br>'; } echo'</td>';
                                echo '<br></tr>';
                            }
                        }
                        ?>
                </table>

            <?php if(($this->bookDate) != null){?>
                <input type="hidden" name="book_date" id="book_date" value="<?php echo $this->bookDate ?>"/>
                <input type="hidden" name="book_journeyFrom" id="book_journeyFrom" value="<?php if(($this->journeyFrom) != null){echo $this->journeyFrom;} ?>"/>
                <input type="hidden" name="book_journeyTo" id="book_journeyTo" value="<?php if(($this->journeyTo) != null){echo $this->journeyTo;} ?>"/>
                <input type="hidden" name="book_busNo" id="book_busNo" value=""/>
                <input type="hidden" name="book_numberOfSeat" id="book_numberOfSeat" value=""/>
                <input type="hidden" name="book_price" id="book_price" value=""/>
            <?php }?>

    </form>
</div>

