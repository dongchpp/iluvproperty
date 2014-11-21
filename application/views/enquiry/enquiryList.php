
<ul data-role="listview" data-split-icon="gear" data-split-theme="d" data-filter="true" data-filter-placeholder="Search..." data-inset="true">
    <?php foreach ($enquiryArr as $listing) { ?>
        <li>

            <a data-ajax="false" href=" <?= $this->config->item('base_url') . 'admin/mobile_enquire/'.$listing->userListingSN.'/'.$listing->userSN ?>">
                <?php
                if ($listing->dateFirstRead > 0) {
                    $changeColor = "";
                } else {
                    $changeColor = "redColor";
                }
                ?>
                <h3 class="<?= $changeColor ?>"> <?= $listing->firstName . " " . $listing->lastName . " - " . $listing->title ?></h3>
                <p><?= $listing->subject . " - " . $listing->message ?></p>

            </a>
        </li>
    <?php } ?>
        
        <div data-role="main" class="ui-content">

            
  </div>
</ul>