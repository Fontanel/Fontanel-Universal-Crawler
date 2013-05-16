<?php
  require_once( FONTANEL_UNIVERSAL_CRAWLER_TIMELINE_EVENTS_DIR . '/fontanel-universal-crawler-timeline-event-magazine.class.php' );
  
  if( ! class_exists( 'TimelineEventMagazineFontanel' ) ):
		class TimelineEventMagazineFontanel extends TimelineEventMagazine {
			protected $slug = 'timeline-event-magazine-fontanel';
			protected $type = 'Magazine Fontanel';
		}
	endif;
?>