<?php
  $post = json_decode( $vars['objects'][0]->object );
  
  $article =
        strstr($post->caption, '<p>', true) .        
        '<h4>' . date_i18n( 'j F', $vars['created_at'] ) . ' - ' . get_the_author_meta( 'display_name', $vars['user']->wordpress_id ) . '</h4>' .
        '<p>' .
        strstr($post->caption, '<p>');
  
  if( !$vars['skip_readmore_wrap'] ) {
    $article_parts = preg_split( "/<p>.*?<!-- more -->.*?\/p>|<!-- more -->/", $article );
  } else {
    $article_parts = array( $article );
  }
?>
<article class="note text<?php include( dirname(__FILE__) . '/partials/author-tag.php' ); ?>" data-id="<?php print_r( $vars['id'] ); ?>" <?php include( dirname(__FILE__) . '/partials/origin-pretty-url.php' ); ?>>
	<div class="article-body">
  	<div class="text">
    	<?php if( !empty( $post->title ) ): ?>
        <h2><?php print( $post->title ); ?></h2>
      <?php endif; ?>
      <?php print( $article_parts[0] ); ?>
      <?php include( dirname(__FILE__) . '/partials/read-more.php' ); ?>
    </div>
	</div>
</article>
<?php
if( $vars['large_author_block'] ):
  include( dirname(__FILE__) . '/partials/large-author-block.php' );
endif;
