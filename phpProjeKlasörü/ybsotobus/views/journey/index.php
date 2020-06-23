<div>
    <button><a href="<?php echo URL; ?>journey"><img class="table-button"/></a></button>
    <button><a href="<?php echo URL; ?>journey/create"><img class="add-button"/></a></button>
</div>

<div class="">
    <div><h1>Seferler</h1></div>
    <?php
    $url = explode('/', $_GET['url']);
    if (isset($url[2])) {
            echo '<P class="magNo"> Hata ... ! İşlem Başarısız. </p>';
    }
    ?>
    <div class="table-responsive">
        <div>
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>Sefer No</th>
                        <th>Güzergah</th>
                        <th>Nereden</th>
                        <th>Nereye</th>
                        <th>Hareket Saati</th>
                        <th>Varış Saati</th>
                        <th>Fiyat</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Sefer No</th>
                        <th>Güzergah</th>
                        <th>Nereden</th>
                        <th>Nereye</th>
                        <th>Hareket Saati</th>
                        <th>Varış Saati</th>
                        <th>Fiyat</th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    if(isset($this->searchAllJourney)){
                    foreach ($this->searchAllJourney as $key => $value) {
                        echo '<tr>';
                        echo '<td style="text-align:left;">' . $value['journeyNo'] . '</td>';
                        echo '<td>' . $value['routeNo'] . '</td>';
                        echo '<td>' . $value['journeyFrom'] . '</td>';
                        echo '<td>' . $value['journeyTo'] . '</td>';
                        echo '<td>' . $value['departureTime'] . '</td>';
                        echo '<td>' . $value['arrivalTime'] . '</td>';
                        echo '<td>' . $value['price'] . '</td>';
                        echo '<td> <a href="' . URL . 'journey/entryPoint/' . $value['journeyNo'] . '"> Biniş Noktası </a> </td>';
                        echo '<td>
                            <a href="' . URL . 'journey/updateFromTable/' . $value['journeyNo'] . '"><img class="table-edit-button"/></a>
                            <a href="' . URL . 'journey/deleteJourney/' . $value['journeyNo'] . '"><img class="table-delete-button"/></a>
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

