<?php
  require_once( FONTANEL_UNIVERSAL_CRAWLER_TIMELINE_EVENTS_DIR . '/fontanel-universal-crawler-timeline-event-jobs.class.php' );
  
  if( ! class_exists( 'TimelineEventJobsRoundup' ) ):
		class TimelineEventJobsRoundup extends TimelineEventJobs {
		  protected $slug = 'timeline-event-jobs-roundup';
			protected $type = 'JobsRoundup';
		}
	endif;
?>
