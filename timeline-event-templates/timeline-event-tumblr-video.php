<?php
  $video = json_decode( $vars['objects'][0]->object );
  
  if( !$vars['skip_readmore_wrap'] ) {
    $article_parts = preg_split( "/<p>.*?<!-- more -->.*?\/p>|<!-- more -->/", $video->caption );
  } else {
    $article_parts = array( $video->caption );
  }
?>
<article class="note video photo<?php include( dirname(__FILE__) . '/partials/author-tag.php' ); ?>" data-id="<?php print_r( $vars['id'] ); ?>" <?php include( dirname(__FILE__) . '/partials/origin-pretty-url.php' ); ?>>
	<?php include( dirname(__FILE__) . '/partials/author.php' ); ?>
	<div class="article-body">
		<figure class="fitting-video">
			<?php print( $video->player[0]->embed_code ); ?>
		</figure>
		<div class="caption">
		  <section>
  			<?php print( $article_parts[0] ); ?>
  			<?php include( dirname(__FILE__) . '/partials/read-more.php' ); ?>
		  </section>
		  <?php include( dirname(__FILE__) . '/partials/footer.php' ); ?>
		</div>
  </div>

  <?php
    if( $vars['large_author_block'] ):
      include( dirname(__FILE__) . '/partials/large-author-block.php' );
    endif;
  ?>
</article>
