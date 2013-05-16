<aside class="avatar">
  <figure>
    <?php if( !is_null( $vars['user'] ) ): ?>
      <img src="<?php print( $vars['user']->thumb ); ?>"?>
      <figcaption><?php print( $vars['user']->name ); ?></figcaption>
    <?php else: ?>
      <img src="unkown_author.png">
      <figcaption>Annoniem</figcaption>
    <?php endif; ?>
  </figure>
</aside>