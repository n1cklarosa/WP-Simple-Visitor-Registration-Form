<?php

/**
 * Register our global shortcodes
 *
 * @link       http://re.markable.com.au
 * @since      1.0.0
 *
 * @package    Simple_Visitor_Registration
 * @subpackage Simple_Visitor_Registration/includes
 */
class Simple_Visitor_Registration_Shortcodes { 

  	public $options;

	public function __construct() { 
		// $this->options = get_option('nucleus');  
	}


 	public function init_simplevisitorregistration_shortcodes() { 
		add_shortcode('visitor_registration_form', array($this, 'show_vistor_registration_form'));  
  	}  


	/**
	 * Build grid element needed to pulls grid via javascript
	 */
  	public function show_vistor_registration_form($atts) { 

  		 $atts = shortcode_atts(
	        array(
	        	'fnametext' => 'First Name',
	        	'lnametext' => 'Last Name',
	        	'emailtext' => 'Email',
	        	'phonetext' => 'Phone',
	            'inputfieldbordertop' => '0px solid black !important',
	            'inputfieldborderleft' => '0px solid black !important',
	            'inputfieldborderright' => '0px solid black !important',
	            'inputfieldborderbottom' => '2px solid black !important',
	            'inputfieldfontsize' => '1em',
	            'inputfieldwidth' => '100%',
	            'inputfieldlineheight' => '2rem',
	            'inputfieldtextcolor' => 'black !important',
	            'inputfieldbackgroundcolor' => 'transparent !important',
	            'inputfieldpadding' => '10px 0px !important',
	            'inputfieldmargin' => '10px 0px !important',
	            'buttoncolour' => 'black !important',
	            'buttontextcolor' => 'white !important',
	            'buttonpadding' => '20px 20px !important',
	            'buttonmargin' => '10px 0px !important',
	            'buttonwidth' => '100% !important',
	            'errortextcolor' => 'white !important',
	            'customfield1' => null, 
	        	'buttontext' => 'Register'
	        ), $atts, 'show_stream_form' );

 

  		global $post;
		ob_start(); 
		if($GOOGLE_CAPTCHA_SITE_KEY = getenv('GOOGLE_CAPTCHA_SITE_KEY')){
  		} else {
  			$options = get_option( 'simple-visitor-registration' ); 
  			$GOOGLE_CAPTCHA_SITE_KEY = ( isset( $options['google_captcha_site_key'] ) && ! empty( $options['google_captcha_site_key'] ) ) ? esc_attr( $options['google_captcha_site_key'] ) : '';
  		}


		 ?> 

		 <style>
		 	#simplevisitorregistration-userdetails p {
		 		color:<?php echo $atts['errorTextColor']; ?>;
		 	}
		 	#simplevisitorregistration-userdetails label {
		 		display:none;
		 	}
		 	#simplevisitorregistration-userdetails input[type=text], #simplevisitorregistration-userdetails input[type=email] {
		 		color:<?php echo $atts['inputfieldtextcolor']; ?>;
		 		padding:<?php echo $atts['inputfieldpadding']; ?>;
		 		background-color:<?php echo $atts['inputfieldbackgroundcolor']; ?>;
		 		margin:<?php echo $atts['inputfieldmargin']; ?>;
		 		border-top:<?php echo $atts['inputfieldbordertop']; ?>;
		 		border-right:<?php echo $atts['inputfieldborderright']; ?>;
		 		border-left:<?php echo $atts['inputfieldborderleft']; ?>;
		 		border-bottom:<?php echo $atts['inputfieldborderbottom']; ?>;
		 		width:<?php echo $atts['inputfieldwidth']; ?>;
		 		line-height:<?php echo $atts['inputfieldlineheight']; ?>;
		 		font-size:<?php echo $atts['inputfieldfontsize']; ?>;
		 	}
		 	#simplevisitorregistration-userdetails input[type=submit], #simplevisitorregistration-userdetails button {
		 		color:<?php echo $atts['buttontextcolor']; ?>;
		 		padding:<?php echo $atts['buttonpadding']; ?>;
		 		margin:<?php echo $atts['buttonmargin']; ?>;
		 		background-color:<?php echo $atts['buttoncolour']; ?>;
		 		width:<?php echo $atts['buttonwidth']; ?>;
		 	}
		 </style>
			<form id="simplevisitorregistration-userdetails" action="login" method="post"> 
			    <p class="register-message"></p>
			    <input type="hidden" id="post_id" value="<?php echo $post->ID; ?>">
			    <div class="simplevisitorregistration-form-container">
				    <label for="username"><?php echo $atts['fnametext']; ?></label>
				    <input id="fname" type="text" name="fname" placeholder="<?php echo $atts['fnametext']; ?>">
			    </div>
			    <div class="simplevisitorregistration-form-container">
				    <label for="password"><?php echo $atts['lnametext']; ?></label>
				    <input id="lname" type="text" name="lname" placeholder="<?php echo $atts['lnametext']; ?>">
			    </div> 
			    <div class="simplevisitorregistration-form-container">
				    <label for="email_address"><?php echo $atts['emailtext']; ?></label>
				    <input id="email" type="email" name="email" placeholder="<?php echo $atts['emailtext']; ?>">
			    </div> 
			    <div class="simplevisitorregistration-form-container">
				    <label for="phone"><?php echo $atts['phonetext']; ?></label>
				    <input id="phone" type="text" name="phone" placeholder="<?php echo $atts['phonetext']; ?>">
			    </div> 
			    <?php if($atts['customfield1'] != null): ?>
				    <div class="simplevisitorregistration-form-container">
					    <label for="cfield1"><?php echo $atts['customfield1']; ?></label>
					    <input id="cfield1" type="text" name="cfield1" placeholder="<?php echo $atts['customfield1']; ?>">
				    </div> 
			    <?php else: ?>
			    	<input id="cfield1" type="hidden" name="cfield1"  value='null'>
			    <?php endif; ?> 
			    <?php if($GOOGLE_CAPTCHA_SITE_KEY !== ''): ?>
			    	<div class="g-recaptcha"
			          data-sitekey="<?php echo $GOOGLE_CAPTCHA_SITE_KEY; ?>"
			          data-callback="onSubmit"
			          data-size="invisible"></div> 
			    <?php endif; ?>
				    <div class="simplevisitorregistration-form-container" style='margin-top:10px;'> 
				        <input class="submit_button" type="submit" value="<?php echo $atts['buttontext']; ?>" id="visitor_submit" name="submit"> 
				    </div>
				
			    <?php wp_nonce_field( VISITOR_REGISTRATION_NONCE, '_nonce' ); ?>
			</form>

		 <?php
		$content =  ob_get_contents();
		ob_clean();
		return $content ;

  	}
 

} 