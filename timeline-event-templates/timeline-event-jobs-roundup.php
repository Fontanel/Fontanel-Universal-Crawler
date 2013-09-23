<article class="jobs weekly" data-id="<?php print_r( $vars['id'] ); ?>">
  <aside class="avatar jobs">
    <figure>
      <a href="http://www.fontaneljobs.nl" target="_blank">
        <img src="<?php bloginfo('template_directory') ?>/img/timeline-jobs-logo.png">
        <figcaption>Fontanel Jobs</figcaption>
      </a>
    </figure>
  </aside>
	<div class="article-body">
	  <section>
    	<h2><a target="_blank" href="<?php print( FONTANEL_UNIVERSAL_CRAWLER_JOBS_URL ); ?>">Weekly Jobs Roundup</a></h2>
    	<h3>Alle vacatures vorige week op Fontanel Jobs</h3>
    	<ul>
    	  <?php foreach( array_reverse( $vars['objects'] ) as $raw_job ): ?>
    	    <?php $job = json_decode( $raw_job->object ); ?>
          <li>
            <a href="<?php echo FONTANEL_UNIVERSAL_CRAWLER_JOBS_URL . $job->url ?>" target="_blank">
              <h5><?php print( $job->company ); ?> zoekt een</h5>
              <h4><?php print( $job->job_function ); ?><?php if( ( time() - $job->created_at ) < 604800 ): ?> <span class="new">nieuw</span><?php endif; ?></h4>
              <p>
                Vaste baan in <?php print( $job->city ); ?>
                <span class="fields-container">
                  <span class="dot">•</span>
                  <?php print( $job->fields ); ?>
                </span>
                <span class="dot">•</span>
                <?php print( fontanel_time_ago( $job->created_at ) ); ?>
              </p>
            </a>
          </li>
    	  <?php endforeach; ?>
      	  <li><a target="_blank" href="<?php print( FONTANEL_UNIVERSAL_CRAWLER_JOBS_URL ); ?>" class="deep">Bekijk alle vacatures en stages</a></li>
    	</ul>
	  </section>
    <footer>&nbsp;</footer>
  </div>
</article>
