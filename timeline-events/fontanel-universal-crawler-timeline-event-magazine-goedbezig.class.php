<?php
  if( ! class_exists( 'TimelineEventMagazineGoedbezig' ) ):
		class TimelineEventMagazineGoedbezig extends TimelineEvent {
			protected $slug = 'timeline-event-magazine-goedbezig';
			protected $type = 'Magazine Goedbezig';
			
			protected function setObjects( $objects ) {
  			$this->objects = get_post( $objects );
			}
		}
	endif;
?>