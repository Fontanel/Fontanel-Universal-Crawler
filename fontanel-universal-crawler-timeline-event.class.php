<?php
  if( ! class_exists( 'TimelineEvent' ) ):
		class TimelineEvent {
			private $objects = Array();
			private $template_path;
			private $database_manager;
			protected $slug = 'timeline-event';
			
			public function __construct( $objects, $database_manager, $template_path = false ) {
        $this->database_manager = $database_manager;
        
        $this->setObjects( $objects );
				
				if( !$template_path ) {
  				$this->findTemplate();
				} else {
  				$this->template_path = $template_path;
				}
			}
			
			private function setObjects( $objects ) {
  			$this->objects = $this->database_manager->getObjects( $objects );
			}
			
			private function findTemplate() {
        if( file_exists( get_template_directory() . '/timeline-events/' . $this->slug . '.php' ) ) {
    			$this->template_path = get_template_directory() . '/timeline-events/' . $this->slug . '.php';
    		} elseif( file_exists( dirname(__FILE__) . '/timeline-events-templates/' . $this->slug . '.php' ) ) {
      		$this->template_path =  dirname(__FILE__) . '/timeline-event-templates/' . $this->slug . '.php';
    		} else {
      		$this->template_path = dirname(__FILE__) . '/timeline-event-templates/timeline-event.php';
    		}
    		//print_r( $this->slug );
    		//print_r( $this->template_path );
			}
			
			public function render() {
        $vars = $this->objects;
        	 
        if( is_array( $vars ) && !empty( $vars ) ) {
          extract($vars);
        }
        
  			ob_start();
        include $this->template_path;
        return ob_get_clean();
			}
		}
	endif;
?>