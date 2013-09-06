<article class="story nieuwwerk goedbezig timeline post-<?php print( $vars['objects']->ID ); ?>" style="background-image: url('<?php include( dirname(__FILE__) . '/partials/single-acf-attachment-image.php' ); ?>');" id="post-<?php print( $vars['objects']->ID ); ?>" data-id="<?php print_r( $vars['id'] ); ?>">
  <?php include( dirname(__FILE__) . '/partials/sponsor.php' ); ?>
	<h2><?php print( $vars['objects']->post_title ); ?></h2>
	<h3><?php print( $vars['objects']->post_excerpt ); ?></h3>
	<a href="<?php print( get_permalink( $vars['objects']->ID ) ); ?>" style="background-color: <?php the_field( 'header_kleur_boven', $vars['objects']->ID ) ?>;" class="deep">Lees het artikel</a>
</article>

<?php include( dirname(__FILE__) . '/partials/gradient-bg.php' ); ?>
