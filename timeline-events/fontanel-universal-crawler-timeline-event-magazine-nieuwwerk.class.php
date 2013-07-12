<?php
  require_once( FONTANEL_UNIVERSAL_CRAWLER_TIMELINE_EVENTS_DIR . '/fontanel-universal-crawler-timeline-event-magazine.class.php' );
  
  if( ! class_exists( 'TimelineEventMagazineNieuwwerk' ) ):
		class TimelineEventMagazineNieuwwerk extends TimelineEventMagazine {
			protected $slug = 'timeline-event-magazine-nieuwwerk';
			protected $type = 'Magazine Nieuwwerk';
		}
	endif;
?>