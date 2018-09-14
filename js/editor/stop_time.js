function buscarTrajetos(){
	var route_id = $("[name='route_id']").val();
	var caminho = $('meta[name="base_url"]').attr('content') + "/painel/trips/" + route_id;

	$("#form-novo-horario-trajetos").empty();
	$("#form-novo-horario-trajetos").val(null);

	$.get(caminho, function(res){
		$(res).each(function(key,value){
			$("#form-novo-horario-trajetos").append($('<option>', {
		        value: value.trip_id,
		        text : value.trip_short_name
		    }));
		});

		buscarPontosParada();
	});
}

function buscarPontosParada(){
	var trip_id = $("#form-novo-horario-trajetos").val();
	var caminho = $('meta[name="base_url"]').attr('content') + "/painel/stops/" + trip_id;

	$("#form-novo-horario-paradas").empty();
	$("#form-novo-horario-paradas").val(null);

	$.get(caminho, function(res){
		$(res).each(function(key,value){
			$("#form-novo-horario-paradas").append($('<option>', {
		        value: value.stop_id,
		        text : value.stop_name
		    }));
		});

		atualizaListaDeHorarios();
	});
}

function adicionarStopTime(){
	var caminho = $('meta[name="base_url"]').attr('content') + "/painel/stoptimes";
	var trip_id = $("#form-novo-horario-trajetos").val();
	var stop_id = $("#form-novo-horario-paradas").val();
	var hora_chegada = $("[name='hora_de_chegada']").val() + ":00";
	var hora_partida = $("[name='hora_de_partida']").val() + ":00";

	$.ajax({
		url: caminho,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: 'POST',
		dataType: 'json',
		data: {trip_id: trip_id,
			stop_id: stop_id,
			hora_chegada: hora_chegada,
			hora_partida: hora_partida},

		success:function(){
			//$("#form-novo-horario").toggle("blind");
			atualizaListaDeHorarios();
		},
		error:function(msj){
			//abrir alerta de falha
			console.log(msj + "");
		}
	});

	return false;
}

function atualizaListaDeHorarios(){
	var stop_id = $("#form-novo-horario-paradas").val();
	var caminho = $('meta[name="base_url"]').attr('content') + "/painel/stoptime/" + stop_id;

	$("#stoptimes-table tbody > tr").empty();

	$.get(caminho, function(res){
		$(res).each(function(key,value){
			$("#stoptimes-table tbody").append('<tr><td>' + value.stoptimes_id + '</td>'+
											'<td>' + value.arrival_time + '</td>'+
											'<td>' + value.departure_time + '</td>'+
											'<td><button id="botao-deletar-stoptime" onClick="deletarStopTimes('+value.stoptimes_id+')" class="btn btn-danger"><span class="fa fa-trash" aria-hidden="true"></span></button></td></tr>');
		});
	});
}

function deletarStopTimes(id){
	var caminho = $('meta[name="base_url"]').attr('content') + "/painel/stoptimes/" + id;

	$.ajax({
		url: caminho,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: 'DELETE',

		success:function(){
			//abrir alerta de sucesso
			atualizaListaDeHorarios();
		},
		error:function(msj){
			//abrir alerta de falha
			console.log("deu erro");
		}
	});
}

$('#form-novo-horario-trajetos').change(function() {
    buscarPontosParada();
});

$('#form-novo-horario-paradas').change(function() {
    atualizaListaDeHorarios();
});