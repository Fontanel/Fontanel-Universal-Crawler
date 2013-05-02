<?php
	if( ! class_exists( 'FontanelUniversalCrawler' ) ):
  	class FontanelUniversalCrawler {
  	  private $timelineDatabaseManager;
  	  private $crawlers = array();
  	  private $file_prefix = 'fontanel-universal-crawler-';
  	  
    	public function __construct() {
    	  $this->requireClasses();
    	  $this->requireCrawlers();
				$this->timelineDatabaseManager = new TimelineDatabaseManager();
				$this->crawlers[] = new TimelineTumblrCrawler( $this->timelineDatabaseManager );
				$this->crawlers[] = new TimelineJobsCrawler( $this->timelineDatabaseManager );
				$this->crawlers[] = new TimelineMagazineCrawler( $this->timelineDatabaseManager );
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
  			foreach( $this->timelineDatabaseManager->getEvents( $page, $per_page ) as $event ) {
    			$returns[] = new TimelineEvent( split( ',', $event->objects ) );
  			}
  			return $returns;
  		}
  	}
  endif;
?>