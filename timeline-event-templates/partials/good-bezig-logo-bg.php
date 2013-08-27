<style>
  .post-<?php print( $vars['objects']->ID ); ?>:before {
	  background-image: url("<?php echo wp_get_attachment_image_src( get_field( 'logo_l', $vars['objects']->ID ), 'original' )[0]; ?>");
	}
</style>
