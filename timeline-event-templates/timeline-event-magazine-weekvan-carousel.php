<a href="<?php print( get_permalink( $vars['objects']->ID ) ); ?>" class="item story weekvan" data-second-background="#300747" data-id="<?php print_r( $vars['id'] ); ?>">
  <?php /* <img src="<?php echo $portrait[0] ?>" class="portrait"> */ ?>
  <?php if( is_null( $vars['sponsor'] ) ): ?>
    <figure class="sponsor">
      <figcaption>presented by</figcaption>
      <img src="<?php bloginfo('template_directory') ?>/img/vitra-logo-purple.png">
    </figure>
  <?php else: ?>
    <?php include( dirname(__FILE__) . '/partials/sponsor.php' ); ?>
  <?php endif; ?>
  <img src="<?php bloginfo('template_directory') ?>/img/logo-weekvan.png" class="logo" />
  <h2><?php print( $vars['objects']->post_title ); ?></h2>
  <h3>Chief Pencil bij Present Plus</h3>
  <h4><?php print( $vars['objects']->post_excerpt ); ?></h4>
</a>
