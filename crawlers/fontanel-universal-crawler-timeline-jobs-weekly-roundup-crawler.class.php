<?php
	if( ! class_exists( 'TimelineJobsWeeklyRoundupCrawler' ) ):
		class TimelineJobsWeeklyRoundupCrawler extends TimelineCrawler {
			private $platform = 'jobs';
			
			public function fetchPosts() {
				$result = $this->fetch( 'http://fontaneljobs.nl/roundup.json' );
				
				$this->processResult( $result );
			}
			
			private function processResult( $result ) {
				$workable_result = json_decode( $result );
				
				$mapper = function($val) {
				  if( $val->job_type == 'Vaste baan' ) {
    				return( $val->id );
  				}
				};
				
				$object_ids = array_filter( array_map( $mapper, $workable_result ) );
				$type_id = $this->getTypeId( $this->platform, 'roundup' );
				$timestamp = $workable_result[0]->created_at;
				
				$savable_objects = $this->createSavableObjects( $workable_result );
				
				$this->storeEvent( $type_id, implode( ',', $object_ids ), $timestamp, $savable_objects, 'jobs' );
			}
			
			private function createSavableObjects( $raw_objects ) {
				$results = array();
				foreach( $raw_objects as $raw_object ) {
				  if( $raw_object->job_type == 'Vaste baan' ) {
  					$new_savable_object = array();
  					$new_savable_object['type'] = 'jobs';
  					$new_savable_object['id'] = $raw_object->id;
  					$new_savable_object['object'] = json_encode( $raw_object );
  					$results[] = $new_savable_object;
  				}
				}
				return $results;
			}
		}
	endif;
?>
