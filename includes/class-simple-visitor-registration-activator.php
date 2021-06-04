<?php

/**
 * Fired during plugin activation
 *
 * @link       https://nicklarosa.net
 * @since      1.0.0
 *
 * @package    Simple_Visitor_Registration
 * @subpackage Simple_Visitor_Registration/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Simple_Visitor_Registration
 * @subpackage Simple_Visitor_Registration/includes
 * @author     Nick La Rosa <nick@nicklarosa.net>
 */
class Simple_Visitor_Registration_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() { 

	    self::create_db();

	    flush_rewrite_rules();

	}

	public static function create_db() {

	    global $wpdb;
	    $table_name = $wpdb->prefix . "visitor_registration_logger";
	    $plugin_name_db_version = get_option( 'simple-visitor-registration_db_version', '1.0' );

	    if( $wpdb->get_var( "show tables like '{$table_name}'" ) != $table_name ||
	        version_compare( $version, '1.0' ) < 0 ) {

	        $charset_collate = $wpdb->get_charset_collate(); 

	        $sql[] = "CREATE TABLE " . $wpdb->prefix . "visitor_registration_logger (
	            id mediumint(9) NOT NULL AUTO_INCREMENT, 
	            entered_at datetime DEFAULT '0000-00-00 00:00:00', 
	            email varchar(128),
	            fname varchar(50),
	            lname varchar(50),
	            phone varchar(50),
	            custom_field_1 varchar(128),
	            PRIMARY KEY  (id)
	        ) $charset_collate;";

	        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

	        /**
	         * It seems IF NOT EXISTS isn't needed if you're using dbDelta - if the table already exists it'll
	         * compare the schema and update it instead of overwriting the whole table.
	         *
	         * @link https://code.tutsplus.com/tutorials/custom-database-tables-maintaining-the-database--wp-28455
	         */
	        dbDelta( $sql );

	        add_option( 'simple-visitor-registration_db_version', $plugin_name_db_version );

	    }

	}


}
