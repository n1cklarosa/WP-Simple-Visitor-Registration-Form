<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Simple Visitor Registration Form 
 * Plugin URI:        https://nicklarosa.net
 * Description:       Add a simple visitor registration form to any wordpress content
 * Version:           1.0.1
 * Author:            Nick La Rosa
 * Author URI:        https://nicklarosa.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       simple-visitor-registration
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_role('viewer',
	__( 'Viewer' ),
	array(
		'read'         => false,   
		'edit_posts'   => false, 
		'create_posts'      => false, // Allows user to create new posts
		'edit_posts'        => false, // Allows user to edit their own posts
		'edit_others_posts' => false, // Allows user to edit others posts too
		'publish_posts' => false, // Allows the user to publish posts
		'manage_categories' => false, // Allows user to manage post categories
       ) 
);

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SIMPLE_VISITOR_REGISTRATION_VERSION', '1.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-simple-visitor-registration-activator.php
 */
function activate_simple_visitor_registration() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-simple-visitor-registration-activator.php';
	Simple_Visitor_Registration_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-simple-visitor-registration-deactivator.php
 */
function deactivate_simple_visitor_registration() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-simple-visitor-registration-deactivator.php';
	Simple_Visitor_Registration_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_simple_visitor_registration' );
register_deactivation_hook( __FILE__, 'deactivate_simple_visitor_registration' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-simple-visitor-registration.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_simple_visitor_registration() {

	$plugin = new Simple_Visitor_Registration();
	$plugin->run();

}
run_simple_visitor_registration();

 