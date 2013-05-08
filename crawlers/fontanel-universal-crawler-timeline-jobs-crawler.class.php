<?php
	if( ! class_exists( 'TimelineJobsCrawler' ) ):
		class TimelineJobsCrawler extends TimelineCrawler {
			private $platform = 'jobs';
			
			public function fetchPosts() {
				$result = $this->fetch( 'http://fontaneljobs.nl/vacatures.json?limit=10' );
				
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
?>
