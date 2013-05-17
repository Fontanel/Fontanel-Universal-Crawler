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
?>
<article class="story weekvan">
	<div class="article-body">
		<div class="caption">
      <h2><?php print( $vars['objects']->post_title ); ?></h2>
      <h3><?php print( $vars['objects']->post_excerpt ); ?></h3>
      <?php $portrait = wp_get_attachment_image_src( get_field('portretfoto', $vars['objects']->ID), 'medium' ); ?>
		  <img src="<?php echo $portrait[0] ?>" class="portrait">
      <?php
				if ( count( $attachments ) > 0 ) {
					foreach ( $attachments as $attachment ) {
						$title = $attachment->post_title;
						echo '<li><a href="#' . strtolower( $title ) . '">' . $title . '</a></li>';
						}
					}
				?>
<!-- 				<p><?php print_r($vars['objects']); ?></p> -->
		</div>
	</div>
</article>
