<div class="main-button">
    <button class="btn"><a href="<?php echo URL; ?>journey"><img class="table-button"/></a></button>
    <button class="btn"><a href="<?php echo URL; ?>journey/create"><img class="add-button"/></a></button>
</div>

<div class="main-form">
    <h1>Sefer Güncelle</h1>
    <?php
    $url = explode('/', $_GET['url']);
    if (isset($url[2])) {
        if ($url[2] == 'Success')
            echo '<P class="magOk"> Veri Güncelleme Başarılı ... ! </p>';
        if ($url[2] == 'Fail')
            echo '<P class="magNo"> Veri Güncelleme Başarısız ... !</p>';
    }
    ?>
    <form id="bus_update_form" action="<?php echo URL; ?>journey/updateJourney/" method="post">



        <input type="hidden" name="ujourneyNo" value="<?php
    if (isset($this->journey[0]['journeyNo'])) {
        echo $this->journey[0]['journeyNo'];
    }
    ?>">
        <label for="routeNo" class="required">Sefer No</label>
        <label for="routeNo" class="required"><?php
               if (isset($this->journey[0]['journeyNo'])) {
                   echo $this->journey[0]['journeyNo'];
               }
    ?></label><br />

        <label for="routeNo" class="required">Güzergah</label>
        <input size="10" maxlength="200" name="uRouteNo" id="uRouteNo" type="text" value="<?php
            if (isset($this->journey[0]['routeNo'])) {
                echo $this->journey[0]['routeNo'];
            }
    ?>" data-validation="required"><br />			

        <label for="journeyFrom" class="required">Nereden</label>
        <input size="10" name="uJourneyFrom" id="uJourneyFrom" type="text"  value="<?php
               if (isset($this->journey[0]['journeyFrom'])) {
                   echo $this->journey[0]['journeyFrom'];
               }
    ?>" data-validation="required"><br />			

        <label for="journeyTo" class="required">Nereye</label>
        <input size="10" name="uJourneyTo" id="uJourneyTo" type="text"  value="<?php
               if (isset($this->journey[0]['journeyTo'])) {
                   echo $this->journey[0]['journeyTo'];
               }
    ?>" data-validation="required"><br />

        <label for="Bus_departureTime" class="required">Hareket Saati</label>
        <input size="10" name="uBus_departureTime" type="text"  value="<?php
               if (isset($this->journey[0]['departureTime'])) {
                   echo $this->journey[0]['departureTime'];
               }
    ?>" value="00:00" type="text" data-validation="required"> 24 Saat<br />

        <label for="Bus_arrivalTime" class="required">Varış Saati</label>
        <input size="10" name="uBus_arrivalTime" type="text"  value="<?php
               if (isset($this->journey[0]['arrivalTime'])) {
                   echo $this->journey[0]['arrivalTime'];
               }
    ?>" value="24:00" data-validation="required"> 24 Saat<br />

        <label for="price" class="required">Fiyat</label>
        <input  size="10" name="uPrice" id="uPrice" type="text"  value="<?php
               if (isset($this->journey[0]['price'])) {
                   echo $this->journey[0]['price'];
               }
    ?>" data-validation="required"><br />

        <label ></label>
        <input type="submit" name="updateJourney" id="updateJourney" value="Kaydet">

    </form>
</div>
