<?php
  $portrait = wp_get_attachment_image_src( get_field( 'portretfoto', $vars['objects']->ID ), 'portrait_l' );
	$logo_l = wp_get_attachment_image_src( get_field( 'logo_l', $vars['objects']->ID ), 'original' );
	$logo_s = wp_get_attachment_image_src( get_field( 'logo_s', $vars['objects']->ID ), 'original' );
	$bg = get_field( 'bg_pattern', $vars['objects']->ID );
?>
<article class="story goedbezig" style="background-image: url(<?php print( $bg ); ?>);">
  <div class="title">
    <div class="wrap-logo left">
      <img src="<?php print( $logo_l[0] ); ?>" class="logo">
    </div>
    <div class="wrap-logo right">
      <img src="<?php print( $logo_l[0] ); ?>" class="logo">
    </div>
    <img src="<?php print( $portrait[0] ); ?>" class="portrait">
    <img src="<?php print( $portrait[0] ); ?>" class="fake-portrait">
  </div>
	<h2><?php print( $vars['objects']->post_title ); ?></h2>
	<h3><?php print( $vars['objects']->post_excerpt ); ?></h3>
	<a href="<?php print( get_permalink( $vars['objects']->ID ) ); ?>" class="deep">Bekijk de story</a>
</article>
