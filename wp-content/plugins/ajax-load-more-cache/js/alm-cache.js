var _alm_admin = _alm_admin || {};

jQuery(document).ready(function($) {
	"use strict"; 	
	
	
	/*
    *  _alm_admin.deleteCache
    *  Delete the cache, single and all
    *
    *  @since 2.0.0
    */  
	
	
	$('.alm-cache-search-wrap input').keyup(function(){
   	var val = $.trim($(this).val());
   	if(val !== ''){
   	   $('.alm-dir-listing').each(function(e) { 
      	   var el = $(this);
      	   if($('h3.dir-title', el).text().match(val) || $('ul.cache-details a', el).text().match(val)) {
      	     el.show();
      	   }else{
      	      el.hide();
      	   }
   	   });
   	}else{
      	$('.alm-dir-listing').show();
   	}
   	
   	
	});
	
	
	/*
    *  _alm_admin.deleteCache
    *  Delete the cache, single and all
    *
    *  @since 2.0.0
    */  
   
   _alm_admin.deleteCache = function(cache, btn, container) {	
   		
		$.ajax({
			type: 'POST',
			url: alm_admin_localize.ajax_admin_url,
			data: {
				action: 'alm_delete_cache',
				cache: cache, 
				nonce: alm_admin_localize.alm_admin_nonce,
			},
			success: function(response) {	
            container.slideUp(250, function(){
               container.removeClass('deleting').remove(); 
               
               if($('.alm-dir-listing').length === 0){ // If cache is now empty, redirect to cache dashboard.
                  window.location = 'admin.php?page=ajax-load-more-cache';
               }           
            });
			},
			error: function(xhr, status, error) {
			   alert("The was an error and the cache could not be deleted.");
			}
      });
        
   }
   
   // Delete single cache item
   $(document).on('click', '.alm-dir-listing .delete', function(e){
      
   	var btn = $(this),
   	    cache = btn.data('id'),
   	    container = btn.closest('.alm-dir-listing'),
   	    msg = $('#alm-cache').data('msg');
      var r = confirm(msg);
      if (r == true && !$(this).hasClass('deleting')) {	
   	   e.stopPropagation()
         container.addClass('deleting');							
         _alm_admin.deleteCache(cache, btn, container);
   	}else{
   	   e.stopPropagation()
      	e.preventDefault();
   	}
   });
   
   
   // Delete All cache - does a postback to server
   $(document).on('click', 'form#delete-all-cache button', function(e){
   	var container = $('form#delete-all-cache'),
   	    msg = container.data('msg');
      var r = confirm(msg);
      if (!r) {
         e.preventDefault();				
   	}else{
         container.addClass('deleting');
   	}
   });
	
	
	
	
	
});