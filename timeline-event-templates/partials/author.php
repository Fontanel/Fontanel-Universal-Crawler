<?php if( !is_null( $vars['user'] ) ): ?>
  <?php
    $user_url = null;
    if( !is_null( $vars['user']->wordpress_id ) ) {
      $user_url = get_author_posts_url( $vars['user']->wordpress_id );
    } elseif( !is_null( $vars['user']->url ) ) {
      $user_url = $vars['user']->url;
    }
  ?>
  <aside class="avatar">
    <figure>
      <?php if( !is_null( $user_url ) ): ?><a href="<?php print( $user_url ); ?>"><?php endif; ?>
      <img src="<?php print( $vars['user']->thumb ); ?>">
      <figcaption><?php print( $vars['user']->name ); ?></figcaption>
      <?php if( !is_null( $user_url ) ): ?></a><?php endif; ?>
    </figure>
  </aside>
<?php endif; ?>
