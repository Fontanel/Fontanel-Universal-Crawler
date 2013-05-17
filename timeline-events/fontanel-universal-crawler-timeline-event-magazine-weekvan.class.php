<?php
  require_once( FONTANEL_UNIVERSAL_CRAWLER_TIMELINE_EVENTS_DIR . '/fontanel-universal-crawler-timeline-event-magazine.class.php' );
  
  if( ! class_exists( 'TimelineEventMagazineWeekvan' ) ):
		class TimelineEventMagazineWeekvan extends TimelineEventMagazine {
			protected $slug = 'timeline-event-magazine-weekvan';
			protected $type = 'Magazine Weekvan';
		}
	endif;
?>