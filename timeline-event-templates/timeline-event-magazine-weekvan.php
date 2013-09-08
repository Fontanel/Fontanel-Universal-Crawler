<article class="story weekvan timeline" data-id="<?php print_r( $vars['id'] ); ?>">
  <?php if( is_null( $vars['sponsor'] ) ): ?>
    <figure class="sponsor">
      <figcaption>presented by</figcaption>
      <img src="<?php bloginfo('template_directory') ?>/img/vitra-logo-purple.png">
    </figure>  
  <?php else: ?>
    <?php include( dirname(__FILE__) . '/partials/sponsor.php' ); ?>
  <?php endif; ?>
  <?php $portrait = wp_get_attachment_image_src( get_field( 'portretfoto', $vars['objects']->ID ), 'medium' ); ?>
  <img src="<?php print( $portrait[0] ); ?>" class="portrait">
  <h2><?php print( $vars['objects']->post_title ); ?></h2>
  <h3><?php print( $vars['objects']->post_excerpt ); ?></h3>
  <a href="<?php print( get_permalink( $vars['objects']->ID ) ); ?>" class="deep">Lees het artikel</a>
</article>
