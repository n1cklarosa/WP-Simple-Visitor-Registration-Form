<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://nicklarosa.net
 * @since      1.0.0
 *
 * @package    Simple_Visitor_Registration
 * @subpackage Simple_Visitor_Registration/public
 */

class Simple_Visitor_Registration_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() { 

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/simple-visitor-registration-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		global $wp;
		global $post; 
		$GOOGLE_CAPTCHA_SITE_KEY = null;


		// check to see if shortcode exists in content, if not, dont enqueue the captcha scripts
  		$shortcode_found = false;
		if ( has_shortcode($post->post_content, 'visitor_registration_form') ) {

	  		if($GOOGLE_CAPTCHA_SITE_KEY = getenv('GOOGLE_CAPTCHA_SITE_KEY')){
	  		} else {
	  			$options = get_option( $this->plugin_name ); 
	  			$GOOGLE_CAPTCHA_SITE_KEY = ( isset( $options['google_captcha_site_key'] ) && ! empty( $options['google_captcha_site_key'] ) ) ? esc_attr( $options['google_captcha_site_key'] ) : '';
	  		} 
		    $shortcode_found = true;
		} 
  		if(($shortcode_found == true) && ($GOOGLE_CAPTCHA_SITE_KEY != '') && ($GOOGLE_CAPTCHA_SITE_KEY != null)){
  			wp_enqueue_script( "recpatcha", 'https://www.google.com/recaptcha/api.js', [], $this->version, false );   
  		}
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/simple-visitor-registration-public.js', array( 'jquery' ), $this->version, false );
		

		wp_localize_script( $this->plugin_name, 
			'wp_ajax', 
			array(
		        'ajax_url' => admin_url( 'admin-ajax.php' ), 
		        '_nonce' => wp_create_nonce( VISITOR_REGISTRATION_NONCE ), 
      			'google_captcha_site_key' => $GOOGLE_CAPTCHA_SITE_KEY

		    ) 
		); 
	} 
	  


	/** 
	 * Here we process a form's data using the ajax hooks available in wordpress
	 *
	 * @since    1.0.0
	 */
	public function ajax_register_visitor() {
 
        check_ajax_referer( VISITOR_REGISTRATION_NONCE, 'security' );
 
		$fname = sanitize_text_field(stripcslashes($_POST['fname']));
		$lname = sanitize_text_field(stripcslashes($_POST['lname'])); 
		$email = sanitize_email(stripcslashes($_POST['email'])); 
		$custom1 = sanitize_text_field(stripcslashes($_POST['cfield1']));  
		$phone = sanitize_text_field(stripcslashes($_POST['phone']));     // Not sanitizes as a number as the user name want to use this as a plain text field  

		if($GOOGLE_CAPTCHA_SITE_KEY = getenv('GOOGLE_CAPTCHA_SITE_KEY')){
  		} else {
  			$options = get_option( 'simple-visitor-registration' ); 
  			$GOOGLE_CAPTCHA_SITE_KEY = ( isset( $options['google_captcha_site_key'] ) && ! empty( $options['google_captcha_site_key'] ) ) ?  $options['google_captcha_site_key']  : '';
  		}

  		// If there are google captcha values set, use them to ensure we have a valid capture response

  		if(($GOOGLE_CAPTCHA_SITE_KEY !== '') && ($GOOGLE_CAPTCHA_SITE_KEY !== null) && ($GOOGLE_CAPTCHA_SITE_KEY !== false)){
  			try {
			    $testCaptcha = $this->verify_captcha(); 
			} catch (Exception $e) { 
			    echo json_encode(array('status'=>false, 'message'=>__('Caught exception: '.$e->getMessage())));
			    die;
			} 
  			if($testCaptcha != true){
  				echo json_encode(array('status'=>false, 'message'=>__('Looks like recaptcha has failed')));
				die;
  			}
		  } 
		// ensure all feilds have SOMETHING in them - This is not meant to be a barrier for a physical venue so we will be simple in our validation here
		if(strlen($fname) < 2):
			echo json_encode(array('status'=>false, 'message'=>__('Please enter a valid first name')));
			die;
		endif;
		if(strlen($lname) < 2):
			echo json_encode(array('status'=>false, 'message'=>__('Please enter a valid last name')));
			die;
		endif;

		if(strlen($phone) < 2):
			echo json_encode(array('status'=>false, 'message'=>__('Please enter a valid phone number')));
			die;
		endif;

		// validating the email address
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		    echo json_encode(array('status'=>false, 'message'=>__('Invalid Email Format')));
			die();
		} 


		if(strlen($custom1) < 1) :
			echo json_encode(array('status'=>false, 'message'=>__('Please ensure all fields are entered in correctly')));
			die;
		endif;

		$logger = new Simple_Visitor_Registration_Logger; 

		  
		$newId = $logger->insert_entry($email, $fname, $lname, $phone, $custom1);
		if($newId):
			echo json_encode(array('status'=>true,  'message'=>__('Thank you for signing in. Your details have been registered')));
		else:
			echo json_encode(array('status'=>false,  'message'=>__('Sorry, something went wrong here.')));
		endif;
		die; 
	}


	public function my_simple_crypt( $string, $action = 'e' ) {
	    // you may change these values to your own
	    $secret_key = 'asdfasdfasdfasdfasdfasdfasdfasdfasdf';
	    $secret_iv = 'sdafassadfasdfasdfasdfasdfasdfasdfasd';
	 
	    $output = false;
	    $encrypt_method = "AES-256-CBC";
	    $key = hash( 'sha256', $secret_key );
	    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
	 
	    if( $action == 'e' ) {
	        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
	    }
	    else if( $action == 'd' ){
	        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
	    }
	 
	    return $output;
	}

	/** 
	 * filter to defer google captcha when enqueud
	 *
	 * @since    1.0.0
	 */
	public function defer_google_captcha_script( $tag, $handle ) {

		if ( 'recpatcha' !== $handle ) {
			return $tag;
		} 
		return str_replace( ' src', ' async defer src', $tag ); // OR do both!

	}



	/** 
	 * Send our capctcha response data off to google to verify, throw exception on fail
	 *
	 * @since    1.0.0
	 */
	public function verify_captcha(){ 

		if($GOOGLE_CAPTCHA_SECRET_KEY = getenv('GOOGLE_CAPTCHA_SECRET_KEY')){
		} else { 
			$options = get_option( 'simple-visitor-registration' ); 
		    $GOOGLE_CAPTCHA_SECRET_KEY = ( isset( $options['google_captcha_secret_key'] ) && ! empty( $options['google_captcha_secret_key'] ) ) ? esc_attr( $options['google_captcha_secret_key'] ) : ''; 
		}

		$post_data =  array(
						'secret' => $GOOGLE_CAPTCHA_SECRET_KEY,
						'response' => $_POST['g-recaptcha-response'],
						'remoteip' => $_SERVER['REMOTE_ADDR']
					);
		$args = array(
		        'method'  => 'POST',
		        'HEADERS'  => ['Content-type: application/x-www-form-urlencoded'],
		        'body' => $post_data
			); 
			
		$response = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify', $args );
		$body     = wp_remote_retrieve_body( $response );

		$result = json_decode($body);
 
		if (!$result->success) {
		    throw new Exception('Oops! CAPTCHA verification failed. Please let one of our staff know that something is wrong here', 1);
		} else {
			return true;
		}
	}

}
