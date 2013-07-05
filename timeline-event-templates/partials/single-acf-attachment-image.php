<?php
  $size = 'max-width';
  if( get_field( 'project', $vars['objects']->ID ) ){
    $first = true;
    while( has_sub_field( 'project', $vars['objects']->ID ) ) {
      if( $first ) {
        if ( get_sub_field('afbeeldingen') ) {
          $inner_first = true;
          foreach( get_sub_field('afbeeldingen') as $image ){
            $projectImg = wp_get_attachment_image_src( $image['afbeelding'] );
						print( $projectImg[0] );
          }
        }
      }
    }
  }
?>