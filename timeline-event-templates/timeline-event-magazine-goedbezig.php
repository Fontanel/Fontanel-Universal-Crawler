<?php
  $portrait = wp_get_attachment_image_src( get_field( 'portretfoto', $vars['objects']->ID ), 'portrait_l' );
	$logo_l = wp_get_attachment_image_src( get_field( 'logo_l', $vars['objects']->ID ), 'original' );
	$logo_s = wp_get_attachment_image_src( get_field( 'logo_s', $vars['objects']->ID ), 'original' );
	$bg = get_field( 'bg_pattern', $vars['objects']->ID );
?>
<article class="story goedbezig" style="background-image: url(<?php print( $bg ); ?>);">
	<div class="article-body">
		<div class="caption">
		  <img src="<?php print( $portrait[0] ); ?>" ?>
		  <img src="<?php print( $logo_l[0] ); ?>" ?>
			<h2><?php print( $vars['objects']->post_title ); ?></h2>
			<h3>post_excerpt</h3>
      <!-- <p><?php print_r($vars['objects']); ?></p> -->
		</div>
	</div>
</article>
