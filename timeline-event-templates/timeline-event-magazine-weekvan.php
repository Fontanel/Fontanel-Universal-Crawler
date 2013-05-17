<?php
  $post_content = get_the_content( $vars['objects']->ID );
	preg_match('/\[gallery.*ids=.(.*).\]/', $post_content, $ids);
  $attachments = array();
		
  if( count( $ids ) > 0 ) {
    $attachments = get_posts( array(
  		'post_type' => 'attachment',
  		'numberposts' => 3,
  		'include' => $ids[1],
  		'exclude' => array(
  									get_field( 'portret_persoon', $vars['objects']->ID ),
  									get_field( 'grote_afbeelding', $vars['objects']->ID )
  								),
  		'orderby' => 'post__in'
  		)
  	);
	} 
	$portrait = wp_get_attachment_image_src( get_field('portretfoto', $vars['objects']->ID), 'medium' );
?>
<article class="story weekvan">
  <img src="<?php echo $portrait[0] ?>" class="portrait">
  <img src="<?php bloginfo('template_directory') ?>/img/format-weekvan-logo-l.png" class="logo" />
  <h2><?php print( $vars['objects']->post_title ); ?></h2>
  <h3><?php print( $vars['objects']->post_excerpt ); ?></h3>
  <?php
		if ( count( $attachments ) > 0 ) {
			foreach ( $attachments as $attachment ) {
				$title = $attachment->post_title;
				echo '<li><a href="#' . strtolower( $title ) . '">' . $title . '</a></li>';
				}
			}
		?>
  <a href="<?php print( get_permalink( $vars['objects']->ID ) ); ?>">Bekijk de story</a>
  <!-- <?php print_r($vars['objects']); ?> -->
</article>
