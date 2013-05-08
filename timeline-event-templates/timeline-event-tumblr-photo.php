<?php $photo = json_decode( $vars['objects'][0]->object )->photos[0]->alt_sizes[1]; ?>
<article class="note photo">
	<aside class="avatar"></aside>
	<div class="article-body">
		<figure>
			<img src="<?php print( $photo->url ); ?>" width="<?php print( $photo->width ); ?>" height="<?php print( $photo->height ); ?>">
		</figure>
		<div class="caption">
			<?php print( json_decode( $vars['objects'][0]->object )->caption ); ?>
			<p><a href="<?php print( json_decode( $vars['objects'][0]->object )->post_url ); ?>">De originele post</a></p>
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
<!-- Like -->  </div>
</article>
