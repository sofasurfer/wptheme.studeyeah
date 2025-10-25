<div class="container"> 
    <div class="row">
        <?php foreach( $site_element['list'] as $video ): ?>
        <div class="col-md-4 col-video">
            <div class="ratio ratio-16x9">
            <iframe src="<?=$video['video_url'];?>" frameborder="0" allowfullscreen></iframe>
            </div>
        </div> 
        <?php endforeach; ?>
        
        <?php if( !empty($site_element['youtube_url']) ): ?>
        <div class="col-md-12">
            <p class="spacetop"><a class="c-btn" href="<?= $site_element['youtube_url']['url']; ?>" class="" target="<?= $site_element['youtube_url']['target']; ?>"><?= $site_element['youtube_url']['title']; ?></a></p>
        </div>
        <?php endif; ?>
    </div>
</div>