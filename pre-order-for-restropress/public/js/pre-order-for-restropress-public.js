jQuery(document).ready(function($) {
	jQuery('body').on('change', '.rpress_get_delivery_dates', function (e) {
		e.preventDefault();
  
		var _self = $(this);
		var foodItemId = _self.attr('data-food-id');
  
		if ($('.rpress-tabs-wrapper')
		  .find('.nav-item.active a')
		  .length > 0) {
		  var serviceType = $('.rpress-tabs-wrapper')
			.find('.nav-item.active a')
			.attr('data-service-type');
		  var serviceLabel = $('.rpress-tabs-wrapper')
			.find('.nav-item.active a')
			.text()
			.trim();
		  //Store the service label for later use
		  window.localStorage.setItem('serviceLabel', serviceLabel);
		}
  
		var serviceTime = _self.parents('.rpress-tabs-wrapper')
		  .find('.delivery-settings-wrapper.active .rpress-hrs')
		  .val();
		var serviceTimeText = _self.parents('.rpress-tabs-wrapper')
		  .find('.delivery-settings-wrapper.active .rpress-hrs option:selected')
		  .text();
		var serviceDate = _self.parents('.rpress-tabs-wrapper')
		  .find('.delivery-settings-wrapper.active .rpress_get_delivery_dates')
		  .val();
  
		if (serviceTime === undefined && (rpress_scripts.pickup_time_enabled == 1 && serviceType == 'pickup' || rpress_scripts.delivery_time_enabled == 1 && serviceType == 'delivery')) {
		  tata.error(rp_scripts.error, select_time_error + serviceLabel);
		  return false;
		}
  
  
		var sDate = serviceDate === undefined ? rpress_scripts.current_date : serviceDate;
  
		var action = 'rpress_check_service_slot';
		var data = {
		  action: action,
		  serviceType: serviceType,
		  serviceTime: serviceTime,
		  service_date: sDate,
  
		};
  
		$.ajax({
		  type: "POST",
		  data: data,
		  dataType: "json",
		  url: rpress_scripts.ajaxurl,
		  xhrFields: {
			withCredentials: true
		  },
		  beforeSend: (jqXHR, status) => {
			_self.addClass('rp-loading');
			_self.find('.rp-ajax-toggle-text')
			  .addClass('rp-text-visibility');
		  },
		  complete: (jqXHR, oject) => {
			_self.removeClass('rp-loading');
			_self.find('.rp-ajax-toggle-text')
			  .removeClass('rp-text-visibility');
		  },
		  success: function (response) {
			_self.removeClass('rp-loading');
			_self.find('.rp-ajax-toggle-text')
			  .removeClass('rp-text-visibility');
  
			if (response.status == 'error') {
			  _self.text(rpress_scripts.update);
			  tata.error(rp_scripts.error, response.msg);
			  return false;
			} else {
			  rp_setCookie('service_type', serviceType, rp_scripts.expire_cookie_time);
			  if (serviceDate === undefined) {
				rp_setCookie('service_date', rpress_scripts.current_date, rp_scripts.expire_cookie_time);
				rp_setCookie('delivery_date', rpress_scripts.display_date, rp_scripts.expire_cookie_time);
			  } else {
				var delivery_date = $('.delivery-settings-wrapper.active .rpress_get_delivery_dates option:selected')
				  .text();
				rp_setCookie('service_date', serviceDate, rp_scripts.expire_cookie_time);
				rp_setCookie('delivery_date', delivery_date, rp_scripts.expire_cookie_time);
			  }
  
			  if (serviceTime === undefined) {
				rp_setCookie('service_time', '', rp_scripts.expire_cookie_time);
			  } else {
				rp_setCookie('service_time', serviceTime, rp_scripts.expire_cookie_time);
				rp_setCookie('service_time_text', serviceTimeText, rp_scripts.expire_cookie_time);
			  }
  
			  $('#rpressModal')
				.removeClass('show-service-options');
  
			  if (foodItemId) {
  
				$('#rpressModal')
				  .addClass('loading');
				$('#rpress_fooditem_' + foodItemId)
				  .find('.rpress-add-to-cart')
				  .trigger('click');
				MicroModal.close('rpressModal');
  
			  } else {
  
				MicroModal.close('rpressModal');
  
				if (typeof serviceType !== 'undefined' && typeof serviceTime !== 'undefined') {
  
				  $('.delivery-wrap .delivery-opts')
					.html('<span class="delMethod">' + serviceLabel + ',</span> <span class="delTime"> ' + Cookies.get('delivery_date') + ', ' + serviceTimeText + '</span>');
  
				} else if (typeof serviceTime == 'undefined') {
  
				  $('.delivery-items-options')
					.find('.delivery-opts')
					.html('<span class="delMethod">' + serviceLabel + ',</span> <span class="delTime"> ' + Cookies.get('delivery_date') + '</span>');
				}
			  }
		
			  //Trigger checked slot event so that it can be used by theme/plugins
			  $(document.body)
				.trigger('rpress_checked_slots', [response]);
  
			  //If it's checkout page then refresh the page to reflect the updated changes.
			  if (rpress_scripts.is_checkout == '1')
				window.location.reload();
			}
		  }
  
		});
	  });
});