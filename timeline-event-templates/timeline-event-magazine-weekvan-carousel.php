<?php
$portrait = wp_get_attachment_image_src( get_field( 'portretfoto', $vars['objects']->ID ), 'large' );
preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $vars['objects']->post_content, $images);
?>
<div class="rsContent item story weekvan header carousel" data-second-background="#300747" data-id="<?php print_r( $vars['id'] ); ?>">
  <div class="carousel-wrapper" style="background-color:<?php the_field( 'eerste_kleur', $vars['objects']->ID ); ?>">
    <a href="<?php print( get_permalink( $vars['objects']->ID ) ); ?>">
        <div class="weekvan-thumb t1" style="background-image:url(<?php echo $images[1][0];?>);"></div>
        <div class="weekvan-thumb t2" style="background-image:url(<?php echo $images[1][1];?>);"></div>
        <div class="weekvan-thumb t3" style="background-color:<?php the_field( 'eerste_kleur', $vars['objects']->ID ); ?>">
            <figure class="logo"></figure>
            <h2><?php print( $vars['objects']->post_title ); ?></h2>
            <h3><?php print( $vars['objects']->post_excerpt ); ?></h3>
        </div>
        <div class="weekvan-thumb t4" style="background-image:url(<?php echo $portrait[0];?>);"></div>
        <div class="weekvan-thumb t5" style="background-image:url(<?php echo $images[1][2];?>);"></div>
        <div class="weekvan-thumb t6" style="background-image:url(<?php echo $images[1][3];?>);"></div>
    </a>
  </div>
</div>
