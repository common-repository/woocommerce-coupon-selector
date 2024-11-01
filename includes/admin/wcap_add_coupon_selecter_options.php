<?php
class wcap_add_coupon_selector_options {
    
	public function __construct() {
	  add_action('woocommerce_coupon_options', array($this, 'wcap_coupon_selector_options'));
	  add_action('woocommerce_coupon_options_save', array($this, 'wcap_coupon_selector_options_save'));
	 
	}
	
	public function wcap_coupon_selector_options() {
	            //exclude coupon from coupon selector
				woocommerce_wp_checkbox( array( 'id' => 'exclude_in_coupon_selector', 'label' => __( 'Exclude in Coupon Selector', 'wcap' ), 'description' => sprintf(__( 'Check this box if you do not want to show this coupon in coupon selector coupons list.', 'wcap' )) ) );
	}
	
	public function wcap_coupon_selector_options_save($post_id) {
	   $exclude_in_coupon_selector         = isset( $_POST['exclude_in_coupon_selector'] ) ? 'yes' : 'no';
	   update_post_meta( $post_id, 'exclude_in_coupon_selector', $exclude_in_coupon_selector );
	}
}

new wcap_add_coupon_selector_options();
?>