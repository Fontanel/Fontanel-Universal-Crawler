<?php
  $post = json_decode( $vars['objects'][0]->object );
  $photo = $post->photos[0]->alt_sizes[1];
  
  if( !$vars['skip_readmore_wrap'] ) {
    $article_parts = preg_split("/<p><!-- more -->.*?\/p>/", $post->caption );
  } else {
    $article_parts = array( $post->caption );
  }
?>
<article class="note photo<?php include( dirname(__FILE__) . '/partials/author-tag.php' ); ?>">
	<?php include( dirname(__FILE__) . '/partials/author.php' ); ?>
	<div class="article-body">
		<figure class="<?php if( count( $post->photos ) > 1 ): ?>icon-gallery has-slideshow<?php endif; ?>">
			<img src="<?php print( $photo->url ); ?>" width="100%" height="auto">
		</figure>
		<ul class="all-images" data-ref="group-<?php print( $post->id ); ?>">
		  <?php foreach( $post->photos as $slide_photo ): ?>
		    <li><a class="group-<?php print( $post->id ); ?>" href="<?php print( $slide_photo->alt_sizes[0]->url ); ?>">Dit is een foto</a></li>
		  <?php endforeach; ?>
		</ul>
		<div class="caption">
		  <section>
  			<?php print( $article_parts[0] ); ?>
  			<?php include( dirname(__FILE__) . '/partials/read-more.php' ); ?>
		  </section>
			<?php include( dirname(__FILE__) . '/partials/footer.php' ); ?>
		</div>
  </div>
</article>
