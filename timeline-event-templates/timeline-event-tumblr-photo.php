<?php
  $post = json_decode( $vars['objects'][0]->object );
  
  $isShortStory = in_array('story', $post->tags) || $vars['id'] < 1495;
  
  $title = trim(strstr($post->caption, '<p>', true));
  
  if ($title !== '') {
      $title = '<a class="read-more" href="' . home_url() . '/notes' . $vars['objects'][0]->pretty_url . '">' . $title . '</a>';
  }
  
  $article =
        $title .
        '<h4>' . date_i18n( 'j F', $vars['created_at'] ) . ' - ' . get_the_author_meta( 'display_name', $vars['user']->wordpress_id ) . '</h4>' .
        '<p>' .
        strstr($post->caption, '<p>');
  
  if( $isShortStory && !$vars['skip_readmore_wrap'] ) {
    $article_parts = preg_split( "/<p>.*?<!-- more -->.*?\/p>|<!-- more -->/", $article );
    $article = explode(' ', $article_parts[0]);
    $article_tmp = '';
    while (strlen(strip_tags($article_tmp)) < 250 && count($article) > 0) {
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
?>
<article class="note photo<?php include( dirname(__FILE__) . '/partials/author-tag.php' ); ?>" data-id="<?php print_r( $vars['id'] ); ?>" data-story="<?php echo $isShortStory ? 'true' : 'false'; ?>" <?php include( dirname(__FILE__) . '/partials/origin-pretty-url.php' ); ?>>
	<div class="article-body">
        <?php if (!$isShortStory && !$vars['skip_readmore_wrap'] && isset($post->link_url)):?>
        <a href="<?php print $post->link_url;?>" target="_blank">
        <?php elseif ($isShortStory && !$vars['skip_readmore_wrap']): ?>
        <a href="<?php print home_url() . '/notes' . $vars['objects'][0]->pretty_url;?>">
        <?php endif;?>
		<figure class="<?php if ($isShortStory && $vars['skip_readmore_wrap'] && count($post->photos) > 1 && $vars['id'] != 1612):?>has-slideshow royalSlider rsDefault<?php endif;?>">
		  <?php foreach( $post->photos as $slide_photo ): ?>
  			<!--<a class="rsImg bugaga group-<?php print( $post->id ); ?>" href="<?php print( $slide_photo->alt_sizes[0]->url ); ?>">-->
  			  <img class="rsTmb" src="<?php print( $slide_photo->alt_sizes[0]->url ); ?>">
        <!--</a>-->
          <?php if (!$isShortStory || !$vars['skip_readmore_wrap'] || $vars['id'] == 1612) { break; } ?>
		  <?php endforeach; ?>
		</figure>
        <?php if ((!$isShortStory && !$vars['skip_readmore_wrap'] && isset($post->link_url)) || ($isShortStory && !$vars['skip_readmore_wrap'])):?>
        </a>
        <?php endif;?>
		<div class="caption <?php if (!$isShortStory):?>short-note<?php endif;?>">
		  <section>
            <?php if ($isShortStory):?>
            <h3>Short story</h3>
            <?php else:?>
            <h3>Note</h3>
            <?php endif;?>
  			<?php print( $article_parts[0] ); ?>
  			<?php include( dirname(__FILE__) . '/partials/read-more.php' ); ?>
            <?php if (!$isShortStory && $vars['skip_readmore_wrap'] && isset($post->link_url)):?>
            <p><a href="<?php print $post->link_url;?>" target="_blank">&mdash; Link</a></p>
            <?php endif;?>
		  </section>
            <?php
            if (($isShortStory || count($post->photos) > 1) && $vars['skip_readmore_wrap']):
            foreach( $post->photos as $k => $slide_photo ): if ($k === 0) { continue; }
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
