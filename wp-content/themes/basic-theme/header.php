<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <title>
       <?php
          if (function_exists('is_tag') && is_tag()) {
             single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
          elseif (is_archive()) {
             wp_title(''); echo ' Archive - '; }
          elseif (is_search()) {
             echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
          elseif (!(is_404()) && (is_single()) || (is_page())) {
             wp_title(''); echo ' - '; }
          elseif (is_404()) {
             echo 'Not Found - '; }
          if (is_home()) {
             bloginfo('name'); echo ' - '; bloginfo('description'); }
          else {
              bloginfo('name'); }
          if ($paged>1) {
             echo ' - page '. $paged; }
       ?>
	</title>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>" charset="<?php bloginfo('charset'); ?>" />

    <link rel="shortcut icon" href="<?= get_stylesheet_directory_uri(); ?>/images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans">

    <link rel="stylesheet" type="text/css" href="<?= get_stylesheet_directory_uri(); ?>/assets/css/arrow-icons.css" />
    <link rel="stylesheet" type="text/css" href="/libaries/uifont/ui-font-solid.css" />
	<link rel="stylesheet" media="screen" href="/libaries/bootstrap/css/grid12.css">

    <?php wp_head(); ?>

    <link rel="stylesheet" href="<?= get_stylesheet_uri(); ?>" />

    <!--[if lt IE 9]>
    <link rel="stylesheet" media="all" href="<?php bloginfo('template_directory'); ?>/css/ie.css" />
    <script type="text/javascript" src="/libaries/bind.js"></script>
    <script type="text/javascript" src="/libaries/html5.js"></script>
    <script type="text/javascript" src="/libaries/respond.js"></script>
    <script type="text/javascript" src="/libaries/placeholder.js"></script>
    <![endif]-->
</head>

<body <?php body_class(); ?>>
    <noscript>
        <div>
            Deze website werkt niet volledig zonder javascript. <strong>Schakel uw javascript in.</strong>
        </div>
    </noscript>

    <header class="header">
        <section class="container">
            <nav class="primary col-xs-12">
                <?php
                $primary = array(
                    'theme_location'  => 'primary',
                    'container' => 'none',
                    'items_wrap' => '<ul>%3$s</ul>',
                    'walker' => new PrimaryArrowWalker
                );

                wp_nav_menu($primary);
                ?>
            </nav>
        </section>
    </header>

    <main class="content col-xs-12">