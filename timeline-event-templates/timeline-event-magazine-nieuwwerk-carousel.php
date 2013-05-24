<div class="item story nieuwwerk" style="background-image: url('<?php the_field( 'achtergrondafbeelding', $vars['objects']->ID ); ?>');" id="post-<?php print( $vars['objects']->ID ); ?>" <?php include( dirname(__FILE__) . '/partials/carousel-colors.php' ); ?>>
	<h2><?php print( $vars['objects']->post_title ); ?></h2>
	<h3><?php print( $vars['objects']->post_excerpt ); ?></h3>
	<?php include( dirname(__FILE__) . '/partials/carousel-next.php' ); ?>
</div>
