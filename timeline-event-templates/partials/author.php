<?php if( !is_null( $vars['user'] ) ): ?>
  <aside class="avatar">
    <figure>
      <img src="<?php print( $vars['user']->thumb ); ?>">
      <figcaption><?php print( $vars['user']->name ); ?></figcaption>
    </figure>
  </aside>
<?php endif; ?>
