<!DOCTYPE html>
<html <?php language_attributes(); ?> id="open-navigation" class="navigation k-deployment-2" >
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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Covered+By+Your+Grace&family=Outfit:wght@100..900&family=Poetsen+One&family=Shantell+Sans:ital,wght@0,300..800;1,300..800&family=Wendy+One&display=swap" rel="stylesheet">


    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >

