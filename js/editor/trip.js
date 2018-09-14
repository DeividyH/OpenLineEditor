function atualizaListaDeTrajetos(){
	var route_id = $("[name='route_id']").val();
	var caminho = $('meta[name="base_url"]').attr('content') + "/painel/trips/" + route_id;
	var diasDeFuncionamento;
	var data;
	var dataInicioFormatada;
	var dataFimFormatada;

	$("#trips-table tbody > tr").empty();

	$.get(caminho, function(res){
		$(res).each(function(key,value){
			diasDeFuncionamento = "";
			diasDeFuncionamento += verificaDiaDeFuncionamento('Seg', value.monday);
			diasDeFuncionamento += verificaDiaDeFuncionamento('Ter', value.tuesday);
			diasDeFuncionamento += verificaDiaDeFuncionamento('Qua', value.wednesday);
			diasDeFuncionamento += verificaDiaDeFuncionamento('Qui', value.thursday);
			diasDeFuncionamento += verificaDiaDeFuncionamento('Sex', value.friday);
			diasDeFuncionamento += verificaDiaDeFuncionamento('Sab', value.saturday);
			diasDeFuncionamento += verificaDiaDeFuncionamento('Dom', value.sunday);

			data = value.start_date;
			dataInicioFormatada = data[6]+data[7]+"/"+data[4]+data[5]+"/"+data[0]+data[1]+data[2]+data[3];
			data = value.end_date;
			dataFimFormatada = data[6]+data[7]+"/"+data[4]+data[5]+"/"+data[0]+data[1]+data[2]+data[3];

			$("#trips-table tbody").append('<tr><td>' + value.trip_id + '</td>'+
											'<td>' + value.trip_short_name + '</td>'+
											'<td>' + diasDeFuncionamento + '</td>'+
											'<td>' + dataInicioFormatada + '</td>'+
											'<td>' + dataFimFormatada + '</td>'+
											'<td><button id="botao-deletar-trajeto" onClick="deletarTrajeto('+value.trip_id+')" class="btn btn-danger"><span class="fa fa-trash" aria-hidden="true"></span></button></td></tr>');
		});
	});
}

function verificaDiaDeFuncionamento(atributo, valor){
	if (valor == "1"){
		return atributo + " ";
	}
	else {
		return "";
	}
}

$("#registra-novo-trajeto").click(function(){
	if (validarNovoTrajeto()){
		var route_id = $("[name='route_id']").val();
		var trip_name = $("[name='nome_do_trajeto']").val();

		if ($("[name='segunda']").is(":checked")) monday = 1;
	    else monday = 0;

	    if ($("[name='terca']").is(":checked")) tuesday = 1;
	    else tuesday = 0;

	    if ($("[name='quarta']").is(":checked")) wednesday = 1;
	    else wednesday = 0;

	    if ($("[name='quinta']").is(":checked")) thursday = 1;
	    else thursday = 0;

	    if ($("[name='sexta']").is(":checked")) friday = 1;
	    else friday = 0;

	    if ($("[name='sabado']").is(":checked")) saturday = 1;
	    else saturday = 0;

	    if ($("[name='domingo']").is(":checked")) sunday = 1;
	    else sunday = 0;

		var start_date = $("[name='data_de_inicio']").val();
		var end_date = $("[name='data_de_termino']").val();

		var caminho = $('meta[name="base_url"]').attr('content') + "/painel/trip";

		$.ajax({
			url: caminho,
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: 'POST',
			dataType: 'json',
			data: {route_id: route_id,
					trip_name: trip_name,
					monday: monday,
					tuesday: tuesday,
					wednesday: wednesday,
					thursday: thursday,
					friday: friday,
					saturday: saturday,
					sunday: sunday,
					start_date: start_date,
					end_date: end_date
				  },

			success:function(){
				//$("#form-novo-trajeto").hide('blind');
				atualizaListaDeTrajetos();
			},
			error:function(msj){
				//abrir alerta de falha
				console.log("deu erro");
			}
		});
	}

	//cancelar efeito de redirecionar
	return false;
});

function validarNovoTrajeto(){
	var erro = 0;

	var regex_trip_name = new RegExp('^[a-zA-Z0-9 ]{5,}$');
	var regex_date = new RegExp('^[0-9]{4,4}-[0-9]{2,2}-[0-9]{2,2}$');

	//validando nome do trajeto
	if ($("[name='nome_do_trajeto']").val().match(regex_trip_name)){
		$("#form-group-trip-name").removeClass("has-error");
	} else {
		erro = 1;
		$("#form-group-trip-name").addClass("has-error");
	}

	//validando as datas
	if ($("[name='data_de_inicio']").val().match(regex_date)){
		$("#form-group-trip-start-date").removeClass("has-error");
	} else {
		erro = 1;
		$("#form-group-trip-start-date").addClass("has-error");
	}
	if ($("[name='data_de_termino']").val().match(regex_date)){
		$("#form-group-trip-departure-date").removeClass("has-error");
	} else {
		erro = 1;
		$("#form-group-trip-departure-date").addClass("has-error");
	}

	if (erro == 1){
		return false;
	} else {
		return true;
	}
}

function deletarTrajeto(id){
	var caminho = $('meta[name="base_url"]').attr('content') + "/painel/trip/" + id;

	$.ajax({
		url: caminho,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: 'DELETE',

		success:function(){
			//abrir alerta de sucesso
			atualizaListaDeTrajetos();
		},
		error:function(msj){
			//abrir alerta de falha
			console.log("deu erro");
		}
	});
}

function atualizarSelectTrajetos(){
	var route_id = $("[name='route_id']").val();
	var caminho = $('meta[name="base_url"]').attr('content') + "/painel/trips/" + route_id;

	$("#trajetos-cadastrados").empty();
	$("#trajetos-cadastrados").val(null);

	$.get(caminho, function(res){
		$(res).each(function(key,value){
			$("#trajetos-cadastrados").append($('<option>', {
		        value: value.trip_id,
		        text : value.trip_short_name
		    }));
		});

		recuperarShapes();
		atualizarPontos();
	});
}
