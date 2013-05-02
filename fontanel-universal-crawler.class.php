<?php
	
	
	
	if( ! class_exists( 'TimelineCrawler' ) ):
		class TimelineCrawler {
			protected $db_manager;
			private $url;
			private $event_types = array(
				'tumblr_text' => 1,
				'tumblr_quote' => 2,
				'tumblr_link' => 3,
				'tumblr_answer' => 4,
				'tumblr_video' => 5,
				'tumblr_audio' => 6,
				'tumblr_photo' => 7,
				'tumblr_chat' => 8,
				'jobs_stage' => 9,
				'jobs_fulltime' => 10,
				'magazine_weekvan' => 11,
				'magazine_nieuwwerk' => 12,
				'magazine_goedbezig' => 13,
				'magazine_fontanel' => 14
			);
			
			public function __construct( $db_manager ) {
				$this->db_manager = $db_manager;
			}
			
			protected function getTypeId ( $platform = 'wp', $post_type = 'post' ) {
				$type = $platform . '_' . $post_type;
				return $this->event_types[ $type ];
			}
			
			/* 
			 * Send the objects encapsulated in a bi-dimentional array:
			 * $objects = array(
			 * 	 array( ['type'] => 'tumblr', ['id'] => 9874, ['object'] => OBJECT ),
			 *   array( ['type'] => 'job', ['id'] => 987859, ['object'] => OBJECT )
			 * );
			 */
			protected function storeEvent( $type_id, $objects_id, $timestamp, $objects = NULL ) {
				$new_or_updated = $this->db_manager->newOrUpdatedEvent( $type_id, $objects_id, $timestamp );
				if( $new_or_updated ) {
					$this->db_manager->storeEvent( $type_id, $objects_id, $timestamp );
					
					if( ! is_null( $objects ) ) {
						$this->db_manager->storeObjects($objects);
					}
				}
			}
			
			protected function fetch( $url ) {
				$chandle = curl_init();
				curl_setopt( $chandle, CURLOPT_URL, $url );
				curl_setopt( $chandle, CURLOPT_RETURNTRANSFER, 1 );
				$result = curl_exec( $chandle );
				curl_close( $chandle );
				return $result;
			}
		}
	endif;
	
	
	
	if( ! class_exists( 'TimelineTumblrCrawler' ) ):
		class TimelineTumblrCrawler extends TimelineCrawler {
			/* private $url; */
			private $api_key;
			private $platform = 'tumblr';
			
			public function __construct( $db_manager) {
				parent::__construct( $db_manager );
				
				$this->api_key = get_option( 'fontanel_tumblr_importer_api_key' );
			}
			
			public function fetchPosts() {
				$result = $this->fetch( 'http://api.tumblr.com/v2/blog/fontanel.tumblr.com/posts?api_key=' . $this->api_key . '&limit=1' );
				
				$this->processResult( $result );
			}
			
			private function processResult( $result ) {
				$workable_result = json_decode( $result );
				$type = $workable_result->response->posts[0]->type;
				$object_id = $workable_result->response->posts[0]->id;
				$type_id = $this->getTypeId( $this->platform, $type );
				$timestamp = $workable_result->response->posts[0]->timestamp;
				
				$savable_objects = $this->createSavableObjects( $workable_result->response->posts );
				
				$this->storeEvent( $type_id, $object_id, $timestamp, $savable_objects );
			}
			
			private function createSavableObjects( $raw_objects ) {
				$results = array();
				foreach( $raw_objects as $raw_object ) {
					$new_savable_objects = array();
					$new_savable_objects['type'] = 'tumblr';
					$new_savable_objects['id'] = $raw_object->id;
					$new_savable_objects['object'] = json_encode( $raw_object );
					$results[] = $new_savable_objects;
				}
				return $results;
			}
		}
	endif;



	if( ! class_exists( 'TimelineJobsCrawler' ) ):
		class TimelineJobsCrawler extends TimelineCrawler {
			private $platform = 'jobs';
			
			public function fetchPosts() {
				$result = $this->fetch( 'http://fontaneljobs.nl/vacatures.json?limit=1' );
				
				$this->processResult( $result );
			}
			
			private function processResult( $result ) {
				$workable_result = json_decode( $result );
				$type = strtolower( $workable_result[0]->job_type );
				$object_id = $workable_result[0]->id;
				$type_id = $this->getTypeId( $this->platform, $type );
				$timestamp = $workable_result[0]->created_at;
				
				$savable_objects = $this->createSavableObjects( $workable_result );
				
				$this->storeEvent( $type_id, $object_id, $timestamp, $savable_objects );
			}
			
			private function createSavableObjects( $raw_objects ) {
				$results = array();
				foreach( $raw_objects as $raw_object ) {
					$new_savable_objects = array();
					$new_savable_objects['type'] = 'jobs';
					$new_savable_objects['id'] = $raw_object->id;
					$new_savable_objects['object'] = json_encode( $raw_object );
					$results[] = $new_savable_objects;
				}
				return $results;
			}
		}
	endif;
	
	
	
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
	
	
	
	if( ! class_exists( 'FontanelUniversalCrawler' ) ):
  	class FontanelUniversalCrawler {
  	  private $timelineDatabaseManager;
  	  private $crawlers = array();
  	  
    	public function __construct() {
				$this->timelineDatabaseManager = new TimelineDatabaseManager();
				$this->crawlers[] = new TimelineTumblrCrawler( $this->timelineDatabaseManager );
				$this->crawlers[] = new TimelineJobsCrawler( $this->timelineDatabaseManager );
				$this->crawlers[] = new TimelineMagazineCrawler( $this->timelineDatabaseManager );
				$this->fetchPosts();
			}
			
			private function fetchPosts() {
				foreach( $this->crawlers as $crawler ){
					$crawler->fetchPosts();
				}
			}
  	}
  endif;
?>