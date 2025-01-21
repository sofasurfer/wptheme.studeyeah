<?php if ( get_field('acf_header_image_desktop') ): ?>
<div class="c-container-wide c-main-title-img">
	<!-- zweites bild mit anderem ratio ab 786 px -->
	<figure class="c-showroom-img">
		<?php
		$image_header = get_field('acf_header_image_desktop');
		$image_header_mobile = get_field('acf_header_image_mobile');	 
		$args = [
			'class'            => 'some-class',
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
	</figure>
	<div class="c-container-wide">
	    <span class="c-deco c-deco-title"></span>
	    <div class="c-container">
		<div class="c-row">
		    <div class="c-col-6">
		        <div class="c-box">
		            <h1><?= get_field('acf_header_title');?></h1>
		            <p class="c-lead"><?= get_field('acf_header_lead');?></p>
		        </div>
		    </div>
		</div>
	    </div>
	</div>
</div>
<?php else:?>
    <div class="c-container-wide c-main-title">
        <span class="c-deco c-deco-title"></span>
        <div class="c-container">
            <div class="c-row">
		    <div class="c-col-6">
		        <div class="c-box">
		            <h1><?= get_field('acf_header_title');?></h1>
		            <p class="c-lead"><?= get_field('acf_header_lead');?></p>
		        </div>
		    </div>
            </div>
        </div>
    </div>
<?php endif;?>