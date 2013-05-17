<?php
  if( ! class_exists( 'TimelineDatabaseManager' ) ):
  	class TimelineDatabaseManager {
    	private $database_prefix = 'timeline_';
    	private $tables = array();
    	public $iwpdb;
  	
      public function __construct() {
      	global $wpdb;
      	$this->iwpdb = $wpdb;
      	foreach( array( 'events', 'objects', 'authors' ) as $table_name ) {
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
          . "PRIMARY KEY(time,objects) );";
				
				$sql[] =
          "CREATE TABLE IF NOT EXISTS " . $this->tables['objects'] . " ( "
          . "type varchar(128) NOT NULL,"
          . "id varchar(128) NOT NULL,"
          . "updated_at int NOT NULL,"
          . "object text NOT NULL,"
          . "PRIMARY KEY(id,type) );";
          
        $sql[] =
          "CREATE TABLE IF NOT EXISTS " . $this->tables['authors'] . " ( "
          . "tumblr_tag varchar(128) NOT NULL,"
          . "name varchar(128) NOT NULL,"
          . "thumb varchar(128) NOT NULL,"
          . "wordpress_id int NOT NULL,"
          . "PRIMARY KEY(tumblr_tag) );";
				
				foreach( $sql as $query ) {
					$this->iwpdb->query( $query );
				}
      }
      
      public function newOrUpdatedEvent( $type = 0, $objects = '0', $timestamp = 0 ) {
	      $sql =
          "SELECT updated_at "
          . "FROM " . $this->tables['events'] . " "
          . "WHERE type=" . $type . " "
          . "AND objects=" . $objects . ";";
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
		      $this->iwpdb->insert( $this->tables['objects'], array(
	      		'type' => $object['type'],
	      		'object' => $object['object'],
	      		'id' => $object['id'],
	      		'updated_at' => time()
	      	) );
      	}
      }
      
      public function getEvents( $page = 0, $per_page = 10 ) {
        $query = 
          "SELECT "
          . $this->tables['events'] . ".type,"
          . $this->tables['events'] . ".objects,"
          . $this->tables['events'] . ".sticky_untill,"
          . $this->tables['authors'] . ".name,"
          . $this->tables['authors'] . ".thumb,"
          . $this->tables['authors'] . ".wordpress_id "
          . "FROM " . $this->tables['events'] . " "
            . "LEFT JOIN " . $this->tables['authors'] . " "
            . "ON " . $this->tables['authors'] . ".tumblr_tag = " . $this->tables['events'] . ".author "
          . "ORDER BY time DESC "
          . "LIMIT " . $per_page . ";";
        return $this->iwpdb->get_results( $query );
      }
      
      public function getObjects( $objects ) {
        $query = 
          "SELECT " . $this->tables['objects'] . ".type, " . $this->tables['objects'] . ".object " .
          "FROM " . $this->tables['objects'] . " " .
          "WHERE " . $this->tables['objects'] . ".id IN (" . $objects . ");";
        return $this->iwpdb->get_results( $query );
      }
  	}
	endif;
?>