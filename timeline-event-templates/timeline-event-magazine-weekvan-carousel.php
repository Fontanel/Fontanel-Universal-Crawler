<a href="<?php print( get_permalink( $vars['objects']->ID ) ); ?>" class="item story weekvan" data-second-background="#300747">
  <?php /* <img src="<?php echo $portrait[0] ?>" class="portrait"> */ ?>
  <figure class="sponsor">
    <figcaption>presented by</figcaption>
    <img src="<?php bloginfo('template_directory') ?>/img/vitra-logo-purple.png">
  </figure>
  <img src="<?php bloginfo('template_directory') ?>/img/logo-weekvan.png" class="logo" />
  <h2><?php print( $vars['objects']->post_title ); ?></h2>
  <h3>Chief Pencil bij Present Plus</h3>
  <h4><?php print( $vars['objects']->post_excerpt ); ?></h4>
</a>
