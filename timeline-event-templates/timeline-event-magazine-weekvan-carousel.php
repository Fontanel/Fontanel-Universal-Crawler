<?php
  $post_content = $vars['objects']->post_content;
	preg_match('/\[gallery.*ids=.(.*).\]/', $post_content, $ids);
  /*
$attachments = array();
		
  if( count( $ids ) > 0 ) {
    global $keys;
    $mapper = function($key){
      global $keys;
      return $keys[$key];
    };
    
    $keys = explode( ',', $ids[1] );
    $random_keys = array_rand( $keys, 3 );
    $random_vals = array_map( $mapper, $random_keys );
    $attachments = get_posts( array(
  		'post_type' => 'attachment',
  		'posts_per_page' => 3,
  		'include' => $random_vals,
  		'exclude' => array(
  									get_field( 'portret_persoon', $vars['objects']->ID ),
  									get_field( 'grote_afbeelding', $vars['objects']->ID )
  								)
  		)
  	);
	}
	$portrait = wp_get_attachment_image_src( get_field('portretfoto', $vars['objects']->ID), 'medium' );
*/
?>

<div class="item story weekvan" data-second-background="#300747">
  <?php /* <img src="<?php echo $portrait[0] ?>" class="portrait"> */ ?>
  <img src="<?php bloginfo('template_directory') ?>/img/logo-weekvan.png" class="logo" />
  <?php
		/*
if ( count( $attachments ) > 0 ):
		  $i = 0;
			foreach ( $attachments as $attachment ):
				print( wp_get_attachment_image(
				  $attachment->ID,
				  array( 240, 240 ),
				  false,
				  array(
				    'class' => 'prev-thumb'
				  ) 
				) );
				$i++;
  		endforeach;
		endif;
*/
	?>
  <h2><?php print( $vars['objects']->post_title ); ?></h2>
  <h3>Chief Pencil bij Present Plus</h3>
  <h4><?php print( $vars['objects']->post_excerpt ); ?></h4>
</div>
