<?php if( !is_null( $vars['user'] ) ): ?>
  <aside class="avatar">
    <figure>
      <?php if( !is_null( $vars['user']->url ) ): ?><a href="<?php print( $vars['user']->url ); ?>"><?php endif; ?>
      <img src="<?php print( $vars['user']->thumb ); ?>">
      <figcaption><?php print( $vars['user']->name ); ?></figcaption>
      <?php if( !is_null( $vars['user']->url ) ): ?></a><?php endif; ?>
    </figure>
  </aside>
<?php endif; ?>
