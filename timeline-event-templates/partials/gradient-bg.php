<style>
  .post-<?php print( $vars['objects']->ID ); ?>:after {
	  background-image: -webkit-gradient(linear, 0% 0%, 100% 100%, color-stop(0%, <?php the_field('eerste_kleur', $vars['objects']->ID ) ?>), color-stop(100%, <?php the_field('tweede_kleur', $vars['objects']->ID ) ?>));
	  background-image: -webkit-linear-gradient( left top, <?php the_field( 'eerste_kleur', $vars['objects']->ID ); ?>, <?php the_field( 'tweede_kleur', $vars['objects']->ID ); ?>);
	  background-image: -moz-linear-gradient( left top, <?php the_field( 'eerste_kleur', $vars['objects']->ID ); ?>, <?php the_field( 'tweede_kleur', $vars['objects']->ID ); ?>);
	  background-image: -o-linear-gradient( left top, <?php the_field( 'eerste_kleur', $vars['objects']->ID ); ?>, <?php the_field( 'tweede_kleur', $vars['objects']->ID); ?>);
	  background-image: linear-gradient( left top, <?php the_field( 'eerste_kleur', $vars['objects']->ID ); ?>, <?php the_field( 'tweede_kleur', $vars['objects']->ID ); ?>);
	}
</style>