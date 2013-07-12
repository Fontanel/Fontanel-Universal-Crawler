<?php
  if( ! class_exists( 'TimelineEventMagazine' ) ):
		class TimelineEventMagazine extends TimelineEvent {
			protected $slug = 'timeline-event-magazine';
			protected $type = 'Magazine';
			
			protected function setObjects( $objects ) {
  			$this->objects = get_post( $objects );
			}
		}
	endif;
?>