<?php
$referrer = $_SERVER['HTTP_REFERER'] ?? wp_get_referer();
$title    = get_the_title();
?>
<div class="c-container-wide c-main-title">
    <div class="c-container">        
        <div class="c-row">
            <div class="c-col-8">
                <h1>Login</h1>
                <!-- optionales Datum für Promotionen, Nähkurse-->
                <p class="c-lead"><?= __('Dieser Inhalt ist passwortgeschützt.<br/>Um ihn anschauen zu können, bitte das Passwort eingeben', 'neofluxe');?></p>
            </div>
        </div>
    </div>
</div>

<div class="c-container c-text-only">
    <div class="c-row">
        <div class="c-col-8 c-text-block c-form-standard">
            <?php if ( $referrer == get_permalink() ) {
				?>
                <p class="c-form-error"><?= __( 'Password incorrect. Contact an administrator.', 'neofluxe' ) ?></p>
				<?php
			} ?>
			<?= wp_login_form(); ?>
        </div>
    </div>
</div>