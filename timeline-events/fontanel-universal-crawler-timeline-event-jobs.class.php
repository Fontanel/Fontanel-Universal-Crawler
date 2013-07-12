<?php
  if( ! class_exists( 'TimelineEventJobs' ) ):
		class TimelineEventJobs extends TimelineEvent {
			protected $slug = 'timeline-event-jobs';
			protected $type = 'Jobs';
		}
	endif;
?>