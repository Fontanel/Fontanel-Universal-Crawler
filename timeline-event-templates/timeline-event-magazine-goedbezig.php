<?php
	$logo_l = wp_get_attachment_image_src( get_field( 'logo_l', $vars['objects']->ID ), 'original' );
	$bg = get_field( 'bg_pattern', $vars['objects']->ID );
?>
<article class="story goedbezig" style="background-image: url(<?php print( $bg ); ?>);">
  <img src="<?php print( $logo_l[0] ); ?>" class="logo">
	<h2><?php print( $vars['objects']->post_title ); ?></h2>
	<h3><?php print( $vars['objects']->post_excerpt ); ?></h3>
	<a href="<?php print( get_permalink( $vars['objects']->ID ) ); ?>" class="deep">Bekijk de story</a>
</article>
