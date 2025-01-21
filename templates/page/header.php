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

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
        <div class="collapse navbar-collapse justify-content-center d-none d-lg-flex" id="navbarNav">
            <?php wp_nav_menu(
                array(
                    'theme_location' => 'header-menu',
                    'container'      => false,
                    'menu_class'     => 'navbar-nav',
                )
            ); ?>
        </div>
    </div>
</nav>

<div class="header">
    <!--h1>Studeyeah</h1-->
    <?php
    $image_header = get_field('acf_header_image_desktop');
    $image_header_mobile = get_field('acf_header_image_mobile');	 
    $args = [
        'class'            => 'img-fluid img-header',
        'id'               => 'some-id',
        'fallback_image_id' => $image_header_mobile,
        'images'           => [
            [
            'id'    => $image_header,
            'media' => '(min-width: 768px)',
            'size'  => 'large'
            ]
        ]
    ];
    ?>
    <?=  apply_filters('c_render_picturetag', $args); ?>		


</div>

<!-- content-->
<main class="c-content" role="main">
