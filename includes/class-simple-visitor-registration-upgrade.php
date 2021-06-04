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

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-simple-visitor-registration-post_types.php';
  	    $plugin_post_types = new Simple_Visitor_Registration_Post_Types();

	  	    
	    /**
	     * This only required if custom post type has rewrite!
	     *
	     * Remove rewrite rules and then recreate rewrite rules.
	     *
	     * This function is useful when used with custom post types as it allows for automatic flushing of the WordPress
	     * rewrite rules (usually needs to be done manually for new custom post types).
	     * However, this is an expensive operation so it should only be used when absolutely necessary.
	     * See Usage section for more details.
	     *
	     * Flushing the rewrite rules is an expensive operation, there are tutorials and examples that suggest
	     * executing it on the 'init' hook. This is bad practice. It should be executed either
	     * on the 'shutdown' hook, or on plugin/theme (de)activation.
	     *
	     * @link https://codex.wordpress.org/Function_Reference/flush_rewrite_rules
	     */
	    flush_rewrite_rules();

	    self::create_db();

	}

	public static function create_db() {

	    global $wpdb;
	    $table_name = $wpdb->prefix . "session_logger";
	    $plugin_name_db_version = get_option( 'simple-visitor-registration_db_version', '1.0' );

	    if( $wpdb->get_var( "show tables like '{$table_name}'" ) != $table_name ||
	        version_compare( $version, '1.0' ) < 0 ) {

	        $charset_collate = $wpdb->get_charset_collate();

	        // $sql[] = "CREATE TABLE " . $wpdb->prefix . "database_table (
	        //     id mediumint(9) NOT NULL AUTO_INCREMENT,
	        //     db_field_tinytext tinytext,
	        //     db_field_datetime DEFAULT '0000-00-00 00:00:00',
	        //     ip_address varchar(128) DEFAULT '',
	        //     db_field_mediumint mediumint,
	        //     db_field_text text,
	        //     PRIMARY KEY  (id)
	        // ) $charset_collate;";

	        $sql[] = "CREATE TABLE " . $wpdb->prefix . "database_table (
	            id mediumint(9) NOT NULL AUTO_INCREMENT, 
	            first_seen datetime DEFAULT '0000-00-00 00:00:00',
	            last_seen datetime DEFAULT '0000-00-00 00:00:00',
	            ip_address varchar(128) DEFAULT '',
	            post_id mediumint,
	            user_id mediumint,
	            user_agent text,
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
