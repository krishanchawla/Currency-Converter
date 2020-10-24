$( document ).ready(function() {
    
	$.ajax({
		url: 'https://api.exchangeratesapi.io/latest?base=INR',
		type: 'GET',
		dataType: "html",
		success: function(result) {
			var obj = jQuery.parseJSON(result);
			
			$.each( obj.rates, function( key, value ) {
			  $('#fromCode').append('<option value="'+ key +'">'+ key +'</option>');
			  $('#toCode').append('<option value="'+ key +'">'+ key +'</option>');
			});
		},
		error : function(result) {
			
		}
	});
	
	$( "#convertBtn" ).click(function(e) {
	  var amount = $('#amount').val();
	  var fromCode = $('#fromCode').val();
	  var toCode = $('#toCode').val();
	  
	  $('#result').html('');
	  
	  $.ajax({
			url: "https://api.exchangeratesapi.io/latest?base="+ fromCode +"&symbols=" + toCode,
			type: 'GET',
			dataType: "html",
			success: function(result) {
				var obj = jQuery.parseJSON(result);
				
				var result = '<center>';
				result = result + '<h3>' + amount + ' ' + fromCode + ' equals to ' + obj.rates[toCode] + ' ' + toCode + '</h3>';
				result = result + '1 ' + fromCode + ' <i class="fas fa-exchange-alt"></i> ' + obj.rates[toCode] + ' ' + toCode;
				result = result + '</center>';
				$('#result').attr('class','result').append(result);
			},
			error : function(result) {
				
			}
		});
	  
	});
	
});