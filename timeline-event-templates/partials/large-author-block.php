<?php if( !is_null( $vars['user'] ) ): ?>
  <?php
    $user_url = null;
    if( !is_null( $vars['user']->wordpress_id ) ) {
      $user_url = get_author_posts_url( $vars['user']->wordpress_id );
    } elseif( !is_null( $vars['user']->url ) ) {
      $user_url = $vars['user']->url;
    }
  ?>
  
  <footer class="author-block">
    <section>
      <figure>
        <?php if( !is_null( $user_url ) ): ?><a href="<?php print( $user_url ); ?>"><?php endif; ?>
        <img src="<?php print( $vars['user']->thumb ); ?>">
        <?php if( !is_null( $user_url ) ): ?></a><?php endif; ?>
      </figure>
      <aside>
        <h2><?php print( $vars['user']->name ); ?></h2>
        <p><?php print( get_the_author_meta( 'description', $vars['user']->wordpress_id ) ); ?></p>
      </aside>
    </section>
  </footer>
<?php endif; ?>
