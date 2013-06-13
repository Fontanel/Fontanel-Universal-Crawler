<?php $post = json_decode( $vars['objects'][0]->object ); ?>
<?php $article_parts = preg_split("/<p><!-- more -->.*?\/p>/", $post->body ); ?>
<article class="note text">
	<?php include( dirname(__FILE__) . '/partials/author.php' ); ?>
	<div class="article-body">
  	<div class="text"><?php print( $article_parts[0] ); ?></div>
		<?php include( dirname(__FILE__) . '/partials/footer.php' ); ?>
	</div>
</article>

