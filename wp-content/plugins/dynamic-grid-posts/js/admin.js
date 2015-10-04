(function($, undefined) {
	var settingsChanged = false, hasTitle = false, hasShortcode = false;
	
	$(document).ready(function() {
		// INIT
		init_tabs();
		init_radio_groups();
		init_yellow_fade();
		form_inline_validation();
		validate_form();
		form_interactivity();
		preview_tab_warning();
	});
	
	// Init functions
	
	function init_tabs() {
		if ($('.ndd-tab-group').length == 0) return;
		
		$('.preload-active').removeClass('preload-active');
		
		var listItems = $('.ndd-tab-group > ul li');
		var tabs = $('.ndd-tab-group > .ndd-tab');
		
		var c = 0;
		listItems.each(function() {
			$(this).attr('id', 'ndd-tab-title-' + c);
			c++;
		});
		
		c = 0;
		tabs.each(function() {
			$(this).attr('id', 'ndd-tab-content-' + c);
			c++;
		});
		
		$('.ndd-tab-group > ul li').on('click', function() {
			listItems.removeClass('active');
			tabs.removeClass('active');
			
			$(this).addClass('active');
			var id = $(this).attr('id').replace('ndd-tab-title-', '');
			$('#ndd-tab-content-' + id).addClass('active');
		});
	}
	function init_radio_groups() {
		if ($('.ndd-radio-group').length == 0) return;
		
		var ctrl = false;
		
		$('.ndd-radio-group > ul li').on('click', function() {
			if (!ctrl || $(this).closest('.ndd-select-multiple').length == 0) {
				$(this).siblings('.active').removeClass('active');
			}
			$(this).addClass('active');
		});
		
		$(document).on('keydown', function(e) {
			if (e.which == 16) {
				ctrl = true;
			}
		});
		$(document).on('keyup', function(e) {
			ctrl = false;
		});
	}
	function init_yellow_fade() {
		$('.ndd-new-row').addClass('ndd-new-row-animate');
		setTimeout(function() {
			$('.ndd-new-row').removeClass('ndd-new-row-animate').removeClass('ndd-new-row');
		}, 2000);
	}
	
	function go_to_tab(tabWrap) {
		// Show tab
		$('.ndd-tab').not(tabWrap).removeClass('active');
		tabWrap.addClass('active');
		
		// Switch active states
		$('.ndd-tab-group ul li').removeClass('active');
		var id = tabWrap.attr('id').replace('ndd-tab-content-', '');
		$('#ndd-tab-title-' + id).addClass('active');
	}
	function show_error_for(field, message) {
		field.addClass('ndd-has-error');
		field.closest('tr').addClass('ndd-error-row');
		field.after('<div class="ndd-error-field">' + message + '</div>');
	}
	function remove_error_for(field) {
		if (!field.hasClass('ndd-has-error')) return;
		field.removeClass('ndd-has-error');
		field.closest('tr').removeClass('ndd-error-row');
		field.next().remove();
	}
	function form_inline_validation() {
		var title = /^[A-Za-z0-9_ ]{3,20}$/;
		var shortcode = /^[A-Za-z0-9_]{3,20}$/;
		
		$('#width, #height, #cols, #min_rows, #max_rows, #padding, #interval, #speed').on('change', function() {
			if (!isNumeric($(this).val())) {
				show_error_for($(this), 'You must enter a number!');
			} else {
				remove_error_for($(this));
			}
			
			settingsChanged = true;
		});
		
		$('#title').on('change', function() {
			if (!title.test($(this).val())) {
				show_error_for($(this), 'Please enter between 3 and 20 alphabets or numbers. Spaces are allowed. No special characters except underscore("_").');
			} else {
				remove_error_for($(this));
			}
			
			settingsChanged = true;
		});
		$('#shortcode').on('change', function() {			
			if (!shortcode.test($(this).val())) {
				show_error_for($(this), 'Please enter between 3 and 20 alphabets or numbers. No spaces. No special characters except underscore("_").');
			} else {
				remove_error_for($(this));
			}
			
			settingsChanged = true;
			
		});
	}
	function validate_form() {
		$('#save_options').on('click', function(e) {
			process_layout_form();
			// e.preventDefault();
			// return false;

			if (!$('#shortcode').val()) {
				show_error_for($('#shortcode'), 'Please enter between 3 and 20 alphabets or numbers. Spaces are allowed. No special characters except underscore("_").');
				
				if (!$('#title').val()) {
					show_error_for($('#title'), 'Please enter between 3 and 20 alphabets or numbers. Spaces are allowed. No special characters except underscore("_").');
					e.preventDefault();
					return false;
				} else {
					remove_error_for($(this));
				}
				
				e.preventDefault();
				return false;
			} else {
				remove_error_for($(this));
			}
			
			if (!$('#title').val()) {
				show_error_for($('#title'), 'Please enter between 3 and 20 alphabets or numbers. Spaces are allowed. No special characters except underscore("_").');
				e.preventDefault();
				return false;
			} else {
				remove_error_for($(this));
			}
			
			if ($('.ndd-has-error').length != 0) {
				go_to_tab($('.ndd-has-error').first().closest('.ndd-tab'));
				$('.as .updated').remove();
				$('.as header').append('<div class="error">There was an error validating the settings!</div>');
				
				e.preventDefault();
				return false;
			}
		});
	}
	function form_interactivity() {
		$('#auto_width').on('change', function() {
			if ($(this).attr('checked') == 'checked') {
				$('#width').attr('disabled', '');
			} else {
				$('#width').removeAttr('disabled');
			}
			
			settingsChanged = true;
		});
		
		// Step 1		
		$('#most-recent-posts').on('click', function() {
			$('.ndd-content-step-2').add('.ndd-content-step-3').add('.ndd-content-step-4').add('.ndd-content-step-5').removeClass('active');
			$('#select-feed-source').addClass('active').find('li.active').removeClass('active');
			
			settingsChanged = true;
		});
		$('#selected-posts').on('click', function() {
			$('.ndd-content-step-2').add('.ndd-content-step-3').add('.ndd-content-step-4').add('.ndd-content-step-5').removeClass('active');
			$('#select-posts').addClass('active').find('li.active').removeClass('active');
			
			settingsChanged = true;
		});
		
		// Step 2		
			// Most recent
			$('#select-category-button').on('click', function() {
				$('.ndd-content-step-3').add('.ndd-content-step-4').add('.ndd-content-step-5').removeClass('active');
				$('#select-category').addClass('active').find('li.active').removeClass('active');
				
				settingsChanged = true;
			});
			$('#select-tag-button').on('click', function() {
				$('.ndd-content-step-3').add('.ndd-content-step-4').add('.ndd-content-step-5').removeClass('active');
				$('#select-tag').addClass('active').find('li.active').removeClass('active');
				
				settingsChanged = true;
			});
			$('#select-custom-tax-button').on('click', function() {
				$('.ndd-content-step-3').add('.ndd-content-step-4').add('.ndd-content-step-5').removeClass('active');
				$('#select-custom-tax').addClass('active').find('li.active').removeClass('active');
				
				settingsChanged = true;
			});
			
			// Selected
			$('#select-posts li').on('click', function() {
				$('.ndd-content-step-3').add('.ndd-content-step-4').add('.ndd-content-step-5').removeClass('active');
				$('#select-posts-number-posts').addClass('active').find('li.active').removeClass('active');	
				
				settingsChanged = true;		
			});
		
		// Step 3		
			// Category, tag
			$('#select-category li, #select-tag li').on('click', function() {
				$('.ndd-content-step-4').add('.ndd-content-step-5').removeClass('active');
				$('#select-number-posts').addClass('active').find('li.active').removeClass('active');
				
				settingsChanged = true;
			});
			
			// Select custom tax
			$('#select-custom-tax li').on('click', function() {
				// Show list of terms for selected category
				$('.taxonomy-terms-list').removeClass('active');
				$('#taxonomy-terms-list-' + $(this).attr('id').replace('taxonomy-button-', '')).addClass('active');
				
				// Show step 4
				$('.ndd-content-step-4').add('.ndd-content-step-5').removeClass('active');
				$('#select-custom-terms').addClass('active').find('li.active').removeClass('active');
				
				settingsChanged = true;
			});
		
		// Step 4		
			// Select custom tax term
			$('#select-custom-terms').on('click', function() {
				$('.ndd-content-step-5').removeClass('active');
				$('#select-custom-number-posts').addClass('active').find('li.active').removeClass('active');
				
				settingsChanged = true;
			});
	}
	function process_layout_form() {
		var steps = new Array();
		steps[0] = $('.ndd-content-step-1.active');
		steps[1] = $('.ndd-content-step-2.active');
		steps[2] = $('.ndd-content-step-3.active');
		steps[3] = $('.ndd-content-step-4.active');
		steps[4] = $('.ndd-content-step-5.active');
		
		var string = '';
		
		// POSTS MODE
		if (steps[1].attr('id') == 'select-posts') {
			
			// Set query mode
			$('#query-mode').val('posts');
			
			// Clear input value
			$('#query-post-ids').val('');
			
			$(steps[1]).find('li').each(function() {
				if ($(this).hasClass('active')) {
					$('#query-post-ids').val($('#query-post-ids').val() + $(this).attr('data-id') + ' ');
				}
			});
			
			$('#query-number-posts').val(steps[2].find('li.active').html());
		}
		
		// TAXONOMY MODE
		if (steps[1].attr('id') == 'select-feed-source') {
			$('#query-mode').val('tax');
			
			if (steps[2].attr('id') == 'select-category') {
				// Set tax to "category"
				$('#query-tax-name').val('category');
				
				// Set terms
				$('#query-tax-terms').val('');
				$(steps[2]).find('li').each(function() {
					if ($(this).hasClass('active')) {
						$('#query-tax-terms').val($('#query-tax-terms').val() + $(this).attr('data-id') + '%');
					}
				});
				
				// Set posts per page
				$('#query-number-posts').val(steps[3].find('li.active').html());
			}
			if (steps[2].attr('id') == 'select-tag') {
				// Set tax to "tag"
				$('#query-tax-name').val('post_tag');
				
				// Set terms
				$('#query-tax-terms').val('');
				$(steps[2]).find('li').each(function() {
					if ($(this).hasClass('active')) {
						$('#query-tax-terms').val($('#query-tax-terms').val() + $(this).attr('data-name') + '%');
					}
				});
				
				// Set posts per page
				$('#query-number-posts').val(steps[3].find('li.active').html());
			}
			if (steps[2].attr('id') == 'select-custom-tax') {
				// Set tax to selected taxonomy
				$('#query-tax-name').val(steps[2].find('li.active').html());
				
				// Set terms
				$('#query-tax-terms').val('');
				$(steps[3]).find('li').each(function() {
					if ($(this).hasClass('active')) {
						$('#query-tax-terms').val($('#query-tax-terms').val() + $(this).attr('data-id') + '%');
					}
				});
				
				// Set posts per page
				$('#query-number-posts').val(steps[4].find('li.active').html());
			}
		}
	}
	function preview_tab_warning() {
		$('.preview-tab').on('click', function() {
			if (settingsChanged) {
				$('.preview-tab-c').prepend('<div class="greetings">Oops! You need to save before the changes can take effect!</div>');
			}
		});
	}
	
	// Utility
	function isNumeric(num) {
	    return !isNaN(num);
	}
	
})(jQuery);