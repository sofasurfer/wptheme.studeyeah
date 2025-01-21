<?php

$options       = get_fields( 'options' );
$title         = $options['company']['company_title'];
$address       = $options['company']['company_address'];
$phone         = $options['company']['company_phone'];
$phone_encoded = apply_filters( 'c_convert_phone_number', $phone );
$email         = $options['company']['company_email'];
$socialmedia_accounts   = apply_filters( 'c_get_option', 'socialmedia_accounts' );

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">              
            <ul class="social-links">
                <?php foreach($socialmedia_accounts as $account): ?>
                <li><a href="<?= $account['link']['url'];?>" target="<?= $account['link']['target'];?>"><i class="fa <?= $account['icon'];?> fa-2x" aria-hidden="true"></i></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div> 
