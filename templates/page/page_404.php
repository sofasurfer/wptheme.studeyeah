<?php
$page_404 = apply_filters('c_get_option','page_404', 'site');
?>

<!-- main title -->
<div class="c-container c-main-title">
    <div class="c-row">
        <div class="c-col-8">
            <h1><?= get_field('acf_header_title',$page_404);?></h1>
            <p class="c-lead"><?= get_field('acf_header_lead',$page_404);?></p>
        </div>
    </div>
</div>