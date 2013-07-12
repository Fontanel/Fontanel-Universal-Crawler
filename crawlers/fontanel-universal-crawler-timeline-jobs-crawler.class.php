<?php
	if( ! class_exists( 'TimelineJobsCrawler' ) ):
		class TimelineJobsCrawler extends TimelineCrawler {
			private $platform = 'jobs';
			
			public function fetchPosts() {
				$result = $this->fetch( 'http://fontaneljobs.nl/vacatures.json?limit=50' );
				
				$this->processResult( $result );
			}
			
			private function processResult( $result ) {
				$workable_result = json_decode( $result );
				$type = strtolower( $workable_result[0]->job_type );
				$object_id = $workable_result[0]->id;
				$type_id = $this->getTypeId( $this->platform, $type );
				$timestamp = $workable_result[0]->created_at;
				
				$savable_objects = $this->createSavableObjects( $workable_result, true );
				
				print_r( $savable_objects );
				
				$this->storeEvent( $type_id, $object_id, $timestamp, $savable_objects );
			}
			
			private function createSavableObjects( $raw_objects, $excludeInternships = false ) {
				$results = array();
				foreach( $raw_objects as $raw_object ) {
				  // Exclude internships if they should be excluded
				  if( !( $excludeInternships and $raw_object->job_type == "Stage" ) ) {
  					$new_savable_objects = array();
  					$new_savable_objects['type'] = 'jobs';
  					$new_savable_objects['id'] = $raw_object->id;
  					$new_savable_objects['object'] = json_encode( $raw_object );
  					$results[] = $new_savable_objects;
					}
				}
				return $results;
			}
		}
	endif;
?>
