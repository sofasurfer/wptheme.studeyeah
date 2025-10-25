<div class="c-container">
    <div class="c-row">
        <div class="c-col-3">
            <ul>
                <li><strong><?= __( 'Veröffentlicht', 'neofluxe' ); ?></strong><br>
					<?= get_the_date( 'd.m.Y' ); ?>
                </li>
                <li><strong><?= __( 'Kategorie', 'neofluxe' ); ?></strong><br>
					<?= do_shortcode( "[c_get_categories pid=\"$post->ID\" posttype=\"category\"]" ); ?>
                </li>
            </ul>

        </div>
        <div class="c-col-8 c-text-block">
			<?= get_field( 'blog_content' ); ?>
        </div>
    </div>
</div>