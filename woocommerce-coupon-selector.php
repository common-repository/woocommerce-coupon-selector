<?php
/*
  Plugin Name: Woocommerce Coupon Selector
  Plugin URI: http://phppoet.com
  Description: Let your Customers choose from all available Coupons
  Version: 1.0.0
  Author: phppoet
  Author URI: http://phppoet.com
  Requires at least: 3.3
  Tested up to: 3.9.1

*/

if( !defined( 'wcap_PLUGIN_URL' ) )
          define( 'wcap_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		  
/*
 * localization
 */
    load_plugin_textdomain( 'wcap', false, basename( dirname(__FILE__) ).'/languages' );
/*
 * include required files to checke weather woocommerce is active or not
 */
 
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
 
 
 /*
  * check weather woocommerce is active or not
  */

 if (is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
 
          require 'includes/front-end/cart/wcap_change_frontend_coupon_form.php';
		   require 'includes/wcap_register_frontend_script_style.php';
		    require 'includes/wcap_override_checkout_coupon_template.php';
			require 'includes/admin/wcap_add_coupon_selecter_options.php';
		  
		  
		  
		  
 
     } else {
    /*
	 * Display Notice if woocommerce is not installed
	 */
      function wcap_installation_notice() {
         echo '<div class="updated" style="padding:15px; position:relative;"><a href="http://wordpress.org/plugins/woocommerce/">'.__('Woocommerce','dpta').'</a>  must be installed and activated before using this plugin. </div>';
       }
        add_action('admin_notices', 'wcap_installation_notice');
       return;

     }
	 
	/*
	 * Gets absolute path for plugin
	 */
    function wcap_plugin_path() {
  
       return untrailingslashit( plugin_dir_path( __FILE__ ) );
    }
?>