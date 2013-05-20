<?php
  $post = json_decode( $vars['objects'][0]->object );
  $photo = $post->photos[0]->alt_sizes[1];
?>
<article class="note photo">
	<?php include( dirname(__FILE__) . '/partials/author.php' ); ?>
	<div class="article-body">
		<figure<?php if( count( $post->photos ) > 1 ): ?> class="has-slideshow"<?php endif; ?>>
			<img src="<?php print( $photo->url ); ?>" width="100%" height="auto">
		</figure>
		<ul class="all-images" data-ref="group-<?php print( $post->id ); ?>">
		  <?php foreach( $post->photos as $slide_photo ): ?>
		    <li><a class="group-<?php print( $post->id ); ?>" href="<?php print( $slide_photo->alt_sizes[0]->url ); ?>">Dit is een foto</a></li>
		  <?php endforeach; ?>
		</ul>
		<div class="caption">
			<?php print( $post->caption ); ?>
		</div>
		<footer>
			<div class="fb-share">Share</div>
			<div class="twitter">Tweet</div>
			<time>16 uur geleden</time>
			<a href="#" class="tags-trigger"><span>Tags</span></a>
			<div class="tags">
				<ul>
					<li><a class="tag" href="#fixme">kunst</a></li>
					<li><a class="tag" href="#fixme">joep meloen</a></li>
					<li><a class="tag" href="#fixme">erotiek</a></li>
					<li><a class="tag" href="#fixme">amsterdam</a></li>
					<li><a class="tag" href="#fixme">design</a></li>
				</ul>
			</div>
		</footer>
  </div>
</article>
