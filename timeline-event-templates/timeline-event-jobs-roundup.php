<article class="jobs weekly">
	<?php include( dirname(__FILE__) . '/partials/author.php' ); ?>
	<div class="article-body">
	  <section>
    	<h2><a href="http://www.fontaneljobs.nl">Weekly roundup</a></h2>
    	<h3>Alle vacatures van de afgelopen week</h3>
    	<ul>
    	  <?php foreach( $vars['objects'] as $raw_job ): ?>
    	    <?php $job = json_decode( $raw_job->object ); ?>
          <li>
            <a href="/vacature/senior-designer-on-en-offline" target="_blank">
              <h5><?php print( $job->company ); ?> zoekt</h5>
              <h4><?php print( $job->job_function ); ?></h4>
              <p>
                Vaste baan in Den Haag E.O.
                <span class="fields-container">
                  <span class="dot">•</span>
                  Grafisch ontwerp + Reclame
                </span>
                <span class="dot">•</span>
                17 mei 2013
              </p>
            </a>
          </li>
    	  <?php endforeach; ?>
    	</ul>
	  </section>
  	<footer class="timeline-footer">
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
