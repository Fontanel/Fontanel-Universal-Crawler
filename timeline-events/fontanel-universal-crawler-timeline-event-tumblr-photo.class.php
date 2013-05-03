<?php
  if( ! class_exists( 'TimelineEventTumblr' ) ):
		class TimelineEventTumblrPhoto extends TimelineEvent {
			protected $slug = 'timeline-event-tumblr-photo';
			protected $type = 'TumblrPhoto';
		}
	endif;
?>