<?php
	if( ! class_exists( 'FontanelUniversalCrawler' ) ):
  	class FontanelUniversalCrawler {
  	  private $database_manager;
  	  private $crawlers = array();
  	  private $file_prefix = 'fontanel-universal-crawler-';
  	  private $event_types = Array();
  	  
    	public function __construct() {
        $this->event_types = unserialize( FONTANEL_UNIVERSAL_CRAWLER_EVENT_TYPES );
    	  $this->requireClasses();
    	  $this->requireTimelineEvents();
    	  $this->requireCrawlers();
				$this->database_manager = new TimelineDatabaseManager();
				$this->crawlers[] = new TimelineTumblrCrawler( $this->database_manager );
				$this->crawlers[] = new TimelineJobsCrawler( $this->database_manager );
				$this->crawlers[] = new TimelineMagazineCrawler( $this->database_manager );
				$this->prepareForWP();
				// $this->fetchPosts();
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
        $timeline_events_dir = dirname(__FILE__) . '/timeline-events';
        if( is_dir( $timeline_events_dir ) ) {
  			  foreach( glob( $timeline_events_dir . '/*.*' ) as $file ) {
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
        $returns = Array();
  			foreach( $this->database_manager->getEvents( $page, $per_page ) as $event ) {
    			$returns[] = $this->createEventObject( $event );
  			}
  			return $returns;
  		}
  		
  		private function createEventObject( $event ) {
  		  if( $event->type > 0 ) {
    		  $class_name = 'TimelineEvent' . array_flip( $this->event_types )[ $event->type ];
    		  if( class_exists( $class_name ) ) {
      		  return new $class_name( $event->objects, $this->database_manager );
    		  } else {
        		return new TimelineEvent( $event->objects, $this->database_manager );
      		}
    		}
  		}
  	}
  endif;
?>