<button><a href="<?php echo URL; ?>bus"><img class="table-button"/></a></button>
<div>
    <div><h1>Yolculuk İçin Otobüsler</h1></div><div></div>
    <label>
        <?php
        $url = explode('/', $_GET['url']);
        if (isset($url[3])) {
            if ($url[3] == 'false')
                echo '<P style="color:red;">Sadece iki izin</p>';
        }
        ?>
    </label>
    <?php
    ?>
    <?php
    ?>
    <div>
        <div class="table-responsive">
            <div>
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                    <thead>
                        <tr>
                            <th>Otobüs No</th>
                            <th>Sefer No</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Otobüs No</th>
                            <th>Sefer No</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody class="main-form">
                        <?php
                        if (isset($this->searchJourneyforBus)) {
                            foreach ($this->searchJourneyforBus as $key => $value) {
                                echo '<tr>';
                                echo '<td>' . $value['busNo'] . '</td>';
                                echo '<td>' . $value['journeyNo'] . '</td>';
                                echo '<td>
                            <a href="' . URL . 'bus/deleteJourneyforBus/' . $value['journey_for_bus_No'] . '/' . $value['busNo'] . '"><img class="table-delete-button"/></a>
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
        <div main-form>
            <form action="<?php echo URL; ?>bus/addJourneyforBus/" method="post">
                <label for="journey" class="required">Sefer Numarası</label>

                <?php
                $url = explode('/', $_GET['url']);
                if (isset($url[2])) {
                    echo '<input type="hidden" name="busNo" value="' . $url[2] . '"><br/>';
                }
                ?>
                <?php
                if (isset($this->searchAllJourney)) {
                    foreach ($this->searchAllJourney as $key => $value) {
                        echo '<label></label>';
                        echo '<input type="radio" name="journeyNo" id="journeyNoRedioBtn" value="' . $value['journeyNo'] . '"/>' . ' ' . $value['journeyNo'] . '<br/>';
                    }
                }
                ?>

                <label ></label>
                <input type="submit" name="addJourney" id="" value="Kaydet">
            </form>
        </div>
    </div>
</div>