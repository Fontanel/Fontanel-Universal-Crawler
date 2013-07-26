<a class="item story nieuwwerk goedbezig post-<?php print( $vars['objects']->ID ); ?>" style="background-image: url('<?php include( dirname(__FILE__) . '/partials/single-acf-attachment-image.php' ); ?>');" <?php include( dirname(__FILE__) . '/partials/carousel-colors.php' ); ?> data-id="<?php print_r( $vars['id'] ); ?>">
  <?php include( dirname(__FILE__) . '/partials/sponsor.php' ); ?>
	<h2><?php print( $vars['objects']->post_title ); ?></h2>
	<h3><?php print( $vars['objects']->post_excerpt ); ?></h3>
</a>

<?php include( dirname(__FILE__) . '/partials/good-bezig-logo-bg.php' ); ?>
<?php include( dirname(__FILE__) . '/partials/gradient-bg.php' ); ?>
