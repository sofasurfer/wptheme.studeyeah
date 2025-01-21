<?php
/** @var array $site_element */
$fields = $site_element;
$title  = $fields['title'];
$tag    = $fields['size'];
?>

<div id="<?= sanitize_title($site_element['title']);?>" class="c-container c-title">
    <h2><?= $title ?></h2>
</div>