<div class="container">
    <div class="row stream-list">
        <?php foreach( $site_element['list'] as $icon ): ?>
            <div class="col-md-4 col-xs-6"><a target="<?= $icon['link']['target']; ?>" href="<?= $icon['link']['url']; ?>"><?= wp_get_attachment_image($icon['icon'], 'full', false, ['class' => 'img-fluid ']);?></a></div>
        <?php endforeach; ?>
    </div>
</div>