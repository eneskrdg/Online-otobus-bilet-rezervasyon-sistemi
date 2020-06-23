<div class="main-button">
    <button class="btn"><a href="<?php echo URL; ?>systemUser"><img class="table-button"/></a></button>
    <button class="btn"><a href="<?php echo URL; ?>systemUser/create"><img class="add-button"/></a></button>
</div>

<div class="main-form">
    <h1>Sistem Kullanıcılarını Düzenle</h1>
    <?php
    $url = explode('/', $_GET['url']);
    if (isset($url[2])) {
        if ($url[2] == 'Success')
            echo '<P class="magOk"> Veri Düzenleme Başarılı .... ! </p>';
        if ($url[2] == 'Fail')
            echo '<P class="magNo"> Veri Düzenleme Başarısız ...!</p>';
    }
    ?>
    <form id="user_update_form" action="<?php echo URL; ?>systemUser/updateSystemUser/" method="post">

                
        <label for="cUserName" class="required">Kullanıcı Adı</label>
        <input size="10" maxlength="10" name="uUserName" id="uUserName" type="text" value="<?php
    if (isset($this->user[0]['userName'])) {
        echo $this->user[0]['userName'];
    }
    ?>"  data-validation="required" ><br />
        <label for="cEmpolyeeNo" class="required">Çalışan No</label>
        <input size="10" maxlength="15" name="uEmpolyeeNo" id="uEmpolyeeNo" type="text" value="<?php
    if (isset($this->user[0]['empolyeeNo'])) {
        echo $this->user[0]['empolyeeNo'];
    }
    ?>" data-validation="required"><br />			

        <label for="cEmpolyeeName" class="required">Çalışan Adı</label>
        <input size="20" name="uEmpolyeeName" id="uEmpolyeeName" type="text" value="<?php
    if (isset($this->user[0]['empolyeeName'])) {
        echo $this->user[0]['empolyeeName'];
    }
    ?>" data-validation="required"><br />			

        <label for="cEmpolyeeMNo" class="required">Telefon Numarası</label>
        <input size="10" name="uEmpolyeeMNo" id="uEmpolyeeMNo" type="text" value="<?php
               if (isset($this->user[0]['empolyeeMNo'])) {
                   echo $this->user[0]['empolyeeMNo'];
               }
    ?>" ddata-validation="required"><br />			

        <label ></label>
        <input type="submit" name="editUser" id="editUser" value="Kaydet">

    </form>
</div>