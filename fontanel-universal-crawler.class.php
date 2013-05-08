<?php
	if( ! class_exists( 'FontanelUniversalCrawler' ) ):
  	class FontanelUniversalCrawler {
  	  private $database_manager;
  	  private $crawlers = Array();
  	  private $event_types = Array();
  	  private $file_prefix = 'fontanel-universal-crawler-';
  	  
    	public function __construct( $fetch = false ) {
        $this->event_types = unserialize( FONTANEL_UNIVERSAL_CRAWLER_EVENT_TYPES );
    	  
    	  $this->requireClasses();
    	  $this->database_manager = new TimelineDatabaseManager();
    	  
    	  $this->requireTimelineEvents();
    	  $this->requireCrawlers();
    	  
    	  if( $fetch ) {
        	$this->fetchPosts();
      	}
      	
				$this->prepareForWP();
			}
			
			private function requireClasses() {
			  $includes = array(
			   'database-manager',
			   'timeline-crawler',
			   'timeline-event'
			  );
			  
			  foreach( $includes as $file ) {
  			  if( file_exists( dirname(__FILE__) . '/' . $this->file_prefix . $file . '.class.php' ) ) {
        		require_once( dirname(__FILE__) . '/' . $this->file_prefix . $file . '.class.php' );
        	}
			  }
    	}
    	
    	private function requireTimelineEvents() {
        if( is_dir( FONTANEL_UNIVERSAL_CRAWLER_TIMELINE_EVENTS_DIR ) ) {
  			  foreach( glob( FONTANEL_UNIVERSAL_CRAWLER_TIMELINE_EVENTS_DIR . '/*.*' ) as $file ) {
        		require_once( $file );
  			  }
			  }
    	}
    	
    	private function requireCrawlers() {
        $crawler_dir = dirname(__FILE__) . '/crawlers';
        if( is_dir( $crawler_dir ) ) {
  			  foreach( glob( $crawler_dir . '/*.*' ) as $file ) {
        		require_once( $file );
  			  }
			  }
			  
			  foreach( get_declared_classes() as $class ) {
          if( is_subclass_of( $class, 'TimelineCrawler' ) ) {
            $this->crawlers[] = new $class( $this->database_manager );
          }
        }
    	}
			
			private function prepareForWP() {
  			// add_filter( 'page_template', array( &$this, 'register_page_templates' ) );
			}
			
			private function fetchPosts() {
				foreach( $this->crawlers as $crawler ){
					$crawler->fetchPosts();
				}
			}
			
			public function getEvents( $page = 0, $per_page = 10 ) {
        $events = Array();
  			foreach( $this->database_manager->getEvents( $page, $per_page ) as $event ) {
    			$new_event = $this->createEventObject( $event );
    			
    			if( is_object( $new_event ) ) {
      			$events[] = $new_event;
    			}
  			}
  			return $events;
  		}
  		
  		private function createEventObject( $event ) {
  		  if( $event->type > 0 ) {
  		    $type = array_flip( $this->event_types )[ $event->type ];
    		  $class_name = 'TimelineEvent' . $type;
    		  if( class_exists( $class_name ) ) {
      		  return new $class_name( $event->objects, $this->database_manager, $type );
    		  } else {
        		return new TimelineEvent( $event->objects, $this->database_manager, $type );
      		}
    		}
  		}
  	}
  endif;
?>