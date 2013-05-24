<?php
  $post_content = $vars['objects']->post_content;
	preg_match('/\[gallery.*ids=.(.*).\]/', $post_content, $ids);
  $attachments = array();
		
  if( count( $ids ) > 0 ) {
    $keys = explode( ',', $ids[1] );
    $random_key = array_rand( $keys );
    $random_val = $keys[$random_key];
    $attachments = get_posts( array(
  		'post_type' => 'attachment',
  		'posts_per_page' => 1,
  		'include' => $random_val,
  		'exclude' => array(
  									get_field( 'portret_persoon', $vars['objects']->ID ),
  									get_field( 'grote_afbeelding', $vars['objects']->ID )
  								)
  		)
  	);
	} 
	$portrait = wp_get_attachment_image_src( get_field('portretfoto', $vars['objects']->ID), 'medium' );
?>

<div class="item story weekvan">
  <img src="<?php echo $portrait[0] ?>" class="portrait">
  <img src="<?php bloginfo('template_directory') ?>/img/format-weekvan-logo-l.png" class="logo" />
  <?php
		if ( count( $attachments ) > 0 ):
			foreach ( $attachments as $attachment ): ?>
				<?php print( wp_get_attachment_image(
				  $attachment->ID,
				  'portrait_s',
				  false,
				  array(
				    'class' => 'prev-thumb',
				    'style' => 'right: -' . rand( 1, 4 ) . 'rem; top: -' . rand( 1, 4 ) . 'rem; transform:rotate(' . rand( -25, 25 ) . 'deg);-ms-transform:rotate(' . rand( -25, 25 ) . 'deg);-webkit-transform:rotate(' . rand( -25, 25 ) . 'deg);'
				  ) 
				) ); ?>
  		<?php endforeach;
		endif;
	?>
  <h2><?php print( $vars['objects']->post_title ); ?></h2>
  <h3><?php print( $vars['objects']->post_excerpt ); ?></h3>
  <a href="<?php print( get_permalink( $vars['objects']->ID ) ); ?>">Bekijk de story</a>
</div>
