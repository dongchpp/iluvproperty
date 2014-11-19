<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $title; ?></title>
        <meta name="resource-type" content="document" />
        <meta name="robots" content="noindex, nofollow"/>
        <meta name="googlebot" content="noindex, nofollow" />


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script type="text/javascript" src="<?= $this->config->item('defaultThemeURL') ?>assets/js/jquery.min.js"></script> 

        <script type="text/javascript" src="<?= $this->config->item('defaultThemeURL') ?>assets/js/site.js"></script>
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
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>

       <!-- Bootstrap -->
        <link href="<?= $this->config->item('defaultThemeURL') ?>dist/css/bootstrap.css" rel="stylesheet">
        <link href="<?= $this->config->item('defaultThemeURL') ?>assets/css/global.css" rel="stylesheet">
        <link href="<?= $this->config->item('defaultThemeURL') ?>assets/css/styles.css" rel="stylesheet">
        <link href="<?= $this->config->item('defaultThemeURL') ?>assets/css/mobile-style.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
              <script src="<?= $this->config->item('defaultThemeURL') ?>js/html5shiv.min.js"></script>
              <script src="<?= $this->config->item('defaultThemeURL') ?>js/respond.min.js"></script>
            <![endif]-->

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="<?= $this->config->item('defaultThemeURL') ?>assets/img/favicon.png" type="image/png"/>


    </head>

    <body>


        <?php echo $this->load->get_section('header_section'); ?>
        <?php echo $this->load->get_section('navigation_section'); ?>
        <!-- CONTENT -->
        <div class="container">
            <div id="main">
                <?php echo $output; ?>
                <?php echo $this->load->get_section('sidebar'); ?>

            </div>
        </div>

        <!-- /#content --> 

        <?php echo $this->load->get_section('footer_section'); ?>




        <script type="text/javascript" src="<?= $this->config->item('defaultThemeURL') ?>js/bootstrap.min.js"></script> 
    </body>
</html>
