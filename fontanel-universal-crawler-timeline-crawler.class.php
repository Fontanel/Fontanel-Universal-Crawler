<?php
  if( ! class_exists( 'TimelineCrawler' ) ):
		class TimelineCrawler {
			protected $db_manager;
			private $url;
			private $event_types = Array();
			
			public function __construct( $db_manager ) {
        $this->event_types = unserialize( FONTANEL_UNIVERSAL_CRAWLER_EVENT_TYPES );
				$this->db_manager = $db_manager;
			}
			
			protected function getTypeId ( $platform = 'wp', $post_type = 'post' ) {
				$type = str_replace(' ', '', ucfirst( $platform ) . ucfirst( $post_type ) );
				return $this->event_types[ $type ];
			}
			
			/* 
			 * Send the objects encapsulated in a bi-dimentional array:
			 * $objects = array(
			 * 	 array( ['type'] => 'tumblr', ['id'] => 9874, ['object'] => OBJECT ),
			 *   array( ['type'] => 'job', ['id'] => 987859, ['object'] => OBJECT )
			 * );
			 */
			protected function storeEvent( $type_id, $objects_id, $timestamp, $objects = NULL, $author = NULL ) {
				if( $this->db_manager->newOrUpdatedEvent( $type_id, $objects_id, $timestamp ) ):
					$this->db_manager->storeEvent( $type_id, $objects_id, $timestamp, $author );
				endif;
				
				if( ! is_null( $objects ) ):
					$this->db_manager->storeObjects( $objects );
				endif;
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
?>
