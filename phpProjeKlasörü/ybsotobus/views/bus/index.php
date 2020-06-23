<div class="table-responsive">
    <div><h1>Tüm Otobüsler</h1></div><br><br>
    <?php
    $url = explode('/', $_GET['url']);
    if (isset($url[2])) {
            echo '<P>Hata ... ! İşlem Başarısız. </p>';
    }
    ?>
    <br>
    <div>
        <button><a href="<?php echo URL; ?>bus"><img class="table-button"/></a></button>
        <button><a href="<?php echo URL; ?>bus/create"><img class="add-button"/></a></button>
    </div>
    <div class="table-responsive">
        <div>
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>Otobüs No</th>
                        <th>Model</th>
                        <th>Koltuk Sayısı</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Otobüs No</th>
                        <th>Model</th>
                        <th>Koltuk Sayısı</th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($this->searchAllBus as $key => $value) {
                        echo '<tr>';
                        echo '<td>' . $value['busNo'] . '</td>';
                        echo '<td>' . $value['busModel'] . '</td>';
                        echo '<td>' . $value['numberOfSeat'] . '</td>';
                        echo '<td><a href="' . URL . 'bus/addJourneytoBus/' . $value['busNo'] . '">Sefer No</a></td>';
                        echo '<td>
                            <a href="' . URL . 'bus/updateFromTable/' . $value['busNo'] . '"><img class="table-edit-button" /></a>
                            <a href="' . URL . 'bus/deleteBus/' . $value['busNo'] . '"><img class="table-delete-button" /></a>
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

