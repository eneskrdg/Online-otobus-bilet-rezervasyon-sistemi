<div class="main-button">
    <button class="btn"><a href="<?php echo URL; ?>entryPoint"><img class="table-button"/></a></button>
    <button class="btn"><a href="<?php echo URL; ?>entryPoint/create"><img class="add-button"/></a></button>
</div>

<div class="main-form">
    <h1>Yeni Biniş Noktası Ekle</h1>
    <?php
    $url = explode('/', $_GET['url']);
    if (isset($url[2])) {
        if ($url[2] == 'Success')
            echo '<P class="magOk"> Veri Ekleme Başarılı .... ! </p>';
        if ($url[2] == 'Fail')
            echo '<P class="magNo"> Bu Biniş Noktası Zaten Var .. !</p>';
    }
    ?>
    <form id="entryPoint_create_form" action="<?php echo URL; ?>entryPoint/createEntryPoint/" method="post">


        <label for="entryPoint" class="required">Biniş Noktası</label>
        <input size="15" maxlength="50" name="cEntryPoint" id="cEntryPoint" type="text"  data-validation="required" ><br />

        <label ></label>
        <input type="submit" name="addNewEntryPoint" id="addNewEntryPoint" value="Kaydet">

    </form>
</div>