<?php
  if( ! class_exists( 'TimelineEvent' ) ):
		class TimelineEvent {
			private $objects = Array();
			private $template_path;
			private $slug = 'timeline-event';
			
			public function __construct( $objects, $template_path = false ) {
				$this->objects = $objects;
				if( !$template ) {
  				$this->findTempate();
				} else {
  				$this->template_path = $template_path;
				}
			}
			
			private function findTemplate() {
        if( file_exists( get_template_directory() . '/timeline-events/' . $this->slug . $file . '.php' ) ) {
    			$this->template_path = get_template_directory() . '/timeline-events/' . $this->slug . $file . '.php';
    		} elseif( file_exists( dirname(__FILE__) . '/timeline-events/' . $this->slug . $file . '.php' ) ) {
      		$this->template_path =  dirname(__FILE__) . '/timeline-events/' . $this->slug . $file . '.php';
    		} else {
      		$this->template_path = dirname(__FILE__) . '/timeline-events/timeline-event.php';
    		}
			}
			
			public function render() {
  			
			}
		}
	endif;
?>