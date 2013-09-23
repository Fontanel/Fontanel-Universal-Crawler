<?php if( isset( $article_parts[1] ) ): ?>
  <p>&raquo; <a href="<?php print( get_permalink( get_page_by_title( 'notes' ) ) ); ?><?php print($vars['objects'][0]->pretty_url); ?>">Lees meer</a></p>
<?php endif; ?>