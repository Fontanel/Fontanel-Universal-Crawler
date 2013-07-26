<div class="item story nieuwwerk label header post-<?php print( $vars['objects']->ID ); ?>" style="background-image: url('<?php the_field( 'achtergrondafbeelding', $vars['objects']->ID ); ?>');" <?php include( dirname(__FILE__) . '/partials/carousel-colors.php' ); ?> data-id="<?php print_r( $vars['id'] ); ?>">
  <?php include( dirname(__FILE__) . '/partials/sponsor.php' ); ?>
	<h2>Een persoonlijke plek voor nieuwe projecten en initiatieven achter de schermen.</h2>
</div>

<style>
  .post-<?php print( $vars['objects']->ID ); ?>:after {
	  background-image: -webkit-radial-gradient( center top, circle cover, rgba( 255, 255, 255, .8 ) 0rem, rgba( 255, 255, 255, 1 ) 100% );
	  background-image: -moz-radial-gradient( center top, circle cover, rgba( 255, 255, 255, .8 ) 0%, rgba( 255, 255, 255, 1 ) 100% );
	  background-image: -o-radial-gradient( center top, circle cover, rgba( 255, 255, 255, .8 ) 0%, rgba( 255, 255, 255, 1 ) 100% );
	  background-image: radial-gradient( center top, circle cover, rgba( 255, 255, 255, .8 ) 0%, rgba( 255, 255, 255, 1 ) 100% );
	}
</style>
