<?php
  require_once( FONTANEL_UNIVERSAL_CRAWLER_TIMELINE_EVENTS_DIR . '/fontanel-universal-crawler-timeline-event-magazine.class.php' );
  
  if( ! class_exists( 'TimelineEventMagazineGoedbezig' ) ):
		class TimelineEventMagazineGoedbezig extends TimelineEventMagazine {
			protected $slug = 'timeline-event-magazine-goedbezig';
			protected $type = 'Magazine Goedbezig';
		}
	endif;
?>