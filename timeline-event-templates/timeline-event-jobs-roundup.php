<article class="jobs weekly">
	<?php include( dirname(__FILE__) . '/partials/author.php' ); ?>
	<div class="article-body">
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
        <!-- <?php print_r( $job ); ?> -->
  	  <?php endforeach; ?>
  	</ul>

  </div>
</article>
