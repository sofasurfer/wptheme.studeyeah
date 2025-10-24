<?php
/** @var array $site_element */
$fields = $site_element;
$title  = $fields['title'];
?>

<div id="<?= sanitize_title($site_element['title']);?>" class="container">
    <div class="row">
        <div class="col-md-12">
            <a class="anchor" id="<?= sanitize_title($site_element['title']);?>"></a>
            <h2><?= $title ?></h2>
        </div>
    </div>
</div>