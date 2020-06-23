<div>
    <button><a href="<?php echo URL; ?>systemUser"><img class="table-button"/></a></button>
</div>

<div>
    <?php
    $url = explode('/', $_GET['url']);
    if ($url[3]=='Not User')
        echo '<h1>Kullanıcı Ekle</h1>';
    else 
        echo '<h1>Görev Ataması</h1>';
    
    if (isset($url[2])) {
        if ($url[2] == 'Success')
            echo '<P class="magOk"> Veri Kaydetme Başarılı .... ! </p>';
        if ($url[2] == 'Fail')
            echo '<P class="magNo"> Veri Kaydetme Başarısız ...!</p>';
    }
    ?>
    <form id="user_update_form" action="<?php echo URL; ?>systemUser/createPrivilege/" method="post">


        <label for="UserName" class="required">Kullanıcı Adı</label>
        <input size="10" maxlength="10" name="loginUserName" id="loginUserName" type="text" value="<?php
    if (isset($url[2])) {
        echo $url[2];
    }
    ?>"  data-validation="required" ><br/>		

        <label for="privilege" class="required">Görev</label>
        <select name="loginPrivilege" id="loginPrivilege" data-validation="required">
            <option value="<?php if (isset($url[3])) {
                   echo $url[3];
               } ?>" selected><?php if (isset($url[3])) {
                   echo $url[3];
               } ?></option>
            <option value="Admin" >Admin</option>
            <option value="Yonetici" >Yönetici</option>
            <option value="Rezervasyon" >Rezervasyon</option>
            <option value="Muavin" >Muavin</option>
        </select><br/>	

        <label ></label>
        <input type="submit" name="createLogin" id="createLogin" value="Kaydet">

    </form>
</div>