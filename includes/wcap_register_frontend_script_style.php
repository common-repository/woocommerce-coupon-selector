<?php
class wcap_register_frontend_script_styles {
      public function __construct() {
       add_action( 'wp_enqueue_scripts', array(&$this,'wcap_register_my_scripts' ));
      }
	  
	  
      public function wcap_register_my_scripts() {
	     global $post,$product;
		 
		  wp_register_style( 'wcap_frontend', wcap_PLUGIN_URL . 'assets/css/frontend.css' );
		  
		  wp_register_script( 'wcap_frontend', wcap_PLUGIN_URL . 'assets/js/frontend.js' ,array('jquery'));
		  
		  $translation_array = array(  'wait' => __( 'loading...' ,'wcap'),'all_coupons' => __( 'All Coupons' ,'wcap'),'wcap_validattion' => __( 'No Coupon Selected' ,'wcap'),'ajax_loader' => '<center><img src="'.wcap_PLUGIN_URL .'/assets/images/ajax-loader.gif" id="wcaploading" alt="loading..." ></center>', );
          wp_localize_script( 'wcap_frontend', 'wcap_frontend', $translation_array );
		  
		if (is_cart() || is_checkout()) {
		  wp_enqueue_script('wcap_frontend');
		  wp_enqueue_style('wcap_frontend');
		}
	  }

}

new wcap_register_frontend_script_styles();
?>