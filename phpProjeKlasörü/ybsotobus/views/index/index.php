<?php
date_default_timezone_set("Europe/Istanbul");
?>
<div class="container">
<h1>BİTİRME PROJESİNE HOŞ GELDİNİZ...</h1>.

<div class="abc">
    <form id="search_buses_form" action="<?php echo URL; ?>booker/" method="post">

        <label for="journeyFrom" class="required">NEREDEN</label>
        <select class="select" name="journeyFrom" id="journeyFrom" style="width:110px;" data-validation="required">
            <option value="" >SEÇİNİZ...</option>
            <?php
            $journeyFrom = null;
            foreach ($this->journeyFrom as $key => $value) {
                if($value['journeyFrom'] == $journeyFrom){}
                else{
                echo '<option value="' . $value['journeyFrom'] . '">' . $value['journeyFrom'] . '</option>';
                $journeyFrom = $value['journeyFrom'];
                }
            }
            ?>
        </select><br/>
        <label for="journeyTo" class="required">NEREYE</label>
        <select class="select" name="journeyTo" id="journeyTo" style="width:110px;" data-validation="required">
            <option value="" >SEÇİNİZ...</option>
            <?php
            foreach ($this->journeyTo as $key => $value) {
                echo '<option value="' . $value['journeyTo'] . '">' . $value['journeyTo'] . '</option>';
            }
            ?>
        </select><br/>

        <label for="dateofJourney" class="required">TARİH</label>
        <input  style="width:110px;" name="dateOfJourney" id="dateOfJourney" type="text" class="datepicker_bus_date" data-validation="required" value="<?php echo date("Y-m-d"); ?>"><br />
        <label ></label>
        <button type="submit" name="searchBuses" class="seabtn">SORGULA</button>
        <div class="clearfix"></div><br>
    </form>     
</div>
</div>


