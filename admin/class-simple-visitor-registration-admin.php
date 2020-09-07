<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://nicklarosa.net
 * @since      1.0.0
 *
 * @package    Simple_Visitor_Registration
 * @subpackage Simple_Visitor_Registration/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Simple_Visitor_Registration
 * @subpackage Simple_Visitor_Registration/admin
 * @author     Nick La Rosa <nick@nicklarosa.net>
 */
class Simple_Visitor_Registration_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
  
		// wp_enqueue_style( 'jquery-ui' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/simple-visitor-registration-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() { 
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/simple-visitor-registration-admin.js', array(  'jquery' ), $this->version, false, true );

		wp_localize_script( $this->plugin_name, 
			'wp_ajax', 
			array(
		        'ajax_url' => admin_url( 'admin-ajax.php' ), 
		        '_nonce' => wp_create_nonce( VISITOR_REGISTRATION_NONCE )

		    ) 
		); 
	}

 


	public function func_delete_all_visitor_registration_details() {
		check_ajax_referer( VISITOR_REGISTRATION_NONCE, 'security' );


		$logger = new Simple_Visitor_Registration_Logger;

		try {
			// run your code here
			$deleted = $logger->delete_all_entries();
			echo json_encode(array('status'=>true, 'deleted'=>$deleted,  'message'=>__('All entries have been deleted')));
			exit();
		}
		catch (exception $e) {
			echo json_encode(array('status'=>failed,  'message'=>__(e)));
			exit();
		}

		
	}
	
	
	public function func_export_visitor_registration_details() {
		$logger = new Simple_Visitor_Registration_Logger;

		if(isset($_GET['export_all_visitor_data'])) {   
			$loggedIn = is_user_logged_in();
	    	if($loggedIn){ 
	    		$fName = 'visitor-registration-'.date("Y-m-d-H-i-s", current_time('timestamp')).'.csv';
		        header('Content-type: text/csv');
		        header('Content-Disposition: attachment; filename="'.$fName.'"');
		        header('Pragma: no-cache');
		        header('Expires: 0');

		        $file = fopen('php://output', 'w');

		        fputcsv($file, array('email', 'first_name', 'last_name', 'phone', 'entered_at', 'custom_field'));

		       	$entries = $logger->return_all_entries();  

		        foreach ( $entries  as $entry ) {  
	        		$result= [
	        			$entry['email'], 
	        			$entry['fname'], 
	        			$entry['lname'], 
	        			$entry['phone'], 
	        			get_date_from_gmt( date( 'Y-m-d H:i:s', strtotime($entry['entered_at']) ), 'Y-m-d H:i:s' ),
	        			$entry['custom_field_1']
	        		];
					fputcsv($file,$result); 
				} 
		        exit(); 
			} 
		} 
 
	}
 

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

	    /**
	     * Add a settings page for this plugin to the Settings menu.
	     *
	     * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
	     *
	     *        Administration Menus: http://codex.wordpress.org/Administration_Menus
	     *
	     * add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);
	     *
	     * @link https://codex.wordpress.org/Function_Reference/add_options_page
	     */


	    add_menu_page('Simple Visitor Registration', 'Simple Visitor Registration', 'manage_options', $this->plugin_name, array($this, 'display_plugin_import_export_page'), 'data:image/svg+xml;base64,'.base64_encode('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="512px" height="512px" class="hovered-paths"><g><g>
	<g>
		<path d="M371.451,0v90.353h-90.353v100.392h-90.353v90.353H90.353v90.353H0V512h512V0H371.451z M481.882,481.882H30.118v-80.314    h90.353v-90.353h100.392v-90.353h90.353V120.471h90.353V30.118h80.314V481.882z" data-original="#000000" class="hovered-path active-path" data-old_color="#000000" fill="#FFFFFF"/>
	</g>
</g><g>
	<g>
		<polygon points="91.952,1.121 91.952,31.239 135.915,31.239 2.718,164.436 24.014,185.733 157.211,52.535 157.211,96.498     187.329,96.498 187.329,1.121   " data-original="#000000" class="hovered-path active-path" data-old_color="#000000" fill="#FFFFFF"/>
	</g>
</g></g> </svg>'));

	    add_submenu_page( $this->plugin_name, 'Export and Delete Entries', 'Export and Delete Entries', 'manage_options', $this->plugin_name, array($this, 'display_plugin_import_export_page'));
	    add_submenu_page( $this->plugin_name, 'Visitor Registration reCAPTCHA', 'Visitor Registration reCAPTCHA', 'manage_options', $this->plugin_name.'-captcha', array($this, 'display_plugin_captcha_setup_page')
		);
		add_submenu_page( $this->plugin_name, 'Help', 'Visitor Registration Help', 'manage_options', $this->plugin_name.'-help', array($this, 'display_plugin_help_page')
	    );

	}

	 /**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {

	    /*
	    *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
	    */
	   $settings_link = array(
	    '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __( 'Settings', $this->plugin_name ) . '</a>',
	   );
	   return array_merge(  $settings_link, $links );

	}

	/**
	 * Render the recaptcha settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_captcha_setup_page() {

	    include_once( 'partials/' . $this->plugin_name . '-admin-display.php' );

	}


	/**
	 * Render the export page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_import_export_page() {

	    include_once( 'partials/' . $this->plugin_name . '-admin-import-export-display.php' );

	}


	/**
	 * Render the help page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_help_page() {

	    include_once( 'partials/' . $this->plugin_name . '-admin-help-display.php' );

	}

	/**
	 * Validate fields from admin area plugin settings form ('exopite-lazy-load-xt-admin-display.php')
	 * @param  mixed $input as field form settings form
	 * @return mixed as validated fields
	 */
	public function validate($input) {

	    $valid = array();
 
	    $valid['google_captcha_secret_key'] = ( isset( $input['google_captcha_secret_key'] ) && ! empty( $input['google_captcha_secret_key'] ) ) ? esc_attr( sanitize_text_field( $input['google_captcha_secret_key'] )) : '';
	    $valid['google_captcha_site_key'] = ( isset( $input['google_captcha_site_key'] ) && ! empty( $input['google_captcha_site_key'] ) ) ? esc_attr( sanitize_text_field( $input['google_captcha_site_key'] )) : '';
 
	    return $valid; 

	}

	public function options_update() {
	    register_setting( $this->plugin_name, $this->plugin_name, array(
	       'sanitize_callback' => array( $this, 'validate' ),
	    ) ); 
	} 

}
