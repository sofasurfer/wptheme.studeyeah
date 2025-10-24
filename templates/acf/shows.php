<?php
$url = 'https://www.yagwud.com/cms/wp-admin/admin-ajax.php?action=events_list&all=true&bid='.$site_element['artist_id'];
//$content = file_get_contents($url);
//$json = json_decode($content, true);

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