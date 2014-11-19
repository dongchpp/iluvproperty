
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
    <span class="fontsml"><b>Description:</b><br/><?= $userListingArr['description'] ?></span>
    <div class="clear"></div>
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
    <a href="<?= $this->config->item('base_url') ?>admin/mobile_enquire/<?= $userListingArr['sn'] ?>"> Enquiry to Agent</a>
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
</script>