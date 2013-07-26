<?php
  if( ! class_exists( 'TimelineDatabaseManager' ) ):
  	class TimelineDatabaseManager {
    	private $database_prefix = 'timeline_';
    	private $tables = array();
    	public $iwpdb;
	
	
	
      public function __construct() {
      	global $wpdb;
      	$this->iwpdb = $wpdb;
      	foreach( array( 'events', 'objects', 'authors', 'sponsors' ) as $table_name ) {
          $this->tables[$table_name] = $this->iwpdb->prefix . $this->database_prefix . $table_name;	
      	}
      	
				/* require_once( ABSPATH . 'wp-admin/includes/upgrade.php' ); */
        $this->ensureDatabaseExistence();
      }
    
    
    
      private function ensureDatabaseExistence() {
        $sql = array();
        $sql[] =
          "CREATE TABLE IF NOT EXISTS " . $this->tables['events'] . " ( "
          . "type smallint NOT NULL,"
          . "time int(128) NOT NULL,"
          . "updated_at int NOT NULL,"
          . "objects varchar(128) NOT NULL,"
          . "sticky_untill int NOT NULL,"
          . "author varchar(128) NULL,"
          . "sponsor int NULL,"
          . "id int NOT NULL AUTO_INCREMENT PRIMARY KEY );";
				
				$sql[] =
          "CREATE TABLE IF NOT EXISTS " . $this->tables['objects'] . " ( "
          . "type varchar(128) NOT NULL,"
          . "id varchar(128) NOT NULL,"
          . "updated_at int NOT NULL,"
          . "object text NOT NULL,"
          . "pretty_url varchar(128) NULL,"
          . "PRIMARY KEY(id,type) );";
          
        $sql[] =
          "CREATE TABLE IF NOT EXISTS " . $this->tables['authors'] . " ( "
          . "tag varchar(128) NOT NULL,"
          . "name varchar(128) NOT NULL,"
          . "thumb varchar(128) NOT NULL,"
          . "wordpress_id int NULL,"
          . "url varchar(128) NULL,"
          . "PRIMARY KEY(tag) );";
        
        $sql[] =
          "CREATE TABLE IF NOT EXISTS " . $this->tables['sponsors'] . " ( "
          . "brand varchar(128) NOT NULL, "
          . "logo_url varchar(128) NOT NULL, "
          . "url varchar(128) NOT NULL, "
          . "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY );";
				
				foreach( $sql as $query ) {
					$this->iwpdb->query( $query );
				}
      }



      public function newOrUpdatedEvent( $type = 0, $objects = '0', $timestamp = 0 ) {
	      $sql =
          "SELECT updated_at "
          . "FROM " . $this->tables['events'] . " "
          . "WHERE type=" . $type . " "
          . "AND objects='" . $objects . "';";
      	$existing_objects = $this->iwpdb->get_row( $sql );
      	
      	if( is_null( $existing_objects ) ) {
	      	return true;
	      }
	      
      	return false;
      }



      public function storeEvent( $type = 0, $objects = '', $timestamp = 0, $author = NULL ) {
      	$this->iwpdb->insert( $this->tables['events'], array(
      		'type' => $type,
      		'objects' => $objects,
      		'time' => $timestamp,
      		'updated_at' => $timestamp,
      		'author' => $author
      	) );
      }
    
    
    
      public function storeObjects( $objects ) {
      	foreach( $objects as $object ) {
      	  $this->storeObject( $object );
      	}
      }
      
      
      
      public function storeObject( $object ) {
    	  $query = "REPLACE " .
    	    "INTO " . $this->tables['objects'] ." " .
  	      "(type, object, id, updated_at,pretty_url)" .
  	      "VALUES (" .
  	        "'" . $object['type'] . "'," .
  	        "'" . mysql_real_escape_string( $object['object'] ) . "'," .
  	        "'" . intval( $object['id'] ) . "'," .
  	        "'" . time() . "'," .
  	        "'" .( array_key_exists('pretty_url', $object ) ? mysql_real_escape_string( $object['pretty_url'] ) : "NULL" ) . "'" .
  	      ");";
	      $this->iwpdb->get_results( $query );
      }
      
      
      
      public function getAuthors() {
        $query = 
          "SELECT "
          . $this->tables['authors'] . ".name, "
          . $this->tables['authors'] . ".thumb, "
          . $this->tables['authors'] . ".tag "
          . "FROM " . $this->tables['authors'] . ";";
          
        return $this->iwpdb->get_results( $query );
      }


    
      public function getEvents( $types = NULL, $page = 0, $per_page = 10, $author = NULL ) {
        if( !is_null( $types ) and !empty( $types ) ) {
          $types = $this->prepareTypes( $types );
        }
        
        if( !is_null( $author ) ) {
          $author = $this->getAuthorByWPId( $author );
        }
        
        $query = 
          "SELECT "
          . $this->tables['events'] . ".type, "
          . $this->tables['events'] . ".objects, "
          . $this->tables['events'] . ".id, "
          . $this->tables['events'] . ".sticky_untill, "
          . $this->tables['events'] . ".sponsor, "
          . $this->tables['authors'] . ".name, "
          . $this->tables['authors'] . ".thumb, "
          . $this->tables['authors'] . ".url, "
          . $this->tables['authors'] . ".wordpress_id, "
          . $this->tables['authors'] . ".tag AS user_tag, "
          . $this->tables['sponsors'] . ".brand, "
          . $this->tables['sponsors'] . ".url AS sponsor_url, "
          . $this->tables['sponsors'] . ".logo_url AS sponsor_logo "
          . "FROM " . $this->tables['events'] . " "
            . "LEFT JOIN " . $this->tables['authors'] . " "
            . "ON " . $this->tables['authors'] . ".tag = " . $this->tables['events'] . ".author "
            . "LEFT JOIN " . $this->tables['sponsors'] . " "
            . "ON " . $this->tables['sponsors'] . ".id = " . $this->tables['events'] . ".sponsor "
          . "WHERE " . $this->tables['events'] . ".type NOT IN (9) "
          . ( ( is_null( $types ) or empty( $types ) ) ? "" : "AND " . $this->tables['events'] . ".type IN (" . $types . ") " )
          . ( ( is_null( $author ) or empty( $author ) ) ? "" : "AND " . $this->tables['events'] . ".author = '" . $author . "' " )
          . "ORDER BY time DESC "
          . "LIMIT " . ( $per_page * $page ) . "," . $per_page . ";";
          
        return $this->iwpdb->get_results( $query );
      }
      
      
      
      public function getEventsByObjectIds( $ids = '' ) {        
        $query = 
          "SELECT "
          . $this->tables['events'] . ".type, "
          . $this->tables['events'] . ".objects, "
          . $this->tables['events'] . ".id, "
          . $this->tables['events'] . ".sticky_untill, "
          . $this->tables['events'] . ".sponsor, "
          . $this->tables['authors'] . ".name, "
          . $this->tables['authors'] . ".thumb, "
          . $this->tables['authors'] . ".url, "
          . $this->tables['authors'] . ".wordpress_id, "
          . $this->tables['authors'] . ".tag AS user_tag, "
          . $this->tables['sponsors'] . ".brand, "
          . $this->tables['sponsors'] . ".url AS sponsor_url, "
          . $this->tables['sponsors'] . ".logo_url AS sponsor_logo "
          . "FROM " . $this->tables['events'] . " "
            . "LEFT JOIN " . $this->tables['authors'] . " "
            . "ON " . $this->tables['authors'] . ".tag = " . $this->tables['events'] . ".author "
            . "LEFT JOIN " . $this->tables['sponsors'] . " "
            . "ON " . $this->tables['sponsors'] . ".id = " . $this->tables['events'] . ".sponsor "
          . "WHERE " . $this->tables['events'] . ".type NOT IN (9) "
          . "AND " . $this->tables['events'] . ".objects IN (" . $ids . ") "
          . "ORDER BY time DESC;";
          
        return $this->iwpdb->get_results( $query );
      }
      
      
      
      private function getAuthorByWPId( $author_id ) {
        $query = 
          "SELECT " . $this->tables['authors'] . ".tag " .
          "FROM " . $this->tables['authors'] . " " .
          "WHERE " . $this->tables['authors'] . ".wordpress_id = (" . $author_id . ");";
        $res = $this->iwpdb->get_results( $query );
        return $res[0]->tag;
      }
      
      
      
      private function prepareTypes( $types ) {
        global $filter_types_on;
          
        $filter = function( $key ) {
          global $filter_types_on;
          return( strpos( strtolower( $key ), $filter_types_on ) !== false );
        };
        
        switch( $types ) {
          case 'magazine':
          case 'stories':
            $types = 'magazine';
            break;
        }
        
        $filter_types_on = $types;
        $keys = array_flip( unserialize( FONTANEL_UNIVERSAL_CRAWLER_EVENT_TYPES ) );
        $filtered_keys = array_filter( $keys, $filter );
        return implode( ',', array_keys( $filtered_keys ) );
      }



      public function getEvent( $id ) {
        global $filter_types_on;
        
        $filter = function( $key ) {
          global $filter_types_on;
          return( strpos( strtolower( $key ), $filter_types_on ) !== false );
        };
        
        $query = 
          "SELECT "
          . $this->tables['events'] . ".type, "
          . $this->tables['events'] . ".objects, "
          . $this->tables['events'] . ".id, "
          . $this->tables['events'] . ".sticky_untill, "
          . $this->tables['authors'] . ".name, "
          . $this->tables['authors'] . ".thumb, "
          . $this->tables['authors'] . ".url, "
          . $this->tables['authors'] . ".wordpress_id "
          . "FROM " . $this->tables['events'] . " "
            . "LEFT JOIN " . $this->tables['authors'] . " "
            . "ON " . $this->tables['authors'] . ".tag = " . $this->tables['events'] . ".author "
          . "WHERE " . $this->tables['events'] . ".id=" . $id . ";";
          
        return $this->iwpdb->get_results( $query );
      }
      
      
      
      public function getEventByNoteUrl( $url ) {
        global $filter_types_on;
        
        $filter = function( $key ) {
          global $filter_types_on;
          return( strpos( strtolower( $key ), $filter_types_on ) !== false );
        };
        
        $query = 
          "SELECT "
          . $this->tables['objects'] . ".id "
          . "FROM " . $this->tables['objects'] . " "
          . "WHERE " . $this->tables['objects'] . ".pretty_url='" . $url . "';";
        $id = $this->iwpdb->get_results( $query );
        $id = $id[0]->id;
        
        $query = 
          "SELECT "
          . $this->tables['events'] . ".type, "
          . $this->tables['events'] . ".objects, "
          . $this->tables['events'] . ".id, "
          . $this->tables['events'] . ".sticky_untill, "
          . $this->tables['authors'] . ".name, "
          . $this->tables['authors'] . ".thumb, "
          . $this->tables['authors'] . ".url, "
          . $this->tables['authors'] . ".wordpress_id "
          . "FROM " . $this->tables['events'] . " "
            . "LEFT JOIN " . $this->tables['authors'] . " "
            . "ON " . $this->tables['authors'] . ".tag = " . $this->tables['events'] . ".author "
          . "WHERE " . $this->tables['events'] . ".objects LIKE '%" . $id . "%';";
        
        return $this->iwpdb->get_results( $query );
      }



      public function getObjects( $objects ) {
        $query = 
          "SELECT " . $this->tables['objects'] . ".type" .
          ", " . $this->tables['objects'] . ".object " .
          ", " . $this->tables['objects'] . ".pretty_url " .
          "FROM " . $this->tables['objects'] . " " .
          "WHERE " . $this->tables['objects'] . ".id IN (" . $objects . ");";
        return $this->iwpdb->get_results( $query );
      }



      public function getObject( $id ) {
        $query = 
          "SELECT " . $this->tables['objects'] . ".type " .
          "FROM " . $this->tables['objects'] . " " .
          "WHERE " . $this->tables['objects'] . ".id = (" . $id . ");";
        return $this->iwpdb->get_results( $query );
      }
      
      
      
      public function tryToFindAuthor( $tags ) {
        $search = implode('|', $tags );
        $sql =
          "SELECT * "
          . "FROM `wp_timeline_authors` "
          . "WHERE `tag` REGEXP '" . $search . "' "
          . "LIMIT 1";
        $author = $this->iwpdb->get_row( $sql );
        if( $author ){ return $author->tag; }
        return '';
			}
  	}
	endif;
?>