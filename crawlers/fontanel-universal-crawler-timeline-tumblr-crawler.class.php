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
				$result = $this->fetch( 'http://api.tumblr.com/v2/blog/fontanel.tumblr.com/posts?api_key=' . $this->api_key . '&limit=10' );
				$this->processResult( $result );
			}
			
			private function processResult( $result ) {
				$workable_result = json_decode( $result );
				foreach( $workable_result->response->posts as $post) {
  				$type = $post->type;
  				$object_id = $post->id;
  				$type_id = $this->getTypeId( $this->platform, $type );
  				$timestamp = $post->timestamp;
  				
  				$savable_objects = $this->createSavableObjects( $post );
  				
  				$this->storeEvent( $type_id, $object_id, $timestamp, $savable_objects );
				}
			}
			
			private function createSavableObjects( $raw_object ) {
				$new_savable_object = array();
				$new_savable_object['type'] = 'tumblr';
				$new_savable_object['id'] = $raw_object->id;
				$new_savable_object['object'] = json_encode( $raw_object );
				return Array( $new_savable_object );
			}
		}
	endif;
?>
