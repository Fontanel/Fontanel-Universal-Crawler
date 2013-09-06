<?php
  $post = json_decode( $vars['objects'][0]->object );
  
  if( !$vars['skip_readmore_wrap'] ) {
    $article_parts = preg_split("/<p><!-- more -->.*?\/p>/", $post->caption );
  } else {
    $article_parts = array( $post->caption );
  }
?>
<article class="note photo<?php include( dirname(__FILE__) . '/partials/author-tag.php' ); ?>" data-id="<?php print_r( $vars['id'] ); ?>" <?php include( dirname(__FILE__) . '/partials/origin-pretty-url.php' ); ?>>
	<?php include( dirname(__FILE__) . '/partials/author.php' ); ?>
	<div class="article-body">
		<figure class="<?php if( count( $post->photos ) > 1 ): ?>has-slideshow royalSlider rsDefault<?php endif; ?>">
		  <?php foreach( $post->photos as $slide_photo ): ?>
  			<a class="rsImg bugaga group-<?php print( $post->id ); ?>" href="<?php print( $slide_photo->alt_sizes[0]->url ); ?>">
  			  <img class="rsTmb" src="<?php print( $slide_photo->alt_sizes[0]->url ); ?>">
        </a>
		  <?php endforeach; ?>
		</figure>
		<div class="caption">
		  <section>
  			<?php print( $article_parts[0] ); ?>
  			<?php include( dirname(__FILE__) . '/partials/read-more.php' ); ?>
		  </section>
			<?php include( dirname(__FILE__) . '/partials/footer.php' ); ?>
		</div>
  </div>
</article>
