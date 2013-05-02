<?php
/*
	Plugin Name: Fontanel Universal Crawler
	Description: Periodically imports posts from a any source and puts all content in a timeline
	Version: undefined
	Author: Fontanel, Jasper Kennis
	Author URI: http://fontanel.nl
	License: None
  */
  


	@ini_set( 'display_errors', 'On' );
	
	// Import settings:
	if( file_exists( dirname(__FILE__) . '/fontanel-universal-crawler.class.php' ) ) {
		require_once( dirname(__FILE__) . '/fontanel-universal-crawler.class.php' );
	}	

	if ( class_exists( 'FontanelTumblrImporter' ) ):
		$MyFontanelUniversalCrawler = new FontanelUniversalCrawler();
	endif;
?>
