<?php $photo = json_decode( $vars['objects'][0]->object )->photos[0]->alt_sizes[1]; ?>
<img src="<?php print( $photo->url ); ?>" width="<?php print( $photo->width ); ?>" height="<?php print( $photo->height ); ?>">
<?php print( json_decode( $vars['objects'][0]->object )->caption ); ?>
<p><a href="<?php print( json_decode( $vars['objects'][0]->object )->post_url ); ?>">De originele post</a></p>
