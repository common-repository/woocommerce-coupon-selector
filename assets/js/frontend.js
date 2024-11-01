(function($) {
  
function deselect(e) {
  $('.pop').slideFadeToggle(function() {
    e.removeClass('selected');
  });    
}

$(function() {
  $('#all_coupons').on('click', function() {
    if($(this).hasClass('selected')) {
      deselect($(this));               
    } else {
      $(this).addClass('selected');
      $('.pop').slideFadeToggle();
    }
	
	document.getElementById("all_coupons").value=wcap_frontend.wait;
	
	    $.ajax({
            data: {action: "show_coupon_selector_form"},
            type: "POST",
            url: woocommerce_params.ajax_url,
            success: function( response ) { 
			 
			 document.getElementById("wcapresponsediv").innerHTML = response;
	         document.getElementById("all_coupons").value=wcap_frontend.all_coupons;
			 
			 
			 }
        });
		 
		
    return false;
	
	
  });
  
  $(function() {
$('#enter_coupon_code').live('click',function(){
    var SelectedCoupon= $('input[name="couponradiovalue"]:checked').val();
	if ($('input[name="couponradiovalue"]:checked').length > 0) {
      document.getElementById("coupon_code").value = SelectedCoupon;
      deselect($('#all_coupons'));
	  
        return false;
   } else {
    alert(wcap_frontend.wcap_validattion);
   }
   
	return false;  
});
});


  $('.wcapclose').live('click', function() {
    deselect($('#all_coupons'));
	return false;
  });
});

$.fn.slideFadeToggle = function(easing, callback) {
  return this.animate({ opacity: 'toggle', height: 'toggle' }, 'fast', easing, callback);
};
})(jQuery);