jQuery(document).on('focus',".ga-date-picker", function() {
	jQuery(this).datepicker({ "dateFormat" : 'yy-mm-d', "showAnim": 'slideDown', });
});	

jQuery( document ).ready(function() {	
	jQuery(document).on("submit", "form#provider-schedule-update", function(e) {
		e.preventDefault();
		var modal_wrapper = jQuery(this);	
		modal_wrapper.parent('.ga_modal_container').find('.modal_overlay').show();	
		var data = jQuery("form#provider-schedule-update").serialize();
		
		jQuery.post(ga_calendar_schedule_obj.ajax_url, data, function(response) {
			if ( typeof response !== 'undefined' ) {			
				modal_wrapper.parent('.ga_modal_container').find('.modal_overlay').hide();
				
				if( response.success == true ) {
	                jQuery("form#provider-schedule-update").html(response.data['html']);
				}		
	            jQuery("form#provider-schedule-update .ajax-response").html(response.data['message']);
			}	
		}).fail(function() {
			jQuery("form#provider-schedule-update .ajax-response").html('<div class="ga_alert ga_alert_danger">Error sending form!</div>');
		});	
	});		
	
	
	/**
	 * ADD NEW BREAK SLOT
	 */		
	jQuery('body').on('click', '.schedule_day .schedule_day_container .ga_add_break', function() {
        var cloned = jQuery(this).parent('.schedule_day_container').find('.schedule_week_breaks .break_time').first().clone().removeAttr( 'style' );
		jQuery(this).parent('.schedule_day_container').find('.schedule_week_breaks').append( cloned );	
    });		
	
	
	/**
	 * REMOVE BREAK SLOT
	 */	   
	jQuery('body').on('click', '.break_time .break-delete', function() {
        jQuery(this).parent('.break_time').fadeOut(150, function() {
			jQuery(this).remove();
		}); 
    });		
	
	
	/**
	 * ADD NEW HOLIDAY
	 */		
	jQuery('body').on('click', '.provider_holidays .ga_add_holiday', function() {
        var cloned = jQuery(this).parent('.provider_holidays').find('#provider_holidays .holiday').first().clone().removeAttr( 'style' );
		jQuery(this).parent('.provider_holidays').find('#provider_holidays').append( cloned );
    });		
	

	/**
	 * REMOVE HOLIDAY
	 */	   
	jQuery('body').on('click', '#provider_holidays .holiday .holiday-delete', function() {
        jQuery(this).parent('.holiday').fadeOut(150, function() {
			jQuery(this).remove();
		}); 
    });	
	
	/**
	 * Show Modal
	 */		
	jQuery('body').on('click', '#provider-schedule .ga-manage-schedule', function(e) {
		e.preventDefault();	
		jQuery('html, body').addClass('ga_modal_open');
		jQuery('#ga_schedule_model').removeClass('ga-hidden');
	});	
	
	/**
	 * Manage Schedule
	 */		
	jQuery('body').on('click', '#ga_schedule_tabs span', function() {
		var section_id = jQuery(this).attr('section_go');
		jQuery('#ga_schedule_tabs span').removeClass('active');
		jQuery(this).addClass('active');
		jQuery('#ga_schedule_content .ga_schedule_content').addClass('ga-hidden');
		jQuery('#' + section_id).removeClass('ga-hidden');
    });		
	
	/**
	 * Hide Modal
	 */		
	jQuery('body').on('click', '#ga_schedule_model .ga_modal_wrapper .ga_close', function(e) {
		e.preventDefault();	
		jQuery(this).parents('#ga_schedule_model').fadeIn(300, function() {
			jQuery(this).addClass('ga-hidden');
			jQuery('html, body').removeClass('ga_modal_open');
		});	
		
	});		
	
}); // end doc ready