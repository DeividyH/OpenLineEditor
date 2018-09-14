$(document).ready(function(){
	var select = $("[name='agencia']");
	var route = $('meta[name="base_url"]').attr('content') + "/painel/agencies";

	$.get(route, function(res){
		$(res).each(function(key,value){
			select.append($('<option>', { 
		        value: value.agency_id,
		        text : value.agency_name 
		    }));
		});
	});
});