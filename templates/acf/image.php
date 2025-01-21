<?php
/** @var array $site_element */
$fields     = $site_element;
$imageID    = $fields['image'];
$caption    = $fields['caption'];
$caption    = $fields['caption'];
?>


<?php if( $fields['two'] ): ?>
    <div class="c-container c-img-2col">
        <div class="c-row">
            <div class="c-col-6">
                <figure>
                    <?= wp_get_attachment_image( $imageID, 'large' ) ?>
                    <?php if ( $caption ) { ?>
                        <figcaption class="c-legend"><?= $caption ?></figcaption>
                    <?php } ?>
                </figure>
            </div>
            <div class="c-col-6">
                <figure>
                    <?= wp_get_attachment_image( $fields['image_2'], 'large' ) ?>
                    <?php if (  $fields['caption_2']) { ?>
                        <figcaption class="c-legend"><?= $fields['caption_2']?></figcaption>
                    <?php } ?>
                </figure>
            </div>
        </div>       
    </div>
<?php elseif( $fields['wide'] ): ?>
    <div class="c-container c-asym-left-edgeless c-img-wide">
        <figure class="c-asym-left-edgeless-img">
            <?= wp_get_attachment_image( $imageID, 'large' ) ?>
            <?php if ( $caption ) { ?>
                <figcaption class="c-legend"><?= $caption ?></figcaption>
            <?php } ?>
        </figure>
    </div>
<?php else: ?>
    <div class="c-container c-img-content">
        <figure>
            <?= wp_get_attachment_image( $imageID, 'large' ) ?>
            <?php if ( $caption ) { ?>
                <figcaption class="c-legend"><?= $caption ?></figcaption>
            <?php } ?>
        </figure>
    </div>
<?php endif; ?>