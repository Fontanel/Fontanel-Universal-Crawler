<a class="item story nieuwwerk label post-<?php print( $vars['objects']->ID ); ?>" style="background-image: url('<?php the_field( 'achtergrondafbeelding', $vars['objects']->ID ); ?>');" <?php include( dirname(__FILE__) . '/partials/carousel-colors.php' ); ?>>
  <?php include( dirname(__FILE__) . '/partials/sponsor.php' ); ?>
	<h2><?php print( $vars['objects']->post_title ); ?></h2>
	<h3><?php print( $vars['objects']->post_excerpt ); ?></h3>
</a>

<?php include( dirname(__FILE__) . '/partials/gradient-bg.php' ); ?>