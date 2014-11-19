<div class="property-listing">

    <div class="left">
        <img src="http://placehold.it/70x70">
    </div>
    <div class="middle">
        <h2><?= $listing['title'] ?></h2>
        <p>Price by negotiation</p>
        <p><?= $listing['address'] ?></p>
        <p class="rooms"><img src="<?= $this->config->item('mobileThemeURL') ?>assets/img/bed.jpg" alt="bed"> <?= $listing['beds'] ?> <img src="<?= $this->config->item('mobileThemeURL') ?>assets/img/bath.jpg" alt="back"> <?= $listing['bath'] ?></p>
    </div>
    <!-- <div class="right">
         <img src="<?= $this->config->item('mobileThemeURL') ?>assets/img/favourite.jpg" alt="favourite" width="48" height="42">
         <img src="<?= $this->config->item('mobileThemeURL') ?>assets/img/agent.jpg" alt="agent" width="69" height="43">
     </div>
    -->
</div><!-- /listing -->


