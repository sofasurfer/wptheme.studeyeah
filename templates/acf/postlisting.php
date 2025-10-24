<?php
/** @var array $site_element */
$posts = apply_filters( 'get_post_listings', $site_element);
$postcount = 0;
$posttype = false;
if (!empty($posts)) {
    $first_post = $posts[0]; 
	$posttype = $first_post->post_type;
	$postcount = count($posts);
}

if($posttype == 'post'):
?>
<div class="c-container c-text-block c-container-postlisting">
	<div class="c-row">
	<?php foreach ( $posts as $post ) {
		$title      = $post->post_title;
		$text       = $post->post_excerpt;
		$date       = get_the_date( 'd. M Y',$post->ID );
		$image      = get_the_post_thumbnail_url($post->ID );
		$link		= get_permalink($post->ID)
		?>
		
		<div class="c-col-4">
			<article class="c-news-item c-box-small c-text-medium c-text-block">
				<?php if (!empty($image) ): ?>
					<figure> <img src="<?= $image; ?>" /> </figure>
				<?php endif; ?>
				<span class="c-subtitle"><?= $date ?></span>
				<h3><a class="c-teaser-link" href="<?= $link ?>"><?= $title ?></a></h3>
				<p><?= $text ?></p>
				<a href="<?= $link ?>" class="c-icon c-icon-arrow"><?= __( 'Mehr lesen', 'neofluxe' ) ?></a>
			</article>
		</div>
	<?php } ?>
	</div>
</div>
<?php endif; ?>