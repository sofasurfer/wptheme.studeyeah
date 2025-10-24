<?php
/** @var array $site_element */
$fields = $site_element;
$title  = $fields['title'];
$author = $fields['author'];
?>
<div class="c-quote">
    <div class="c-container">
        <div class="c-text-block">
            <blockquote>
				<?= $title ?>
                <cite><?= $author ?></cite>
            </blockquote>
        </div>
    </div>
</div>