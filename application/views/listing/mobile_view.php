<div class="content-primary">	
    <?php if (!empty($status)) { ?>
        <div class="alert alert-success"><?= urldecode($status) ?></div>
    <?php } ?>
    <div data-role="collapsible">
        <h4>Filters</h4>
        <form method="POST" data-ajax="false" action="<?= $this->config->item('base_url') . substr($_SERVER['REDIRECT_QUERY_STRING'], 1) ?>">
            <div>

                <select name="countrySN" id="countrySN">
                    <option value="">Please Select Country </option>
                </select>
                <input type="hidden" id="countrySN_hid" value="<?= (!empty($_POST) && array_key_exists('countrySN', $_POST) ? $_POST['countrySN'] : "") ?>" />
            </div>
            <div>

                <select name="regionSN" id="regionSN">
                    <option value="">Please Select Region </option>
                </select>
                <input type="hidden" id="regionSN_hid" value="<?= (!empty($_POST) && array_key_exists('regionSN', $_POST) ? $_POST['regionSN'] : "") ?>" />
            </div>
            <div>

                <select name="districtSN" id="districtSN">
                    <option value="">Please Select District </option>
                </select>
                <input type="hidden" id="districtSN_hid" value="<?= (!empty($_POST) && array_key_exists('districtSN', $_POST) ? $_POST['districtSN'] : "") ?>" />
            </div>
            <div>

                <select name="suburbSN" id="suburbSN">
                    <option value="">Please Select Suburb </option>
                </select>
                <input type="hidden" id="suburbSN_hid" value="<?= (!empty($_POST) && array_key_exists('suburbSN', $_POST) ? $_POST['suburbSN'] : "") ?>" />
            </div>
            <div>
                <label>Bedrooms:</label>
                <select name="beds[MIN]">
                    <?php for ($i = 0; $i <= 6; $i++) { ?>
                        <option value="<?= $i ?>" <?= (!empty($_POST) && array_key_exists('beds', $_POST) ? ($_POST['beds']['MIN'] == $i ? "selected" : "") : "") ?>><?= ($i == 0 ? "Any" : ($i == 6 ? "6+" : $i)) ?></option>
                    <?php } ?>
                </select> 
                <select name="beds[MAX]">
                    <?php for ($i = 0; $i <= 6; $i++) { ?>
                        <option value="<?= $i ?>" <?= (!empty($_POST) && array_key_exists('beds', $_POST) ? ($_POST['beds']['MAX'] == $i ? "selected" : "") : "") ?>><?= ($i == 0 ? "Any" : $i) ?></option>
                    <?php } ?>
                </select> 
            </div>
            <div>
                <label>Bathrooms:</label>
                <select name="bath[MIN]">
                    <?php for ($i = 0; $i <= 6; $i++) { ?>
                        <option value="<?= $i ?>" <?= (!empty($_POST) && array_key_exists('bath', $_POST) ? ($_POST['bath']['MIN'] == $i ? "selected" : "") : "") ?>><?= ($i == 0 ? "Any" : ($i == 6 ? "6+" : $i)) ?></option>
                    <?php } ?>
                </select> 
                <select name="bath[MAX]">
                    <?php for ($i = 0; $i <= 6; $i++) { ?>
                        <option value="<?= $i ?>" <?= (!empty($_POST) && array_key_exists('bath', $_POST) ? ($_POST['bath']['MAX'] == $i ? "selected" : "") : "") ?>><?= ($i == 0 ? "Any" : $i) ?></option>
                    <?php } ?>
                </select> 
            </div>
            <div>
                <label>Car parks:</label>
                <select name="carpark[MIN]">
                    <?php for ($i = 0; $i <= 6; $i++) { ?>
                        <option value="<?= $i ?>" <?= (!empty($_POST) && array_key_exists('carpark', $_POST) ? ($_POST['carpark']['MIN'] == $i ? "selected" : "") : "") ?>><?= ($i == 0 ? "Any" : ($i == 6 ? "6+" : $i)) ?></option>
                    <?php } ?>
                </select> 
                <select name="carpark[MAX]">
                    <?php for ($i = 0; $i <= 6; $i++) { ?>
                        <option value="<?= $i ?>" <?= (!empty($_POST) && array_key_exists('carpark', $_POST) ? ($_POST['carpark']['MAX'] == $i ? "selected" : "") : "") ?>><?= ($i == 0 ? "Any" : $i) ?></option>
                    <?php } ?>
                </select> 
            </div>
            <button type="submit" id="submit" class="ui-shadow ui-btn ui-corner-all redBgColor">Search</button>
        </form>
    </div>
    <ul data-role="listview" data-split-icon="gear" data-split-theme="d" data-filter="true" data-filter-placeholder="Search..." data-inset="true">
        <?php foreach ($listingArr as $listing) { ?>
            <li>
                <a data-ajax="false" href="<?= $this->config->item('base_url') ?>admin/listing_mobile/detail/<?= $listing['sn'] ?>">
                    <?php if (!empty($listing['imageName'])) { ?>
                        <img class="imgPadding" src="<?= $this->config->item('listingURL') . $listing['userAgentSN'] . "/t_" . $listing['imageName'] ?>" />
                    <?php } else { ?>
                        <img class="imgPadding" src="<?= $this->config->item('mobileThemeURL') . "assets/img/placeHolder.png" ?>" />
                    <?php } ?>
                    <h3><?= $listing['title'] ?></h3>
                    <p><?= $listing['address'] . ", " . $listing['suburb'] . ", " . $listing['city'] . ", " . $listing['country'] ?></p>

                    <p>
                        <?php if ($listing['beds'] > 0) { ?>
                            <img src="<?= $this->config->item('mobileThemeURL') ?>assets/img/bed.png" alt="bed"> <?= $listing['beds'] ?> &nbsp;&nbsp;
                        <?php } ?>
                        <?php if ($listing['bath'] > 0) { ?>
                            <img src="<?= $this->config->item('mobileThemeURL') ?>assets/img/bath.png" alt="back"> <?= $listing['bath'] ?> &nbsp;&nbsp;
                        <?php } ?>
                        <?php if ($listing['carpark'] > 0) { ?>
                            <img src="<?= $this->config->item('mobileThemeURL') ?>assets/img/car.png" alt="back"> <?= $listing['carpark'] ?> &nbsp;&nbsp;
                        <?php } ?>
                    </p>
                </a>
                <?php if ($listing['userAgentSN'] == $this->session->userdata('logged_website_user_id')) { ?>
                    <a href="#action" data-sn="<?= $listing['sn'] ?>" class="action" data-rel="popup" data-position-to="window" data-transition="pop">Action</a>
                <?php } ?>
            </li>
        <?php } ?>
    </ul>

    <div data-role="popup" id="action" data-theme="d" data-overlay-theme="b" class="ui-content" style="max-width:340px;">
        <h3>Action?</h3>
        <a href="#" class="editBtn" data-role="button" data-theme="b" data-icon="check" data-inline="true" data-mini="true">Edit</a>
        <a href="#" class="deleteListing" data-sn="" data-role="button" data-theme="b" data-icon="delete" data-inline="true" data-mini="true">Delete</a>
        <a href="#" data-role="button" data-rel="back" data-inline="true" data-mini="true">Cancel</a>	
    </div>

