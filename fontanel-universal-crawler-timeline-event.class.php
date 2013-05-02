<?php
  if( ! class_exists( 'TimelineEvent' ) ):
		class TimelineEvent {
			private $objects = Array();
			private $template_path;
			private $slug = 'timeline-event';
			
			public function __construct( $objects, $template_path = false ) {
				$this->objects = $objects;
				if( !$template_path ) {
  				$this->findTemplate();
				} else {
  				$this->template_path = $template_path;
				}
			}
			
			private function findTemplate() {
        if( file_exists( get_template_directory() . '/timeline-events/' . $this->slug . '.php' ) ) {
    			$this->template_path = get_template_directory() . '/timeline-events/' . $this->slug . '.php';
    		} elseif( file_exists( dirname(__FILE__) . '/timeline-events-templates/' . $this->slug . '.php' ) ) {
      		$this->template_path =  dirname(__FILE__) . '/timeline-event-templates/' . $this->slug . '.php';
    		} else {
      		$this->template_path = dirname(__FILE__) . '/timeline-event-templates/timeline-event.php';
    		}
			}
			
			public function render() {
/*
        if (is_array($vars) && !empty($vars)) {
          extract($vars);
        }
*/
  			ob_start();
        include $this->template_path;
        return ob_get_clean();
			}
		}
	endif;
?>