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
			   'timeline-event',
			   'user'
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
  			add_action( 'wp_enqueue_scripts', array( &$this, 'register_fontanel_universal_import_scripts' ) );
			}
			
			public function register_fontanel_universal_import_scripts() {
				wp_register_script( 'waypoints'         , plugins_url( '/js/waypoints.min.js', __FILE__ ), array('jquery'), 1, true );
				wp_register_script( 'fitvid'            , plugins_url( '/js/fitvid.js', __FILE__ ), array('jquery'), 1, true );
				wp_register_script( 'infinity'          , plugins_url( '/js/infinity.min.js', __FILE__ ), array('jquery'), 1, true );
				wp_register_script( 'colorbox'          , plugins_url( '/js/vendor/jquery.colorbox-min.js', __FILE__ ), array( 'jquery' ), 1, true );
				wp_register_script( 'universal-importer', plugins_url( '/js/universal-importer.js', __FILE__ ), array('fitvid','jquery','waypoints', 'colorbox'), 1, true );

        wp_enqueue_script( 'colorbox' );
				wp_enqueue_script( 'waypoints' );
				wp_enqueue_script( 'fitvid' );
				wp_enqueue_script( 'universal-importer' );
			}
			
			private function fetchPosts() {
				foreach( $this->crawlers as $crawler ){
					$crawler->fetchPosts();
				}
			}
			
			public function getEvents( $types = null, $page = 0, $per_page = 10 ) {
        $events = Array();
  			foreach( $this->database_manager->getEvents( $types, $page, $per_page ) as $event ) {
    			$new_event = $this->createEventObject( $event );
    			
    			if( is_object( $new_event ) ) {
      			$events[] = $new_event;
    			}
  			}
  			return $events;
  		}
  		
  		public function getEvent( $id ) {
        $events = Array();
  			foreach( $this->database_manager->getEvent( $id ) as $event ) {
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
    		  $user = NULL;
    		  
    		  if( !empty( $event->name ) ) {
      		  $user = new FontanelUniversalCrawlerUser( $event->name, $event->thumb, $event->wordpress_id, $event->url );
    		  }
    		  
    		  if( class_exists( $class_name ) ) {
      		  return new $class_name( $event->objects, $this->database_manager, $type, false, $user );
    		  } else {
        		return new TimelineEvent( $event->objects, $this->database_manager, $type, false, $user );
      		}
    		}
  		}
  	}
  endif;
?>