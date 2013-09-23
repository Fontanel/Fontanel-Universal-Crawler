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
            <a href="<?php print( FONTANEL_UNIVERSAL_CRAWLER_JOBS_URL . $vacancy->url ); ?>" target="_blank">
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
    <?php
    	$permalink = home_url() . '/notes' . $vars['objects'][0]->pretty_url;
    ?>
    <footer class="timeline-footer">
      <p><?php print_r($vars) ?></p>
    	<div class="fb-share icon-facebook-1" data-url="<?php echo $permalink; ?>" data-title="Like"></div>
    	<div class="tw-share icon-twitter" data-url="<?php echo $permalink; ?>" data-title="Tweet" data-text="De nieuwste vacatures op @fontaneljobs"></div>
    	<time class="icon-clock"><a href="<?php echo $permalink; ?>">Week <?php print( $vars['created_at'] ); ?></a></time>
    </footer>
  </div>
</article>
