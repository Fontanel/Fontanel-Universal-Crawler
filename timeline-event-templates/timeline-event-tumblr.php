<?php $post = json_decode( $vars['objects'][0]->object ); ?>
<?php $article_parts = preg_split("/<p><!-- more -->.*?\/p>/", $post->body ); ?>
<article class="note text">
	<?php include( dirname(__FILE__) . '/partials/author.php' ); ?>
	<div class="article-body">
  	<div class="text"><?php print( $article_parts[0] ); ?></div>
		<footer class="timeline-footer">
			<div class="fb-share">Share</div>
			<div class="twitter">Tweet</div>
			<time><?php print( fontanel_time_ago( $post->timestamp ) ); ?></time>
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

