<?php
  if( ! class_exists( 'TimelineEventTumblr' ) ):
		class TimelineEventTumblr extends TimelineEvent {
			protected $slug = 'timeline-event-tumblr';
			protected $type = 'Tumblr';
			
			protected function setCreatedAt() {
			  $obj = json_decode( $this->objects[0]->object );
  			$this->createdAt = $obj->timestamp;
			}
		}
	endif;
?>
