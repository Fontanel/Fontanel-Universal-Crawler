<article class="note text">
  <?php include( dirname(__FILE__) . '/partials/author.php' ); ?>
	<div class="article-body">
		<h2><a href="#fixme"><?php print_r( $vars['type'] ); ?> (<?php print_r( $vars['slug'] ); ?>)</a></h2>
		<div class="caption">
			<p><?php print_r( $vars['objects'] ); ?></p>
		</div>
		<footer class="timeline-footer">
			<div class="fb-share">Share</div>
			<div class="twitter">Tweet</div>
			<time>x geleden</time>
		</footer>
	</div>
</article>
