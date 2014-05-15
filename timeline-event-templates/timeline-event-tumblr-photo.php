<?php
  $post = json_decode( $vars['objects'][0]->object );
  
  $article =
        strstr($post->caption, '<p>', true) .        
        '<h4>' . date_i18n( 'j F', $vars['created_at'] ) . ' - ' . get_the_author_meta( 'display_name', $vars['user']->wordpress_id ) . '</h4>' .
        '<p>' .
        strstr($post->caption, '<p>');
  
  if( !$vars['skip_readmore_wrap'] ) {
    $article_parts = preg_split( "/<p>.*?<!-- more -->.*?\/p>|<!-- more -->/", $article );
    $article = explode(' ', $article_parts[0]);
    $article_tmp = '';
    while (strlen(strip_tags($article_tmp)) < 320 && count($article) > 0) {
        $article_tmp .= array_shift($article) . ' ';
    }
    $article_parts[0] = trim($article_tmp);
    
    if (count($article) > 0) {
        $article_parts[0] .= "...";
        $article_parts[1] = ".";
    }
    
  } else {
    $article_parts = array( $article );
  }
  
  $isShortStory = in_array('story', $post->tags) || $vars['id'] < 1438;
?>
<article class="note photo<?php include( dirname(__FILE__) . '/partials/author-tag.php' ); ?>" data-id="<?php print_r( $vars['id'] ); ?>" data-story="<?php echo $isShortStory ? 'true' : 'false'; ?>" <?php include( dirname(__FILE__) . '/partials/origin-pretty-url.php' ); ?>>
	<div class="article-body">
		<figure class="has-slideshow royalSlider rsDefault">
		  <?php foreach( $post->photos as $slide_photo ): ?>
  			<a class="rsImg bugaga group-<?php print( $post->id ); ?>" href="<?php print( $slide_photo->alt_sizes[0]->url ); ?>">
  			  <img class="rsTmb" src="<?php print( $slide_photo->alt_sizes[0]->url ); ?>">
        </a>
		  <?php endforeach; ?>
		</figure>
		<div class="caption">
		  <section>
            <?php if ($isShortStory):?>
            <h3>Short story</h3>
            <?php endif;?>
  			<?php print( $article_parts[0] ); ?>
  			<?php include( dirname(__FILE__) . '/partials/read-more.php' ); ?>
		  </section>
            <?php
            if ($vars['skip_readmore_wrap']):
            foreach( $post->photos as $slide_photo ):
            ?>
  			  <img src="<?php print( $slide_photo->alt_sizes[0]->url ); ?>">
            <?php
            endforeach;
            endif;
            ?>
            <aside class="sharing"></aside>
		</div>
  </div>
</article>

<?php
if( $vars['large_author_block'] ):
  include( dirname(__FILE__) . '/partials/large-author-block.php' );
endif;
