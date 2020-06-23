
    <button><a href="<?php echo URL; ?>journey"><img class="table-button"/></a></button>

<div>
    <div ><h1>Sefer İçin Biniş Noktası</h1></div>
    <?php
    ?>
    <?php
    ?>
    <div class="table-responsive">
        <div >
            <div class="demo_jui">
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                    <thead>
                        <tr>
                            <th>Sefer No</th>
                            <th>Biniş Noktası</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sefer No</th>
                            <th>Güzergah</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        if (isset($this->searchEntryPointForJourney)) {
                            foreach ($this->searchEntryPointForJourney as $key => $value) {
                                echo '<tr>';
                                echo '<td>' . $value['journeyNo'] . '</td>';
                                echo '<td>' . $value['entryPoint'] . '</td>';
                                echo '<td>
                            <a href="' . URL . 'journey/deleteEntryPointForJourney/' . $value['entryPoint_for_journeyNo'] . '/' . $value['journeyNo'] . '"><img class="table-delete-button"/></a>
                        </td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="spacer"></div>
        <div class="tFotm">
            <form id="EntryPointForJourney_create_form" action="<?php echo URL; ?>journey/addEntryPointForJourney/" method="post">
                <label for="enntryPoint" class="required">Biniş Noktası</label>
                <?php
                $url = explode('/', $_GET['url']);
                if (isset($url[2])) {
                    echo '<input type="hidden" name="journeyNo" value=' . $url[2] . '><br/>';
                }
                ?>
                <?php
                if (isset($this->searchAllEnrtyPointNo)) {
                    foreach ($this->searchAllEnrtyPointNo as $key => $value) {
                        echo '<label></label>';
                        echo '<input type="checkbox" name="enntryPoint[]" value=' . $value['entryPointNo'] . '>' . ' ' . $value['entryPoint'] . '<br/>';
                    }
                }
                ?>
                <label ></label>
                <input type="submit" name="addNewJourney" id="addNewJourney" value="Kaydet">
            </form>
        </div>
    </div>
</div>