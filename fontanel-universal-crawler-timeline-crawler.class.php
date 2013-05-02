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
?>