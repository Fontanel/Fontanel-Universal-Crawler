<?php
  require_once( FONTANEL_UNIVERSAL_CRAWLER_TIMELINE_EVENTS_DIR . '/fontanel-universal-crawler-timeline-event-jobs.class.php' );
  
  if( ! class_exists( 'TimelineEventJobsVasteBaan' ) ):
		class TimelineEventJobsVasteBaan extends TimelineEventJobs {
			protected $slug = 'timeline-event-jobs-vastebaan';
			protected $type = 'JobsVastebaan';
		}
	endif;
?>