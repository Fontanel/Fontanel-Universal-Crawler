<?php
	if( ! class_exists( 'TimelineJobsCrawler' ) ):
		class TimelineJobsCrawler extends TimelineCrawler {
			private $platform = 'jobs';
			
			public function fetchPosts() {
				$result = $this->fetch( 'http://fontaneljobs.nl/vacatures.json?limit=50' );
				
				$this->processResult( $result );
			}
			
			private function processResult( $result ) {
				$workable_results = json_decode( $result );
								
				foreach( $workable_results as $workable_result ) {
  				$type = strtolower( $workable_result->job_type );
  				$object_id = $workable_result->id;
  				$type_id = $this->getTypeId( $this->platform, $type );
  				$timestamp = $workable_result->created_at;
  				
  				$savable_objects = $this->createSavableObjects( $workable_result, true );
  				
  				$this->storeEvent( $type_id, $object_id, $timestamp, $savable_objects );
				}
			}
			
			private function createSavableObjects( $raw_object, $excludeInternships = false ) {
			  if( !( $excludeInternships and $raw_object->job_type == "Stage" ) ) {
					$new_savable_objects = array();
					$new_savable_objects['type'] = 'jobs';
					$new_savable_objects['id'] = $raw_object->id;
					$new_savable_objects['object'] = json_encode( $raw_object );
					
					return $new_savable_objects;
				}
			}
		}
	endif;
?>
