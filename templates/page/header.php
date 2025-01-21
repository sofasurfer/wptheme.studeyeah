<!DOCTYPE html>
<html <?php language_attributes(); ?> id="open-navigation" class="navigation" >
<head>
	<?php
	$og_info = apply_filters( 'c_get_ogobj', '' );
	?>
    <meta charset="utf-8">
    <title><?= $og_info['title']; ?></title>
    <meta name="author" content="<?= $og_info['author']; ?>">
    <meta name="description" content="<?= $og_info['description']; ?>">

    <meta property="og:locale" content="<?= $og_info['locale']; ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="<?= $og_info['title']; ?>"/>
    <meta property="og:description" content="<?= $og_info['description']; ?>"/>

    <?php if( !empty($og_info['image']) ): ?>
    <meta property="og:image" content="<?= $og_info['image'][0] ?? ''; ?>"/>
    <meta property="og:image:width" content="<?= $og_info['image'][1] ?? ''; ?>"/>
    <meta property="og:image:height" content="<?= $og_info['image'][2] ?? ''; ?>"/>
    <?php endif; ?>

    <!-- Theme Color -->
    <meta name="theme-color" content="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">

    <!-- favicon-->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= apply_filters( 'get_file_from_dist', '../images/ico/apple-touch-icon.png' ); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= apply_filters( 'get_file_from_dist', '../images/ico/favicon-32x32.png' ); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= apply_filters( 'get_file_from_dist', '../images/ico/favicon-16x16.png' ); ?>">
    <link rel="mask-icon" href="<?= apply_filters( 'get_file_from_dist', 'safari-pinned-tab.svg' ); ?>" color="#2e1aa9">

    <link rel="sitemap" type="application/xml" title="Sitemap" href="<?= get_sitemap_url( 'index' ) ?>">

    <!-- Preventing IE11 to request by default the /browserconfig.xml more than one time -->
    <meta name="msapplication-config" content="none">
    <!-- Disable touch highlighting in IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- Ensure edge compatibility in IE (HTTP header can be set in web server config) -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <!-- Force viewport width and pixel density. Plus, disable shrinking. -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Disable Skype browser-plugin -->
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >

<!-- header-->
<header class="c-header <?=  do_shortcode("[c_option key='sticky_header']")? 'c-header-sticky':''; ?>" role="banner">
    
    <!-- header inner-->
    <div class="c-container c-container-no-padding c-header-inner">
        <div class="c-header-logo">
            <a href="<?= get_home_url(); ?>">
                <img src="<?=  do_shortcode("[c_option key='logo_image']"); ?>" alt="<?=  do_shortcode("[c_option key='company_title']"); ?>" />
            </a>
        </div>

        <nav class="c-main-nav">
            <!-- navigation -->
            <?php wp_nav_menu(
                array(
                    'theme_location' => 'header-menu',
                    'container'      => false,
                    'menu_class'     => 'c-main-nav-list',
                )
            ); ?>
        </nav>
        
        <div class="c-header-lang wpml-ls-legacy-list-horizontal">
            <ul class="c-header-lang-list">
                <li class="wpml-ls-current-language"><a class="wpml-ls-link" href="">DE</a></li>
                <li><a href="">FR</a></li>
            </ul>
        </div>

        <!-- offcanvas trigger-->
        <a href="#open-navigation" class="c-offcanvas-trigger c-offcanvas-trigger-open">
            <span class="c-hide-visually">Menü öffnen</span>
        </a>
    </div>

    <!-- offcanvas nav-->
    <nav class="c-offcanvas-nav">
        <div class="c-offcanvas-inner">
            <div class="c-container c-container-no-padding c-header-inner">
                <!-- offcanvas trigger-->
                <a href="#" class="c-offcanvas-trigger c-offcanvas-trigger-close">
                    <span class="c-hide-visually">Menu schliessen</span>
                </a>
            </div>
            <div class="c-container c-offcanvas-content">
                <div class="c-row">
                    <div class="c-col-12">
                        <div class="c-offcanvas-lang wpml-ls-legacy-list-horizontal">
                            <ul class="c-header-lang-list">
                                <li class="wpml-ls-current-language"><a class="wpml-ls-link" href="">DE</a></li>
                                <li><a href="">FR</a></li>
                            </ul>
                        </div>
						<?php wp_nav_menu(
							array(
								'theme_location' => 'header-menu-offcanvas',
								'container'      => false,
								'menu_class'     => 'c-offcanvas-nav-list',
                                'walker'         => new Overlay_Walker_Nav_Menu()
							)
						); ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>


<!-- content-->
<main class="c-content" role="main">
