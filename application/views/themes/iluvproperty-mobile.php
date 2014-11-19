<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $title; ?></title>
        <meta name="resource-type" content="document" />
        <meta name="robots" content="noindex, nofollow"/>
        <meta name="googlebot" content="noindex, nofollow" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
              <!--  <link rel="stylesheet" href="<?= $this->config->item('mobileThemeURL') ?>css/jquery.mobile-1.4.5.min.css">-->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
       <!-- <script src="<?= $this->config->item('mobileThemeURL') ?>js/jquery.js"></script>
        <script src="<?= $this->config->item('mobileThemeURL') ?>assets/js/index.js"></script>
        <script src="<?= $this->config->item('mobileThemeURL') ?>js/jquery.mobile-1.4.5.min.js"></script>-->
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.css" />
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

        <link rel="stylesheet" href="<?= $this->config->item('mobileThemeURL') ?>assets/css/common.css" />
        <script>
            $base_url = '<?php echo base_url(); ?>';
        </script> 

        <?php
        /** -- Copy from here -- */
        if (!empty($meta))
            foreach ($meta as $name => $content) {
                echo "\n\t\t";
                ?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
            }
        echo "\n";

        if (!empty($canonical)) {
            echo "\n\t\t";
            ?><link rel="canonical" href="<?php echo $canonical ?>" /><?php
        }
        echo "\n\t";

        foreach ($css as $file) {
            echo "\n\t\t";
            ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
        } echo "\n\t";

        foreach ($js as $file) {
            echo "\n\t\t";
            ?><script src="<?php echo $file; ?>"></script><?php
        } echo "\n\t";

        /** -- to here -- */
        ?>
        <link rel="shortcut icon" href="<?= $this->config->item('defaultThemeURL') ?>assets/img/favicon.png" type="image/png"/>
    </head>
    <body>
        <div data-role="page" data-theme="b">
            <?php echo $this->load->get_section('header_section'); ?>
            <?php echo $this->load->get_section('navigation_section'); ?>
            <!-- CONTENT -->
            <div role="main">
                <?php echo $this->load->get_section('common_section'); ?>
                <?php echo $output; ?>
                <?php echo $this->load->get_section('sidebar'); ?>
            </div>
            <!-- /#content --> 
            <div data-role="footer">
                <?php echo $this->load->get_section('footer_section'); ?>
            </div><!-- /footer -->
        </div><!-- /page -->

    </body>
</html>
