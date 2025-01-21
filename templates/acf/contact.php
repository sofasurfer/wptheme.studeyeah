<?php

$options       = get_fields( 'options' );
$title         = $options['company']['company_title'];
$address       = $options['company']['company_address'];
$phone         = $options['company']['company_phone'];
$phone_encoded = apply_filters( 'c_convert_phone_number', $phone );
$email         = $options['company']['company_email'];
$gmaps         = $options['google_maps'];

?>

<div class="c-container c-contact c-text-block">
    <h3><?= __( 'Kontakt', 'neofluxe' ) ?></h3>
    <p><strong><?= $title ?></strong><br/>
		<?= $address ?></p>
	<?php if ( isset( $gmaps ) ) { ?>
        <p><a href="<?= $gmaps ?>"><?= __( 'Routenplaner (Link auf Google Map)', 'neofluxe' ) ?></a></p>
	<?php } ?>
    <a href="tel:<?= $phone_encoded ?>"><?= __( 'Tel.', 'neofluxe' ) ?> <?= $phone ?></a><br/>
    <a href="mailto:<?= $email ?>"><?= $email ?></a>
</div>