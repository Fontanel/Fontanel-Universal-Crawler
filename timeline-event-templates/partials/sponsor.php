<?php if( !is_null( $vars['sponsor'] ) ): ?>
  <figure class="sponsor">
    <figcaption>presented by</figcaption>
    
    <img src="<?php print( $vars['sponsor']->thumb ); ?>">
  </figure>
<?php endif; ?>