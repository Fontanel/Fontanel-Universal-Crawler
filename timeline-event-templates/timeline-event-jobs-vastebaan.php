<?php $vacancy = json_decode( $vars['objects'][0]->object ); ?>
<article class="jobs fulltime">
	<div class="article-body">
	  <figure>
  	  <img src="">
  	</figure>
	  <h3><?php print( $vacancy->company ); ?> zoekt een</h3>
  	<h2><a href="<?php print( FONTANEL_UNIVERSAL_CRAWLER_JOBS_URL . $vacancy->url ); ?>"><?php print( $vacancy->job_function ); ?></a></h2>
  	<p>We zoeken <?php print( $vacancy->short_description ); ?></p>
  	<footer>
    	<p>
        Vaste baan in <?php print( $vacancy->city ); ?>
        <span class="fields-container">
          <span class="dot">•</span>
          <?php print( $vacancy->fields ); ?>
        </span>
        <span class="dot">•</span>
        17 mei 2013
      </p>
  	</footer>
	</div>
</article>
