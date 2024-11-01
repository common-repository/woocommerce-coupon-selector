<?php
class wcap_override_variable_template {
    /*
	 * Construct 
	 */
    public function __construct() {
	
     add_action( 'woocommerce_locate_template', array(&$this,'wcap_override_default_coupon_checkout_template'), 10, 3 );
    }
    
	/*
	 * Overrides core variables template
	 * since 1.0.0
	 */
	public function wcap_override_default_coupon_checkout_template( $template, $template_name, $template_path ) {
    
	 if (  strstr($template, 'form-coupon.php') ) {
       $template = wcap_plugin_path() . '/templates/checkout/form-coupon.php';
      }
    
  
    
    return $template;
    
    }

   }
   
   
   

new wcap_override_variable_template();
?>