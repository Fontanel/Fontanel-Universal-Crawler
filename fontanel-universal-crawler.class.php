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
				
				$this->register_admin_pages();
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
    	
    	
    	
    	
    	public function getAuthors() {
      	return $this->database_manager->getAuthors();
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
/*   			add_action( 'wp_enqueue_scripts', array( &$this, 'register_fontanel_universal_import_scripts' ) ); */
			}
			
			public function register_admin_pages() {
  			add_action( 'admin_init', array( &$this, 'register_editable_settings' ) );
  			add_action( 'admin_menu', array( &$this, 'add_plugin_menu' ) );
			}
			
			
			private function fetchPosts() {
				foreach( $this->crawlers as $crawler ){
					$crawler->fetchPosts();
				}
			}
			
			
			
			public function getEvents( $types = NULL, $page = 0, $per_page = 10, $cleaned_order = false, $author = NULL ) {
        $events = Array();
  			foreach( $this->database_manager->getEvents( $types, $page, $per_page, $author ) as $event ) {
    			$new_event = $this->createEventObject( $event );
    			
    			if( is_object( $new_event ) ) {
      			$events[] = $new_event;
    			}
  			}
  			
  			if( $cleaned_order ) { return $this->cleanOrder( $events ); }
  			
  			return $events;
  		}
  		
  		public function getEventsByObjectIds( $ids ) {
    		$events = Array();
  			foreach( $this->database_manager->getEventsByObjectIds( $ids ) as $event ) {
    			$new_event = $this->createEventObject( $event );
    			
    			if( is_object( $new_event ) ) {
      			$events[] = $new_event;
    			}
  			}
  			
  			return $this->cleanOrder( $events );
  		}
  		
  		
  		private function cleanOrder( $events ) {
    		$i = 1;
			  foreach( $events as $event ) {
			    if( $event->isNote() ) {
  			    array_unshift($events, $event);
  			    unset( $events[$i] );
  			    break;
			    }
			    $i++;
			  }
			  return $events;
  		}
  		
  		
  		
  		public function getEvent( $id ) {
  		  $events = $res = Array();
  		  if( gettype( $id ) === "integer" ) {
          $events = $this->database_manager->getEvent( $id );
        } else {
          $events = $this->database_manager->getEventByNoteUrl( $id );
        }
        
  			foreach( $events as $event ) {
    			$new_event = $this->createEventObject( $event );
    			
    			if( is_object( $new_event ) ) {
      			$res[] = $new_event;
    			}
  			}
  			return $res;
  		}
  		
  		

  		private function createEventObject( $event ) {
  		  if( $event->type > 0 ) {
  		    $type = array_flip( $this->event_types )[ $event->type ];
    		  $class_name = 'TimelineEvent' . $type;
    		  $user = $sponsor = NULL;
    		  
    		  if( !empty( $event->name ) ) {
      		  $user = new FontanelUniversalCrawlerUser( $event->name, $event->thumb, $event->wordpress_id, $event->url, $event->user_tag );
    		  }
    		  
    		  if( !empty( $event->brand ) ) {
      		  $sponsor = new FontanelUniversalCrawlerUser( $event->sponsor_url, $event->sponsor_logo, $event->brand );
    		  }
    		  
    		  if( class_exists( $class_name ) ) {
      		  return new $class_name( $event->id, $event->objects, $this->database_manager, $type, false, $user, $sponsor );
    		  } else {
        		return new TimelineEvent( $event->id, $event->objects, $this->database_manager, $type, false, $user, $sponsor );
      		}
    		}
  		}
  		
  		
  		
  		public function register_editable_settings() {
				register_setting(
				  'fontanel_universal_crawler_section',
				  'fontanel_universal_crawler_tumblr_api_key',
				  array( &$this, 'sanitize_fontanel_universal_crawler_tumblr_api_key' ) 
				);
				
				register_setting(
				  'fontanel_universal_crawler_section',
          'fontanel_universal_crawler_tumblr_blog_url',
          array( &$this, 'sanitize_fontanel_universal_crawler_tumblr_blog_url' ) 
        );
        
        register_setting(
				  'fontanel_universal_crawler_section',
          'fontanel_universal_crawler_ajax_url',
          array( &$this, 'sanitize_fontanel_universal_crawler_ajax_url' ) 
        );
			}
			
			
			
			public function add_plugin_menu() {
				add_settings_section(
				  'fontanel_universal_crawler_section',
				  'General',
				  array( &$this, 'render_fontanel_universal_crawler_tumblr_api_key_section' ),
				  'fontanel-universal-crawler-options'
				);
				
				add_settings_field(
				  'fontanel_universal_crawler_tumblr_api_key_field',
				  'Tumblr Api Key',
				  array( &$this, 'render_fontanel_universal_crawler_tumblr_api_key_field' ),
				  'fontanel-universal-crawler-options',
				  'fontanel_universal_crawler_section'
				);
				
				add_settings_field(
				  'fontanel_universal_crawler_tumblr_blog_url_field',
				  'Tumblr Url (without \'http\' or \'www\')',
				  array( &$this, 'render_fontanel_universal_crawler_tumblr_blog_url_field' ),
				  'fontanel-universal-crawler-options',
				  'fontanel_universal_crawler_section'
				);
				
				add_settings_field(
				  'fontanel_universal_crawler_ajax_url_field',
				  'Ajax Url (with \'http\')',
				  array( &$this, 'render_fontanel_universal_crawler_ajax_url_field' ),
				  'fontanel-universal-crawler-options',
				  'fontanel_universal_crawler_section'
				);
				
				add_options_page(
				  'Fontanel Universal Crawler Options',
				  'Universal Crawler',
				  'manage_options',
				  'fontanel-universal-crawler-options',
				  array( &$this, 'render_options_admin' )
				);
			}
			
			
			
			private function standard_input_field( $name ){
  			return '<input id="fontanel_universal_crawler_' . $name . '_field" name="fontanel_universal_crawler_' . $name . '[fontanel_universal_crawler_' . $name . '_field]" value="' . get_option( 'fontanel_universal_crawler_' . $name ) . '">';
			}
			
			
			public function render_fontanel_universal_crawler_tumblr_api_key_field() {
				echo $this->standard_input_field( 'tumblr_api_key' );
			}
			
			public function sanitize_fontanel_universal_crawler_tumblr_api_key( $input ) {
				return $input['fontanel_universal_crawler_tumblr_api_key_field'];
			}
			
			
			
			public function render_fontanel_universal_crawler_tumblr_blog_url_field() {
			  echo $this->standard_input_field( 'tumblr_blog_url' );
			}
			
			public function sanitize_fontanel_universal_crawler_tumblr_blog_url( $input ) {
				return $input['fontanel_universal_crawler_tumblr_blog_url_field'];
			}
			
			
			
			public function render_fontanel_universal_crawler_ajax_url_field() {
			  echo $this->standard_input_field( 'ajax_url' );
			}
			
			public function sanitize_fontanel_universal_crawler_ajax_url( $input ) {
				return $input['fontanel_universal_crawler_ajax_url_field'];
			}
			
			
			
			public function render_fontanel_universal_crawler_tumblr_api_key_section() {
				do_settings_fields( 'fontanel-universal-crawler-options', 'fontanel_universal_crawler_tumblr_api_key_field' );
				do_settings_fields( 'fontanel-universal-crawler-options', 'fontanel_universal_crawler_tumblr_blog_url_field' );
				do_settings_fields( 'fontanel-universal-crawler-options', 'fontanel_universal_crawler_ajax_url_field' );
			}
			
			
			
			public function render_options_admin() {
				if ( !current_user_can( 'manage_options' ) )	{
					wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
				}
				
				if( file_exists( dirname(__FILE__) . '/fontanel-universal-crawler-options-admin.php' ) ) {
					require_once( dirname(__FILE__) . '/fontanel-universal-crawler-options-admin.php' );
				}
			}
  	}
  endif;
?>
