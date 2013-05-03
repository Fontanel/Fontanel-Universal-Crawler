<?php
  if( ! class_exists( 'TimelineEventTumblrPhoto' ) ):
		class TimelineEventTumblrPhoto extends TimelineEvent {
			protected $slug = 'timeline-event-tumblr-photo';
			protected $type = 'TumblrPhoto';
		}
	endif;
?>