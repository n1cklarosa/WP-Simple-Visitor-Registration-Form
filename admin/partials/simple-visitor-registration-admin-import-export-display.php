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
    <h2>Visitor Registration <?php esc_attr_e('Import / Export', 'simple-visitor-registration' ); ?></h2> 

    <a href="<?php echo get_admin_url(); ?>admin.php?page=simple-visitor-registration&export_all_visitor_data">export all visitor information</a>
</div>