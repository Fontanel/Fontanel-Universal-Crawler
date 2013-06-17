<?php
  if( ! class_exists( 'TimelineEvent' ) ):
		class TimelineEvent {
			private $template_path;
			private $database_manager;
			private $user;
			private $id;
			protected $created_at;
			protected $objects = Array();
			protected $slug = 'timeline-event';
			protected $type = 'Undefined';
			
			public function __construct( $id, $objects, $database_manager, $type = 'Undefined', $template_path = false, $user = NULL ) {
			  $this->id = $id;
        $this->type = $type;
        $this->database_manager = $database_manager;
        $this->user = $user;
        
        if( empty( $objects ) ) {
          return false;
        } else {
          $this->setObjects( $objects );
				}
				
				$this->setCreatedAt();
				
				if( !$template_path ) {
  				$this->findTemplate();
				} else {
  				$this->template_path = $template_path;
				}
			}
			
			protected function setObjects( $objects ) {
  			$this->objects = $this->database_manager->getObjects( $objects );
			}
			
			protected function setCreatedAt() {
  			$this->createdAt = 0;
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
			
			private function extendTemplatePath( $template ) {
  			$this->template_path = preg_replace('/\.php/', "-$template.php", $this->template_path);
			}
			
			public function render( $template = null, $skip_readmore_wrap = false ) {
			  if( !is_null( $template ) ){
  			  $this->extendTemplatePath( $template );
			  }
			  
        $vars = Array();
        $vars['objects'] = $this->objects;
        $vars['type'] = $this->type;
        $vars['id'] = $this->id;
        $vars['slug'] = $this->slug;
        $vars['user'] = $this->user;
        $vars['created_at'] = $this->createdAt;
        $vars['skip_readmore_wrap'] = $skip_readmore_wrap;
        
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
