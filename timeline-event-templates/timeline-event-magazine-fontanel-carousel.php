<div class="rsContent item story nieuwwerk header carousel post-<?php print( $vars['objects']->ID ); ?>" style="background-image: url('<?php the_field( 'achtergrondafbeelding', $vars['objects']->ID ); ?>');" <?php include( dirname(__FILE__) . '/partials/carousel-colors.php' ); ?> data-id="<?php print_r( $vars['id'] ); ?>">
  <?php include( dirname(__FILE__) . '/partials/sponsor.php' ); ?>
  <div class="carousel-wrapper">
  	<h2><a href="<?php print( get_permalink( $vars['objects']->ID ) ); ?>"><?php print( $vars['objects']->post_title ); ?></a></h2>
  	<h3><?php print( $vars['objects']->post_excerpt ); ?></h3>
		<a href="<?php print( get_permalink( $vars['objects']->ID ) ); ?>" class="deep">Lees verder</a>
  </div>
  <?php include( dirname(__FILE__) . '/partials/gradient-bg.php' ); ?>
</div>
