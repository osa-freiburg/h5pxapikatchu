<?php

namespace H5PXAPIKATCHU;

/**
 * Database stuff
 *
 * @package H5PXAPIKATCHU
 * @since 0.1
 */
class Database {

  public static $COLUMN_TITLES;
  public static $TABLE_NAME;

  public static function build_table() {
    global $wpdb;

    $table_name = Database::$TABLE_NAME;
    $charset_collate = $wpdb->get_charset_collate();

    // naming a row object_id will cause trouble!
    $sql = "CREATE TABLE $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      actor_object_type TEXT,
      actor_name TEXT,
      actor_mbox TEXT,
      actor_account_homepage TEXT,
      actor_account_name TEXT,
      verb_id TEXT,
      verb_display TEXT,
      xobject_id TEXT,
      object_definition_name TEXT,
      object_definition_description TEXT,
      object_definition_choices TEXT,
      object_definition_correctResponsesPattern TEXT,
      result_response TEXT,
      result_score_raw INT,
      result_score_scaled FLOAT,
      result_completion BOOLEAN,
      result_success BOOLEAN,
      result_duration VARCHAR(20),
      time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
      xapi text,
      PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
  }

  public static function delete_table() {
    global $wpdb;
    $table_name = Database::$TABLE_NAME;
    $wpdb->query( $wpdb->prepare(
      "
        DROP TABLE IF EXISTS $table_name
      "
    ) );
  }

  static function init() {
	  global $wpdb;
    self::$TABLE_NAME = $wpdb->prefix . 'h5pxapikatchu';

    self::$COLUMN_TITLES = array(
      'id' => 'ID',
      'actor_object_type' => __( 'Actor Type', 'H5PxAPIkatchu'),
      'actor_name' => __( 'Actor Name', 'H5PxAPIkatchu'),
      'actor_mbox' => __( 'Actor Email', 'H5PxAPIkatchu'),
      'actor_account_homepage' => __( 'Actor Account Homepage', 'H5PxAPIkatchu' ),
      'actor_account_name' => __( 'Actor Account Name', 'H5PxAPIkatchu'),
      'verb_id' => __( 'Verb Id', 'H5PxAPIkatchu'),
      'verb_display' => __( 'Verb Display', 'H5PxAPIkatchu'),
      'xobject_id' => __( 'Object Id', 'H5PxAPIkatchu'),
      'object_definition_name' => __( 'Object Def. Name', 'H5PxAPIkatchu' ),
      'object_definition_description' => __( 'Object Def. Description', 'H5PxAPIkatchu' ),
      'object_definition_choices' => __( 'Object Def. Choices', 'H5PxAPIkatchu' ),
      'object_definition_correctResponsesPattern' => __( 'Object Def. Correct Responses', 'H5PxAPIkatchu' ),
      'result_response' => __( 'Result Response', 'H5PxAPIkatchu' ),
      'result_score_raw' => __( 'Result Score Raw', 'H5PxAPIkatchu' ),
      'result_score_scaled' => __( 'Result Score Scaled', 'H5PxAPIkatchu' ),
      'result_completion' => __( 'Result Completion', 'H5PxAPIkatchu' ),
      'result_success' => __( 'Result Success', 'H5PxAPIkatchu' ),
      'result_duration' => __( 'Result Duration', 'H5PxAPIkatchu' ),
      'time' => __( 'Time', 'H5PxAPIkatchu' ),
      'xapi' => __( 'xAPI', 'H5PxAPIkatchu' )
    );
  }
}
Database::init();
