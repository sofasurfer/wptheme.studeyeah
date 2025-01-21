<?php
/** @var array $site_element */
$fields     = $site_element;
$imageID    = $fields['image'];
$caption    = $fields['caption'];
$caption    = $fields['caption'];
?>


<?php if( $fields['two'] ): ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <figure>
                    <?= wp_get_attachment_image( $imageID, 'large', false, ['class' => 'img-fluid'] ) ?>
                    <?php if ( $caption ) { ?>
                        <figcaption class="c-legend"><?= $caption ?></figcaption>
                    <?php } ?>
                </figure>
            </div>
            <div class="col-md-6">
                <figure>
                    <?= wp_get_attachment_image( $fields['image_2'], 'large', false, ['class' => 'img-fluid'] ) ?>
                    <?php if (  $fields['caption_2']) { ?>
                        <figcaption class="c-legend"><?= $fields['caption_2']?></figcaption>
                    <?php } ?>
                </figure>
            </div>
        </div>       
    </div>
<?php elseif( $fields['wide'] ): ?>
    <div class="w-100 vh-100">
            <?= wp_get_attachment_image( $imageID, 'large', false, ['class' => 'img-fluid  w-100'] ) ?>
            <?php if ( $caption ) { ?>
                <figcaption class="c-legend"><?= $caption ?></figcaption>
            <?php } ?>
    </div>
<?php else: ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <figure>
                    <?= wp_get_attachment_image( $imageID, 'large', false, ['class' => 'img-fluid'] ) ?>
                    <?php if ( $caption ) { ?>
                        <figcaption class="c-legend"><?= $caption ?></figcaption>
                    <?php } ?>
                </figure>
            </div>
        </div>
    </div>
<?php endif; ?>