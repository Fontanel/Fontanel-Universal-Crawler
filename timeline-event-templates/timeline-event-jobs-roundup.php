<article class="jobs weekly">
	<?php include( dirname(__FILE__) . '/partials/author.php' ); ?>
	<div class="article-body">
	  <section>
    	<h2><a href="<?php print( FONTANEL_UNIVERSAL_CRAWLER_JOBS_URL ); ?>">Weekly Jobs Roundup</a></h2>
    	<h3>Alle vacatures vorige week op Fontanel Jobs</h3>
    	<ul>
    	  <?php foreach( array_reverse( $vars['objects'] ) as $raw_job ): ?>
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
                <?php print( fontanel_time_ago( $job->created_at ) ); ?>
              </p>
            </a>
          </li>
    	  <?php endforeach; ?>
      	  <li><a href="<?php print( FONTANEL_UNIVERSAL_CRAWLER_JOBS_URL ); ?>" class="deep">Bekijk alle vacatures en stages</a></li>
    	</ul>
	  </section>
    <footer class="timeline-footer">
    	<div class="fb-share icon-facebook-1">Like<span>126</span></div>
    	<div class="twitter icon-twitter"> Tweet<span>240</span></div>
    	<time class="icon-clock">Week <?php print( $vars['created_at'] ); ?></time>
    </footer>

  </div>
</article>
