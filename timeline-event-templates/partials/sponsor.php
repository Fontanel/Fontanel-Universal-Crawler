<?php if( !is_null( $vars['sponsor'] ) ): ?>
  <figure class="sponsor">
    <figcaption class="proxima-light">presented by</figcaption>
    <a href="http://www.vitra.nl/" target="_blank"><img src="<?php print( $vars['sponsor']->thumb ); ?>"></a>
  </figure>
<?php endif; ?>