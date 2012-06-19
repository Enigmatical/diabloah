$(document).ready(function() {
	$('.ajax-item-stat').selectmenu('disable');
	$('.ajax-item-type').selectmenu('disable');

	$('#ItemCategoryId').on('change', function(event) {
		if ($(this).val() == "") {
		
			$('.ajax-item-stat').empty();
			$('.ajax-item-stat').selectmenu('disable').val('').selectmenu('refresh');
			$('.ajax-item-type').empty();
			$('.ajax-item-type').selectmenu('disable').val('').selectmenu('refresh');
			
			$('#comparison-category').html('&nbsp;');
			$('#comparison-type').html('&nbsp;');
		
		} else {

			var user = $.current_user.id;

			$.getJSON('/ajax/get/Stat/' + $(this).val() + '/' + user, function(data) {		
				var options = '<option value=""></option>';
				$.each(data, function(key, value) {
					options = options + '<option value="' + key + '">' + value + '</option>';
				});
				$('.ajax-item-stat').empty();
				$('.ajax-item-stat').html(options).selectmenu('enable');
			});
			
			$.getJSON('/ajax/get/Type/' + $(this).val() + '/' + user, function(data) {
				var options = '<option value=""></option>';
				$.each(data, function(key, value) {
					options = options + '<option value="' + key + '">' + value + '</option>';
				});
				$('.ajax-item-type').empty();
				$('.ajax-item-type').html(options).selectmenu('enable');				
			});
						
			$('.ajax-item-stat').val('').selectmenu('refresh');
			$('.ajax-item-type').val('').selectmenu('refresh');

			$('#comparison-category').text($(this).children('option').filter(':selected').text());
			$('#comparison-type').html('&nbsp;');
		}
	});
	
	$('#ItemTypeId').on('change', function(event) {
		if ($(this).val() == "") {
		
			$('#comparison-type').html('&nbsp;');
			
		} else if ($('#ItemCategoryId').val() == 1 || $('#ItemCategoryId').val() == 2) {
		
			$('#comparison-type').text('All ' + $('#comparison-category').text() + ' Item Types');
		
		} else {
			
			$('#comparison-type').text($(this).children('option').filter(':selected').text());
			
		}
	});
	
	$('#ItemRequiredLevel').on('change', function(event) {
		if ($(this).val() == "") {
		
			$('#comparison-level-required').html('&nbsp;');
		
		} else {
		
			var high = $(this).val() - 0 + $.prefs.required_level_hi;
			var low = $(this).val() - $.prefs.required_level_lo;
			
			if (high > 60) { high = 60; }
			if (low < 1) { low = 1; }
			
			$('#comparison-level-required').text(low + ' - ' + high);
		
		}
	});
	
	$('#ItemPrimaryStat').on('change', function(event) {
		if ($(this).val() == "") {
		
			$('#comparison-stat-primary-label').text('');
			$('#comparison-stat-primary-value').text('');
			$('#comparison-stat-primary-container').hide().removeClass('active');
		
		} else {
		
			if ($('#ItemCategoryId').val() == 1 || $('#ItemCategoryId').val() == 2) {
				$('#comparison-stat-primary-label').text('DPS');
			} else {
				$('#comparison-stat-primary-label').text('Armor');
			}
			
			$('#comparison-stat-primary-value').text( $(this).val() );
			$('#comparison-stat-primary-container').show().addClass('active');
		
		}
		
		comparisonStatDivider();
	});
	
	$('.secondary-stat-value').on('change', function(event) {
		var stat = $(this).attr('rel');
	
		if ($(this).val() == "") {
			
			$('#comparison-stat-' + stat + '-label').text('');
			$('#comparison-stat-' + stat + '-value').text('');
			$('#comparison-stat-' + stat + '-container').hide().removeClass('active');
			
		} else {
		
			var value;
		
			if (isInt($(this).val())) {
				value = parseInt($(this).val() - ($(this).val() * $.prefs.stat_range));
			} else {
				value = parseFloat($(this).val() - ($(this).val() * $.prefs.stat_range)).toFixed(2);
			}
			
			$('#comparison-stat-' + stat + '-label').text($('#ItemStat' + stat + 'StatId').children('option').filter(':selected').text());
			$('#comparison-stat-' + stat + '-value').text(value);
			$('#comparison-stat-' + stat + '-container').show().addClass('active');
			
		}
		
		comparisonStatDivider();
	});
	
	$('#suggested-buyout-button').live('click', function(event) {
		
		var data = {
			user_id : $.current_user.id, 
			ah_id : $('#ItemAuctionHouse').val(),
			cate_id : $('#ItemCategoryId').val(),
			type_id : $('#ItemTypeId').val(),
			level : $('#ItemRequiredLevel').val(),
			vendor : $('#ItemVendorValue').val(),
			lowest : $('#item-lowest-buyout').val(),
			primary : $('#ItemPrimaryStat').val(),
			stats: []
		};
		
		for( var i = 0; i < 15; i++ ) {
			var label = $('#ItemStat'+i+'StatId').val();
			var value = $('#ItemStat'+i+'Value').val();
			
			if (label != '' && value != '') {
				data.stats[i] = { 'stat_id' : label, 'value' : value };
			}
		}
		
		$.post('/ajax/suggestion', data, function(results) {
			$('#suggested-buyout-results').empty();
			
			results = $.parseJSON(results);
			
			var recommended_value = 0;
			
			$.each(results, function(index, result) {
				var item = $('<div></div>').addClass('suggested-buyout');
				var label = $('<div></div>').addClass('item-label').text(result.label);
				var value = $('<div></div>').addClass('item-value').text(result.value);
				$(item).append($(label));
				$(item).append($(value));
				if (index == 0) {
					recommended_value = result.value;
					$(item).addClass('recommended');
				}
				$('#suggested-buyout-results').append($(item));
			});
			
			$('#suggested-buyout-results').show();
			
			$('#ItemBid').val( recommended_value );
			$('#ItemBuyout').val( recommended_value );
		});
		
	});
	
	$('.item-list-tab').live('click', function(event) {
		var tab = $(this).attr('rel');
		$('.item-list').hide();
		$('#'+tab).show();
	});
	
	$('.auction-button').live('click', function(event) {
		$('#ItemStatus').val(1);
		$('form').submit();
	});
	
	$('.success-button').live('click', function(event) {
		$('#ItemStatus').val(2);
		$('form').submit();
	});
	
	$('.remove-button').live('click', function(event) {
		$('#ItemStatus').val(3);
		$('form').submit();
	});
	
	$('.tab').live('click', function(event) {
		$(this).parents('.ui-page').find('.tab-section').hide();
		$(this).parents('.ui-page').find('.auction-button').hide();
		$('#' + $(this).attr('id') + '-list').show();
		$('#' + $(this).attr('id') + '-button').show();
	});
	
	$('#more-logs-button').live('click', function(event) {
		var offset = $('#cur-log-count').val();
		var user = $.current_user.id;

		$.get('/ajax/logs/' + offset + '/' + user, function(results) {
			$('#log-auctions-list-ul').append(results);
			$('#log-auctions-list-ul').listview('refresh');
			
			$('#cur-log-count').val( offset - 0 + 20 );
			if ($('#cur-log-count').val() >= $('#max-log-count')) {
				$('#more-logs-button').hide();
			}
		});
	});
	
	$('#add-another-stat').live('click', function(event) {
		$('li.another-secondary.hide').first().removeClass('hide').addClass('active');
		
		if ($('li.another-secondary.hide').length == 0) {
			$(this).parents('li').hide();
		}
	});
	
	$('.preference-toggle').live('change', function(event) {
		var user = $.current_user.id;
		var code = $(this).attr('rel');
		var val = $(this).val();
		
		if ($(this).hasClass('percentage')) {
			val = val / 100;
		}
		
		$.get('/ajax/preference/' + user + '/' + code + '/' + val, function(result) {
			//console.log(result);
		});
	});
	
	$('.save-preference').live('click', function(event) {
		var input = $(this).parents('li').find('input.preference-slider');
		var user = $.current_user.id;
		var code = $(input).attr('rel');
		var val = $(input).val();
		
		if ($(input).hasClass('percentage')) {
			val = val / 100;
		}
		
		$.get('/ajax/preference/' + user + '/' + code + '/' + val, function(result) {
			//console.log(result);
		});
	});
});

function comparisonStatDivider() {
	if ($('.item-detail-list .stat-container.active').length > 0) {
		$('#comparison-stats-list-item').show();
	} else {
		$('#comparison-stats-list-item').hide();
	}
}

function isInt(val) {
	return val % 1 === 0;
}
