<?php
	$logo_l = wp_get_attachment_image_src( get_field( 'logo_l', $vars['objects']->ID ), 'original' );
	$bg = get_field( 'bg_pattern', $vars['objects']->ID );
?>
<a class="item story goedbezig" style="background-image: url(<?php print( $bg ); ?>);" <?php include( dirname(__FILE__) . '/partials/carousel-colors.php' ); ?>>
  <img src="<?php print( $logo_l[0] ); ?>" class="logo">
	<h2><?php print( $vars['objects']->post_title ); ?></h2>
	<h3><?php print( $vars['objects']->post_excerpt ); ?></h3>
</a>
