function prepararFormularioNovoPonto(lat, lng){
	if (iniciouCriacaoPonto == false){
		iniciouCriacaoPonto = true;

		stopMarkers.push(new L.marker([lat, lng], {icon: busIcon}).addTo(map));

		$("[name=nome_do_ponto]").val("");
		$("[name=latitude_do_ponto]").val(lat);
		$("[name=longitude_do_ponto]").val(lng);

		$("#form-novo-ponto").toggle("blind");
	}
}

function adicionarStop(){
	var caminho = $('meta[name="base_url"]').attr('content') + "/painel/stop";
	var trip_id = $("#trajetos-cadastrados").val();
	var latitude_ponto = $("[name='latitude_do_ponto']").val();
	var longitude_ponto = $("[name='longitude_do_ponto']").val();
	var nome_ponto = $("[name='nome_do_ponto']").val();

	$.ajax({
		url: caminho,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: 'POST',
		dataType: 'json',
		data: {trip_id: trip_id,
			latitude_ponto: latitude_ponto,
			longitude_ponto: longitude_ponto,
			nome_ponto: nome_ponto},

		success:function(){
			$("#form-novo-ponto").toggle("blind");
			iniciouCriacaoPonto = false;
			atualizarPontos();
		},
		error:function(msj){
			//abrir alerta de falha
			console.log(msj + "");
		}
	});

	return false;
}

function cancelarPonto(){
	iniciouCriacaoPonto = false;
	map.removeLayer(stopMarkers.pop());
	$("#form-novo-ponto").toggle("blind");

	return false;
}

function atualizarPontos(){
	var trip_id = $("#trajetos-cadastrados").val();
	var caminho = $('meta[name="base_url"]').attr('content') + "/painel/stops/" + trip_id;

	$.get(caminho, function(res){
		limparStopMarkers();

		$(res).each(function(key,value){
			stopMarkers.push(new L.marker([value.stop_lat, value.stop_lon], {icon: busIcon}).bindPopup(
				"<b><font size='3'>" + value.stop_name + "</font></b><BR><BR>" +
				"<center><button class='btn btn-danger' onClick='deletarPonto("+ value.stop_id +")'>" +
					"<span class='fa fa-trash' aria-hidden='true'></span>" +
				"</button></center>"
				));
		});

		plotarStopMarkers();
	});
}

function deletarPonto(stop_id){
	var caminho = $('meta[name="base_url"]').attr('content') + "/painel/stop/" + stop_id;

	$.ajax({
		url: caminho,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: 'DELETE',

		success:function(){
			atualizarPontos();
		},
		error:function(msj){
			//abrir alerta de falha
			console.log(msj);
		}
	});
}

function limparStopMarkers(){
	stopMarkers.forEach(function(marker){
		map.removeLayer(marker);
	});

	stopMarkers = [];
}

function plotarStopMarkers(){
	stopMarkers.forEach(function(marker){
		marker.addTo(map);
	});
}
