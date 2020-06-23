<div>
    <button><a href="<?php echo URL; ?>conductor"><img class="table-button"/></a></button>
    <button><a href="<?php echo URL; ?>conductor/create"><img class="add-button"/></a></button>
</div>

<div class="">
    <div><h1>Tüm Muavinler</h1></div>
    <?php
    $url = explode('/', $_GET['url']);
    if (isset($url[2])) {
            echo '<P class="magNo"> Hata ... ! İşlem Başarısız...</p>';
    }
    ?>
    <div class="table-responsive">
        <div>
            <table cellpadding="0" cellspacing="0" border="0" class="display table-responsive" id="example">
                <thead>
                    <tr>
                        <th>Muavin No</th>
                        <th>Muavin Adı</th>
                        <th>Muavin Telefon Numarası</th>
                        <th>Otobüs No</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Muavin No</th>
                        <th>Muavin Adı</th>
                        <th>Muavin Telefon Numarası</th>
                        <th>Otobüs No</th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($this->searchAllConductor as $key => $value) {
                        echo '<tr>';
                        echo '<td>' . $value['conductorNo'] . '</td>';
                        echo '<td>' . $value['conductorName'] . '</td>';
                        echo '<td>' . $value['conductorMNo'] . '</td>';
                        echo '<td>' . $value['busNo'] . '</td>';
                        echo '<td>
                            <a href="' . URL . 'conductor/updateFromTable/' . $value['conductorNo'] . '"><img class="table-edit-button"/></a>
                            <a href="' . URL . 'conductor/deleteConductor/' . $value['conductorNo'] . '"><img class="table-delete-button"/></a>
                     </td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="spacer"></div>
    </div>
</div>

