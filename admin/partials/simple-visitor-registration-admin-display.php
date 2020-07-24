<?php

/**
 * Provide a admin area view for the plugin
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
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h2>Google ReCaptcha <?php esc_attr_e('Options', 'simple-visitor-registration' ); ?></h2>

    <form method="post" name="<?php echo $this->plugin_name; ?>" action="options.php">
    <?php
        //Grab all options
        $options = get_option( $this->plugin_name );

       
        $google_captcha_site_key = ( isset( $options['google_captcha_site_key'] ) && ! empty( $options['google_captcha_site_key'] ) ) ? esc_attr( $options['google_captcha_site_key'] ) : '';
        $google_captcha_secret_key = ( isset( $options['google_captcha_secret_key'] ) && ! empty( $options['google_captcha_secret_key'] ) ) ? esc_attr( $options['google_captcha_secret_key'] ) : '';
        
        settings_fields($this->plugin_name);
        do_settings_sections($this->plugin_name);

    ?>
 

    <!-- Text -->
    <fieldset>
        <p><?php esc_attr_e( 'Site key.', 'simple-visitor-registration' ); ?></p>
        <legend class="screen-reader-text">
            <span><?php esc_attr_e( 'Site key', 'simple-visitor-registration' ); ?></span>
        </legend>
        <input type="text" class="google_captcha_site_key" id="<?php echo $this->plugin_name; ?>-google_captcha_site_key" name="<?php echo $this->plugin_name; ?>[google_captcha_site_key]" value="<?php if( ! empty( $google_captcha_site_key ) ) echo $google_captcha_site_key; else echo ''; ?>"/ style='min-width:400px'>
    </fieldset>

    <!-- Text -->
    <fieldset>
        <p><?php esc_attr_e( 'Secret key.', 'simple-visitor-registration' ); ?></p>
        <legend class="screen-reader-text">
            <span><?php esc_attr_e( 'Example Text', 'simple-visitor-registration' ); ?></span>
        </legend>
        <input type="text" class="google_captcha_secret_key" id="<?php echo $this->plugin_name; ?>-google_captcha_secret_key" name="<?php echo $this->plugin_name; ?>[google_captcha_secret_key]" value="<?php if( ! empty( $google_captcha_secret_key ) ) echo $google_captcha_secret_key; else echo ''; ?>"/ style='min-width:400px'>
    </fieldset>
 

    <?php submit_button( __( 'Save all changes', 'simple-visitor-registration' ), 'primary','submit', TRUE ); ?>
    </form>
</div>