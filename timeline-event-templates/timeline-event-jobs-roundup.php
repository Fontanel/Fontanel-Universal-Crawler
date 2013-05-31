<article class="jobs weekly">
	<?php include( dirname(__FILE__) . '/partials/author.php' ); ?>
	<div class="article-body">
	  <section>
    	<h2><a href="<?php print( FONTANEL_UNIVERSAL_CRAWLER_JOBS_URL ); ?>">Weekly roundup</a></h2>
    	<h3>Alle vacatures van de afgelopen week</h3>
    	<ul>
    	  <?php foreach( $vars['objects'] as $raw_job ): ?>
    	    <?php $job = json_decode( $raw_job->object ); ?>
          <li>
            <a href="/vacature/senior-designer-on-en-offline" target="_blank">
              <h5><?php print( $job->company ); ?> zoekt een</h5>
              <h4><?php print( $job->job_function ); ?> <span class="new">nieuw</span></h4>
              <p>
                Vaste baan in <?php print( $job->city ); ?>
                <span class="fields-container">
                  <span class="dot">•</span>
                  <?php print( $job->fields ); ?>
                </span>
                <span class="dot">•</span>
                17 mei 2013
              </p>
            </a>
          </li>
    	  <?php endforeach; ?>
      	  <li><a href="<?php print( FONTANEL_UNIVERSAL_CRAWLER_JOBS_URL ); ?>">Bekijk alle vacatures en stages &gt;</a></li>
    	</ul>
	  </section>
  	<?php include( dirname(__FILE__) . '/partials/footer.php' ); ?>
  </div>
</article>
