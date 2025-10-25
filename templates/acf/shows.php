<?php
$url = 'https://www.yagwud.com/cms/wp-admin/admin-ajax.php?action=events_list&bid='.$site_element['artist_id'];
// $content = file_get_contents($url);
// $json = json_decode($content, true);

$response = wp_remote_get( $url );

if ( is_wp_error( $response ) ) {
    // Handle error
    error_log( $response->get_error_message() );
} else {
    $body = wp_remote_retrieve_body( $response );
    $json = json_decode( $body, true );
}

// echo("<pre>");
// print_r($json['shows']);
// echo("</pre>");
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div style="overflow-x:auto;">
                <?php if( !empty($json['shows']) && count($json['shows']) > 0 && !empty($json['shows'][0]) ): ?>
                    <table class="table table-hover table-responsive">
                        <?php foreach($json['shows'] as $item): ?>
                        <tr class="">
                            <td><?= $item['show_date'];?></td>
                            <td><?= $item['title'];?></td>
                            <td><a href="<?= $item['event_link'];?>" target="_blank"><?= $item['club_name'];?></a></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                <?php else: ?>
                    <h3>SORRY, no upcoming shows.</h3>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>