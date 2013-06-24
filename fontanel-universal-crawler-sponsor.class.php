<?php
	if( ! class_exists( 'FontanelUniversalCrawlerSponsor' ) ):
  	class FontanelUniversalCrawlerSponsor {
  	  public $url = '';
  	  public $logo = '';
  	  public $brand = '';
  	    	  
    	public function __construct( $url = '', $logo = '', $brand = '' ) {
        $this->url = $url;
        $this->logo = $logo;
        $this->brand = $brand;
			}
  	}
  endif;
?>