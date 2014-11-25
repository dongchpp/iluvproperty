
<?php if (!empty($status)) { ?>
    <div class="alert alert-success"><?= urldecode($status) ?></div>
<?php } ?>
<div class="device">
    <a class="arrow-left" href="#"></a> 
    <a class="arrow-right" href="#"></a>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php if (!empty($userListingImagesArr)) { ?>

                <?php foreach ($userListingImagesArr as $userListingImages) { ?>
                    <div class="swiper-slide"> 
                        <img src="<?= $this->config->item('listingURL') . $userListingArr['userAgentSN'] . "/m_" . $userListingImages['imageName'] ?>"> 
                    </div>
                <?php } ?>

            <?php } ?>


        </div>
    </div>
    <div class="pagination"></div>
</div>
<div  class="ui-content">
    <?= $userListingArr['title'] ?><br/>
    <span class="fontsml"><?= $userListingArr['address'] ?></span><br/>
    <span class="fontsml"> <?= $userListingArr['suburb'] . ", " . $userListingArr['city'] ?></span><br/>
    <span class="fontsml"><?= $userListingArr['country'] ?></span><br/>

    <p>
        <?php if ($userListingArr['beds'] > 0) { ?>
            <img src="<?= $this->config->item('mobileThemeURL') ?>assets/img/bed.png" alt="bed"> <?= $userListingArr['beds'] ?> &nbsp;&nbsp;
        <?php } ?>
        <?php if ($userListingArr['bath'] > 0) { ?>
            <img src="<?= $this->config->item('mobileThemeURL') ?>assets/img/bath.png" alt="back"> <?= $userListingArr['bath'] ?> &nbsp;&nbsp;
        <?php } ?>
        <?php if ($userListingArr['carpark'] > 0) { ?>
            <img src="<?= $this->config->item('mobileThemeURL') ?>assets/img/car.png" alt="back"> <?= $userListingArr['carpark'] ?> &nbsp;&nbsp;
        <?php } ?>
    </p>
    <?php
    $apartmentName = '';
    foreach ($apartmentTypeArr as $propertyType) {
        if ($userListingArr['apartmentTypeSN'] == $propertyType['sn']) {
            $apartmentName = $propertyType['name'];
            break;
        }
    }
    $listingName = '';
    foreach ($listingTypeArr as $propertyType) {
        if ($userListingArr['listingTypeSN'] == $propertyType['sn']) {
            $listingName = $propertyType['name'];
            break;
        }
    }
    $listingStatus = '';
    if ($userListingArr['listingTypeSN'] == 7) {
        foreach ($listingStatusArr as $propertyType) {
            if ($userListingArr['listingStatusSN'] == $propertyType['sn']) {
                $listingStatus = $propertyType['name'];
                break;
            }
        }
    }
    ?>



    <ul data-role="listview">
        <li><b>Property Type:</b> <?= $apartmentName ?></li>
        <li><b>Listing Type:</b> <?= $listingName ?></li>

    </ul>


    <div class="clear"></div>
    <?php if (!empty($listingStatus)) { ?>
        <p class="redColor alignCenter"><?= $listingStatus ?></p>
        <?php if (!empty($userListingArr['auctionDescription'])) { ?>
            <span class="fontsml"><b>Auction Description:</b></span><br/><?= nl2br($userListingArr['auctionDescription']) ?>
        <?php } ?>
    <?php } ?>
    <?php if ($userListingArr['listingTypeSN'] == 6) { ?>
        <b>Available From: </b><?= date("d M, Y", strtotime($userListingArr['availableFrom'])) ?>
        <b>Available To: </b><?= date("d M, Y", strtotime($userListingArr['availableTo'])) ?>
    <?php } ?> 
    <div class="clear"></div>
    <br/>




    <div data-role="tabs" id="tabs">
        <div data-role="navbar">
            <ul>
                <li ><a href="#one" data-ajax="false" class="ui-btn-active">Detail</a></li>
                <li><a href="#two" data-ajax="false">Agent</a></li>
                <li><a href="#three" data-ajax="false">Enquire</a></li>
            </ul>
        </div>
        <div id="one" class="ui-body-d ui-content">
            <span class="fontsml"><b>Description:</b><br/><?= $userListingArr['description'] ?></span>

        </div>
        <div id="two">
            <div data-role="collapsible" data-collapsed="false">
                <h4>Agent Information</h4>
                <p> <?= $userProfileArr['firstName'] . " " . $userProfileArr['lastName'] ?> <br/>
                    <span class="fontsml">E: <?= $userProfileArr['email'] ?></span><br/>
                    <?php if (!empty($userProfileArr['mobile'])) { ?>
                        <span class="fontsml">M: <?= $userProfileArr['mobile'] ?></span><br/>
                    <?php } ?>
                    <?php if (!empty($userProfileArr['phoneNo'])) { ?>
                        <span class="fontsml">M: <?= $userProfileArr['phoneNo'] ?></span><br/>
                    <?php } ?>
                </p>
            </div>
        </div>


        <div id="three" class="ui-body-d ui-content">


            <div  class="ui-content">

                <form id="pie_regiser_form" enctype="multipart/form-data">
                    <input type="hidden" name="sn" value="<?= $userListingArr['sn'] ?>" />
                    <input type="hidden" name="userSN" value="<?= $this->session->userdata('logged_website_user_id') ?>" />
                    <input type="hidden" name="userAgentSN" value="<?= $userListingArr['userAgentSN'] ?>" />
                    <input type="hidden" name="userListingSN" value="<?= $userListingArr['sn'] ?>" />
                    <!--<input type="hidden" name="email" value="<?= $toUserArr['email'] ?>" />-->
                    <input type="hidden" name="useremail" value="<?= $userProfileArr['email'] ?>" />


                    <div>
                        <a href="#" data-ajax="false" class="ui-btn-active"> <label id="successMessage" ></label></a>
                        <label>Title:</label>
                        <input type="text" name="subject" id="title" placeholder="Title" value="" />
                        
                    </div>
                    <textarea rows="10" name="message" id="message" class="textarea_class" placeholder="my enquire"></textarea>
            </div>
            <button type="submit" id="submit" class="ui-shadow ui-btn ui-corner-all">Submit</button>
            </form>









        </div>


    </div>
























    <!--    <div class="clear"></div>-->

