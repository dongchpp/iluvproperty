
  <ul data-role="listview" data-split-icon="gear" data-split-theme="d" data-filter="true" data-filter-placeholder="Search..." data-inset="true">
        <?php foreach ($enquiryArr as $listing) { ?>
            <li>
               
                 <h3><?= $listing->firstName ." ". $listing->lastName ." - ".$listing->title ?></h3>
                    <p><?= $listing->subject ." - ". $listing->message  ?></p>
                    
                    
            </li>
        <?php } ?>
    </ul>