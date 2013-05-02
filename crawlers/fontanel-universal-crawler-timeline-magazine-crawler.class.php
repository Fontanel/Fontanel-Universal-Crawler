<?php
	if( ! class_exists( 'TimelineMagazineCrawler' ) ):
		class TimelineMagazineCrawler extends TimelineCrawler {
			private $platform = 'magazine';
			
			public function fetchPosts() {
				global $wp_query;
				$args = array( 'post_type' => array( 'weekvan', 'nieuwwerk', 'goedbezig', 'fontanel' ), 'posts_per_page' => 1 );
				query_posts( $args );

				while ( have_posts() ) : the_post();
					$type_id = $this->getTypeId( $this->platform, get_post_type( get_the_ID() ) );
					$this->storeEvent( $type_id, get_the_ID(), get_the_time() );
				endwhile;
				
				wp_reset_query();
			}
		}
	endif;
?>
