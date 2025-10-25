
<nav class="navbar navbar-expand-lg navbar-light fixed-top">
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
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<a class="anchor" id="info"></a>                    
				<h1><?= get_field('acf_header_title');?></h1>
				<!-- optionales Datum für Promotionen, Nähkurse-->
				<p class="c-lead"><?= get_field('acf_header_lead');?></p>
			</div>
		</div>
	</div>
