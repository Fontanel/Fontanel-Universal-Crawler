<div href="<?php print( get_permalink( $vars['objects']->ID ) ); ?>" class="item story weekvan header" data-second-background="#300747" data-id="<?php print_r( $vars['id'] ); ?>">
  <?php if( is_null( $vars['sponsor'] ) ): ?>
    <figure class="sponsor">
      <figcaption>presented by</figcaption>
      <img src="<?php bloginfo('template_directory') ?>/img/vitra-logo-purple.png">
    </figure>
  <?php else: ?>
    <?php include( dirname(__FILE__) . '/partials/sponsor.php' ); ?>
  <?php endif; ?>
  <img src="<?php bloginfo('template_directory') ?>/img/logo-weekvan.png" class="logo" />
  <h2>Een kijkje in het dagelijks leven van iemand met een toffe baan in de creatieve industrie</h2>
</div>
