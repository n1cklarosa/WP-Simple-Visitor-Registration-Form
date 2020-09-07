<?php

/**
 * Provide a admin area view for the plugin where a user may download thier CSV, or empty the database
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
<style>
	p a img{ margin-right:10px; }
	p a{
		background-color:white;
		text-decoration: none;
		font-size: 13px;
		line-height: 30pxpx;
		margin: 0;
		padding: 10px 10px;
		cursor: pointer;
		border-width: 1px;
		border-style: solid;
		-webkit-border-radius: 3px;
		-webkit-appearance: none;
		border-radius: 3px;
		white-space: nowrap;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		display:flex;
		align-items: center;
  		justify-content: center;
	}
</style>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h2>Visitor Registration <?php esc_attr_e('Export', 'simple-visitor-registration' ); ?></h2> 
    <p style='display:flex;'><a href="<?php echo get_admin_url(); ?>admin.php?page=simple-visitor-registration&export_all_visitor_data"> <img src="<?php echo plugin_dir_url( __FILE__ ) . '../img/export.svg';?>" alt="download" width="22"> <?php esc_attr_e('Export all visitor information', 'simple-visitor-registration' ); ?> </a></p>
</div>

<hr>

<h4><?php esc_attr_e('Caution - pressing the following will remove all entries from your database', 'simple-visitor-registration' ); ?></h4>
<div class="wrap" style='margin-top:20px;'>
	<button class='remove_entries' id="remove_visitor_entries" type="button"><?php esc_attr_e('Delete all entries', 'simple-visitor-registration' ); ?></button>
</div>