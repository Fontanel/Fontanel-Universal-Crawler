<?php
	if( ! class_exists( 'FontanelUniversalCrawlerUser' ) ):
  	class FontanelUniversalCrawlerUser {
  	  public $name = '';
  	  public $thumb = '';
  	  public $url = '';
  	  public $tag = '';
  	  public $wordpress_id = 0;
  	    	  
    	public function __construct( $name = '', $thumb = '', $wordpress_id = 0, $url = '', $tag = '' ) {
        $this->name = $name;
        $this->thumb = $thumb;
        $this->wordpress_id = $wordpress_id;
        $this->url = $url;
        $this->tag = $tag;
			}
  	}
  endif;
?>