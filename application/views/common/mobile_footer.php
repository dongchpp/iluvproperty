		
<div data-role="navbar">
    <ul>
        <?php foreach ($footerArr as $footer) { ?>
            <li><a data-ajax="false"  data-icon="<?= $footer['icon'] ?>" class="<?= $footer['class'] ?>" href="<?= $this->config->item('base_url') . $footer['href'] ?>"><?= $footer['name'] ?></a></li>
        <?php } ?>

    </ul>
</div><!-- /navbar -->
