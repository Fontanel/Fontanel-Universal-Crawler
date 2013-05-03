<?php $video = json_decode( $vars['objects'][0]->object ); ?>
<?php print( $video->player[0]->embed_code ); ?>
<?php print( $video->caption ); ?>
<p><a href="<?php print( $video->post_url ); ?>">De originele post</a></p>
