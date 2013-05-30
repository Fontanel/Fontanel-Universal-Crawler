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
