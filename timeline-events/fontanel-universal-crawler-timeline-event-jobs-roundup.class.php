<?php
  require_once( FONTANEL_UNIVERSAL_CRAWLER_TIMELINE_EVENTS_DIR . '/fontanel-universal-crawler-timeline-event-jobs.class.php' );
  
  if( ! class_exists( 'TimelineEventJobsRoundup' ) ):
		class TimelineEventJobsRoundup extends TimelineEventJobs {
		  protected $slug = 'timeline-event-jobs-roundup';
			protected $type = 'JobsRoundup';
			
			protected function setCreatedAt() {
			  $obj = json_decode( $this->objects[0]->object );
  			$this->createdAt = $obj->created_at;
			}
		}
	endif;
?>
