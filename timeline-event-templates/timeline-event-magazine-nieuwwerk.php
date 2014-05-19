<article class="story nieuwwerk label timeline post-<?php print( $vars['objects']->ID ); ?>" id="post-<?php print( $vars['objects']->ID ); ?>" data-id="<?php print_r( $vars['id'] ); ?>">
    <a href="<?php print( get_permalink( $vars['objects']->ID ) ); ?>">
        <div style="background-color:<?php the_field( 'eerste_kleur', $vars['objects']->ID ); ?>">
            <span class="helper"></span>
            <div class="<?php the_field( 'thema', $vars['objects']->ID ); ?>">
                <figure class="logo"></figure>
                <h2><?php print( $vars['objects']->post_title ); ?></h2>
                <h3><?php print( $vars['objects']->post_excerpt ); ?></h3>
            </div>
        </div>
        <div style="background-color:<?php the_field( 'tweede_kleur', $vars['objects']->ID ); ?>">
            <span class="helper"></span>
            <img src="<?php print reset(wp_get_attachment_image_src( get_post_thumbnail_id( $vars['objects']->ID ), 'full' )); ?>" alt="" />
        </div>
	</a>
</article>
