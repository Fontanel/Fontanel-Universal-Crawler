<?php
  if( ! class_exists( 'TimelineEventTumblr' ) ):
		class TimelineEventTumblr extends TimelineEvent {
			protected $slug = 'timeline-event-tumblr';
			protected $type = 'Tumblr';
		}
	endif;
?>