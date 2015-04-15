<?php
  if( ! class_exists( 'TimelineTumblrCrawler' ) ):
		class TimelineTumblrCrawler extends TimelineCrawler {
			/* private $url; */
			private $api_key;
			private $platform = 'tumblr';
			
			public function __construct( $db_manager) {
				parent::__construct( $db_manager );
				
				$this->api_key = get_option( 'fontanel_universal_crawler_tumblr_api_key' );
			}
			
			public function fetchPosts( $range ) {
  			$results = Array();
  			$results[] = $this->fetch( 'http://api.tumblr.com/v2/blog/fontanel.tumblr.com/posts?api_key=' . $this->api_key . '&limit=20' );
  			
			  if( $range == "max" ):
			    for ( $i = 0; $i < 40; $i++ ):
  			    $results[] = $this->fetch( 'http://api.tumblr.com/v2/blog/fontanel.tumblr.com/posts?api_key=' . $this->api_key . '&limit=20&offset=' . ( ( $i * 20 ) - 1 ) );
  			   endfor;
			  endif;
			  
			  foreach( $results as $result ):
  				$this->processResult( $result );
        endforeach;
			}
			
			private function processResult( $result ) {
				$workable_result = json_decode( $result );
				foreach( $workable_result->response->posts as $post) {
  				$type = $post->type;
  				$object_id = $post->id;
  				$type_id = $this->getTypeId( $this->platform, $type );
  				$timestamp = $post->timestamp;
  				
  				$savable_objects = $this->createSavableObjects( $post );
  				
  				$author = null;
  				if( isset( $savable_objects[0]['author'] ) ) {
    				$author = $this->db_manager->tryToFindAuthor( $savable_objects[0]['author']['alt'] );
  				}
  				
  				$this->storeEvent( $type_id, $object_id, $timestamp, $savable_objects, $author );
				}
			}
			
			private function getAuthorData( $url ) {
			  $dom = new DomDocument();
        @$dom->loadHTMLFile($url);
        $finder = new DomXPath($dom);
        $classname="author-profile";
        $nodes = $finder->query("//*[contains(@class, '$classname')]");
        $data = array();
        foreach($nodes as $node):
          foreach($node->childNodes as $child):
            if( $child->nodeName == "img" ):
              foreach( $child->attributes as $attr ):
                $data[$attr->nodeName] = $attr->nodeValue;
              endforeach;
            endif;
          endforeach;
        endforeach;
        return $data;
			}
			
			private function createSavableObjects( $raw_object ) {
				$new_savable_object = array();
				$new_savable_object['type'] = 'tumblr';
				$new_savable_object['id'] = $raw_object->id;
				$new_savable_object['object'] = json_encode( $raw_object );
				$new_savable_object['pretty_url'] = strrchr( $raw_object->post_url, '/' );
				$new_savable_object['author'] = $this->getAuthorData( "http://notes.fontanel.nl/post/" . $new_savable_object['id'] . $new_savable_object['pretty_url'] );
				return Array( $new_savable_object );
			}
		}
	endif;
?>
