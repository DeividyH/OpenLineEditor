$("#salva-info-linha").click(function(){
	var route_id = $("[name='route_id']").val();
	var agency = $("[name='agencia']").val();
	var route_short_name = $("[name='nome_abreviado_da_linha']").val();
	var route_long_name = $("[name='nome_completo_da_linha']").val();

	var caminho = $('meta[name="base_url"]').attr('content') + "/painel/route/" + route_id;

	$.ajax({
		url: caminho,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: 'PUT',
		dataType: 'json',
		data: {agencia: agency, nome_abreviado: route_short_name, nome_completo: route_long_name},

		success:function(){
			alert("Informações atualizadas com sucesso.")
		},
		error:function(msj){
			//abrir alerta de falha
			console.log("deu erro");
		}
	});

	//cancelar efeito de redirecionar
	return false;
});

function liberarLinha(){
	var route_id = $("[name='route_id']").val();

	var caminho = $('meta[name="base_url"]').attr('content') + "/painel/route/unlock/" + route_id;

	$.ajax({
		url: caminho,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: 'PUT',

		success:function(){
			//
		},
		error:function(msj){
			//abrir alerta de falha
			console.log("deu erro");
		}
	});

	//cancelar efeito de redirecionar
	return false;
}
