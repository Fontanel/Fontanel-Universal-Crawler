<div class="rsContent item story weekvan header carousel" data-second-background="#300747" data-id="<?php print_r( $vars['id'] ); ?>">
  <?php if( is_null( $vars['sponsor'] ) ): ?>
    <figure class="sponsor">
      <figcaption>presented by</figcaption>
      <a href="http://www.vitra.nl" target="_blank"><img src="<?php bloginfo('template_directory') ?>/img/sponsors/vitra-logo-purple.png"></a>
    </figure>
  <?php else: ?>
    <?php include( dirname(__FILE__) . '/partials/sponsor.php' ); ?>
  <?php endif; ?>
    
  <div class="carousel-wrapper">
    <?php $portrait = wp_get_attachment_image_src( get_field( 'portretfoto', $vars['objects']->ID ), 'medium' ); ?>
    <img src="<?php echo $portrait[0] ?>" class="portrait">
    <img src="<?php bloginfo('template_directory') ?>/img/logo-weekvan.png" class="logo" />
    <h3><?php print( $vars['objects']->post_excerpt ); ?></h3>
		<a href="<?php print( get_permalink( $vars['objects']->ID ) ); ?>" class="deep">Lees het artikel</a>
  </div>
</div>
