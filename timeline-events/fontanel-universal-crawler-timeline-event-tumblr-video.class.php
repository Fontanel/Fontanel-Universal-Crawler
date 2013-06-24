<?php
  require_once( FONTANEL_UNIVERSAL_CRAWLER_TIMELINE_EVENTS_DIR . '/fontanel-universal-crawler-timeline-event-tumblr.class.php' );
  
  if( ! class_exists( 'TimelineEventTumblrVideo' ) ):
		class TimelineEventTumblrVideo extends TimelineEventTumblr {
			protected $slug = 'timeline-event-tumblr-video';
			protected $type = 'TumblrVideo';
		}
	endif;
?>
