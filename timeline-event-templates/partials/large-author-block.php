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
        <img src="<?php if( has_wp_user_avatar( $vars['user']->wordpress_id ) ) {
        print( get_wp_user_avatar_src( $vars['user']->wordpress_id, 'thumbnail' ) );
      } else {
        print( $vars['user']->thumb );
      } ?>">
        <?php if( !is_null( $user_url ) ): ?></a><?php endif; ?>
      </figure>
        <h3><?php if( !is_null( $user_url ) ): ?><a href="<?php print( $user_url ); ?>"><?php endif; ?>Auteur<?php if( !is_null( $user_url ) ): ?></a><?php endif; ?></h3>
        <h2><?php if( !is_null( $user_url ) ): ?><a href="<?php print( $user_url ); ?>"><?php endif; ?><?php print( get_the_author_meta( 'display_name', $vars['user']->wordpress_id ) ); ?><?php if( !is_null( $user_url ) ): ?></a><?php endif; ?></h2>
        <p><?php print( get_the_author_meta( 'description', $vars['user']->wordpress_id ) ); ?></p>
    </section>
  </footer>
<?php endif; ?>
