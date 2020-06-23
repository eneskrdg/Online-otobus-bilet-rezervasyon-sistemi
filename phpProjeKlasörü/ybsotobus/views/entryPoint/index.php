<div>
    <button><a href="<?php echo URL; ?>entryPoint"><img class="table-button"/></a></button>
    <button><a href="<?php echo URL; ?>entryPoint/create"><img class="add-button"/></a></button>
</div>

<div class="">
    <div><h1>Tüm Biniş Noktaları</h1></div>
    <?php
    $url = explode('/', $_GET['url']);
    if (isset($url[2])) {
            echo '<P class="magNo">Hata ... ! İşlem Başarısız.</p>';
    }
    ?>
    <div>
        <div class="table-responsive">
        <div class="demo_jui">
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>Biniş Noktası No</th>
                        <th>Biniş Noktası</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Biniş Noktası No</th>
                        <th>Biniş Noktası</th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($this->searchAllEntryPoint as $key => $value) {
                        echo '<tr>';
                        echo '<td>' . $value['entryPointNo'] . '</td>';
                        echo '<td>' . $value['entryPoint'] . '</td>';
                        echo '<td>
                            <a href="' . URL . 'entryPoint/updateFromTable/' . $value['entryPointNo'] . '"><img class="table-edit-button"/></a>
                            <a href="' . URL . 'entryPoint/deleteEntryPoint/' . $value['entryPointNo'] . '"><img class="table-delete-button"/></a>
                     </td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
            
        </div>
        <div class="spacer"></div>
    </div>
</div>