</div><!--/content-primary -->	

<script>
    $(".deleteListing").click(function () {
        $datasn = $(this).attr('data-sn');
        var conf1 = confirm("Are you sure you want to delete");
        if (conf1) {
            location.href = $base_url + "admin/listing_mobile/deleteListing/" + $datasn;
        }
        return false;
    });
    $(".action").click(function () {
        $sn = $(this).attr("data-sn");
        $(".editBtn").attr('href', $base_url + 'admin/listing_mobile/edit/' + $sn);
        $(".deleteListing").attr('data-sn', $sn);
    });

    function getParent(populateID, parentSN, label) {

        //console.log($selected);
        $.ajax({
            url: $base_url + 'admin/getParent/' + parentSN,
            type: 'POST',
            dataType: 'json',
            success: function (json) {
                $('#' + populateID).find('option').remove().end();
                $selected2 = $("#" + populateID + "_hid").val();
                $('#' + populateID).append($('<option>').text('Please Select ' + label).attr('value', ''));
                $.each(json, function (i, data) {
                    //alert(value);
                    //console.log(data.sn +" ==" +$selected2+$("#" + populateID + "_hid").val());
                    if ($selected2 == data.sn) {
                        $('#' + populateID).append($('<option>').text(data.regionName).attr('value', data.sn).attr('selected', 'selected'));
                    } else {
                        $('#' + populateID).append($('<option>').text(data.regionName).attr('value', data.sn));
                    }
                });
                $('#' + populateID).selectmenu('refresh', true);
            }
        });
    }
    $(document).ready(function () {
        getParent('countrySN', 0, 'Country');
        $("#countrySN").change(function () {
            getParent('regionSN', $(this).val(), 'Region');
        });
        $("#regionSN").change(function () {
            getParent('districtSN', $(this).val(), 'District');
        });
        $("#districtSN").change(function () {
            getParent('suburbSN', $(this).val(), 'Suburb');
        });
<?php if (!empty($_POST)) { ?>
            $selected1 = $("#countrySN_hid").val();
            if ($selected1 > 0) {
                getParent('regionSN', $selected1, 'Region');
            }
            $selected1 = $("#regionSN_hid").val();
            if ($selected1 > 0) {
                getParent('districtSN', $selected1, 'District');
            }
            $selected1 = $("#districtSN_hid").val();
            if ($selected1 > 0) {
                getParent('suburbSN', $selected1, 'Suburb');
            }
<?php } ?>
    });
</script>