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
      <?php if( !is_null( $user_url ) ): ?><a href="<?php print( $user_url ); ?>"<?php if( strpos( $user_url, "jobs" ) !== false ): ?> target="_blank"<?php endif; ?>><?php endif; ?>
      <img src="<?php if( has_wp_user_avatar( $vars['user']->wordpress_id ) ) {
        print( get_wp_user_avatar_src( $vars['user']->wordpress_id, 'thumbnail' ) );
      } else {
        print( $vars['user']->thumb );
      } ?>" class="hovers darker-shadow">
      <figcaption class="proxima-regular"><?php print( $vars['user']->name ); ?></figcaption>
      <?php if( !is_null( $user_url ) ): ?></a><?php endif; ?>
    </figure>
  </aside>
<?php endif; ?>