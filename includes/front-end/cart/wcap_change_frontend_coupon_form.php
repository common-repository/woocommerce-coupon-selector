<?php 
   class wcap_change_frontend_cart_coupon_form {
        public function __construct() {
		    add_action( 'woocommerce_cart_coupon', array(&$this, 'wcap_add_coupon_selector_link'));
			add_action( 'wp_ajax_show_coupon_selector_form', array(&$this,'wcap_show_coupon_selector_form') );
            add_action( 'wp_ajax_nopriv_show_coupon_selector_form', array(&$this,'wcap_show_coupon_selector_form')  );
		}
		
		public function wcap_add_coupon_selector_link() {
	
		?>
		
<div class="messagepop pop" id="wcapresponsediv">
    	  
</div>

<input type="button" class="button" href="#" id="all_coupons" value="<?php echo __('All Coupons','wcap'); ?>">

		<?php
		}
		
		public function wcap_show_coupon_selector_form() {
		 global $woocommerce;
	     $couponargs = array( 'post_type' => 'shop_coupon','posts_per_page' => -1);
         $mycoupons = get_posts( $couponargs );
	     
	  
	  ?>
	  <div class="white_content">

	  <div id="closediv" style="float:right; margin:0px 10px 0px 2px;"><a class="wcapclose"><img src="<?php echo wcap_PLUGIN_URL; ?>/assets/images/close.png" alt="<?php echo __('close','wcap'); ?>"></a></div>
	   <br />
	  <table width="100%">
	  <tr>
	  <th width="5%"></th>
	  <th width="10%"><?php echo __('Code','wcap'); ?></th>
	  <th width="75%"><?php echo __('Description','wcap'); ?></th>
	  <th width="10%"><?php echo __('Discount','wcap'); ?></th>
	  </tr>
	  <?php 
	  $couponnumber=0;
	  foreach ($mycoupons as $mycoupon) { 
	  $exclude_in_coupon_selector         = 'no';
	   if ( class_exists('WC_Coupon') ) {
            $coupon = new WC_Coupon(get_the_title($mycoupon->ID));
			$exclude_in_coupon_selector = $mycoupon->exclude_in_coupon_selector;
            $couponavailibility = $coupon->is_valid();
			$couponexpiry = $mycoupon->expiry_date;
		}
		 
		
	  if ($exclude_in_coupon_selector != "yes") {
		 
	   ?>
	  <tr>
	  <td>&emsp;<input type="radio" class="wcapradio " name="couponradiovalue" value="<?php echo get_the_title($mycoupon->ID); ?>" <?php if ($couponavailibility != 1) { echo 'disabled="disabled"'; } ?>> </th>
	  <td><span class="wcapcouponcode"><?php echo get_the_title($mycoupon->ID); ?></span></th>
	  <td><span class="wcapdescription"><?php echo $mycoupon->post_excerpt;  ?></span>
	  <?php   if (isset($couponexpiry) && ($couponexpiry != '')) { ?><span class="wcapseparator">/</span><span class="wcapexpirytext"><?php echo __('Expiry Date','wcap'); ?></span>: <span class="wcapexpirydate"><?php echo date("d-m-Y", strtotime($couponexpiry));  } ?></span>
	  <span class="wcapfreeshipping"><?php if (isset($coupon->free_shipping) && ($coupon->free_shipping == 'yes')) { ?><span class="wcapseparator">/</span><?php echo __('Free Shipping','wcap');  } ?> </span>
	   <span class="minimumspendtext"><?php if (isset($coupon->minimum_amount) && ($coupon->minimum_amount > 0)) { ?><span class="wcapseparator">/</span><?php echo __('Minimum Spend Required','wcap');   ?> </span> : <span class="minimumspendamount"><?php echo woocommerce_price($coupon->minimum_amount);  } ?></span>
	  </th>
	  <td><span class="wcapdiscount"><?php 
	  
	  if (isset($coupon->type) && ($coupon->type !='')) { $discounttype= $coupon->type; } else { $discounttype= $coupon->discount_type;}
	  switch($discounttype) {
	    case "fixed_cart":
		 echo ''.woocommerce_price($coupon->coupon_amount).'';
		break;
		
		case "percent":
		 echo ''.$coupon->coupon_amount.'%';
		break;
		
		case "fixed_product":
		 echo ''.woocommerce_price($coupon->coupon_amount).'';
		break;
		
		case "percent_product":
		 echo ''.$coupon->coupon_amount.'%';
		break;
		
		
		
	  }
	  
	  ?></span></td>

	  </tr>
	  <?php 
	  $couponnumber++;
	  }
	  
	  }
	  ?>
	  </table>
	  <?php if ( $couponnumber == 0) { ?> <center><b><?php echo __('There is no Coupon Available at this time.','wcap'); ?> </b></center> <?php } else { ?>
	  <br />
	  <center><button class="button" id="enter_coupon_code" ><?php echo __('Enter Coupon Code','wcap'); ?></button></center>
	  <br />
	  <?php } ?>
	  </div>
	  <?php
	  
		die();
		
	}
	

		
		
   }
   
   	
   
   
   
   new wcap_change_frontend_cart_coupon_form();

?>