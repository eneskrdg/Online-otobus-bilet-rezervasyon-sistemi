<div class="main-button">
    <button class="btn"><a href="<?php echo URL; ?>conductor"><img class="table-button"/></a></button>
    <button class="btn"><a href="<?php echo URL; ?>conductor/create"><img class="add-button"/></a></button>
</div>
<div class="main-form">
    <h1>Yeni Muavin Ekle</h1>
    <?php
    $url = explode('/', $_GET['url']);
    if (isset($url[2])) {
        if ($url[2] == 'Success')
            echo '<P class="magOk"> Veri Ekleme Başarılı .... ! </p>';
        if ($url[2] == 'Fail')
            echo '<P class="magNo"> Bu Muavin Zaten Kayıtlı .. !</p>';
    }
    ?>
    <form id="conductor_create_form" action="<?php echo URL; ?>conductor/createConductor/" method="post">


        <label for="conductorNo" class="required">Muavin No</label>
        <input size="10" maxlength="10" name="cConductorNo" id="cConductorNo" type="text"  data-validation="required" ><br />			

        <label for="conductorName" class="required">Muavin Adı</label>
        <input size="15" maxlength="15" name="cConductorName" id="cConductorName" type="text" data-validation="required"><br />			

        <label for="conductorMNo" class="required">Muavin Telefon Numarası</label>
        <input size="10" name="cConductorMNo" id="cConductorMNo" type="text" data-validation="required"><br />			

        <label for="busNo" class="required">Otobüs Numarası</label>
        <select name="cBusNo" data-validation="">
            <option ></option>
            <?php
            foreach ($this->searchAllBus as $key => $value) {
                echo '<option value="'.$value['busNo'].'" > ' . $value['busNo'] . '</option>';
            }
            ?>
        </select><br/>
        
        <label ></label>
        <input type="submit" name="addNewConductor" id="addNewConductor" value="Kaydet">

    </form>
</div>