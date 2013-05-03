<?php
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
?>
