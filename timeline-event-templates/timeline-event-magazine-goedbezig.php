<?php $portrait = wp_get_attachment_image_src( get_field( 'portretfoto', $vars['objects']->ID ), 'full' ); ?>
<article class="story nieuwwerk goedbezig timeline post-<?php print( $vars['objects']->ID ); ?>" id="post-<?php print( $vars['objects']->ID ); ?>" data-id="<?php print_r( $vars['id'] ); ?>" style="background-image:url(<?php print( $portrait[0] ); ?>);">
    <a href="<?php print( get_permalink( $vars['objects']->ID ) ); ?>">
        <div>
            <span class="helper"></span>
            <div>
                <figure class="logo"></figure>
                <h2><?php print( $vars['objects']->post_title ); ?></h2>
            </div>
        </div>
        <div>
            
        </div>
    </a>
</article>
