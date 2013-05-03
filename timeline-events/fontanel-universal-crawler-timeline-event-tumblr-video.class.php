<?php
  if( ! class_exists( 'TimelineEventTumblrVideo' ) ):
		class TimelineEventTumblrVideo extends TimelineEvent {
			protected $slug = 'timeline-event-tumblr-video';
			protected $type = 'TumblrVideo';
		}
	endif;
?>