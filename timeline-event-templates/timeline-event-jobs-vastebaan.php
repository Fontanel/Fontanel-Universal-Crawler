<?php $vacancy = json_decode( $vars['objects'][0]->object ); ?>
<article class="jobs fulltime" data-id="<?php print_r( $vars['id'] ); ?>">
	<a class="article-body" href="<?php print( FONTANEL_UNIVERSAL_CRAWLER_JOBS_URL . $vacancy->url ); ?>">
	  <div class="left">
  	  <figure>
  	    <?php if( !empty( $vacancy->company_logo ) ): ?>
      	  <img src="<?php print( FONTANEL_UNIVERSAL_CRAWLER_JOBS_URL . $vacancy->company_logo ); ?>">
    	  <?php else: ?>
      	  <img src="">
    	  <?php endif; ?>
    	</figure>
	  </div>
	  <div class="right">
  	  <h3><?php print( $vacancy->company ); ?> zoekt een</h3>
    	<h2><?php print( $vacancy->job_function ); ?></h2>
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
