<div  class="ui-content">
    <div class="">
        <div class="alert alert-danger registerError"></div>

        <?php if (!empty($status)) { ?>
            <div class="alert alert-success"><?= urldecode($status) ?></div>
        <?php } ?>

        <form class="add-listing-form"  enctype="multipart/form-data">
            <input type="hidden" name="listingSN" value="<?= $listingSN ?>" />
            <div>
                <?php if (!empty($userListingArr)) { ?>
                    <label>Title:</label>
                <?php } ?>
                <input type="text" name="title" id="title" placeholder="Title" value="<?= (!empty($userListingArr) ? $userListingArr['title'] : "") ?>" />
            </div>
            <div>
                <?php if (!empty($userListingArr)) { ?>
                    <label>Address:</label>
                <?php } ?>
                <textarea rows="4" name="address" id="address" class="" placeholder="Address"><?= (!empty($userListingArr) ? $userListingArr['address'] : "") ?></textarea>
            </div>
            <div>
                <?php if (!empty($userListingArr)) { ?>
                    <label>Country:</label>
                <?php } ?>
                <select name="countrySN" id="countrySN">
                    <option value="">Please Select Country </option>
                </select>
                <input type="hidden" id="countrySN_hid" value="<?= (!empty($userListingArr) ? $userListingArr['countrySN'] : "") ?>" />
            </div>
            <div>
                <?php if (!empty($userListingArr)) { ?>
                    <label>Region:</label>
                <?php } ?>
                <select name="regionSN" id="regionSN">
                    <option value="">Please Select Region </option>
                </select>
                <input type="hidden" id="regionSN_hid" value="<?= (!empty($userListingArr) ? $userListingArr['regionSN'] : "") ?>" />
            </div>
            <div>
                <?php if (!empty($userListingArr)) { ?>
                    <label>District:</label>
                <?php } ?>
                <select name="districtSN" id="districtSN">
                    <option value="">Please Select District </option>
                </select>
                <input type="hidden" id="districtSN_hid" value="<?= (!empty($userListingArr) ? $userListingArr['districtSN'] : "") ?>" />
            </div>
            <div>
                <?php if (!empty($userListingArr)) { ?>
                    <label>Suburb:</label>
                <?php } ?>
                <select name="suburbSN" id="suburbSN">
                    <option value="">Please Select Suburb </option>
                </select>
                <input type="hidden" id="suburbSN_hid" value="<?= (!empty($userListingArr) ? $userListingArr['suburbSN'] : "") ?>" />
            </div>
            <div>
                <?php if (!empty($userListingArr)) { ?>
                    <label>Property Type:</label>
                <?php } ?>
                <select name="apartmentTypeSN" id="apartmentTypeSN"  >      
                    <option value="">Select Property Type</option>
                    <?php foreach ($apartmentTypeArr as $type) { ?>
                        <option value="<?= $type['sn'] ?>"  <?= (!empty($userListingArr) ? ($userListingArr['apartmentTypeSN'] == $type['sn'] ? "selected" : "") : "") ?>><?= $type['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <?php if (!empty($userListingArr)) { ?>
                    <label>Listing Type:</label>
                <?php } ?>
                <select name="listingTypeSN" id="listingTypeSN">
                    <option value="">Select Listing Type</option>
                    <?php foreach ($listingTypeArr as $type) { ?>
                        <option value="<?= $type['sn'] ?>"  <?= (!empty($userListingArr) ? ($userListingArr['listingTypeSN'] == $type['sn'] ? "selected" : "") : "") ?> ><?= $type['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="statusForSale">
                <?php if (!empty($userListingArr)) { ?>
                    <label>Status For Sale:</label>
                <?php } ?>
                <select name="listingStatusSN" id="listingStatusSN">      
                    <option value="">Status For Sale </option>
                    <?php foreach ($listingStatusArr as $type) { ?>
                        <option value="<?= $type['sn'] ?>"  <?= (!empty($userListingArr) ? ($userListingArr['listingStatusSN'] == $type['sn'] ? "selected" : "") : "") ?>><?= $type['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="forRent">
                <div class="ui-field-contain">
                    <label>Available From</label>
                    <input type="date" data-clear-btn="false" name="availableFrom" id="availableFrom" value="<?= (!empty($userListingArr) ? $userListingArr['availableFrom'] : "") ?>" >
                </div>
                <div class="ui-field-contain">
                    <label>Available To</label>
                    <input type="date" data-clear-btn="false" name="availableTo" id="availableTo" value="<?= (!empty($userListingArr) ? $userListingArr['availableTo'] : "") ?>">
                </div>
            </div>
            <div class="forAuction">
                <?php if (!empty($userListingArr)) { ?>
                    <label>Auction Description:</label>
                <?php } ?>
                <textarea rows="4" name="auctionDescription" id="auctionDescription" class="" placeholder="Auction Description"><?= (!empty($userListingArr) ? $userListingArr['auctionDescription'] : "") ?></textarea>
            </div>
            <div>
                <?php if (!empty($userListingArr)) { ?>
                    <label>Price:</label>
                <?php } ?>
                <input type="text" name="price" id="price" placeholder="Price" value="<?= (!empty($userListingArr) ? $userListingArr['price'] : "") ?>" />
            </div>
            <div>
                <?php if (!empty($userListingArr)) { ?>
                    <label>Bedrooms:</label>
                <?php } ?>
                <input type="text" name="beds" id="beds" placeholder="Bedrooms" value="<?= (!empty($userListingArr) ? $userListingArr['beds'] : "") ?>" />
            </div>
            <div>
                <?php if (!empty($userListingArr)) { ?>
                    <label>Bathrooms:</label>
                <?php } ?>
                <input type="text" name="bath" id="bath" placeholder="Bathrooms"  value="<?= (!empty($userListingArr) ? $userListingArr['bath'] : "") ?>" />
            </div>
            <div>
                <?php if (!empty($userListingArr)) { ?>
                    <label>Car Parks:</label>
                <?php } ?>
                <input type="text" name="carpark" id="carpark" placeholder="Car Parks" value="<?= (!empty($userListingArr) ? $userListingArr['carpark'] : "") ?>" />
            </div>
            <div>
                <?php if (!empty($userListingArr)) { ?>
                    <label>Sqm / Ft:</label>
                <?php } ?>
                <input type="text" name="sqFt" id="sqFt" placeholder="Sqm / Ft" value="<?= (!empty($userListingArr) ? $userListingArr['sqFt'] : "") ?>" />
            </div>
            <div>
                <?php if (!empty($userListingArr)) { ?>
                    <label>Property Description:</label>
                <?php } ?>
                <textarea rows="4" name="description" id="description" class="" placeholder="Property Description"><?= (!empty($userListingArr) ? $userListingArr['description'] : "") ?></textarea>
            </div>
            <div>
                <label>Images:</label>
                <?php if (!empty($userListingImagesArr)) { ?>

                    <?php foreach ($userListingImagesArr as $userListingImages) { ?>
                        <div class="divFloating">
                            <img src="<?= $this->config->item('listingURL') . $userListingArr['userAgentSN'] . "/t_" . $userListingImages['imageName'] ?>" />
                            <input type="button" data-icon="delete" class="deleteBtn deleteImage" data-sn="<?= $userListingImages['sn'] ?>" data-type="button" value="Delete Image" />
                        </div>
                    <?php } ?>

                <?php } ?>

                <input type="file" data-clear-btn="false" multiple="" name="gallery[]" id="fileInput" />
            </div>
            <?php if (!empty($userListingArr)) { ?>
                <input type="button" data-icon="delete" class="deleteBtn deleteListing" data-type="button" value="Delete Listing" />
            <?php } ?>
            <button type="submit" id="submit" class="ui-shadow ui-btn ui-corner-all">Submit</button>
        </form>
    </div>
</div>
<script>
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
                    //console.log(data.sn + " ==" + $selected2 + $("#" + populateID + "_hid").val());
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

<?php if ($listingSN > 0) { ?>
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
        $("#countrySN").change(function () {
            getParent('regionSN', $(this).val(), 'Region');
        });
        $("#regionSN").change(function () {
            getParent('districtSN', $(this).val(), 'District');
        });
        $("#districtSN").change(function () {
            getParent('suburbSN', $(this).val(), 'Suburb');
        });

        $(".statusForSale, .forRent, .forAuction").hide();
        $(".deleteImage").click(function () {
            $datasn = $(this).attr('data-sn');
            var conf1 = confirm("Are you sure you want to delete");
            if (conf1) {
                location.href = $base_url + "admin/listing_mobile/deleteImages/<?= $listingSN ?>/Deleting Images/" + $datasn;
            }
            return false;
        });
        $(".deleteListing").click(function () {
            var conf1 = confirm("Are you sure you want to delete");
            if (conf1) {
                location.href = $base_url + "admin/listing_mobile/deleteListing/<?= $listingSN ?>";
            }
            return false;
        });
        $("#listingTypeSN").change(function () {
            if ($(this).val() == "7") {
                $(".statusForSale").show();
                $(".forRent").hide();
                $("#listingStatusSN").trigger('change');
            } else {
                $(".statusForSale").hide();
                $(".forRent").show();
                $(".forAuction").hide();
            }
            //console.log("listint type");
        });
        $("#listingStatusSN").change(function () {
            if ($(this).val() == "8") {
                $(".forAuction").show();
            } else {
                $(".forAuction").hide();
            }
            //console.log("listint status");
        });

<?php if (!empty($userListingArr)) { ?>
            $("#listingTypeSN").trigger('change');
            $("#listingStatusSN").trigger('change');
<?php } ?>
        // validate signup form on keyup and submit
        $(".add-listing-form").submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
                title: "required",
                address: "required",
                countrySN: "required",
                regionSN: "required",
                districtSN: "required",
                suburbSN: "required",
                apartmentTypeSN: "required",
                listingTypeSN: "required",
                beds: {required: true, minlength: 1, maxlength: 2, number: true},
                bath: {required: true, minlength: 1, maxlength: 2, number: true},
                carpark: {required: true, minlength: 1, maxlength: 2, number: true},
                sqFt: {required: true, minlength: 1, maxlength: 12, number: true},
            },
            messages: {
                title: "Please enter your title",
                address: "Please enter your address",
                countrySN: "Please select country",
                regionSN: "Please select Region",
                districtSN: "Please select district",
                suburbSN: "Please select suburb",
                apartmentTypeSN: "Please choose your apartmentType",
                listingTypeSN: "Please choose your listingTypeSN",
                beds: "Please enter  bedrooms",
                bath: "Please enter your bathrooms",
                carpark: "Please enter your carparks",
                sqFt: "Please enter your sqm/Ft",
            },
            errorPlacement: function (error, element) {

                error.insertAfter($(element).parent());
            },
            submitHandler: function () {

                //event.preventDefault();
                $url = $base_url + 'admin/listing_submit';
                $form = $(".add-listing-form");
                var fileSelect = document.getElementById('fileInput');
                var files = fileSelect.files;
                var formData = new FormData($form);
                // Loop through each of the selected files.
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];

                    // Check the file type.
                    if (!file.type.match('image.*')) {
                        continue;
                    }

                    // Add the file to the request.
                    formData.append('image[]', file, file.name);
                }
                $("input").each(function () {
                    if ($(this).attr('type') != "file") {
                        formData.append($(this).attr('name'), $(this).val());
                    }
                });
                $("select").each(function () {
                    formData.append($(this).attr('name'), $(this).val());
                });
                $("textarea").each(function () {
                    formData.append($(this).attr('name'), $(this).val());
                });

                //formData.append();
                var xhr = new XMLHttpRequest();
                // Open the connection.
                xhr.open('POST', $url, true);
                // Set up a handler for when the request finishes.
                xhr.onload = function () {

                    if (xhr.status === 200) {

                        if (xhr.responseText == "true") {
                            $(".alert-success").html("Thank you for registering. Please check your email to activate your account.");
                            $(".alert-success").show();
                            $(".registerError").hide();
<?php if ($listingSN == 0) { ?>
                                location.href = $base_url + "admin/listing_mobile/view/0/Added Successfully";
<?php } else { ?>
                                location.href = $base_url + "admin/listing_mobile/view/0/Saved";
<?php } ?>
                        } else {
                            $(".registerError").html(xhr.responseText);
                            $(".registerError").show();
                            //$(".alert-success").hide();
                        }
                    } else {
                        $(".registerError").html("Error While Posting");
                        $(".registerError").show();
                        // $(".alert-success").hide();
                    }

                };
                xhr.send(formData);
                return false;
            }
        });
        $(".alert-danger").hide();
        //  $(".alert-success").hide();
    });


</script>

