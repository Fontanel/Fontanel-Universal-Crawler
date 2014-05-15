<?php $portrait = wp_get_attachment_image_src( get_field( 'portretfoto', $vars['objects']->ID ), 'full' ); ?>
<div class="rsContent item story goedbezig carousel header post-<?php print( $vars['objects']->ID ); ?>" style="background-image: url('<?php print( $portrait[0] ); ?>');" <?php include( dirname(__FILE__) . '/partials/carousel-colors.php' ); ?> data-id="<?php print_r( $vars['id'] ); ?>">
  <div class="carousel-wrapper">
  	<a href="<?php print( get_permalink( $vars['objects']->ID ) ); ?>">
        <div>
            <span class="helper"></span>
            <div>
                <figure class="logo"></figure>
                <h2><?php print( $vars['objects']->post_title ); ?></h2>
            </div>
        </div>
        <div>
            
        </div>
    </a>
  </div>
</div>
