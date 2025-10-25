<div class="container">
    <div class="row d-flex justify-content-center">
        <?php foreach( $site_element['list'] as $record ): ?>
            <div class="<?= $site_element['cols'];?>">
                <figure>
                <?= wp_get_attachment_image($record['cover'], 'full', false, ['class' => 'img-fluid']);?>
                </figure>
                <p><a href="<?= $record['link']['url'];?>" target="<?= $record['link']['target'];?>" class="c-btn"><?= $record['link']['title'];?></a></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
