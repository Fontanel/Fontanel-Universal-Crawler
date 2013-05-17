<?php
  if( ! class_exists( 'TimelineEvent' ) ):
		class TimelineEvent {
			private $template_path;
			private $database_manager;
			private $user;
			protected $objects = Array();
			protected $slug = 'timeline-event';
			protected $type = 'Undefined';
			
			public function __construct( $objects, $database_manager, $type = 'Undefined', $template_path = false, $user = NULL ) {
        $this->type = $type;
        $this->database_manager = $database_manager;
        $this->user = $user;
        
        $this->setObjects( $objects );
				
				if( !$template_path ) {
  				$this->findTemplate();
				} else {
  				$this->template_path = $template_path;
				}
			}
			
			protected function setObjects( $objects ) {
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
        $vars = Array();
        $vars['objects'] = $this->objects;
        $vars['type'] = $this->type;
        $vars['slug'] = $this->slug;
        $vars['user'] = $this->user;
        	 
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