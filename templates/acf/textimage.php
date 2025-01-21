<div class="c-container c-asym-<?= $site_element['position']?'right':'left';?>-edgeless c-text-img">
    <div class="c-row <?= $site_element['position']?'c-row-reverse':'';?>">
        <div class="c-col-7 c-asym-col-edgeless">
            <figure class="c-asym-<?= $site_element['position']?'right':'left';?>-edgeless-img">
                <?= wp_get_attachment_image( $site_element['image'], 'large' ) ?>
                <?php if ( $site_element['caption'] ) { ?>
                    <figcaption class="c-legend"><?= $site_element['caption']; ?></figcaption>
                <?php } ?>
            </figure>
        </div>
        <div class="c-col-5 c-asym-col-grid c-text-block">
            <?= $site_element['text']; ?>
        </div>
    </div>
</div>