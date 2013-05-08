<?php
	if( ! class_exists( 'FontanelUniversalCrawlerUser' ) ):
  	class FontanelUniversalCrawlerUser {
  	  public $name = '';
  	  public $thumb_id = '';
  	  private $wordpress_id = 0;
  	    	  
    	public function __construct( $name = '', $thumb = '', $wordpress_id = 0 ) {
        $this->name = $name;
        $this->thumb = $thumb;
        $this->wordpress_id = $wordpress_id;
			}
  	}
  endif;
?>