</div>
<!--<a href="<?= $this->config->item('base_url') ?>admin/mobile_enquire/<?= $userListingArr['sn'] ?>"> Enquiry to Agent</a>-->
<script>
    var mySwiper = new Swiper('.swiper-container', {
        pagination: '.pagination',
        loop: true,
        grabCursor: true,
        paginationClickable: true
    })
    $('.arrow-left').on('click', function (e) {
        e.preventDefault()
        mySwiper.swipePrev()
    })
    $('.arrow-right').on('click', function (e) {
        e.preventDefault()
        mySwiper.swipeNext()
    })

    $(document).ready(function () {

        // validate signup form on keyup and submit
        $("#pie_regiser_form").submit(function (e) {
            e.preventDefault();
        }).validate({
            rules: {
//                subject: "required",
                message: "required"
            },
            messages: {
//                subject: "Please enter your firstname",
                message: "Please enter your message"
            },
            errorPlacement: function (error, element) {

                error.insertAfter($(element).parent());
            },
            submitHandler: function () {

                //event.preventDefault();
                $url = $base_url + 'admin/enquire_submit';
                $form = $("#pie_regiser_form");

                var formData = new FormData($form);

                $("input").each(function () {
                    if ($(this).attr('type') != "file") {
                        formData.append($(this).attr('name'), $(this).val());
                    }
                });

                $("textarea").each(function () {
                    if ($(this).attr('type') != "file") {
                        formData.append($(this).attr('name'), $(this).val());
                    }
                });

                //formData.append();
                var xhr = new XMLHttpRequest();
                // Open the connection.
                xhr.open('POST', $url, true);
                // Set up a handler for when the request finishes.
                xhr.onload = function () {
                    window.scrollTo(0, 0);
                    if (xhr.status === 200) {
                        if (xhr.responseText == "true") {
                            $(".alert-success").html("Thank you for enquire, You message has been sent to  the agent!");
                            $("#successMessage").html("Thank you for enquire, You message has been sent to  the agent!");

                            $(".alert-success").show();
                            $(".registerError").hide();
                            $('#pie_regiser_form').trigger("reset");
//                            alert('Your enquiry has been sent! \n Thanks');
//                            window.location.replace($base_url + 'admin/enquiry_dashboard');
                        } else {
                            $(".registerError").html(xhr.responseText);
                            $(".registerError").show();
                            $(".alert-success").hide();
                        }
                    } else {
                        $(".registerError").html("Error While Posting");
                        $(".registerError").show();
                        $(".alert-success").hide();
                    }
                };
                xhr.send(formData);
                return false;
            }
        });

        // propose username by combining first- and lastname
        $(".alert-danger").hide();
        $(".alert-success").hide();

    });
</script>