<div class="">
    <div><h1>KULLANICILAR</h1></div>
    <div>
        <button><a href="<?php echo URL; ?>systemUser"><img class="table-button"/></a></button>
        <button><a href="<?php echo URL; ?>systemUser/create"><img class="add-button"/></a></button>
    </div>
    <?php
    $url = explode('/', $_GET['url']);
    if (isset($url[2])) {
        echo '<P class="magNo"> HATA ... ! İşlem Başarısız... !</p>';
    }
    ?>
    <div id="tSize" class="table-responsive">
        <div>
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>Kullanıcı Adı</th>
                        <th>Çalışan No</th>
                        <th>Çalışan Adı</th>
                        <th>Telefon Numarası</th>
                        <th>Görevi</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Kullanıcı Adı</th>
                        <th>Çalışan No</th>
                        <th>Çalışan Adı</th>
                        <th>Telefon Numarası</th>
                        <th>Görevi</th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    if (isset($this->searchAllSystemUser)) {
                        foreach ($this->searchAllSystemUser as $key => $value) {
                            echo '<tr>';
                            echo '<td>' . $value['userName'] . '</td>';
                            echo '<td>' . $value['empolyeeNo'] . '</td>';
                            echo '<td>' . $value['empolyeeName'] . '</td>';
                            echo '<td>' . $value['empolyeeMNo'] . '</td>';
                            echo '<td>' . $value['privilege'] . '</td>';
                            if ($value['privilege'] == 'Not User')
                                echo '<td><a href="' . URL . 'systemUser/createUserLogin/' . $value['userName'] . '/' . $value['privilege'] . '"> Üyelik Oluştur</a></td>';
                            else
                                echo '<td><a href="' . URL . 'systemUser/createUserLogin/' . $value['userName'] . '/' . $value['privilege'] . '"> Görev Ataması</a></td>';
                            echo '<td>
                                <a href="' . URL . 'systemUser/updateFromTable/' . $value['userName'] . '"><img class="table-edit-button" /></a>
                                <a href="' . URL . 'systemUser/deleteSystemUser/' . $value['userName'] . '"><img class="table-delete-button" /></a>
                                </td>';
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

