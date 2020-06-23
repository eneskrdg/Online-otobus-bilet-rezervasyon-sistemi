<div class="main-form">
    <h1>Şifremi Değiştir</h1>
    <?php
    $url = explode('/', $_GET['url']);
    if (isset($url[2])) {
        if ($url[2] == 'Success')
            echo '<P class="magOk"> Şifre Değiştirme Başarılı .... ! </p>';
        if ($url[2] == 'Fail')
            echo '<P class="magNo"> Şifre Değiştirme Başarısız ...!</p>';
    }
    ?>
    <form id="update_password_form" action="<?php echo URL; ?>systemUser/updatePassword/" method="post">

                
        <label class="changer_p" for="currentPassword">Şifreniz</label>
        <input size="15" maxlength="15" name="currentPassword" id="currentPassword" type="password" value="" data-validation="required"><br />			

        <label for="newPassword" class="changer_p">Yeni Şifreniz</label>
        <input size="15" name="newPassword" id="newPassword" type="password" value="" data-validation="required"><br />			

        <label for="confirmPassword" class="changer_p">Tekrar Yeni Şifreniz</label>
        <input size="15" name="confirmPassword" id="confirmPassword" type="password" value="" ddata-validation="required" ><br />			

        <label class="changer_p"></label>
        <input type="submit" name="updatePassword" id="updatePassword" value="Kaydet">

    </form>
</div>