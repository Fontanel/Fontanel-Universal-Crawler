<?php $vacancy = json_decode( $vars['objects'][0]->object ); ?>
<article class="jobs fulltime" data-id="<?php print_r( $vars['id'] ); ?>">
  <aside class="avatar jobs">
    <figure>
      <a href="http://www.fontaneljobs.nl">
        <img src="<?php bloginfo('template_directory') ?>/img/timeline-jobs-logo.png">
        <figcaption>Fontanel Jobs</figcaption>
      </a>
    </figure>
  </aside>

	<a class="article-body" href="<?php print( FONTANEL_UNIVERSAL_CRAWLER_JOBS_URL . $vacancy->url ); ?>">
	  <div class="right">
  	  <figure>
  	    <?php if( !empty( $vacancy->company_logo ) ): ?>
      	  <img src="<?php print( FONTANEL_UNIVERSAL_CRAWLER_JOBS_URL . $vacancy->company_logo ); ?>">
    	  <?php else: ?>
      	  <img src="">
    	  <?php endif; ?>
    	</figure>
	  </div>
	  <div class="left">
  	  <h3><?php print( $vacancy->company ); ?> zoekt een</h3>
    	<h2><?php print( $vacancy->job_function ); ?><?php if( ( time() - $vacancy->created_at ) < 604800 ): ?> <span class="new">nieuw</span><?php endif; ?></h2>
    	<p>We zoeken <?php print( $vacancy->short_description ); ?></p>
    	<footer>
      	<p>
          Vaste baan in <?php print( $vacancy->city ); ?>
          <span class="fields-container">
            <span class="dot">•</span>
            <?php print( $vacancy->fields ); ?>
          </span>
          <span class="dot">•</span>
          <?php print( fontanel_time_ago( $vacancy->created_at ) ); ?>
        </p>
    	</footer>
  	</div>
  </a>
</article>
