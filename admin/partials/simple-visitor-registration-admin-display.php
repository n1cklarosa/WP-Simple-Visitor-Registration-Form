<?php

/**
 * Provide a admin area view for the plugin's google recaptcha details
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://nicklarosa.net
 * @since      1.0.0
 *
 * @package    Simple_Visitor_Registration
 * @subpackage Simple_Visitor_Registration/admin/partials
 */
 

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) die;

$options = get_option( $this->plugin_name ); 
$show_site_key = false;
$show_secret_key = false;
if($GOOGLE_CAPTCHA_SITE_KEY = getenv('GOOGLE_CAPTCHA_SITE_KEY')){
} else {
    $GOOGLE_CAPTCHA_SITE_KEY = ( isset( $options['google_captcha_site_key'] ) && ! empty( $options['google_captcha_site_key'] ) ) ? esc_attr( $options['google_captcha_site_key'] ) : '';
    $show_site_key = true;
}

if($GOOGLE_CAPTCHA_SECRET_KEY = getenv('GOOGLE_CAPTCHA_SECRET_KEY')){
} else { 
    $GOOGLE_CAPTCHA_SECRET_KEY = ( isset( $options['google_captcha_secret_key'] ) && ! empty( $options['google_captcha_secret_key'] ) ) ? esc_attr( $options['google_captcha_secret_key'] ) : '';
    $show_secret_key = true;
}

?>

<div class="wrap">
    <h2>Google ReCaptcha <?php esc_attr_e('Options', 'simple-visitor-registration' ); ?></h2>

    <p>The form is compatible with the invisible method of google reCAPTCHA v2. You can obtain your site and sectret keys <a href="https://www.google.com/recaptcha/intro/v3.html" target="_new">here</a>.</p>

    <form method="post" name="<?php echo $this->plugin_name; ?>" action="options.php">
    <?php 
        
        $google_captcha_site_key = $GOOGLE_CAPTCHA_SITE_KEY ;
        $google_captcha_secret_key = $GOOGLE_CAPTCHA_SECRET_KEY;
        
        settings_fields($this->plugin_name);
        do_settings_sections($this->plugin_name);

    ?>
 
    <?php if($show_site_key == true): ?> 
        <fieldset>
            <p><?php esc_attr_e( 'Site key.', 'simple-visitor-registration' ); ?></p>
            <legend class="screen-reader-text">
                <span><?php esc_attr_e( 'Site key', 'simple-visitor-registration' ); ?></span>
            </legend>
            <input type="text" class="google_captcha_site_key" id="<?php echo esc_attr($this->plugin_name); ?>-google_captcha_site_key" name="<?php echo esc_attr($this->plugin_name); ?>[google_captcha_site_key]" value="<?php if( ! empty( $google_captcha_site_key ) ) echo esc_attr($google_captcha_site_key); else echo ''; ?>"/ style='min-width:400px'>
        </fieldset>
    <?php else: ?>
        <p>Your site key is already configured via environment variables.</p>
    <?php endif; ?>

    <?php if($show_secret_key == true): ?> 
        <fieldset>
            <p><?php esc_attr_e( 'Secret key.', 'simple-visitor-registration' ); ?></p>
            <legend class="screen-reader-text">
                <span><?php esc_attr_e( 'Example Text', 'simple-visitor-registration' ); ?></span>
            </legend>
            <input type="text" class="google_captcha_secret_key" id="<?php echo esc_attr($this->plugin_name); ?>-google_captcha_secret_key" name="<?php echo esc_attr($this->plugin_name); ?>[google_captcha_secret_key]" value="<?php if( ! empty( $google_captcha_secret_key ) ) echo esc_attr($google_captcha_secret_key); else echo ''; ?>"/ style='min-width:400px'>
        </fieldset>
    <?php else: ?>
        <p>Your secret key is already configured via environment variables.</p>
    <?php endif; ?>
 
    <?php if(($show_site_key == true) || ($show_secret_key == true)): ?>
        <?php submit_button( __( 'Save all changes', 'simple-visitor-registration' ), 'primary','submit', TRUE ); ?>
    <?php endif; ?>
    </form>
</div>