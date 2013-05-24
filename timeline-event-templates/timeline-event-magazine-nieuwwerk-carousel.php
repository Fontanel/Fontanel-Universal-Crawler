<!--
<article class="story nieuwwerk" style="background-image: url('<?php the_field( 'achtergrondafbeelding', $vars['objects']->ID ); ?>');" id="post-<?php print( $vars['objects']->ID ); ?>">
	<h2><?php print( $vars['objects']->post_title ); ?></h2>
	<h3><?php print( $vars['objects']->post_excerpt ); ?></h3>
	<a href="<?php print( get_permalink( $vars['objects']->ID ) ); ?>" style="background-color: <?php the_field( 'header_kleur_boven', $vars['objects']->ID ) ?>;">Bekijk de story</a>
</article>
-->

<div style="background-image: url(<?php print( bloginfo( 'template_url' ) ); ?>/img/mainstory-img.png);" class="item">
  <img src="<?php print( bloginfo( 'template_url' ) ); ?>/img/logo.png" alt="logo" width="285" height="100" id="logo">
</div>

