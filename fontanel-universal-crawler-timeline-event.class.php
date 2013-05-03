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
        $template_file = get_template_directory() . '/timeline-events/' . $this->slug . '.php';
        $plugin_file = dirname(__FILE__) . '/timeline-event-templates/' . $this->slug . '.php';
        $default_file = dirname(__FILE__) . '/timeline-event-templates/timeline-event.php';
        
        if( file_exists( $template_file ) ) {
    			$this->template_path = $template_file;
    		} elseif( file_exists( $plugin_file ) ) {
      		$this->template_path = $plugin_file;
    		} else {
      		$this->template_path = $default_file;
    		}
			}
			
			public function render() {
        $vars = $this->objects;
        	 
        if( is_array( $vars ) && !empty( $vars ) ) {
          extract( $vars );
        }
        
  			ob_start();
        include $this->template_path;
        return ob_get_clean();
			}
		}
	endif;
?>