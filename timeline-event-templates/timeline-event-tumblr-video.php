<?php $video = json_decode( $vars['objects'][0]->object ); ?>
<article class="note video photo">
	<?php include( dirname(__FILE__) . '/partials/author.php' ); ?>
	<div class="article-body">
		<figure class="fitting-video">
			<?php print( $video->player[0]->embed_code ); ?>
		</figure>
		<div class="caption">
			<?php print( $video->caption ); ?>
		</div>
		<?php include( dirname(__FILE__) . '/partials/footer.php' ); ?>
  </div>
</article>
